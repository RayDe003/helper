<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class YourTask
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->tasks()->where('task_id', $task->id)->get()->isNotEmpty();
    }
}
