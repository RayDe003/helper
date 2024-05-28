<?php

namespace App\Notifications;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskReminderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Task $task
    )
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $deadlineDate = Carbon::parse($this->task->deadline)->format('Y-m-d');
        $url = url('/tasks/' . $deadlineDate . '/' . $this->task->id);

        return (new MailMessage)
            ->greeting("Привет, $notifiable->login")
            ->line('Напоминание о задаче: ' . $this->task->title)
            ->action('Просмотреть задачу', $url)
            ->line('Дедлайн задачи: ' . $this->task->deadline);
    }
}
