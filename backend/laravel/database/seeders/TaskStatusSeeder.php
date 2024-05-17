<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_status')->insert([
            ['name' => 'Запланировано'],
            ['name' => 'Сдана'],
            ['name' => 'Просрочена'],
        ]);
    }
}
