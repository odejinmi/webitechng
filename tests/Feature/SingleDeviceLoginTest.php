<?php

namespace Tests\Feature;

use App\Http\Middleware\EnsureLatestWebSession;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Session\ArraySessionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SingleDeviceLoginTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite.database', ':memory:');
    }

    private function setUpAuthSchema(): void
    {
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('ts')->default(0);
            $table->tinyInteger('tv')->default(1);
            $table->string('latest_web_session_id', 191)->nullable();
            $table->unsignedBigInteger('latest_api_token_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('tokenable_type', 191);
            $table->unsignedBigInteger('tokenable_id');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index(['tokenable_type', 'tokenable_id']);
        });
    }

    public function test_old_web_session_gets_logged_out()
    {
        $this->setUpAuthSchema();

        $userId = DB::table('users')->insertGetId([
            'email' => 'a@example.com',
            'username' => 'usera',
            'password' => bcrypt('secret'),
            'latest_web_session_id' => 'new-session',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::findOrFail($userId);
        Auth::login($user);

        $request = Request::create('/user/dashboard', 'GET');
        $session = new Store('test', new ArraySessionHandler(120));
        $session->setId('old-session');
        $session->start();
        $session->setId('old-session');
        $request->setLaravelSession($session);

        $middleware = new EnsureLatestWebSession();
        $response = $middleware->handle($request, fn () => response('ok', 200));

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_latest_web_session_is_allowed()
    {
        $this->setUpAuthSchema();

        $userId = DB::table('users')->insertGetId([
            'email' => 'b@example.com',
            'username' => 'userb',
            'password' => bcrypt('secret'),
            'latest_web_session_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::findOrFail($userId);
        Auth::login($user);

        $request = Request::create('/user/dashboard', 'GET');
        $session = new Store('test', new ArraySessionHandler(120));
        $session->start();
        $currentId = $session->getId();
        $request->setLaravelSession($session);
        DB::table('users')->where('id', $userId)->update(['latest_web_session_id' => $currentId]);
        $user->refresh();

        $middleware = new EnsureLatestWebSession();
        $response = $middleware->handle($request, fn () => response('ok', 200));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('ok', $response->getContent());
    }

    public function test_api_token_rotation_leaves_only_latest_token()
    {
        $this->setUpAuthSchema();

        $userId = DB::table('users')->insertGetId([
            'email' => 'c@example.com',
            'username' => 'userc',
            'password' => bcrypt('secret'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::findOrFail($userId);

        $old = $user->createToken('auth_token');
        $user->latest_api_token_id = $old->accessToken->id;
        $user->save();

        $user->tokens()->delete();
        $new = $user->createToken('auth_token');
        $user->latest_api_token_id = $new->accessToken->id;
        $user->save();

        $this->assertEquals(1, (int) DB::table('personal_access_tokens')->where('tokenable_id', $userId)->count());
        $this->assertEquals($new->accessToken->id, (int) $user->fresh()->latest_api_token_id);
    }
}
