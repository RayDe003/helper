<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('notifications:send-daily')->dailyAt('02:00');
Schedule::command('notifications:send-weekly')->weeklyOn(1, '06:00');
