<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Test notify function directly
$user = (object)['email' => 'test@example.com', 'fullname' => 'Test User'];
$user->username = 'test@example.com'; // Add username property
notify($user, 'DEFAULT', ['subject' => 'Test', 'message' => 'Test message'], ['email']);

echo "Notify function executed successfully\n";
