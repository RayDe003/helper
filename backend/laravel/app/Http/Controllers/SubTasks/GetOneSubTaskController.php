<?php

namespace App\Http\Controllers\SubTasks;

use App\Models\SubTask;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;


class GetOneSubTaskController extends Controller
{
    public function getSubTask(SubTask $subTask) : JsonResponse
    {
        return response()->json(['subTask' => $subTask]);
    }

}
