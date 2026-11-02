<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureMobileFeatureEnabled
{
    public function handle(Request $request, Closure $next, string $setting)
    {
        if ((int) (gs()->{$setting} ?? 0) !== 1) {
            return response()->json([
                'code' => 403,
                'status' => 'error',
                'message' => 'This service is currently disabled.',
            ], 403);
        }

        return $next($request);
    }
}
