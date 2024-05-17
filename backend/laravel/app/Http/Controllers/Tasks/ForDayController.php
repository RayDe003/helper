<?php

namespace App\Http\Controllers\Tasks;

use App\Models\Task;
use App\Models\UserTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ForDayController extends Controller
{
    public function getByDate(Request $request) : JsonResponse
    {
        $date = $request->input('date', Carbon::today()->toDateString());

        $tasks = Task::whereDate('deadline', $date)
            ->with('subTasks')
            ->get();

        return response()->json([
            'tasks' => $tasks,
        ]);
    }

}
