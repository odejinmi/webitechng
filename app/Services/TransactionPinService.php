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
        $storedPin = (string) $user->trx_password;

        if ($storedPin === '') {
            return false;
        }

        if (Hash::check($pin, $storedPin)) {
            return true;
        }

        $hashInfo = password_get_info($storedPin);
        $isLegacyPlainPin = ($hashInfo['algoName'] ?? 'unknown') === 'unknown'
            && hash_equals($storedPin, $pin);

        if (!$isLegacyPlainPin) {
            return false;
        }

        $user->trx_password = $this->hash($pin);
        $user->save();

        return true;
    }

    private function normalize(string $pin): string
    {
        return trim($pin);
    }
}
