<?php

namespace App\Http\Controllers\Tasks;

use App\Exceptions\NotYourTaskException;
use App\Models\UserTask;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class DeleteTaskController extends Controller
{
    public function deleteTask(UserTask $userTask): JsonResponse
    {
        throw_unless(auth()->user()->id === $userTask->user_id, NotYourTaskException::class);

        $userTask->task->delete();

        return response()->json([
            'message' => 'Задача успешно удалена!',
        ]);
    }
}
