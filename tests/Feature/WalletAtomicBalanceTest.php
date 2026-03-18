<?php

namespace Tests\Feature;

use App\Services\WalletLedgerService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class WalletAtomicBalanceTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite.database', ':memory:');
    }

    private function setUpWalletSchema(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->decimal('balance', 28, 8)->default(0);
            $table->decimal('ref_balance', 28, 8)->default(0);
            $table->tinyInteger('status')->default(1);
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
    }

    public function test_wallet_debit_and_credit_transactions_match_saved_balance()
    {
        $this->setUpWalletSchema();

        $userId = DB::table('users')->insertGetId([
            'balance' => 200,
            'ref_balance' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $service = app(WalletLedgerService::class);

        $service->debitWithTransaction($userId, 'main', 150, [
            'amount' => 150,
            'charge' => 0,
            'details' => 'debit',
            'trx' => 'trx-debit-1',
            'remark' => 'test',
        ]);

        $this->assertEquals(50.0, (float) DB::table('users')->where('id', $userId)->value('balance'));
        $this->assertEquals(50.0, (float) DB::table('transactions')->orderByDesc('id')->value('post_balance'));
        $this->assertEquals(200.0, (float) DB::table('transactions')->orderByDesc('id')->value('balance_before'));
        $this->assertEquals(50.0, (float) DB::table('transactions')->orderByDesc('id')->value('balance_after'));

        try {
            $service->debitWithTransaction($userId, 'main', 100, [
                'amount' => 100,
                'charge' => 0,
                'details' => 'debit',
                'trx' => 'trx-debit-2',
                'remark' => 'test',
            ]);
            $this->fail('Expected insufficient balance exception.');
        } catch (\RuntimeException $e) {
            $this->assertEquals('Insufficient wallet balance', $e->getMessage());
        }

        $this->assertEquals(50.0, (float) DB::table('users')->where('id', $userId)->value('balance'));
        $this->assertEquals(1, (int) DB::table('transactions')->count());

        $service->creditWithTransaction($userId, 'main', 20, [
            'amount' => 20,
            'charge' => 0,
            'details' => 'credit',
            'trx' => 'trx-credit-1',
            'remark' => 'test',
        ]);

        $this->assertEquals(70.0, (float) DB::table('users')->where('id', $userId)->value('balance'));
        $this->assertEquals(70.0, (float) DB::table('transactions')->orderByDesc('id')->value('post_balance'));
        $this->assertEquals(50.0, (float) DB::table('transactions')->orderByDesc('id')->value('balance_before'));
        $this->assertEquals(70.0, (float) DB::table('transactions')->orderByDesc('id')->value('balance_after'));
    }

    public function test_concurrent_like_debits_do_not_overspend()
    {
        $this->setUpWalletSchema();

        $userId = DB::table('users')->insertGetId([
            'balance' => 200,
            'ref_balance' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $service = app(WalletLedgerService::class);

        $service->debitWithTransaction($userId, 'main', 150, [
            'amount' => 150,
            'charge' => 0,
            'details' => 'debit',
            'trx' => 'trx-overspend-1',
            'remark' => 'test',
        ]);

        try {
            $service->debitWithTransaction($userId, 'main', 150, [
                'amount' => 150,
                'charge' => 0,
                'details' => 'debit',
                'trx' => 'trx-overspend-2',
                'remark' => 'test',
            ]);
            $this->fail('Expected insufficient balance exception.');
        } catch (\RuntimeException $e) {
            $this->assertEquals('Insufficient wallet balance', $e->getMessage());
        }

        $this->assertEquals(50.0, (float) DB::table('users')->where('id', $userId)->value('balance'));
        $this->assertEquals(1, (int) DB::table('transactions')->count());
    }
}
