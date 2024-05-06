<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllUsersTasksController extends Controller
{
    public function getUserTasks() : JsonResponse
    {
        $user = auth()->user();
        $tasks = UserTask::where('user_id', $user->id)->with(['task', 'status'])->get();

        return response()->json([
            'tasks' => $tasks,
        ]);
    }

}
