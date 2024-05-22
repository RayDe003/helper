<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('achievements')->insert([
            [
                'title' => 'Выполнить 5 задач с высоким приоритетом',
                'required_count' => 5,
                'type' => 'high_priority_tasks'
            ],
            [
                'title' => 'Выполнить 10 задач с высоким приоритетом',
                'required_count' => 10,
                'type' => 'high_priority_tasks'
            ],
            [
                'title' => 'Выполнить 50 задач с высоким приоритетом',
                'required_count' => 50,
                'type' => 'high_priority_tasks'
            ],
            [
                'title' => 'Выполнить 100 задач с высоким приоритетом',
                'required_count' => 100,
                'type' => 'high_priority_tasks'
            ],
            [
                'title' => 'Выполнить 5 задач со средним приоритетом',
                'required_count' => 5,
                'type' => 'medium_priority_tasks'
            ],
            [
                'title' => 'Выполнить 10 задач со средним приоритетом',
                'required_count' => 10,
                'type' => 'medium_priority_tasks'
            ],
            [
                'title' => 'Выполнить 50 задач со средним приоритетом',
                'required_count' => 50,
                'type' => 'medium_priority_tasks'
            ],
            [
                'title' => 'Выполнить 100 задач со средним приоритетом',
                'required_count' => 100,
                'type' => 'medium_priority_tasks'
            ],
            [
                'title' => 'Выполнить 5 задач с низким приоритетом',
                'required_count' => 5,
                'type' => 'low_priority_tasks'
            ],
            [
                'title' => 'Выполнить 10 задач с низким приоритетом',
                'required_count' => 10,
                'type' => 'low_priority_tasks'
            ],
            [
                'title' => 'Выполнить 50 задач с низким приоритетом',
                'required_count' => 50,
                'type' => 'low_priority_tasks'
            ],
            [
                'title' => 'Выполнить 100 задач с низким приоритетом',
                'required_count' => 100,
                'type' => 'low_priority_tasks'
            ],
            [
                'title' => 'Выполнить 15 любых задач',
                'required_count' => 15,
                'type' => 'any_tasks'
            ],
            [
                'title' => 'Выполнить 50 любых задач',
                'required_count' => 50,
                'type' => 'any_tasks'
            ],
            [
                'title' => 'Выполнить 100 любых задач',
                'required_count' => 100,
                'type' => 'any_tasks'
            ],
            [
                'title' => 'Поменять название задачи 5 раз',
                'required_count' => 5,
                'type' => 'rename_task'
            ],
            [
                'title' => 'Создать чек листы с 10 подзадачами',
                'required_count' => 10,
                'type' => 'create_checklist'
            ],
            [
                'title' => 'Зарандомить задачи в режиме “спасение от прокрастинации” 10 раз',
                'required_count' => 10,
                'type' => 'procrastination_mode'
            ],
            [
                'title' => 'Зарандомить задачи в режиме “спасение от прокрастинации” 50 раз',
                'required_count' => 50,
                'type' => 'procrastination_mode'
            ],
            [
                'title' => 'Зарандомить задачи в режиме “спасение от прокрастинации” 100 раз',
                'required_count' => 100,
                'type' => 'procrastination_mode'
            ],
            [
                'title' => 'Перерандомить одну задачу более 5 раз',
                'required_count' => 1,
                'type' => 're_random_task'
            ],
            [
                'title' => 'Попасть 20 раз на задачу “Провести минутку в тишине и просто дышать”',
                'required_count' => 20,
                'type' => 'quiet_minute'
            ],
        ]);

        DB::table('achievements')->insert([
            [
                'title' => 'Поставить себе задачи со всеми видами приоритета',
                'type' => 'all_priorities'
            ],
            [
                'title' => 'Выполнять задачи каждый день на протяжении недели',
                'type' => 'daily_tasks_week'
            ],
            [
                'title' => 'Выполнять задачи каждый день на протяжении месяца',
                'type' => 'daily_tasks_month'
            ],
            [
                'title' => 'Изменить частоту уведомлений',
                'type' => 'change_notification_frequency'
            ],
        ]);
    }
}
