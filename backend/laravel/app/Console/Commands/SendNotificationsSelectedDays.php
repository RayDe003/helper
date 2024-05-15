<?php

namespace App\Console\Commands;

use App\Notifications\TaskReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendNotificationsSelectedDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notifications-selected-days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDayOfWeek = Carbon::now()->dayOfWeek; //с 0 воскресенье
        $notifications = Notification::whereJsonContains('notification_days', $currentDayOfWeek)
            ->whereHas('notifications', function ($query) {
                $query->where('not_type_id', 3);
            })
            ->get();

        foreach ($notifications as $notification) {
            if (Carbon::parse($notification->task->deadline)->isFuture()) {
                $notification->user->notify(new TaskReminderNotification($notification->task));
            }
        }

        $this->info('Notifications sent successfully.');
    }
}
