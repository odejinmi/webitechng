<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class FirebaseNotificationService
{
    protected $serverKey;
    protected $projectId;
    protected $credentialsFile;

    public function __construct()
    {
        $this->serverKey = config('services.firebase.server_key');
        $this->credentialsFile = storage_path('app/firebase_credentials.json.json');
    }

    /**
     * Get OAuth 2.0 Access Token
     */
    private function getAccessToken()
    {
        return Cache::remember('firebase_access_token', 3000, function () {
            if (!file_exists($this->credentialsFile)) {
                throw new \Exception('Firebase credentials file not found: ' . $this->credentialsFile);
            }

            $credentials = json_decode(file_get_contents($this->credentialsFile), true);
            $this->projectId = $credentials['project_id'];

            $now_seconds = time();
            $payload = [
                'iss' => $credentials['client_email'],
                'sub' => $credentials['client_email'],
                'aud' => 'https://oauth2.googleapis.com/token',
                'iat' => $now_seconds,
                'exp' => $now_seconds + 3600,
                'scope' => 'https://www.googleapis.com/auth/firebase.messaging'
            ];

            $jwt = JWT::encode($payload, $credentials['private_key'], 'RS256');

            // Exchange JWT for Access Token
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://oauth2.googleapis.com/token',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query([
                    'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                    'assertion' => $jwt
                ]),
                CURLOPT_SSL_VERIFYPEER => false // For local dev
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                throw new \Exception('Failed to get access token: ' . $err);
            }

            $data = json_decode($response, true);
            if (!isset($data['access_token'])) {
                throw new \Exception('Failed to get access token: ' . $response);
            }

            return $data['access_token'];
        });
    }

    /**
     * Send notification to specific device
     */
    public function sendToDevice($deviceToken, $title, $body, $data = [])
    {
        $message = [
            'token' => $deviceToken,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'image' => 'https://renomobilemoney.com/renon.png'
            ]
        ];

        if (!empty($data)) {
            $message['data'] = $data;
        }

        return $this->sendRequest(['message' => $message]);
    }

    /**
     * Send notification to multiple devices
     */
    public function sendToMultipleDevices($deviceTokens, $title, $body, $data = [])
    {
        $results = [];

        foreach ($deviceTokens as $token) {
            $result = $this->sendToTopic($token, $title, $body, $data);
            $results[] = [
                'token' => $token,
                'result' => $result
            ];
        }

        return $results;
    }

    /**
     * Send notification to topic
     */
    public function sendToTopic($topic, $title, $body, $data = [])
    {
        $message = [
            'topic' => $topic,
            'notification' => [
                'title' => $title,
                'body' => $body,
                'image' => 'https://renomobilemoney.com/renon.png'
            ]
        ];

        if (!empty($data)) {
            $message['data'] = $data;
        }

        return $this->sendRequest(['message' => $message]);
    }

    /**
     * Send notification using username (topic-based)
     */
    public function sendToUsername($username, $title, $body, $data = [])
    {
        return $this->sendToTopic($username, $title, $body, $data);
    }

    /**
     * Subscribe devices to topic
     */
    public function subscribeToTopic($deviceTokens, $topic)
    {
        $endpoint = "https://iid.googleapis.com/iid/v1:batchAdd";

        $payload = [
            'to' => '/topics/' . $topic,
            'registration_tokens' => $deviceTokens
        ];

        return $this->makeIidRequest($endpoint, $payload);
    }

    /**
     * Unsubscribe devices from topic
     */
    public function unsubscribeFromTopic($deviceTokens, $topic)
    {
        $endpoint = "https://iid.googleapis.com/iid/v1:batchRemove";

        $payload = [
            'to' => '/topics/' . $topic,
            'registration_tokens' => $deviceTokens
        ];

        return $this->makeIidRequest($endpoint, $payload);
    }

    /**
     * Send cURL request to FCM
     */
    private function sendRequest($payload)
    {
        \Illuminate\Support\Facades\Log::info('push notification request get here');

        try {
            $accessToken = $this->getAccessToken();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Firebase Token Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'response' => null
            ];
        }

        if (!$this->projectId) {
            $credentials = json_decode(file_get_contents($this->credentialsFile), true);
            $this->projectId = $credentials['project_id'];
        }

        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            \Illuminate\Support\Facades\Log::info('push notification error result '. $error);
            return [
                'success' => false,
                'error' => $error,
                'response' => null
            ];
        }

        $responseData = json_decode($response, true);

        \Illuminate\Support\Facades\Log::info('push notification result', $responseData ?? []);
        
        return [
            'success' => $httpCode === 200 && isset($responseData['name']),
            'response' => $responseData,
            'http_code' => $httpCode
        ];
    }

    /**
     * Make IID request for topic subscription
     */
    private function makeIidRequest($endpoint, $payload)
    {
        try {
            $accessToken = $this->getAccessToken();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Firebase Token Error in IID Request: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'response' => null
            ];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json',
                'access_token_auth: true'
            ),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            return [
                'success' => false,
                'error' => $error,
                'response' => null
            ];
        }

        $responseData = json_decode($response, true);

        return [
            'success' => $httpCode === 200,
            'response' => $responseData,
            'http_code' => $httpCode
        ];
    }
}
