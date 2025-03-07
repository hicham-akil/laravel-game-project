<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            [
                'quiz_id' => 1, 
                'question' => 'What is the capital of France?',
                'option_a' => 'Berlin',
                'option_b' => 'Madrid',
                'option_c' => 'Paris',
                'option_d' => 'Rome',
                'correct_option' => 'c', 
            ],
            [
                'quiz_id' => 1, 
                'question' => 'What is 2 + 2?',
                'option_a' => '3',
                'option_b' => '4',
                'option_c' => '5',
                'option_d' => '6',
                'correct_option' => 'b',
            ],
            [
                'quiz_id' => 2,
                'question' => 'Which programming language is used for Laravel?',
                'option_a' => 'Java',
                'option_b' => 'Python',
                'option_c' => 'PHP',
                'option_d' => 'C++',
                'correct_option' => 'c',
            ],
        ];

        foreach ($questions as $question) {
            DB::table('questions')->insert([
                'quiz_id' => $question['quiz_id'],
                'question' => $question['question'],
                'option_a' => $question['option_a'],
                'option_b' => $question['option_b'],
                'option_c' => $question['option_c'],
                'option_d' => $question['option_d'],
                'correct_option' => $question['correct_option'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
