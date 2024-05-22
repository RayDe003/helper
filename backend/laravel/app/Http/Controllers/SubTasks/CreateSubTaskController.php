<?php

namespace App\Http\Controllers\SubTasks;

use App\Http\Requests\CreateSubTaskRequest;
use App\Models\SubTask;
use App\Models\Task;
use App\Services\AchievementService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CreateSubTaskController extends Controller
{
    protected $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }
    public function create_sub_task(CreateSubTaskRequest $request, Task $task) : JsonResponse
    {
        $subTask = SubTask::create([
            'text' => $request->text,
            'task_id' => $task->id,
        ]);

        $subTaskCount = SubTask::where('task_id', $task->id)->count();
        if ($subTaskCount >= 10) {
            $user = Auth::user();
            $this->achievementService->updateAchievements($user, 'create_checklist', 1);
        }


        return response()->json([
            'message' => 'Подзадача успешно создана!',
            'sub_task' => $subTask,
        ]);
    }

}
