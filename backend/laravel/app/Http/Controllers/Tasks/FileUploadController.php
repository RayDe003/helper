<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
    public function upload(Request $request, Task $task)
    {
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

        return response()->json(['message' => 'Файл не загружен'], 400);
    }

    public function download(Task $task)
    {
        if ($task->file && Storage::disk('public')->exists($task->file)) {
            return response()->download(storage_path('app/public/' . $task->file));
        }

        return response()->json(['message' => 'Файл не найден'], 404);
    }

}
