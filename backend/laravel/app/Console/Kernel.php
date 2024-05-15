<?php

use App\Models\User;
use App\Notifications\TaskReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notifications:send-daily')->dailyAt('09:00');
        $schedule->command('notifications:send-weekly')->weeklyOn(1, '09:00');
        $schedule->command('notifications:send-selected-days')->daily()->when(function () {
            // Проверяем, что текущий день недели совпадает с выбранными днями недели
            $currentDayOfWeek = Carbon::now()->dayOfWeek;
            $notificationDays = $this->parameters['notification_days'];
            return in_array($currentDayOfWeek, $notificationDays);
        });
    }
}
