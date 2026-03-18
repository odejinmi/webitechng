<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FirebaseNotificationService;
use ReflectionClass;

class TestFirebaseToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'firebase:test-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Firebase OAuth token generation';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $service = new FirebaseNotificationService();
        $reflection = new ReflectionClass($service);
        $method = $reflection->getMethod('getAccessToken');
        $method->setAccessible(true);
        
        $this->info('Attempting to generate Firebase access token...');
        
        try {
            $token = $method->invoke($service);
            $this->info('Success! Token retrieved.');
            $this->line('Token prefix: ' . substr($token, 0, 50) . '...');
        } catch (\Exception $e) {
            $this->error('Failed: ' . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
