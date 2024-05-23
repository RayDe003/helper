<?php

namespace App\Console\Commands;

use App\Notifications\VerifyEmailNotification;
use Illuminate\Console\Command;
use App\Models\Task;
use App\Notifications\TaskReminderNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class SendDailyNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily notifications to users about their tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasksWithDailyNotifications = Task::whereHas('notifications', function ($query) {
            $query->where('not_type_id', 1);
        })->with(['notifications', 'users'])->get();

        foreach ($tasksWithDailyNotifications as $task) {
            foreach ($task->notifications as $notification) {
                if ($task->deadline >= Carbon::today()) {
                    $user = $task->users()->first()->user()->first();
                    if ($task instanceof Task) Log::info('ebanat? nahuya ti chitaesh eto??? gay ebaniy');
                    $user->notify(new TaskReminderNotification($task));
                }
            }
        }

        $this->info('Daily notifications sent successfully.');
    }

}
