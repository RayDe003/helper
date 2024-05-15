<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendWeeklyNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weekly notifications to users about their tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::today();
            $tasksWithWeeklyNotifications = Task::whereHas('notifications', function ($query) {
                $query->where('not_type_id', 2);
            })->with(['notifications', 'users'])->get();

            foreach ($tasksWithWeeklyNotifications as $task) {
                foreach ($task->notifications as $notification) {
                    if ($task->deadline > $currentDate) {
                        $user = $task->users()->where('user_id', $notification->user_id)->first();
                        $user->notify(new TaskReminderNotification($task));
                    }
                }
            }

            $this->info('Weekly notifications sent successfully.');

    }
}
