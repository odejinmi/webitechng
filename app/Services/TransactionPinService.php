<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TransactionPinService
{
    public function hash(string $pin): string
    {
        return Hash::make($this->normalize($pin));
    }

    public function matches(User $user, string $pin): bool
    {
        $rawPin = $pin;
        $pin = $this->normalize($pin);
        $freshUser = User::query()->find($user->getKey());

        Log::info('TransactionPinService::matches - Check initiated', [
            'user' => $user,
            'user_id' => $user->getKey(),
            'raw_pin' => $rawPin,
            'normalized_pin' => $pin,
            'db_trx_password' => $freshUser ? $freshUser->trx_password : null,
        ]);

        if (!$freshUser) {
            Log::warning('TransactionPinService::matches - User not found in DB', [
                'user_id' => $user->getKey(),
            ]);
            return false;
        }

        $storedPin = (string) $freshUser->trx_password;

        if ($storedPin === '') {
            Log::warning('TransactionPinService::matches - Stored trx_password is empty', [
                'user_id' => $freshUser->id,
            ]);
            return false;
        }

        $hashMatch = Hash::check($pin, $storedPin);
        Log::info('TransactionPinService::matches - Hash check result', [
            'user_id' => $freshUser->id,
            'hash_match' => $hashMatch,
        ]);

        if ($hashMatch) {
            $user->setAttribute('trx_password', $storedPin);

            return true;
        }

        $hashInfo = password_get_info($storedPin);
        $isLegacyPlainPin = ($hashInfo['algoName'] ?? 'unknown') === 'unknown'
            && hash_equals($storedPin, $pin);

        Log::info('TransactionPinService::matches - Legacy plain pin check result', [
            'user_id' => $freshUser->id,
            'hash_algo' => $hashInfo['algoName'] ?? 'unknown',
            'is_legacy_plain_pin' => $isLegacyPlainPin,
        ]);

        if (!$isLegacyPlainPin) {
            return false;
        }

        $freshUser->trx_password = $this->hash($pin);
        $freshUser->save();
        $user->setAttribute('trx_password', $freshUser->trx_password);

        return true;
    }

    public function update(User $user, string $pin): bool
    {
        $pin = $this->normalize($pin);
        $user->trx_password = $this->hash($pin);
        $user->saveOrFail();
        $user->refresh();

        return Hash::check($pin, (string) $user->trx_password);
    }

    private function normalize(string $pin): string
    {
        return trim($pin);
    }
}
