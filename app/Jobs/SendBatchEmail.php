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

        Log::info("Starting " . ($this->testMode ? "TEST MODE - " : "") . "batch email sending", [
            'total_recipients' => $totalRecipients,
            'batch_size' => $this->batchSize,
            'total_batches' => $batches->count(),
            'delay_minutes' => $this->delayMinutes,
            'test_mode' => $this->testMode
        ]);

        foreach ($batches as $index => $batch) {
            $this->sendBatch($batch, $index + 1);

            // Add delay between batches (except for the last batch)
            if ($index < $batches->count() - 1) {
                $delaySeconds = $this->delayMinutes * 60;
                Log::info("Waiting {$this->delayMinutes} minutes before next batch", [
                    'current_batch' => $index + 1,
                    'total_batches' => $batches->count(),
                    'delay_seconds' => $delaySeconds
                ]);
                sleep($delaySeconds);
            }
        }

        Log::info("Batch email sending completed", [
            'total_recipients' => $totalRecipients,
            'total_batches' => $batches->count()
        ]);
    }

    protected function sendBatch($batch, $batchNumber)
    {
        $successCount = 0;
        $failureCount = 0;

        foreach ($batch as $recipient) {
            try {
                if ($this->testMode) {
                    // Test mode - simulate sending without actual email
                    Log::info("TEST MODE - Simulating email send", [
                        'email' => $recipient['email'],
                        'subject' => $this->subject,
                        'batch_number' => $batchNumber
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
                        'batch_number' => $batchNumber
                    ]);
                }

            } catch (\Exception $e) {
                $failureCount++;
                Log::error("Failed to send email", [
                    'email' => $recipient['email'],
                    'error' => $e->getMessage(),
                    'batch_number' => $batchNumber,
                    'test_mode' => $this->testMode
                ]);
            }
        }

        Log::info("Batch " . ($this->testMode ? "(TEST MODE) " : "") . "completed", [
            'batch_number' => $batchNumber,
            'success_count' => $successCount,
            'failure_count' => $failureCount,
            'batch_size' => $batch->count(),
            'test_mode' => $this->testMode
        ]);
    }
}
