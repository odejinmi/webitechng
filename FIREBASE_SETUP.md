# Firebase Cloud Messaging (FCM) Setup for Laravel

This guide will help you set up Firebase notifications in your Laravel application for sending push notifications from the admin panel.

## 1. Firebase Project Setup

1. Go to [Firebase Console](https://console.firebase.google.com/)
2. Create a new project or select an existing one
3. Enable Cloud Messaging API
4. Go to Project Settings > Service Accounts
5. Generate a new private key and download the JSON file
6. Go to Project Settings > Cloud Messaging to get your Server Key and Sender ID

## 2. Environment Configuration

Add the following to your `.env` file:

```env
FIREBASE_SERVER_KEY=your_server_key_here
FIREBASE_SENDER_ID=your_sender_id_here
```

## 3. Database Migration

Run the migration to add the `fcm_token` column to the users table:

```bash
php artisan migrate
```

## 4. API Endpoints for Mobile App

Your mobile app can use these API endpoints to manage FCM tokens:

### Update FCM Token
```
POST /api/fcm/token/update
Headers: Authorization: Bearer {token}
Body: {
    "fcm_token": "device_fcm_token"
}
```

### Remove FCM Token
```
DELETE /api/fcm/token/remove
Headers: Authorization: Bearer {token}
```

### Get Current FCM Token
```
GET /api/fcm/token
Headers: Authorization: Bearer {token}
```

## 5. Admin Panel Usage

Access the Firebase notification interface:
- Go to Admin Panel
- Click on "Firebase Notifications" in the sidebar menu
- You can send notifications to:
  - Single user
  - Multiple users
  - All users
  - Specific topics

## 6. Features

### Single User Notification
- Select a specific user from the dropdown
- Send personalized notifications

### Multiple Users Notification
- Select multiple users using checkboxes
- Bulk notification sending

### All Users Notification
- Send notifications to all users with FCM tokens
- Confirmation dialog before sending

### Topic-based Notification
- Send notifications to specific topics
- Useful for categorized notifications

### Additional Features
- Custom data payload support (JSON format)
- Real-time delivery status
- Error handling and reporting

## 7. Mobile App Integration

### Android Setup
```java
// Add to your Android app
// Initialize Firebase
FirebaseMessaging.getInstance().getToken()
    .addOnCompleteListener(new OnCompleteListener<String>() {
        @Override
        public void onComplete(@NonNull Task<String> task) {
            if (!task.isSuccessful()) {
                Log.w(TAG, "Fetching FCM registration token failed", task.getException());
                return;
            }
            
            String token = task.getResult();
            // Send this token to your Laravel API
            sendTokenToServer(token);
        }
    });
```

### iOS Setup
```swift
// Add to your iOS app
import FirebaseMessaging

func messaging(_ messaging: Messaging, didReceiveRegistrationToken fcmToken: String?) {
    let token = fcmToken ?? ""
    // Send this token to your Laravel API
    sendTokenToServer(token)
}
```

## 8. Testing

You can test the notifications using:
1. The admin panel interface
2. Postman/curl for API endpoints
3. Firebase Console's notification composer

## 9. Troubleshooting

### Common Issues
- **"Invalid registration token"**: User's FCM token has expired, ask them to update the app
- **"NotRegistered"**: User uninstalled the app or cleared data
- **"MissingAuthorization"**: Check your Firebase server key in .env

### Debugging
- Check Laravel logs: `storage/logs/laravel.log`
- Verify Firebase project settings
- Ensure mobile app is properly configured

## 10. Security Considerations

- Never expose your Firebase server key in client-side code
- Validate FCM tokens before storing
- Implement rate limiting for notification sending
- Use HTTPS for all API calls

## 11. Advanced Features

### Custom Notification Icons
```php
$data = [
    'icon' => 'custom_icon_name',
    'click_action' => 'OPEN_ACTIVITY',
    'custom_key' => 'custom_value'
];
```

### Scheduled Notifications
You can extend the service to support scheduled notifications using Laravel's task scheduling.

### Notification Analytics
Track delivery rates, open rates, and user engagement with sent notifications.

## 12. Files Created/Modified

- `app/Services/FirebaseNotificationService.php` - Core notification service
- `app/Http/Controllers/Admin/FirebaseNotificationController.php` - Admin controller
- `app/Http/Controllers/Api/FcmTokenController.php` - API controller for mobile apps
- `database/migrations/2024_02_07_000001_add_fcm_token_to_users_table.php` - Database migration
- `resources/views/admin/notifications/index.blade.php` - Admin UI
- `routes/admin.php` - Admin routes (modified)
- `routes/api.php` - API routes (modified)
- `config/services.php` - Firebase configuration (modified)

## Support

For issues and questions, check the Firebase documentation or Laravel documentation.
