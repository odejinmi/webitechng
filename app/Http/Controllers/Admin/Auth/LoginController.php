<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laramin\Utility\Onumoti;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = 'admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin.guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {

        \Cache::flush();
        $pageTitle = "Admin Login";
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);
        return view('admin.auth.login', $data, compact('pageTitle'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        // Log the login attempt
        Log::info('Admin login attempt started', [
            'username' => $request->input('username'),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'timestamp' => now()
        ]);

        // Validate login
        try {
            $this->validateLogin($request);
            Log::info('Login validation passed');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Login validation failed', [
                'errors' => $e->errors(),
                'input' => $request->only(['username'])
            ]);
            throw $e;
        }

        $request->session()->regenerateToken();

        if (!verifyCaptcha()) {
            Log::warning('Captcha verification failed', [
                'username' => $request->input('username'),
                'ip' => $request->ip()
            ]);
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        Log::info('Captcha verification passed');

        try {
            Onumoti::getData();
            Log::info('Onumoti::getData() executed successfully');
        } catch (\Exception $e) {
            Log::error('Onumoti::getData() failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }

        // Check for too many login attempts
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            Log::warning('Too many login attempts', [
                'username' => $request->input('username'),
                'ip' => $request->ip()
            ]);
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Attempt login with detailed logging
        $credentials = $this->credentials($request);
        Log::info('Attempting login with credentials', [
            'username' => $credentials['username'] ?? 'not_set',
            'password_provided' => !empty($credentials['password']),
            'guard' => 'admin'
        ]);

        // Check if user exists before attempting login
        $adminModel = config('auth.providers.admins.model', \App\Models\Admin::class);
        $admin = $adminModel::where('username', $credentials['username'])->first();

        if (!$admin) {
            Log::warning('Admin user not found', [
                'username' => $credentials['username'],
                'model' => $adminModel
            ]);
        } else {
            Log::info('Admin user found', [
                'admin_id' => $admin->id,
                'username' => $admin->username,
                'status' => $admin->status ?? 'no_status_field',
                'created_at' => $admin->created_at
            ]);

            // Check if admin is active (if you have a status field)
            if (isset($admin->status) && $admin->status != 1) {
                Log::warning('Admin account is inactive', [
                    'admin_id' => $admin->id,
                    'status' => $admin->status
                ]);
            }
        }

        if ($this->attemptLogin($request)) {
            Log::info('Login attempt successful', [
                'admin_id' => auth()->guard('admin')->id(),
                'username' => $request->input('username')
            ]);
            return $this->sendLoginResponse($request);
        }

        // Login failed - log the failure reason
        Log::error('Login attempt failed', [
            'username' => $request->input('username'),
            'user_exists' => $admin ? 'yes' : 'no',
            'user_status' => $admin->status ?? 'unknown',
            'ip' => $request->ip(),
            'credentials_keys' => array_keys($credentials)
        ]);

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    // Override attemptLogin to add more detailed logging
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        Log::info('Attempting authentication', [
            'guard' => 'admin',
            'credentials' => array_keys($credentials),
            'username' => $credentials['username'] ?? 'not_provided'
        ]);

        $result = $this->guard()->attempt($credentials, $request->filled('remember'));

        Log::info('Authentication result', [
            'success' => $result,
            'guard' => 'admin'
        ]);

        return $result;
    }

    // Override sendFailedLoginResponse to provide more specific error messages
    protected function sendFailedLoginResponse(Request $request)
    {
        $username = $request->input('username');
        $adminModel = config('auth.providers.admins.model', \App\Models\Admin::class);
        $admin = $adminModel::where('username', $username)->first();

        $errorMessage = 'These credentials do not match our records.';

        if (!$admin) {
            $errorMessage = 'No admin account found with this username.';
            Log::error('Login failed: Admin not found', ['username' => $username]);
        } elseif (isset($admin->status) && $admin->status != 1) {
            $errorMessage = 'Your admin account is inactive.';
            Log::error('Login failed: Admin account inactive', [
                'username' => $username,
                'status' => $admin->status
            ]);
        } else {
            $errorMessage = 'Invalid password provided.';
            Log::error('Login failed: Invalid password', ['username' => $username]);
        }

        $notify[] = ['error', $errorMessage];
        return back()->withNotify($notify)->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Log::info('Admin logout', [
            'admin_id' => auth()->guard('admin')->id(),
            'ip' => $request->ip()
        ]);

        $this->guard('admin')->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/admin');
    }
}
