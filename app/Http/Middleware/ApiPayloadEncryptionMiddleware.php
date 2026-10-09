<?php

namespace App\Http\Middleware;

use App\Services\ApiEncryptionService;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiPayloadEncryptionMiddleware
{
    protected ApiEncryptionService $encryptionService;

    /**
     * Webhook and cron paths excluded from client payload encryption
     * (These third-party gateways send their own provider signatures).
     */
    protected array $excludedPaths = [
        'api/strowallet/webhook',
        'api/paylony/webhook',
        'api/monnify/webhook',
        'api/payvessel/webhook',
        'api/vpay/webhook',
        'api/savings/cronjob',
        'api/fixed/cronjob',
    ];

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
        // Skip third-party webhooks & crons
        if ($this->shouldSkip($request)) {
            return $next($request);
        }

        $sessionKey = null;
        $hasPayload = $request->has('payload') && $request->has('iv') && $request->has('tag');
        $hasEncryptedHeader = $request->header('X-Encrypted') === 'true';

        // Enforce Mandatory Encryption: Reject unencrypted plain requests
        if (!$hasPayload && !$hasEncryptedHeader) {
            return response()->json([
                'code' => 400,
                'status' => 'error',
                'message' => 'Unencrypted request rejected. Mandatory 4-Layer Encryption is required on all API endpoints.',
                'required_fields' => ['payload', 'iv', 'tag'],
                'required_headers' => ['X-Encrypted', 'X-Timestamp', 'X-Nonce', 'X-Signature'],
            ], 400);
        }

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

        $encryptedPayload = (string) $request->input('payload', '');
        $iv = (string) $request->input('iv', '');
        $tag = (string) $request->input('tag', '');

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

        // Process controller request
        $response = $next($request);

        // ALWAYS Encrypt Outgoing Response Payload
        if ($response instanceof JsonResponse) {
            $responseArray = $response->getData(true);
            $encryptedResponseData = $this->encryptionService->encryptResponseData($responseArray, $sessionKey);

            return response()->json($encryptedResponseData, $response->getStatusCode());
        }

        return $response;
    }

    protected function shouldSkip(Request $request): bool
    {
        foreach ($this->excludedPaths as $path) {
            if ($request->is($path)) {
                return true;
            }
        }
        return false;
    }
}
