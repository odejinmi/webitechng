<?php

namespace App\Jobs;

use App\Notify\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendBatchEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $recipients;
    protected $subject;
    protected $message;
    protected $batchSize;
    protected $delayMinutes;
    protected $testMode;
    protected $currentBatch;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipients, $subject, $message, $batchSize = 30, $delayMinutes = 15, $testMode = false, $currentBatch = 1)
    {
        $this->recipients = $recipients;
        $this->subject = $subject;
        $this->message = $message;
        $this->batchSize = $batchSize;
        $this->delayMinutes = $delayMinutes;
        $this->testMode = $testMode;
        $this->currentBatch = $currentBatch;
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
        
        Log::info("Processing " . ($this->testMode ? "TEST MODE - " : "") . "batch #{$this->currentBatch}", [
            'total_recipients_in_batch' => $totalRecipients,
            'batch_number' => $this->currentBatch,
            'test_mode' => $this->testMode
        ]);

        $successCount = 0;
        $failureCount = 0;

        foreach ($recipients as $recipient) {
            try {
                if ($this->testMode) {
                    // Test mode - simulate sending without actual email
                    Log::info("TEST MODE - Simulating email send", [
                        'email' => $recipient['email'],
                        'subject' => $this->subject,
                        'batch_number' => $this->currentBatch
                    ]);
                    $successCount++;
                } else {
                    // Production mode - actually send email
                    $email = new Email();
                    $email->email = $recipient['email'];
                    $email->subject = $this->subject;
                    $email->receiverName = $recipient['fullname'];

                    // Set the message content
                    $email->finalMessage = $this->message;

                    // Get the global settings
                    $email->setting = \App\Models\GeneralSetting::first();

                    // Send the email
                    $email->send();
                    $successCount++;

                    Log::info("Email sent successfully", [
                        'email' => $recipient['email'],
                        'batch_number' => $this->currentBatch
                    ]);
                }

            } catch (\Exception $e) {
                $failureCount++;
                Log::error("Failed to send email", [
                    'email' => $recipient['email'],
                    'error' => $e->getMessage(),
                    'batch_number' => $this->currentBatch,
                    'test_mode' => $this->testMode
                ]);
            }
        }

        Log::info("Batch " . ($this->testMode ? "(TEST MODE) " : "") . "#{$this->currentBatch} completed", [
            'success_count' => $successCount,
            'failure_count' => $failureCount,
            'batch_size' => $totalRecipients,
            'test_mode' => $this->testMode
        ]);
    }
}
