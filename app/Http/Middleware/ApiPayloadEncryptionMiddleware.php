<?php

namespace App\Http\Middleware;

use App\Services\ApiEncryptionService;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiPayloadEncryptionMiddleware
{
    protected ApiEncryptionService $encryptionService;

    public function __construct(ApiEncryptionService $encryptionService)
    {
        $this->encryptionService = $encryptionService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $isEncryptedRequest = $request->header('X-Encrypted') === 'true' || $request->has('payload');
        $sessionKey = null;

        if ($isEncryptedRequest) {
            $timestamp = (int) $request->header('X-Timestamp', $request->input('timestamp', 0));
            $nonce = (string) $request->header('X-Nonce', $request->input('nonce', ''));
            $signature = (string) $request->header('X-Signature', $request->input('signature', ''));
            $encryptedSessionKey = $request->header('X-Session-Key', $request->input('session_key'));

            // Layer 4: Replay Protection Check
            if (!$this->encryptionService->verifyReplayProtection($timestamp, $nonce)) {
                return response()->json([
                    'code' => 403,
                    'status' => 'error',
                    'message' => 'Request expired or duplicate replay detected.',
                ], 403);
            }

            // Layer 3: Ephemeral Key Exchange (if provided)
            if ($encryptedSessionKey) {
                $sessionKey = $this->encryptionService->decryptSessionKey($encryptedSessionKey);
                if (!$sessionKey) {
                    return response()->json([
                        'code' => 400,
                        'status' => 'error',
                        'message' => 'Failed to decrypt session key.',
                    ], 400);
                }
            }

            $encryptedPayload = $request->input('payload');
            $iv = $request->input('iv');
            $tag = $request->input('tag');

            // Layer 4: Verify HMAC Signature over raw payload
            if (!$this->encryptionService->verifySignature($encryptedPayload, $timestamp, $nonce, $signature, $sessionKey)) {
                return response()->json([
                    'code' => 401,
                    'status' => 'error',
                    'message' => 'Invalid signature or payload tampered.',
                ], 401);
            }

            // Layer 2: Decrypt AES-256-GCM Payload
            $decryptedInput = $this->encryptionService->decryptPayload($encryptedPayload, $iv, $tag, $sessionKey);

            if ($decryptedInput === null) {
                return response()->json([
                    'code' => 400,
                    'status' => 'error',
                    'message' => 'Failed to decrypt request payload.',
                ], 400);
            }

            // Merge decrypted payload into Request data for Laravel Controllers
            $request->replace($decryptedInput);
        }

        // Process controller request
        $response = $next($request);

        // Encrypt Outgoing Response if client requested encryption or sends X-Encrypted
        if ($isEncryptedRequest && $response instanceof JsonResponse) {
            $responseArray = $response->getData(true);
            $encryptedResponseData = $this->encryptionService->encryptResponseData($responseArray, $sessionKey);

            return response()->json($encryptedResponseData, $response->getStatusCode());
        }

        return $response;
    }
}
