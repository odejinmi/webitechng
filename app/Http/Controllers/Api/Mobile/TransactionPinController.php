<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Services\TransactionPinService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TransactionPinController extends Controller
{
    public function status(Request $request)
    {
        $user = $request->user()->fresh();

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => [
                'user_id' => $user->id,
                'configured' => !empty($user->trx_password),
            ],
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_pin' => 'nullable|required_without_all:current_password,password|digits_between:4,6',
            'current_password' => 'nullable|required_without_all:current_pin,password|string',
            'password' => 'nullable|required_without_all:current_pin,current_password|string',
            'pin' => 'required|digits_between:4,6',
            'pin_confirmation' => 'nullable|digits_between:4,6|same:pin',
        ]);

        $user = $request->user();
        if (!empty($validated['current_pin'])) {
            if (!app(TransactionPinService::class)->matches($user, $validated['current_pin'])) {
                throw ValidationException::withMessages([
                    'current_pin' => ['The current transaction PIN is incorrect.'],
                ]);
            }
        } else {
            $accountPassword = $validated['current_password'] ?? $validated['password'];
            if (!Hash::check($accountPassword, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['The account password is invalid.'],
                ]);
            }
        }

        if (!app(TransactionPinService::class)->update($user, $validated['pin'])) {
            throw ValidationException::withMessages([
                'pin' => ['The transaction PIN could not be saved. Please try again.'],
            ]);
        }

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'message' => 'Transaction PIN updated successfully.',
            'data' => [
                'user_id' => $user->id,
                'configured' => true,
                'verified' => true,
            ],
        ]);
    }

    public function verify(Request $request)
    {
        $validated = $request->validate([
            'pin' => 'required|digits_between:4,6',
        ]);

        $user = $request->user();
        if (!app(TransactionPinService::class)->matches($user, $validated['pin'])) {
            throw ValidationException::withMessages([
                'pin' => ['The transaction PIN does not match this account.'],
            ]);
        }

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'message' => 'Transaction PIN verified successfully.',
            'data' => [
                'user_id' => $user->id,
                'verified' => true,
            ],
        ]);
    }
}
