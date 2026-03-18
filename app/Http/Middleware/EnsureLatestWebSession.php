<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureLatestWebSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $latest = $user->latest_web_session_id ?? null;
        $current = $request->session()->getId();

        if ($latest && $current && hash_equals((string) $latest, (string) $current) === false) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'status' => 'danger',
                    'message' => 'Session expired. Please login again.',
                ], 401);
            }

            $notify[] = ['error', 'You have been logged out because you logged in from another device.'];
            return redirect()->route('user.login')->withNotify($notify);
        }

        return $next($request);
    }
}
