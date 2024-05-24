<?php

namespace App\Http\Controllers\Tasks;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\TaskNotFoundException;
use App\Models\Task;
use App\Models\UserTask;
use App\Services\AchievementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UpdateTaskController extends Controller
{
    protected $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    public function updateTask(Request $request, Task $task): JsonResponse
    {
        $user = Auth::user();
        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();
        throw_unless($userTask, AccessDeniedException::class);

        $priorityId = $request->input('priority_id');
        if ($priorityId != null && ($priorityId < 1 || $priorityId > 3)) {
            return response()->json([
                'error' => 'Недопустимое значение приоритета задачи.',
            ], 422);
        }
        $oldTitle = $task->title;
        $newTitle = $request->input('title', $task->title);

        if ($oldTitle !== $newTitle) {
            $task->increment('name_changes_count');
            $this->achievementService->updateAchievements($user, 'rename_task', 1);
        }

        $task->update([
            'title' => $request->input('title', $task->title),
            'description' => $request->input('description', $task->description),
            'deadline' => $request->input('deadline', $task->deadline),
            'priority_id' => $priorityId,
        ]);

        return response()->json([
            'message' => 'Задача успешно обновлена!',
            'task' => $task,
        ]);
    }

}
