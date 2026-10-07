<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ApiEncryptionService
{
    protected string $secretKey;
    protected string $cipherMethod = 'aes-256-gcm';
    protected int $replayWindowSeconds = 300; // 5 minutes window

    public function __construct()
    {
        // Secret key derived from APP_KEY or dedicated API_ENCRYPTION_SECRET
        $this->secretKey = env('API_ENCRYPTION_SECRET', config('app.key'));
        if (str_starts_with($this->secretKey, 'base64:')) {
            $this->secretKey = base64_decode(substr($this->secretKey, 7));
        }
    }

    /**
     * Layer 4: Verify Timestamp & Nonce to prevent Replay Attacks
     */
    public function verifyReplayProtection(int $timestamp, string $nonce): bool
    {
        $now = time();

        // Check if timestamp is within acceptable time window (e.g., 5 mins)
        if (abs($now - $timestamp) > $this->replayWindowSeconds) {
            return false;
        }

        // Check nonce in cache to ensure request hasn't been replayed
        $cacheKey = 'api_nonce_' . md5($nonce);
        if (Cache::has($cacheKey)) {
            return false; // Replay attempt detected!
        }

        // Cache nonce for the duration of the window
        Cache::put($cacheKey, true, $this->replayWindowSeconds);

        return true;
    }

    /**
     * Layer 4: Verify HMAC-SHA256 Signature
     */
    public function verifySignature(string $payload, int $timestamp, string $nonce, string $signature, ?string $sessionKey = null): bool
    {
        $key = $sessionKey ? $sessionKey : $this->secretKey;
        $signedData = $timestamp . '.' . $nonce . '.' . $payload;
        $expectedSignature = hash_hmac('sha256', $signedData, $key);

        return hash_equals($expectedSignature, $signature);
    }

    /**
     * Layer 3: Decrypt Per-Request Ephemeral Key using RSA Private Key
     */
    public function decryptSessionKey(string $encryptedKey): ?string
    {
        $privateKeyPath = storage_path('keys/private.pem');
        if (!file_exists($privateKeyPath)) {
            $this->ensureRsaKeysExist();
        }

        $privateKey = file_get_contents($privateKeyPath);
        $decryptedKey = null;

        $success = openssl_private_decrypt(
            base64_decode($encryptedKey),
            $decryptedKey,
            $privateKey,
            OPENSSL_PKCS1_OAEP_PADDING
        );

        return $success ? $decryptedKey : null;
    }

    /**
     * Layer 2: Decrypt AES-256-GCM Payload
     */
    public function decryptPayload(string $encryptedData, string $iv, string $tag, ?string $key = null): ?array
    {
        $decryptionKey = $key ? $key : substr(hash('sha256', $this->secretKey, true), 0, 32);

        $decrypted = openssl_decrypt(
            base64_decode($encryptedData),
            $this->cipherMethod,
            $decryptionKey,
            OPENSSL_RAW_DATA,
            base64_decode($iv),
            base64_decode($tag)
        );

        if ($decrypted === false) {
            return null;
        }

        $jsonData = json_decode($decrypted, true);
        return is_array($jsonData) ? $jsonData : null;
    }

    /**
     * Layer 2 & 4: Encrypt Response Payload using AES-256-GCM & Generate Signature
     */
    public function encryptResponseData(array $data, ?string $key = null): array
    {
        $encryptionKey = $key ? $key : substr(hash('sha256', $this->secretKey, true), 0, 32);
        $jsonPayload = json_encode($data);

        $iv = openssl_random_pseudo_bytes(12); // 96-bit IV for GCM
        $tag = '';

        $ciphertext = openssl_encrypt(
            $jsonPayload,
            $this->cipherMethod,
            $encryptionKey,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );

        $encodedCiphertext = base64_encode($ciphertext);
        $encodedIv = base64_encode($iv);
        $encodedTag = base64_encode($tag);

        $timestamp = time();
        $nonce = bin2hex(random_bytes(16));

        // Generate HMAC signature for response payload
        $signature = hash_hmac('sha256', $timestamp . '.' . $nonce . '.' . $encodedCiphertext, $encryptionKey);

        return [
            'encrypted' => true,
            'payload' => $encodedCiphertext,
            'iv' => $encodedIv,
            'tag' => $encodedTag,
            'timestamp' => $timestamp,
            'nonce' => $nonce,
            'signature' => $signature,
        ];
    }

    /**
     * Auto-generate RSA 2048 keypair if not existing in storage/keys/
     */
    public function ensureRsaKeysExist(): void
    {
        $keysDir = storage_path('keys');
        if (!file_exists($keysDir)) {
            mkdir($keysDir, 0755, true);
        }

        $privateKeyPath = $keysDir . '/private.pem';
        $publicKeyPath = $keysDir . '/public.pem';

        if (!file_exists($privateKeyPath) || !file_exists($publicKeyPath)) {
            $config = [
                "digest_alg" => "sha256",
                "private_key_bits" => 2048,
                "private_key_type" => OPENSSL_KEYTYPE_RSA,
            ];

            $res = openssl_pkey_new($config);
            if ($res) {
                openssl_pkey_export($res, $privateKey);
                $pubKey = openssl_pkey_get_details($res);

                file_put_contents($privateKeyPath, $privateKey);
                file_put_contents($publicKeyPath, $pubKey["key"]);
            }
        }
    }

    /**
     * Get Public RSA Key for Mobile App Pinning / Key Exchange
     */
    public function getPublicKey(): string
    {
        $publicKeyPath = storage_path('keys/public.pem');
        if (!file_exists($publicKeyPath)) {
            $this->ensureRsaKeysExist();
        }

        return file_get_contents($publicKeyPath);
    }
}
