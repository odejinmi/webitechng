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
        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => [
                'configured' => !empty($request->user()->trx_password),
            ],
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'nullable|required_without:password|string',
            'password' => 'nullable|required_without:current_password|string',
            'pin' => 'required|digits_between:4,6',
        ]);

        $user = $request->user();
        $accountPassword = $validated['current_password'] ?? $validated['password'];
        if (!Hash::check($accountPassword, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The account password is invalid.'],
            ]);
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
            'data' => ['configured' => true],
        ]);
    }
}
