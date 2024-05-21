<?php

namespace App\Http\Controllers\SystemTasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\RandomTasksResource;
use App\Http\Resources\UserSystemTaskResource;
use App\Models\RandomTasks;
use App\Models\UsersSystemTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetTenTasks extends Controller
{

    public function getRandomTasks(): JsonResponse
    {
        $user = Auth::user();

        if ($user) {
            $randomTasks = UsersSystemTask::where('user_id', $user->id)
                ->where('accept', true)
                ->inRandomOrder()
                ->limit(10)
                ->with('systemTask')
                ->get();

            foreach ($randomTasks as $task) {
                RandomTasks::create([
                    'user_system_task_id' => $task->id,
                    'is_complete' => false,
                ]);
            }

            $latestRandomTasks = RandomTasks::whereHas('userSystemTask', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->with('userSystemTask.systemTask')
                ->get();

            return RandomTasksResource::collection($latestRandomTasks)->response();

        } else {
            return response()->json(['message' => 'Пользователь не аутентифицирован'], 401);
        }
    }
}
