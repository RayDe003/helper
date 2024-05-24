<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\UserTask;
use App\Services\AchievementService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CreateTaskController extends Controller
{
    protected $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }
    public function create_task(CreateTaskRequest $request) : JsonResponse
    {
        $deadline = $request->filled('deadline') ? $request->deadline : now();

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $deadline,
            'priority_id' => $request->priority_id,
        ]);

       UserTask::create([
            'user_id' => auth()->user()->id,
            'task_id' => $task->id,
        ]);

        $user = Auth::user();

        $hasHighPriority = UserTask::whereHas('task', function ($query) {
            $query->where('priority_id', 3);
        })->where('user_id', $user->id)->exists();

        $hasMediumPriority = UserTask::whereHas('task', function ($query) {
            $query->where('priority_id', 2);
        })->where('user_id', $user->id)->exists();

        $hasLowPriority = UserTask::whereHas('task', function ($query) {
            $query->where('priority_id', 1);
        })->where('user_id', $user->id)->exists();

        if ($hasHighPriority && $hasMediumPriority && $hasLowPriority) {
            $this->achievementService->updateAchievements($user, 'all_priorities');
        }

        return response()->json([
            'message' => 'Задача успешно создана!',
            'task' => $task,
        ]);
    }

}
