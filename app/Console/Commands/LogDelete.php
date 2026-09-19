<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LogDelete extends Command
{
    protected $signature = 'send:log_delete';
    protected $description = 'Delete Laravel log file daily';

    public function handle()
    {
        $logPath = storage_path('logs/laravel.log');

        if (File::exists($logPath)) {
            File::delete($logPath);
            $this->info('Log file deleted successfully.');
        } else {
            $this->info('Log file not found.');
        }

        return 0;
    }
}