<?php

use App\Http\Controllers\Achievements\AllAchievementsController;
use App\Http\Controllers\Notifications\AddNotificationsController;
use App\Http\Controllers\Notifications\UpdateNotificationsController;
use App\Http\Controllers\SubTasks\AllSubTasksController;
use App\Http\Controllers\SubTasks\CompleteSubTask;
use App\Http\Controllers\SubTasks\CreateSubTaskController;
use App\Http\Controllers\SubTasks\DeleteSubTaskController;
use App\Http\Controllers\SubTasks\UpdateSubTaskController;
use App\Http\Controllers\SystemTasks\AcceptSystemTask;
use App\Http\Controllers\SystemTasks\AllSystemTasks;
use App\Http\Controllers\SystemTasks\CompleteRandomTask;
use App\Http\Controllers\SystemTasks\DeleteRandomTask;
use App\Http\Controllers\SystemTasks\GetTenTasks;
use App\Http\Controllers\SystemTasks\RandomTasksForToday;
use App\Http\Controllers\SystemTasks\RarandomOneTask;
use App\Http\Controllers\Tasks\AllUsersTasksController;
use App\Http\Controllers\Tasks\CompleteTaskController;
use App\Http\Controllers\Tasks\CreateTaskController;
use App\Http\Controllers\Tasks\DeleteTaskController;
use App\Http\Controllers\Tasks\FileUploadController;
use App\Http\Controllers\Tasks\ForDayController;
use App\Http\Controllers\Tasks\ForMonthController;
use App\Http\Controllers\Tasks\ForTwoWeeksController;
use App\Http\Controllers\Tasks\GetOneTaskController;
use App\Http\Controllers\Tasks\UpdateTaskController;
use App\Http\Controllers\User\EmailVerificationController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\UserRegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserRegistrationController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/email/verify/{user}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware('signed')
    ->name('verification.verify');


Route::middleware('auth:sanctum')->group(function () {

    Route::post('resend-email', [EmailVerificationController::class, 'resend']);

    Route::post('/create_task',[CreateTaskController::class, 'create_task']);
    Route::get('/users/info', [LoginController::class, 'info']);
    Route::get('/users/tasks', [AllUsersTasksController::class, 'getUserTasks']);
    Route::get('/users/one_task/{task}',[GetOneTaskController::class, 'getTask']);
    Route::patch('/users/update_task/{task}', [UpdateTaskController::class, 'updateTask']);
    Route::delete('/users/delete_task/{task}', [DeleteTaskController::class, 'deleteTask']);
    Route::patch('/tasks/{task}/complete', [CompleteTaskController::class, 'updateStatus']);

    Route::get('/tasks/for_two_weeks', [ForTwoWeeksController::class, "getTwoWeeks"]);
    Route::get('/tasks/by_date', [ForDayController::class, "getByDate"]);
    Route::get('/tasks/by_month', [ForMonthController::class, "getByMonth"]);

    Route::post('/tasks/{task}/notification', [AddNotificationsController::class, 'setNotifications']);
    Route::patch('/tasks/{task}/notification_change', [UpdateNotificationsController::class, 'updateNotifications']);

    Route::post('/tasks/{task}/subtasks', [CreateSubTaskController::class, 'create_sub_task']);
    Route::patch('/tasks/{task}/subtasks/{sub_task}', [UpdateSubTaskController::class, 'updateSubTask']);
    Route::get('/tasks/{task}/subtasks', [AllSubTasksController::class, 'getSubTasks']);
    Route::delete('/tasks/{task}/delete_sub_task/{sub_task}', [DeleteSubTaskController::class, "deleteSubTask"]);
    Route::patch('/tasks/{task}/complete/{sub_task}', [CompleteSubTask::class, 'updateStatus']);

    Route::get('/system_tasks', [AllSystemTasks::class, 'getAllTasks']);
    Route::patch('system_tasks/{id}/accept', [AcceptSystemTask::class, 'updateAccept']);
    Route::get('system_tasks/random', [GetTenTasks::class, "getRandomTasks"]);
    Route::post('system_tasks/rerandom', [RarandomOneTask::class, 'rerandomTask']);
    Route::get('system_tasks/today', [RandomTasksForToday::class, 'randomTasksForToday']);
    Route::delete('system_tasks/{id}/delete', [DeleteRandomTask::class, 'deleteRandomTask']);
    Route::patch('system_tasks/complete', [RandomTasksForToday::class, 'completeRandomTask']);

    Route::get('/achievements', [AllAchievementsController::class, 'getAllAchievements']);

    Route::post('/tasks/{task}/upload', [FileUploadController::class, 'upload']);
    Route::get('/tasks/{task}/download', [FileUploadController::class, 'download']);
});

