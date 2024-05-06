<?php

use App\Http\Controllers\Tasks\AllUsersTasksController;
use App\Http\Controllers\Tasks\CreateTaskController;
use App\Http\Controllers\Tasks\GetOneTaskController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\UserRegistrationController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserRegistrationController::class, 'register']);
Route::get('/test', function (\Illuminate\Http\Request $request) {
    return "Hello";
});
Route::post('/login', [LoginController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/create_task',[CreateTaskController::class, 'create_task']);
    Route::get('/users/info', [LoginController::class, 'info']);
    Route::get('/users/tasks', [AllUsersTasksController::class, 'getUserTasks']);
    Route::get('/users/one_task/{task}',[GetOneTaskController::class, 'getTask']);
});


