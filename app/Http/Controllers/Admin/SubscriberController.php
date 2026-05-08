<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendBatchEmailCoordinator;
use App\Models\GeneralSetting;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $pageTitle = 'Subscriber Manager';
        $subscribers = Subscriber::orderBy('id','desc')->paginate(getPaginate());
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);
        return view('admin.subscriber.index', $data, compact('pageTitle', 'subscribers'));
    }

    public function sendEmailForm()
    {
        $pageTitle = 'Email to Subscribers';
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);
        
        // Get current batch settings
        $general = GeneralSetting::first();
        $batchSize = $general->email_batch_size ?? 30;
        $delayMinutes = $general->email_batch_delay ?? 15;
        
        return view('admin.subscriber.send_email', $data, compact('pageTitle', 'batchSize', 'delayMinutes'));
    }

    public function remove($id)
    {
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();

        $notify[] = ['success', 'Subscriber deleted successfully'];
        return back()->withNotify($notify);
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required',
            'batch_size' => 'nullable|integer|min:1|max:100',
            'delay_minutes' => 'nullable|integer|min:1|max:60',
            'test_mode' => 'nullable|boolean',
        ]);

        // Get batch settings from request or defaults
        $general = GeneralSetting::first();
        $batchSize = $request->batch_size ?? $general->email_batch_size ?? 30;
        $delayMinutes = $request->delay_minutes ?? $general->email_batch_delay ?? 15;

        // Prepare recipients
        $subscribers = Subscriber::cursor();
        $recipients = [];
        
        foreach ($subscribers as $subscriber) {
            $receiverName = explode('@', $subscriber->email)[0];
            $recipients[] = [
                'username' => $subscriber->email,
                'email' => $subscriber->email,
                'fullname' => $receiverName,
            ];
        }

        // Check if test mode is enabled
        $testMode = $request->input('test_mode') == '1';
        
        // Dispatch batch email coordinator job
        SendBatchEmailCoordinator::dispatch($recipients, $request->subject, $request->body, $batchSize, $delayMinutes, $testMode);

        $modeText = $testMode ? 'TEST MODE - ' : '';
        $notify[] = ['success', $modeText . 'Email batch job has been queued. ' . count($recipients) . ' emails will be ' . ($testMode ? 'simulated' : 'sent') . ' in batches of ' . $batchSize . ' with ' . $delayMinutes . ' minutes delay between batches.'];
        return back()->withNotify($notify);
    }

    public function batchSettings()
    {
        $pageTitle = 'Email Batch Settings';
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);
        
        $general = GeneralSetting::first();
        
        return view('admin.subscriber.batch_settings', $data, compact('pageTitle', 'general'));
    }

    public function updateBatchSettings(Request $request)
    {
        $request->validate([
            'email_batch_size' => 'required|integer|min:1|max:100',
            'email_batch_delay' => 'required|integer|min:1|max:60',
        ]);

        $general = GeneralSetting::first();
        $general->email_batch_size = $request->email_batch_size;
        $general->email_batch_delay = $request->email_batch_delay;
        $general->save();

        $notify[] = ['success', 'Email batch settings updated successfully'];
        return back()->withNotify($notify);
    }
}
