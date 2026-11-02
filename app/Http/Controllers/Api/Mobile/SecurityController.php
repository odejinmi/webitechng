<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Services\ApiEncryptionService;
use Illuminate\Routing\Controller;

class SecurityController extends Controller
{
    public function publicKey(ApiEncryptionService $encryption)
    {
        return response()->json([
            'code' => 200,
            'status' => 'ok',
            'data' => [
                'public_key' => $encryption->getPublicKey(),
                'key_exchange' => 'RSA-OAEP-SHA1',
                'payload_encryption' => 'AES-256-GCM',
                'signature' => 'HMAC-SHA256',
            ],
        ]);
    }
}
