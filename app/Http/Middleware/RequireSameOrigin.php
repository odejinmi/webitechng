<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireSameOrigin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken() && $request->user()) {
            return $next($request);
        }

        if ($request->header('Sec-Fetch-Site') === 'same-origin') {
            return $next($request);
        }

        $source = $request->header('Origin') ?: $request->header('Referer');
        $sourceHost = $source ? parse_url($source, PHP_URL_HOST) : null;

        if ($sourceHost && hash_equals(strtolower($request->getHost()), strtolower($sourceHost))) {
            return $next($request);
        }

        abort(403, 'Cross-site request rejected.');
    }
}
