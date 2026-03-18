<?php

namespace App\Services;

use App\Constants\Status;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WalletLedgerService
{
    private function enforceNewAccountBanIfNeeded(int $userId, float $amount): void
    {
        if ($amount <= 5000) {
            return;
        }

        $user = User::select(['id', 'status', 'created_at'])->whereKey($userId)->firstOrFail();
        if ((int) $user->status === Status::USER_BAN) {
            throw new \RuntimeException('Account is banned');
        }

        $createdAt = $user->created_at;
        if (!$createdAt) {
            return;
        }

        $accountAgeDays = Carbon::now()->diffInDays($createdAt);
        if ($accountAgeDays >= 60) {
            return;
        }

        DB::transaction(function () use ($userId) {
            DB::table('users')->where('id', $userId)->update(['status' => Status::USER_BAN]);
            DB::table('personal_access_tokens')
                ->where('tokenable_type', User::class)
                ->where('tokenable_id', $userId)
                ->delete();
        });

        throw new \RuntimeException('Account banned: new accounts cannot transact above 5000 within 60 days');
    }

    public function debitWithTransaction(int $userId, string $wallet, $amount, array $data): array
    {
        return $this->debit($userId, $wallet, $amount, function ($user, $balanceBefore, $balanceAfter) use ($data) {
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = (float) ($data['amount'] ?? 0);
            $transaction->balance_before = (float) $balanceBefore;
            $transaction->balance_after = (float) $balanceAfter;
            $transaction->post_balance = (float) $balanceAfter;
            $transaction->charge = (float) ($data['charge'] ?? 0);
            $transaction->trx_type = '-';
            $transaction->details = (string) ($data['details'] ?? '');
            $transaction->trx = (string) ($data['trx'] ?? '');
            $transaction->remark = (string) ($data['remark'] ?? '');
            $transaction->save();
        });
    }

    public function creditWithTransaction(int $userId, string $wallet, $amount, array $data): array
    {
        return $this->credit($userId, $wallet, $amount, function ($user, $balanceBefore, $balanceAfter) use ($data) {
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = (float) ($data['amount'] ?? 0);
            $transaction->balance_before = (float) $balanceBefore;
            $transaction->balance_after = (float) $balanceAfter;
            $transaction->post_balance = (float) $balanceAfter;
            $transaction->charge = (float) ($data['charge'] ?? 0);
            $transaction->trx_type = '+';
            $transaction->details = (string) ($data['details'] ?? '');
            $transaction->trx = (string) ($data['trx'] ?? '');
            $transaction->remark = (string) ($data['remark'] ?? '');
            $transaction->save();
        });
    }

    public function debit(int $userId, string $wallet, $amount, callable $ledgerWriter): array
    {
        $wallet = $wallet === 'main' ? 'main' : 'ref';
        $walletField = $wallet === 'main' ? 'balance' : 'ref_balance';
        $amount = (float) $amount;

        if ($amount <= 0) {
            throw new \RuntimeException('Invalid amount');
        }

        $this->enforceNewAccountBanIfNeeded($userId, $amount);

        return DB::transaction(function () use ($userId, $walletField, $amount, $ledgerWriter) {
            $query = User::whereKey($userId);
            if (DB::connection()->getDriverName() !== 'sqlite') {
                $query->lockForUpdate();
            }
            $user = $query->firstOrFail();

            $balanceBefore = (float) $user->{$walletField};
            if ($amount > $balanceBefore) {
                throw new \RuntimeException('Insufficient wallet balance');
            }

            $primaryKey = $user->getKeyName();
            $affected = DB::table($user->getTable())
                ->where($primaryKey, $userId)
                ->where($walletField, '>=', $amount)
                ->decrement($walletField, $amount);

            if ((int) $affected !== 1) {
                throw new \RuntimeException('Insufficient wallet balance');
            }

            $user->refresh();
            $balanceAfter = (float) $user->{$walletField};

            $ledgerWriter($user, $balanceBefore, $balanceAfter, $walletField);

            return [
                'wallet' => $walletField,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceAfter,
                'user' => $user,
            ];
        });
    }

    public function credit(int $userId, string $wallet, $amount, callable $ledgerWriter): array
    {
        $wallet = $wallet === 'main' ? 'main' : 'ref';
        $walletField = $wallet === 'main' ? 'balance' : 'ref_balance';
        $amount = (float) $amount;

        if ($amount <= 0) {
            throw new \RuntimeException('Invalid amount');
        }

        return DB::transaction(function () use ($userId, $walletField, $amount, $ledgerWriter) {
            $query = User::whereKey($userId);
            if (DB::connection()->getDriverName() !== 'sqlite') {
                $query->lockForUpdate();
            }
            $user = $query->firstOrFail();

            $balanceBefore = (float) $user->{$walletField};

            $primaryKey = $user->getKeyName();
            $affected = DB::table($user->getTable())
                ->where($primaryKey, $userId)
                ->increment($walletField, $amount);

            if ((int) $affected !== 1) {
                throw new \RuntimeException('Failed to credit wallet');
            }

            $user->refresh();
            $balanceAfter = (float) $user->{$walletField};

            $ledgerWriter($user, $balanceBefore, $balanceAfter, $walletField);

            return [
                'wallet' => $walletField,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceAfter,
                'user' => $user,
            ];
        });
    }
}
