<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('not_type')->insert([
            ['title' => 'Каждый день'],
            ['title' => 'Каждую неделю'],
            ['title' => 'Выбрать дни'],
            ['title' => 'Системные']
        ]);
    }
}
