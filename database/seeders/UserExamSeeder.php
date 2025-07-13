<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Exam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::inRandomOrder()->take(5)->get(); 
        $exams = Exam::inRandomOrder()->take(5)->get(); 

        foreach ($users as $user) {
            foreach ($exams->random(2) as $exam) { 
                DB::table('userExams')->insert([
                    'user_id' => $user->id,
                    'exam_id' => $exam->id,
                    'answers' => json_encode([
                        "q1" => "a",
                        "q2" => "c"
                    ]),
                    'score' => rand(5, 10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}