<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Route as LaravelRoute;
use Illuminate\Support\Str;

class ApiDocumentationController
{
    private array $curatedPaths = [];

    private const ENCRYPTION_EXCLUSIONS = [
        '/strowallet/webhook',
        '/paylony/webhook',
        '/monnify/webhook',
        '/payvessel/webhook',
        '/vpay/webhook',
        '/savings/cronjob',
        '/fixed/cronjob',
    ];

    public function index()
    {
        $this->ensureEnabled();

        return view('api.swagger', [
            'title' => config('api-docs.title'),
        ]);
    }

    public function specification()
    {
        $this->ensureEnabled();

        $specification = $this->baseSpecification();
        $specification['info']['title'] = config('api-docs.title');
        $specification['info']['version'] = config('api-docs.version');
        $specification['info']['description'] = $this->description();
        $specification['servers'] = [
            [
                'url' => url('/api'),
                'description' => app()->environment('production') ? 'Production Server' : 'Current Environment',
            ],
        ];

        foreach (app('router')->getRoutes() as $route) {
            $this->addRoute($specification, $route);
        }

        ksort($specification['paths']);

        return response()->json(
            $specification,
            200,
            [],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }

    private function ensureEnabled(): void
    {
        abort_unless(config('api-docs.enabled'), 404);
    }

    private function baseSpecification(): array
    {
        $specification = [
            'openapi' => '3.0.3',
            'info' => [],
            'paths' => [],
            'components' => [],
        ];
        $path = base_path('openapi.json');

        if (is_file($path) && is_readable($path)) {
            $contents = file_get_contents($path);

            if ($contents !== false) {
                try {
                    $decoded = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

                    if (is_array($decoded)) {
                        $specification = array_replace_recursive($specification, $decoded);
                    }
                } catch (\JsonException) {
                }
            }
        }

        $this->curatedPaths = $specification['paths'] ?? [];
        $specification['paths'] = [];
        $specification['components'] = $specification['components'] ?? [];
        $specification['components']['securitySchemes']['bearerAuth'] = [
            'type' => 'http',
            'scheme' => 'bearer',
            'bearerFormat' => 'Sanctum',
            'description' => 'Use the token returned by POST /user/login.',
        ];
        $specification['components']['schemas']['EncryptedRequestEnvelope'] = [
            'type' => 'object',
            'required' => ['payload', 'iv', 'tag'],
            'properties' => [
                'payload' => [
                    'type' => 'string',
                    'description' => 'Base64-encoded AES-256-GCM ciphertext.',
                ],
                'iv' => [
                    'type' => 'string',
                    'description' => 'Base64-encoded 12-byte initialization vector.',
                ],
                'tag' => [
                    'type' => 'string',
                    'description' => 'Base64-encoded 16-byte authentication tag.',
                ],
            ],
        ];
        $specification['x-transport-encryption'] = [
            'algorithm' => 'AES-256-GCM',
            'requestEnvelopeSchema' => '#/components/schemas/EncryptedRequestEnvelope',
            'note' => 'Request body schemas describe the decrypted business payload placed inside payload.',
        ];

        return $specification;
    }

    private function addRoute(array &$specification, LaravelRoute $route): void
    {
        $uri = $route->uri();
        if (!Str::startsWith($uri, 'api/')) {
            return;
        }

        $path = '/' . Str::after($uri, 'api/');
        $path = preg_replace('/\{([^}]+)\?\}/', '{$1}', $path);
        $middleware = $route->gatherMiddleware();

        foreach (array_diff($route->methods(), ['HEAD']) as $routeMethod) {
            $method = strtolower($routeMethod);
            if (!in_array($method, ['get', 'post', 'put', 'patch', 'delete'], true)) {
                continue;
            }

            $existing = $this->curatedPaths[$path][$method] ?? [];
            $operation = array_replace_recursive(
                $this->generatedOperation($route, $path, $method, $middleware),
                $existing
            );

            $operation['parameters'] = $this->mergeParameters(
                $operation['parameters'] ?? [],
                $this->pathParameters($path)
            );

            if ($this->requiresEncryption($path, $method)) {
                $operation['parameters'] = $this->mergeParameters(
                    $operation['parameters'],
                    $this->encryptionHeaders()
                );
                $operation['x-encryption-required'] = true;
            }

            if ($operation['parameters'] === []) {
                unset($operation['parameters']);
            }

            $specification['paths'][$path][$method] = $operation;
        }
    }

    private function generatedOperation(LaravelRoute $route, string $path, string $method, array $middleware): array
    {
        $authenticated = collect($middleware)->contains(function ($item) {
            return is_string($item) && Str::startsWith($item, ['auth:', 'auth.api', 'latest.api.token']);
        });
        $action = $route->getActionName();
        $routeName = $route->getName();
        $operationId = $routeName
            ? $routeName . '_' . $method
            : $method . '_' . trim(str_replace(['/', '{', '}'], '_', $path), '_');

        $operation = [
            'summary' => $this->summary($action, $method, $path),
            'description' => 'Controller: `' . $action . '`',
            'operationId' => preg_replace('/[^A-Za-z0-9_]/', '_', $operationId),
            'tags' => [$this->tag($path)],
            'security' => $authenticated ? [['bearerAuth' => []]] : [],
            'responses' => [
                '200' => ['description' => 'Successful response'],
                '400' => ['description' => 'Invalid request'],
                '401' => ['description' => 'Unauthenticated or invalid token'],
                '422' => ['description' => 'Validation failed'],
            ],
        ];

        if (in_array($method, ['post', 'put', 'patch', 'delete'], true)) {
            $operation['requestBody'] = [
                'required' => true,
                'description' => 'JSON request payload. For encrypted endpoints, this is the inner business payload.',
                'content' => [
                    'application/json' => [
                        'schema' => [
                            'type' => 'object',
                            'additionalProperties' => true,
                        ],
                    ],
                ],
            ];
        }

        return $operation;
    }

    private function pathParameters(string $path): array
    {
        preg_match_all('/\{([^}]+)\}/', $path, $matches);

        return array_map(function ($name) {
            return [
                'name' => $name,
                'in' => 'path',
                'required' => true,
                'schema' => ['type' => 'string'],
            ];
        }, $matches[1]);
    }

    private function encryptionHeaders(): array
    {
        return [
            $this->header('X-Encrypted', true, 'Set to `true`.', 'true'),
            $this->header('X-Timestamp', true, 'Current Unix timestamp. Requests expire after five minutes.'),
            $this->header('X-Nonce', true, 'Unique random value for replay protection.'),
            $this->header('X-Signature', true, 'HMAC-SHA256 signature of timestamp, nonce, and encrypted payload.'),
            $this->header('X-Session-Key', false, 'Optional RSA-encrypted per-request AES key.'),
        ];
    }

    private function header(string $name, bool $required, string $description, ?string $example = null): array
    {
        $parameter = [
            'name' => $name,
            'in' => 'header',
            'required' => $required,
            'description' => $description,
            'schema' => ['type' => 'string'],
        ];

        if ($example !== null) {
            $parameter['example'] = $example;
        }

        return $parameter;
    }

    private function mergeParameters(array $current, array $additional): array
    {
        foreach ($additional as $parameter) {
            $key = ($parameter['in'] ?? '') . ':' . ($parameter['name'] ?? '');
            $current = array_values(array_filter($current, function ($existing) use ($key) {
                return (($existing['in'] ?? '') . ':' . ($existing['name'] ?? '')) !== $key;
            }));
            $current[] = $parameter;
        }

        return $current;
    }

    private function requiresEncryption(string $path, string $method): bool
    {
        return $method !== 'get' && !in_array($path, self::ENCRYPTION_EXCLUSIONS, true);
    }

    private function summary(string $action, string $method, string $path): string
    {
        if ($action === 'Closure') {
            return Str::headline($method . ' ' . trim($path, '/'));
        }

        return Str::headline(Str::afterLast($action, '@'));
    }

    private function tag(string $path): string
    {
        $segments = explode('/', trim($path, '/'));
        if (($segments[0] ?? null) === 'user') {
            $area = $segments[1] ?? 'account';
            if (in_array($area, ['login', 'register', 'check-mail', 'password'], true)) {
                return 'Authentication';
            }

            return Str::headline($area);
        }

        return Str::headline($segments[0] ?? 'API');
    }

    private function description(): string
    {
        return 'Live documentation generated from the registered Laravel API routes. '
            . 'For POST, PUT, PATCH, and DELETE requests, the documented business payload must be AES-256-GCM encrypted. '
            . 'Send the encrypted values as `payload`, `iv`, and `tag`, together with the documented replay-protection headers. '
            . 'Authenticated routes require a Sanctum bearer token returned by the login endpoint.';
    }
}
