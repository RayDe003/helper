<?php

namespace App\Http\Controllers\Tasks;

use App\Exceptions\AccessDeniedException;
use App\Exceptions\TaskNotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\UserTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
    public function upload(Request $request, Task $task)
    {
        $user = Auth::user();

        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();

        throw_unless($userTask, AccessDeniedException::class);

        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('task_files', 'public');

            $task->file = $path;
            $task->save();

            return response()->json(['message' => 'Файл успешно загружен!', 'file_url' => Storage::url($path)], 200);
        }

        throw new TaskNotFoundException ;
    }

    public function download(Task $task)
    {
        $user = Auth::user();

        $userTask = UserTask::where('user_id', $user->id)
            ->where('task_id', $task->id)
            ->first();

        throw_unless($userTask, AccessDeniedException::class);


        if ($task->file && Storage::disk('public')->exists($task->file)) {
            return response()->download(storage_path('app/public/' . $task->file));
        }

        return response()->json(['message' => 'Файл не найден'], 404);
    }

}
