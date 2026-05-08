# cPanel Queue Worker Setup for Batch Email System

## Method 1: Cron Job (Recommended for cPanel)

### 1. Create a Cron Job in cPanel

1. **Log in to cPanel**
2. **Go to "Cron Jobs"** 
3. **Add New Cron Job** with these settings:

**Common Settings:**
```
Minute: */5
Hour: *
Day: *
Month: *
Weekday: *
Command: cd /home/yourusername/public_html/your-project-folder && php artisan queue:work --timeout=300 --sleep=10 --tries=3
```

**Alternative (Every 1 minute):**
```
Minute: *
Hour: *
Day: *
Month: *
Weekday: *
Command: cd /home/yourusername/public_html/your-project-folder && php artisan queue:work --timeout=300 --sleep=5 --tries=3
```

### 2. Replace Paths:
- `/home/yourusername/` = Your cPanel home directory
- `public_html/your-project-folder/` = Your Laravel project path
- Adjust based on your actual cPanel structure

### 3. Add Email Notification (Optional)
Add your email to receive cron notifications:
```
Email: your-email@example.com
```

## Method 2: Supervisor (Advanced)

If you have SSH access, install Supervisor:

### 1. Install Supervisor
```bash
sudo yum install supervisor
# or
sudo apt-get install supervisor
```

### 2. Create Supervisor Config
Create file: `/etc/supervisor/conf.d/laravel-worker.conf`

```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /home/yourusername/public_html/your-project-folder/artisan queue:work --sleep=3 --tries=3 --max-time=300
autostart=true
autorestart=true
user=yourusername
numprocs=1
redirect_stderr=true
stdout_logfile=/home/yourusername/public_html/your-project-folder/storage/logs/worker.log
stopwaitsecs=3600
```

### 3. Start Supervisor
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
```

## Method 3: cPanel Terminal (Manual)

### 1. Access Terminal
In cPanel, go to **Terminal** or **SSH Access**

### 2. Run Queue Worker
```bash
cd /home/yourusername/public_html/your-project-folder
nohup php artisan queue:work --timeout=300 --sleep=10 --tries=3 > storage/logs/worker.log 2>&1 &
```

### 3. Check Status
```bash
ps aux | grep "queue:work"
```

## Method 4: Database Queue Configuration

### 1. Update .env
```env
QUEUE_CONNECTION=database
```

### 2. Run Migration (if not done)
```bash
php artisan queue:table
php artisan migrate
```

## Testing Your Setup

### 1. Test Queue Worker
```bash
php artisan queue:work --timeout=300 --tries=3
```

### 2. Monitor Jobs
```bash
php artisan queue:monitor default
```

### 3. Check Logs
```bash
tail -f storage/logs/laravel.log
```

## Troubleshooting

### Common Issues:

1. **Path Issues**: 
   - Use full path: `/home/username/public_html/project/`
   - Check with `pwd` command in terminal

2. **Permission Issues**:
   - Ensure PHP has execute permissions
   - Check storage/logs folder is writable

3. **Memory Issues**:
   - Increase PHP memory limit: `-d memory_limit=512M`
   - Use `--memory=256` option

4. **Cron Not Running**:
   - Check cron email notifications
   - Verify cron syntax with online validator
   - Check cPanel cron logs

### Verify It's Working:
1. Send a test batch email
2. Check queue: `php artisan queue:monitor default`
3. Count should decrease from 2 → 0
4. Check logs for "Batch completed" messages

## Quick Setup Commands

```bash
# Find your cPanel path
pwd

# Test artisan command
php artisan queue:work --timeout=300 --sleep=10 --tries=3

# Check if jobs are processing
php artisan tinker --execute="echo 'Jobs: ' . DB::table('jobs')->count()"
```
