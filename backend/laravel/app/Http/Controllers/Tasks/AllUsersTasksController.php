<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Resources\AllTasksResource;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AllUsersTasksController extends Controller
{
    public function getUserTasks() : JsonResponse
    {
        $user = auth()->user();
        $tasks = UserTask::where('user_id', $user->id)->with(['task', 'status'])
            ->whereHas('task', function ($query) {
                $query->whereNull('deleted_at');
            })->get();

        $all = AllTasksResource::collection($tasks);

        return response()->json([
            'tasks' => $all,
        ]);
    }

}
