<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SendBatchEmailCoordinator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipients;
    protected $subject;
    protected $message;
    protected $batchSize;
    protected $delayMinutes;
    protected $testMode;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipients, $subject, $message, $batchSize = 30, $delayMinutes = 15, $testMode = false)
    {
        $this->recipients = $recipients;
        $this->subject = $subject;
        $this->message = $message;
        $this->batchSize = $batchSize;
        $this->delayMinutes = $delayMinutes;
        $this->testMode = $testMode;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $recipients = collect($this->recipients);
        $totalRecipients = $recipients->count();
        $batches = $recipients->chunk($this->batchSize);

        Log::info("Starting " . ($this->testMode ? "TEST MODE - " : "") . "batch email coordinator", [
            'total_recipients' => $totalRecipients,
            'batch_size' => $this->batchSize,
            'total_batches' => $batches->count(),
            'delay_minutes' => $this->delayMinutes,
            'test_mode' => $this->testMode
        ]);

        foreach ($batches as $index => $batch) {
            $batchNumber = $index + 1;
            $batchRecipients = $batch->values()->all();

            // Calculate delay for this batch
            $delayInSeconds = $index * ($this->delayMinutes * 60);

            Log::info("Dispatching batch #{$batchNumber}", [
                'batch_number' => $batchNumber,
                'recipients_count' => count($batchRecipients),
                'delay_seconds' => $delayInSeconds,
                'scheduled_at' => $delayInSeconds > 0 ? Carbon::now()->addSeconds($delayInSeconds)->toDateTimeString() : 'immediate'
            ]);

            // Dispatch the batch job with appropriate delay
            SendBatchEmail::dispatch($batchRecipients, $this->subject, $this->message, $this->batchSize, $this->delayMinutes, $this->testMode, $batchNumber)
                ->delay(Carbon::now()->addSeconds($delayInSeconds));
        }

        Log::info("All batch jobs dispatched", [
            'total_batches' => $batches->count(),
            'total_recipients' => $totalRecipients,
            'final_batch_will_run_at' => Carbon::now()->addSeconds(($batches->count() - 1) * ($this->delayMinutes * 60))->toDateTimeString()
        ]);
    }
}
