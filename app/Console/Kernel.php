<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Process the queue every minute
        // Using --stop-when-empty is recommended for cPanel/Shared Hosting to prevent process buildup
        $schedule->command('queue:work --stop-when-empty')->everyMinute()->withoutOverlapping();

        // If you need to process FDR installments daily, uncomment the line below:
        // $schedule->call(function () { app(\App\Http\Controllers\ApiController::class)->fixed(); })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
