<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyCronSecret
{
    public function handle(Request $request, Closure $next)
    {
        $configuredSecret = (string) config('security.cron_secret');
        $providedSecret = (string) $request->header('X-Cron-Secret');

        if ($configuredSecret === '') {
            abort(503, 'Cron secret is not configured.');
        }

        if ($providedSecret === '' || !hash_equals($configuredSecret, $providedSecret)) {
            abort(403, 'Invalid cron credentials.');
        }

        return $next($request);
    }
}
