<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('notifications:send-daily')->dailyAt('02:00');
Schedule::command('notifications:send-weekly')->weeklyOn(2, '02:00');
Schedule::command('notifications:deadline-notifications')->dailyAt('02:00');
Schedule::command('notifications:selected-days')->dailyAt('10:05');
