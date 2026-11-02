<?php

namespace App\Http\Middleware;

use Closure;
class CheckStatusApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        if ($user->status  && $user->ev  && $user->sv  && $user->tv) {
            return $next($request);
        }

        if (!$user->status) {
            return response()->json([
                'code' => 403,
                'status' => 'error',
                'message' => 'Your account has been deactivated.',
            ], 403);
        }

        return response()->json([
            'code' => 403,
            'status' => 'verification_required',
            'message' => 'Complete account verification before using this service.',
            'data' => [
                'authorization_url' => route('api.user.authorization'),
                'authorization_method' => 'GET',
            ],
        ], 403);
    }
}
