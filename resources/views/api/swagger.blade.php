<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5.33.1/swagger-ui.css">
    <style>
        html { box-sizing: border-box; overflow-y: scroll; }
        *, *::before, *::after { box-sizing: inherit; }
        body { margin: 0; background: #fafafa; }
        .api-docs-banner {
            padding: 12px 24px;
            color: #fff;
            background: #172033;
            font: 14px/1.5 system-ui, sans-serif;
        }
        .api-docs-banner a { color: #7dd3fc; }
        .api-docs-banner strong { color: #fff; }
        .api-docs-banner .quick-links { margin-bottom: 4px; }
        .api-docs-banner .quick-links a { margin-right: 14px; font-weight: 700; }
        .api-docs-banner code { color: #fde68a; }
    </style>
</head>
<body>
    <div class="api-docs-banner">
        <div class="quick-links">
            <strong>Mobile quick start:</strong>
            <a href="#/01.%20Authentication/api_user_register_post">Signup</a>
            <a href="#/01.%20Authentication/api_user_login_post">Login</a>
            <a href="#/01.%20Authentication">Password recovery</a>
            <a href="{{ route('mobile.api.openapi') }}" download>Download OpenAPI JSON</a>
        </div>
        Base URL: <code>{{ url('/api') }}</code>. POST, PUT, PATCH, and DELETE requests require the encrypted payload and security headers described in each operation.
    </div>
    <div id="swagger-ui"></div>
    <script src="https://unpkg.com/swagger-ui-dist@5.33.1/swagger-ui-bundle.js" crossorigin></script>
    <script src="https://unpkg.com/swagger-ui-dist@5.33.1/swagger-ui-standalone-preset.js" crossorigin></script>
    <script>
        window.onload = function () {
            window.ui = SwaggerUIBundle({
                url: @json(route('mobile.api.openapi')),
                dom_id: '#swagger-ui',
                deepLinking: true,
                docExpansion: 'none',
                defaultModelsExpandDepth: -1,
                displayRequestDuration: true,
                persistAuthorization: true,
                filter: true,
                tagsSorter: 'alpha',
                operationsSorter: 'alpha',
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                layout: 'StandaloneLayout'
            });
        };
    </script>
</body>
</html>
