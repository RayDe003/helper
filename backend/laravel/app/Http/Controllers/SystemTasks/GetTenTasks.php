<?php

namespace App\Http\Controllers\SystemTasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserSystemTaskResource;
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

            return UserSystemTaskResource::collection($randomTasks)->response();
        } else {
            return response()->json(['message' => 'Пользователь не аутентифицирован'], 401);
        }
    }
}
