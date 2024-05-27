<?php

namespace App\Http\Controllers\SystemTasks;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\TaskNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\RandomTasks;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteRandomTask extends Controller
{

    public function deleteRandomTask($id): JsonResponse
    {
        $user = Auth::user();
        $randomTask = RandomTasks::findOrFail($id);

        if ($randomTask->userSystemTask->user_id !== $user->id) {
            throw new AccessDeniedException() ;
        }

        $randomTask->delete();

        return response()->json(['message' => 'Задача успешно удалена']);
    }
}
