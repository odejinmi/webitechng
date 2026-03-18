<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FirebaseNotificationService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FirebaseNotificationController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseNotificationService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    /**
     * Display notification form
     */
    public function index()
    {
        $pageTitle = 'Send Notification';
        $users = User::get();
        return view('admin.notifications.index', compact('pageTitle', 'users'));
    }

    /**
     * Send notification to specific user
     */
    public function sendToUser(Request $request)
    {
        Log::info('FirebaseNotificationController::sendToUser called', $request->all());

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
            'data' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::find($request->user_id);
        $result = $this->firebaseService->sendToTopic(
            $user->username,
            $request->title,
            $request->body,
            $request->data ?? []
        );

        return response()->json($result);
    }

    /**
     * Send notification to multiple users
     */
    public function sendToMultipleUsers(Request $request)
    {
        Log::info('FirebaseNotificationController::sendToMultipleUsers called', $request->all());

        $validator = Validator::make($request->all(), [
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
            'data' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $users = User::whereIn('id', $request->user_ids)->get();

        $deviceTokens = $users->pluck('username')->unique()->values()->toArray();

        if (empty($deviceTokens)) {
            return response()->json([
                'success' => false,
                'message' => 'No valid FCM tokens found'
            ], 400);
        }

        $results = $this->firebaseService->sendToMultipleDevices(
            $deviceTokens,
            $request->title,
            $request->body,
            $request->data ?? []
        );

        return response()->json([
            'success' => true,
            'results' => $results,
            'total_sent' => count($results)
        ]);
    }

    /**
     * Send notification to all users
     */
    public function sendToAllUsers(Request $request)
    {
        Log::info('FirebaseNotificationController::sendToAllUsers called', $request->all());

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
            'data' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $users = User::get();
        $deviceTokens = $users->pluck('username')->unique()->values()->toArray();

        if (empty($deviceTokens)) {
            return response()->json([
                'success' => false,
                'message' => 'No users with FCM tokens found'
            ], 400);
        }

        $results = $this->firebaseService->sendToMultipleDevices(
            $deviceTokens,
            $request->title,
            $request->body,
            $request->data ?? []
        );

        return response()->json([
            'success' => true,
            'results' => $results,
            'total_sent' => count($results)
        ]);
    }


    /**
     * Subscribe users to topic
     */
    public function subscribeToTopic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'topic' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $users = User::whereIn('id', $request->user_ids)
                    ->whereNotNull('fcm_token')
                    ->get();

        $deviceTokens = $users->pluck('fcm_token')->unique()->values()->toArray();

        if (empty($deviceTokens)) {
            return response()->json([
                'success' => false,
                'message' => 'No valid FCM tokens found'
            ], 400);
        }

        $result = $this->firebaseService->subscribeToTopic($deviceTokens, $request->topic);

        return response()->json($result);
    }

}
