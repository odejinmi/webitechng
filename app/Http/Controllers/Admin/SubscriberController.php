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
            'sending_mode' => 'required|in:queue,live',
        ]);

        $subscribers = Subscriber::all();
        $total = $subscribers->count();

        if ($total == 0) {
            $notify[] = ['error', 'No subscribers found.'];
            return back()->withNotify($notify);
        }

        if ($request->sending_mode == 'queue') {
            $batchSize = $request->batch_size ?? 30;
            $delayMinutes = $request->delay_minutes ?? 15;
            $recipients = [];
            foreach ($subscribers as $subscriber) {
                $receiverName = explode('@', $subscriber->email)[0];
                $recipients[] = [
                    'username' => $subscriber->email,
                    'email' => $subscriber->email,
                    'fullname' => $receiverName,
                ];
            }
            \App\Jobs\SendBatchEmailCoordinator::dispatch($recipients, $request->subject, $request->body, $batchSize, $delayMinutes, false);
            $notify[] = ['success', 'Email batch job has been queued via Background Cron.'];
            return back()->withNotify($notify);
        }

        // Live Mode Logic
        session()->put('email_sending_data', [
            'subject' => $request->subject,
            'body' => $request->body,
            'total' => $total,
            'sent' => 0,
            'subscriber_ids' => $subscribers->pluck('id')->toArray(),
        ]);

        $pageTitle = 'Sending Emails (Live)';
        return view('admin.subscriber.progress', compact('pageTitle', 'total'));
    }

    public function sendEmailLive(Request $request)
    {
        $data = session()->get('email_sending_data');
        if (!$data) {
            return response()->json(['error' => 'No active session found.'], 400);
        }

        $subscriberIds = $data['subscriber_ids'];
        $chunkSize = 10; // Send 10 emails at once
        $currentBatch = array_slice($subscriberIds, $data['sent'], $chunkSize);

        if (empty($currentBatch)) {
            session()->forget('email_sending_data');
            return response()->json(['complete' => true]);
        }

        foreach ($currentBatch as $id) {
            $subscriber = Subscriber::find($id);
            if ($subscriber) {
                $receiverName = explode('@', $subscriber->email)[0];
                notify($subscriber, 'DEFAULT', [
                    'subject' => $data['subject'],
                    'message' => $data['body'],
                ], ['email']);
            }
        }

        $data['sent'] += count($currentBatch);
        session()->put('email_sending_data', $data);

        return response()->json([
            'sent' => $data['sent'],
            'total' => $data['total'],
            'percent' => round(($data['sent'] / $data['total']) * 100, 2),
            'complete' => false
        ]);
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
