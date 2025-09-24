<?php
// app/Http/Controllers/GoogleAuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user already exists with this Google ID
            $existingUser = User::where('google_id', $googleUser->id)->first();

            dd($existingUser);
            if ($existingUser) {
                // User exists, log them in
                Auth::login($existingUser);
                return redirect()->intended('/dashboard');
            }

            // Check if user exists with same email
            $existingEmailUser = User::where('email', $googleUser->email)->first();

            if ($existingEmailUser) {
                // Update existing user with Google ID
                $existingEmailUser->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);

                Auth::login($existingEmailUser);
                return redirect()->intended('/dashboard');
            }

            // Create new user
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => Hash::make(uniqid()), // Random password
                'email_verified_at' => now(), // Auto-verify Google users
            ]);

            Auth::login($newUser);
            return redirect()->intended('/dashboard');

        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong with Google authentication.');
        }
    }
}
