<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendNotificationsSelectedDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:selected-days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications based on selected days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $currentDayOfWeek = Carbon::now()->dayOfWeek; //с 0 воскресенье, 1 - понедельник .... 6 - суббота
            $tasksWithSelectedDaysNotifications = Task::whereHas('notifications', function ($query) use ($currentDayOfWeek) {
                $query->where('not_type_id', 3)
                    ->whereJsonContains('notification_days', $currentDayOfWeek);;
            })->with(['notifications', 'users'])->get();

            foreach ($tasksWithSelectedDaysNotifications  as $task) {
                    $user = $task->users()->first()->user()->first();
                    $user->notify(new TaskReminderNotification($task));
            }


            $this->info('Notifications sent successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to send deadline notifications: ' . $e->getMessage());
            $this->error('Failed to send deadline notifications.');
        }
    }

}
