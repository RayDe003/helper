<?php

namespace App\Http\Controllers\SubTasks;

use App\Http\Resources\AllTasksResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AllSubTasksController extends Controller
{
    public function getSubTasks(Task $task) : JsonResponse
    {
        $subTasks = $task->subTasks()->get();

        $all = AllTasksResource::collection($subTasks);

        return response()->json([
            'sub_tasks' => $all,
        ]);
    }

}
