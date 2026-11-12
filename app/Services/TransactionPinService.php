<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TransactionPinService
{
    public function hash(string $pin): string
    {
        return Hash::make($this->normalize($pin));
    }

    public function matches(User $user, string $pin): bool
    {
        $pin = $this->normalize($pin);
        $freshUser = User::query()->find($user->getKey());
        if (!$freshUser) {
            return false;
        }

        $storedPin = (string) $freshUser->trx_password;

        if ($storedPin === '') {
            return false;
        }

        if (Hash::check($pin, $storedPin)) {
            $user->setAttribute('trx_password', $storedPin);

            return true;
        }

        $hashInfo = password_get_info($storedPin);
        $isLegacyPlainPin = ($hashInfo['algoName'] ?? 'unknown') === 'unknown'
            && hash_equals($storedPin, $pin);

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
