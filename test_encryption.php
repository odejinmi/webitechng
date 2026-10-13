<?php

$secretKey = 'base64:something32byteslong...................'; // mock
if (str_starts_with($secretKey, 'base64:')) {
    $secretKey = base64_decode(substr($secretKey, 7));
}

$data = ['username' => 'test1234', 'password' => 'test1234'];
$jsonPayload = json_encode($data);

$decryptionKey = substr(hash('sha256', $secretKey, true), 0, 32);
$iv = openssl_random_pseudo_bytes(12);
$tag = '';

$ciphertext = openssl_encrypt(
    $jsonPayload,
    'aes-256-gcm',
    $decryptionKey,
    OPENSSL_RAW_DATA,
    $iv,
    $tag
);

$encodedCiphertext = base64_encode($ciphertext);
$encodedIv = base64_encode($iv);
$encodedTag = base64_encode($tag);

$timestamp = time();
$nonce = bin2hex(random_bytes(16));

$signedData = $timestamp . '.' . $nonce . '.' . $encodedCiphertext;
$signature = hash_hmac('sha256', $signedData, $secretKey);

echo json_encode([
    'headers' => [
        'X-Encrypted' => 'true',
        'X-Timestamp' => (string) $timestamp,
        'X-Nonce' => $nonce,
        'X-Signature' => $signature,
    ],
    'body' => [
        'payload' => $encodedCiphertext,
        'iv' => $encodedIv,
        'tag' => $encodedTag,
    ]
], JSON_PRETTY_PRINT);
