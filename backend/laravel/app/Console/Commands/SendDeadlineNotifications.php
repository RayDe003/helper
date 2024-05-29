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

            // Отправка уведомлений для задач с дедлайном больше месяца
            $this->sendNotifications($tasksWithSystemNotifications, $today, 'monthly', function ($deadline, $today) {
                return Carbon::parse($deadline)->gt($today->copy()->addMonth());
            });

            // Отправка уведомлений для задач с дедлайном от двух недель до месяца
            $this->sendNotifications($tasksWithSystemNotifications, $today, 'weekly', function ($deadline, $today) {
                return Carbon::parse($deadline)->lte($today->copy()->addMonth()) && Carbon::parse($deadline)->gt($today->copy()->addWeeks(2));
            });

            // Отправка уведомлений для задач с дедлайном от одной до двух недель
            $this->sendNotifications($tasksWithSystemNotifications, $today, 'biweekly', function ($deadline, $today) {
                return Carbon::parse($deadline)->lte($today->copy()->addWeeks(2)) && Carbon::parse($deadline)->gt($today->copy()->addWeek());
            });

            // Отправка уведомлений для задач с дедлайном до одной недели
            $this->sendNotifications($tasksWithSystemNotifications, $today, 'daily', function ($deadline, $today) {
                return Carbon::parse($deadline)->lte($today->copy()->addWeek());
            });

            $this->info('Deadline notifications sent successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send deadline notifications: ' . $e->getMessage());
            $this->error('Failed to send deadline notifications.');
        }
    }

    private function sendNotifications($tasks, $today, $frequency, $deadlineCondition)
    {
        foreach ($tasks as $task) {
            $deadline = Carbon::parse($task->deadline);

            foreach ($task->notifications as $notification) {
                if ($deadlineCondition($deadline, $today) && !$this->hasBeenNotifiedRecently($notification, $frequency)) {
                    $user = $task->users()->first()->user()->first();
                    $user->notify(new TaskReminderNotification($task));
                    $this->updateLastNotifiedAt($notification);
                }
            }
        }
    }

    private function hasBeenNotifiedRecently($notification, $frequency)
    {
        $lastNotifiedAt = $notification->last_notified_at;
        if (!$lastNotifiedAt) {
            return false;
        }

        $now = Carbon::now();
        return match ($frequency) {
            'monthly' => $lastNotifiedAt->gt($now->subMonth()),
            'weekly' => $lastNotifiedAt->gt($now->subWeek()),
            'biweekly' => $lastNotifiedAt->gt($now->subDays(3)),
            'daily' => $lastNotifiedAt->gt($now->subDay()),
            default => false,
        };
    }

    private function updateLastNotifiedAt($notification)
    {
        $notification->last_notified_at = Carbon::now();
        $notification->save();
    }

}
