<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuizzesTableSeeder extends Seeder
{
    public function run()
    {
        $userId = DB::table('users')->first()->id;

        DB::table('quizzes')->insert([
            [
                'title' => 'General Knowledge Quiz',
                'is_active' => true,
                'start_time' => now(),
                'duration' => 1800, 
                'winner_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Science Quiz',
                'is_active' => true,
                'start_time' => now(),
                'duration' => 1200, 
                'winner_id' => $userId, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
