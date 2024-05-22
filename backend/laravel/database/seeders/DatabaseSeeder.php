<?php

namespace Database\Seeders;

use App\Models\Achievements;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
           PrioritySeeder::class,
           NotTypeSeeder::class,
           SystemTasksSeeder::class,
           AchievementsSeeder::class,
       ]);
    }
}
