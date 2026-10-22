<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class SystemController extends Controller
{
    public function systemInfo(){
        $laravelVersion = app()->version();
        $timeZone = config('app.timezone');
        $pageTitle = 'Application Information';
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);
        return view('admin.system.info',$data, compact('pageTitle', 'laravelVersion','timeZone'));
    }

    public function optimize(){
        $pageTitle = 'Clear System Cache';
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);
        return view('admin.system.optimize',$data, compact('pageTitle'));
    }

    public function optimizeClear(){
        Artisan::call('optimize:clear');
        $notify[] = ['success','Cache cleared successfully'];
        return back()->withNotify($notify);
    }

    public function migration()
    {
        $this->ensureMigrationEnabled();

        $pageTitle = 'Run Database Migration';

        return view('admin.system.migration', compact('pageTitle'));
    }

    public function runMigration()
    {
        $this->ensureMigrationEnabled();

        try {
            $exitCode = Artisan::call('migrate', ['--force' => true]);
        } catch (\Throwable $exception) {
            report($exception);
            $notify[] = ['error', 'Migration failed. Check the application log.'];

            return back()->withNotify($notify);
        }

        if ($exitCode !== 0) {
            $notify[] = ['error', 'Migration failed. Check the application log.'];

            return back()->withNotify($notify);
        }

        $notify[] = ['success', 'Database migration completed successfully.'];

        return back()->withNotify($notify);
    }

    private function ensureMigrationEnabled(): void
    {
        abort_unless(config('app.temporary_admin_migration_enabled'), 404);
        abort_unless(auth('admin')->id() === 1, 403);
    }

    public function systemServerInfo(){
        $currentPHP = phpversion();
        $pageTitle = 'Server Information';
        $serverDetails = $_SERVER;
        $activeTemplate = checkTemplate();
        $data['activeTemplate'] = $activeTemplate;
        $data['activeTemplateTrue'] = checkTemplate(true);
        return view('admin.system.server',$data, compact('pageTitle', 'currentPHP', 'serverDetails'));
    }
}
