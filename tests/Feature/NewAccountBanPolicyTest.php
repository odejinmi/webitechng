<?php

namespace Tests\Feature;

use App\Constants\Status;
use App\Services\WalletLedgerService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class NewAccountBanPolicyTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite.database', ':memory:');
    }

    private function setUpSchema(): void
    {
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->decimal('balance', 28, 8)->default(0);
            $table->decimal('ref_balance', 28, 8)->default(0);
            $table->tinyInteger('status')->default(Status::USER_ACTIVE);
            $table->timestamps();
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('amount', 28, 8)->default(0);
            $table->decimal('balance_before', 28, 8)->nullable();
            $table->decimal('balance_after', 28, 8)->nullable();
            $table->decimal('post_balance', 28, 8)->default(0);
            $table->decimal('charge', 28, 8)->default(0);
            $table->string('trx_type', 2)->nullable();
            $table->text('details')->nullable();
            $table->string('trx', 191)->nullable();
            $table->string('remark', 191)->nullable();
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

    public function test_new_user_gets_banned_on_debit_above_5000()
    {
        $this->setUpSchema();

        $userId = DB::table('users')->insertGetId([
            'balance' => 20000,
            'ref_balance' => 0,
            'status' => Status::USER_ACTIVE,
            'created_at' => now()->subDays(10),
            'updated_at' => now()->subDays(10),
        ]);

        $service = app(WalletLedgerService::class);

        try {
            $service->debitWithTransaction($userId, 'main', 6000, [
                'amount' => 6000,
                'charge' => 0,
                'details' => 'test debit',
                'trx' => 'trx-ban-1',
                'remark' => 'test',
            ]);
            $this->fail('Expected ban exception.');
        } catch (\RuntimeException $e) {
            $this->assertStringContainsString('Account banned', $e->getMessage());
        }

        $this->assertEquals(Status::USER_BAN, (int) DB::table('users')->where('id', $userId)->value('status'));
        $this->assertEquals(20000.0, (float) DB::table('users')->where('id', $userId)->value('balance'));
        $this->assertEquals(0, (int) DB::table('transactions')->count());
    }

    public function test_old_user_is_not_banned_on_debit_above_5000()
    {
        $this->setUpSchema();

        $userId = DB::table('users')->insertGetId([
            'balance' => 20000,
            'ref_balance' => 0,
            'status' => Status::USER_ACTIVE,
            'created_at' => now()->subDays(120),
            'updated_at' => now()->subDays(120),
        ]);

        $service = app(WalletLedgerService::class);
        $service->debitWithTransaction($userId, 'main', 6000, [
            'amount' => 6000,
            'charge' => 0,
            'details' => 'test debit',
            'trx' => 'trx-ok-1',
            'remark' => 'test',
        ]);

        $this->assertEquals(Status::USER_ACTIVE, (int) DB::table('users')->where('id', $userId)->value('status'));
        $this->assertEquals(14000.0, (float) DB::table('users')->where('id', $userId)->value('balance'));
        $this->assertEquals(1, (int) DB::table('transactions')->count());
    }
}
