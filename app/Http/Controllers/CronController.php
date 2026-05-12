<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Lib\CurlRequest;
use App\Models\GeneralSetting;
use App\Models\Order;

class CronController extends Controller
{
    public function runQueue()
    {
        try {
            \Illuminate\Support\Facades\Artisan::call('queue:work', [
                '--stop-when-empty' => true,
                '--timeout' => 60,
                '--tries' => 3
            ]);

            return "Queue processed successfully. " . \Illuminate\Support\Facades\Artisan::output();
        } catch (\Exception $e) {
            return "Error processing queue: " . $e->getMessage();
        }
    }
}
