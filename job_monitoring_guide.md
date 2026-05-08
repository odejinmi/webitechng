# Job Monitoring Guide for Batch Email System

## How to Monitor Job Completion

### 1. Check Queue Status
```bash
# Check current queue status
php artisan queue:monitor default

# Check for failed jobs
php artisan queue:failed

# View all queues
php artisan queue:monitor --queues=default
```

### 2. Check Database Tables
```bash
# Check jobs table
php artisan tinker
> DB::table('jobs')->count();
> DB::table('failed_jobs')->count();
> DB::table('jobs')->orderBy('created_at', 'desc')->take(5)->get();
```

### 3. Monitor Laravel Logs
```bash
# Tail the log file in real-time
tail -f storage/logs/laravel.log

# Or check recent entries
grep "batch" storage/logs/laravel.log | tail -20
```

### 4. Check Job Progress in Real-time

#### Method 1: Database Query
```sql
SELECT 
    queue,
    COUNT(*) as pending_jobs,
    COUNT(CASE WHEN attempts > 0 THEN 1 END) as retry_jobs
FROM jobs 
WHERE queue = 'default';
```

#### Method 2: Laravel Command
```bash
# Create a custom monitoring command
php artisan make:command MonitorQueueJobs
```

### 5. Web Interface (Optional)

Create a simple admin page to show job status:

```php
// In your controller
public function queueStatus()
{
    $pending = DB::table('jobs')->count();
    $failed = DB::table('failed_jobs')->count();
    $recent = DB::table('jobs')
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();
    
    return view('admin.queue.status', compact('pending', 'failed', 'recent'));
}
```

### 6. Real-time Monitoring Script

Create a monitoring script:
```bash
#!/bin/bash
while true; do
    echo "=== $(date) ==="
    php artisan queue:monitor default
    echo "Failed jobs: $(php artisan tinker --execute='DB::table("failed_jobs")->count();' | tail -1)"
    echo "---"
    sleep 30
done
```

## What to Look For

### ✅ Success Indicators:
- Jobs count goes from 2 → 0
- No entries in failed_jobs table
- Log shows "Batch #X completed"
- All recipients processed successfully

### ❌ Failure Indicators:
- Jobs stuck in queue (count doesn't decrease)
- Entries in failed_jobs table
- Log shows error messages
- Job attempts > 1

### 📊 Expected Timeline:
- **Immediate**: Coordinator job creates batch jobs
- **Batch #1**: Runs immediately
- **Batch #2**: Runs after delay (15 minutes default)
- **Batch #3**: Runs after another delay
- etc...

## Current Status Check

Run these commands to check current status:

```bash
# Check current queue
php artisan queue:monitor default

# Check for any failed jobs
php artisan queue:failed

# Check recent log entries
grep "batch" storage/logs/laravel.log | tail -10
```
