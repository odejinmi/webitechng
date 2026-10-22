<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Force Accept header so Laravel handles validation and errors as JSON
        $request->headers->set('Accept', 'application/json');

        $response = $next($request);

        // If response is already a JsonResponse, return as-is
        if ($response instanceof JsonResponse) {
            return $response;
        }

        // Intercept View responses (e.g. return view('...')) and convert to JSON
        $view = $response instanceof View ? $response : null;
        if (!$view && isset($response->original) && $response->original instanceof View) {
            $view = $response->original;
        }

        if ($view) {
            $data = $view->getData();

            // Remove internal blade layout variables to keep API response clean
            unset($data['activeTemplate'], $data['activeTemplateTrue'], $data['app']);

            return response()->json([
                'code' => 200,
                'status' => 'ok',
                'message' => 'Success',
                'data' => $data,
            ], 200);
        }

        // Intercept Redirect responses (e.g. return back()->withNotify(...))
        if ($response instanceof RedirectResponse) {
            $session = $request->hasSession() ? $request->session() : app('session')->driver();
            $notify = $session ? $session->get('notify') : null;
            $errors = $session ? $session->get('errors') : null;

            $messages = [];
            $hasError = false;
            if ($notify) {
                foreach ($notify as $item) {
                    if (is_array($item) && isset($item[1])) {
                        $messages[] = $item[1];
                        $hasError = $hasError || in_array($item[0] ?? null, ['error', 'danger'], true);
                    } elseif (is_string($item)) {
                        $messages[] = $item;
                    }
                }
            }

            if ($errors) {
                $errorBag = $errors->getBag('default');
                if ($errorBag) {
                    $messages = array_merge($messages, $errorBag->all());
                    $hasError = true;
                }
            }

            $statusCode = $hasError ? 400 : 200;

            return response()->json([
                'code' => $statusCode,
                'status' => $hasError ? 'error' : 'ok',
                'message' => $hasError ? $messages : 'Redirect intercepted',
                'target_url' => $response->getTargetUrl(),
            ], $statusCode);
        }

        return $response;
    }
}
