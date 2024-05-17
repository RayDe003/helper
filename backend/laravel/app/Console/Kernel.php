<?php

use App\Models\User;
use App\Notifications\DailyNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $users = User::all();
            foreach ($users as $user) {
                $user->notify(new DailyNotification());
            }
        })->daily();
    }
}
