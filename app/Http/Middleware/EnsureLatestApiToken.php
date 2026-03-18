<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureLatestApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user) {
            return $next($request);
        }

        if (!method_exists($user, 'currentAccessToken')) {
            return $next($request);
        }

        $token = $user->currentAccessToken();
        if (!$token) {
            return $next($request);
        }

        $latestId = $user->latest_api_token_id ?? null;
        if ($latestId && (int) $token->id !== (int) $latestId) {
            $token->delete();

            return response()->json([
                'ok' => false,
                'status' => 'danger',
                'message' => 'Token expired. Please login again.',
            ], 401);
        }

        return $next($request);
    }
}
