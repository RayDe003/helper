<?php

use App\Http\Controllers\Notifications\AddNotificationsController;
use App\Http\Controllers\SubTasks\AllSubTasksController;
use App\Http\Controllers\SubTasks\CreateSubTaskController;
use App\Http\Controllers\SubTasks\DeleteSubTaskController;
use App\Http\Controllers\SubTasks\UpdateSubTaskController;
use App\Http\Controllers\Tasks\AllUsersTasksController;
use App\Http\Controllers\Tasks\CreateTaskController;
use App\Http\Controllers\Tasks\DeleteTaskController;
use App\Http\Controllers\Tasks\ForDayController;
use App\Http\Controllers\Tasks\ForMonthController;
use App\Http\Controllers\Tasks\ForTwoWeeksController;
use App\Http\Controllers\Tasks\GetOneTaskController;
use App\Http\Controllers\Tasks\UpdateTaskController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\UserRegistrationController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserRegistrationController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/create_task',[CreateTaskController::class, 'create_task']);
    Route::get('/users/info', [LoginController::class, 'info']);
    Route::get('/users/tasks', [AllUsersTasksController::class, 'getUserTasks']);
    Route::get('/users/one_task/{task}',[GetOneTaskController::class, 'getTask']);
    Route::patch('/users/update_task/{task}', [UpdateTaskController::class, 'updateTask']);
    Route::delete('/users/delete_task/{userTask}', [DeleteTaskController::class, 'deleteTask']);
    Route::post('/tasks/{task}/subtasks', [CreateSubTaskController::class, 'create_sub_task']);
    Route::patch('/tasks/{task}/subtasks/{sub_task}', [UpdateSubTaskController::class, 'updateSubTask']);
    Route::get('/tasks/{task}/subtasks', [AllSubTasksController::class, 'getSubTasks']);
    Route::delete('/tasks/{task}/delete_sub_task/{sub_task}', [DeleteSubTaskController::class, "deleteSubTask"]);
    Route::get('/tasks/for_two_weeks', [ForTwoWeeksController::class, "getTwoWeeks"]);
    Route::get('/tasks/by_date', [ForDayController::class, "getByDate"]);
    Route::get('/tasks/by_month', [ForMonthController::class, "getByMonth"]);
    Route::post('/tasks/{task}/notification', [AddNotificationsController::class, 'setNotifications']);
});

