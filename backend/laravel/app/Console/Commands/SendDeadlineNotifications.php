<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendDeadlineNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:deadline-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications based on task deadlines.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $tasksWithSystemNotifications = Task::whereHas('notifications', function ($query) {
                $query->where('not_type_id', 4);
            })->with(['notifications', 'users'])->get();

            $today = Carbon::today();

            $monthlyTasks = $tasksWithSystemNotifications->filter(function ($task) use ($today) {
                return Carbon::parse($task->deadline)->gt($today->copy()->addMonth());
            });
            foreach ($monthlyTasks as $task) {
                $user = $task->users()->first()->user()->first();
                $user->notify(new TaskReminderNotification($task));
            }

            $weeklyTasks = $tasksWithSystemNotifications->filter(function ($task) use ($today) {
                $deadline = Carbon::parse($task->deadline);
                return $deadline->lte($today->copy()->addMonth()) && $deadline->gt($today->copy()->addWeeks(2));
            });
            foreach ($weeklyTasks as $task) {
                $user = $task->users()->first()->user()->first();
                $user->notify(new TaskReminderNotification($task));
            }

            $biweeklyTasks = $tasksWithSystemNotifications->filter(function ($task) use ($today) {
                $deadline = Carbon::parse($task->deadline);
                return $deadline->lte($today->copy()->addWeeks(2)) && $deadline->gt($today->copy()->addWeek());
            });
            foreach ($biweeklyTasks as $task) {
                $user = $task->users()->first()->user()->first();
                $user->notify(new TaskReminderNotification($task));
            }

            $dailyTasks = $tasksWithSystemNotifications->filter(function ($task) use ($today) {
                return Carbon::parse($task->deadline)->lte($today->copy()->addWeek());
            });
            foreach ($dailyTasks as $task) {
                $user = $task->users()->first()->user()->first();
                $user->notify(new TaskReminderNotification($task));
            }

            $this->info('Deadline notifications sent successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send deadline notifications: ' . $e->getMessage());
            $this->error('Failed to send deadline notifications.');
        }
    }
}
