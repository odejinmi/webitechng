<?php

namespace App\Http\Controllers\Api\Mobile;

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
            'current_password' => 'required|string',
            'pin' => ['required', 'string', 'regex:/^\d{4,6}$/'],
        ]);

        $user = $request->user();
        if (!Hash::check($validated['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The account password is invalid.'],
            ]);
        }

        $user->trx_password = Hash::make(trim($validated['pin']));
        $user->save();

        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'message' => 'Transaction PIN updated successfully.',
            'data' => ['configured' => true],
        ]);
    }
}
