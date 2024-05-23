<?php

namespace App\Console;

use App\Console\Commands\SendDailyNotifications;
use App\Models\User;
use App\Notifications\TaskReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
    }
}
