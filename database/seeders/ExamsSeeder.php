<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Lesson;

class ExamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $lessons = Lesson::all();

        foreach ($lessons as $lesson) {
            $questions = [];

            for ($i = 0; $i < rand(3, 5); $i++) {
                $q = [
                    'question' => $faker->sentence,
                    'answers' => [
                        $faker->word,
                        $faker->word,
                        $faker->word,
                        $faker->word,
                    ],
                    'correct' => null,
                ];

                $q['correct'] = $faker->randomElement($q['answers']);

                $questions[] = $q;
            }

            Exam::create([
                'course_id' => $lesson->course_id,
                'lesson_id' => $lesson->id,
                'questions' => json_encode($questions),
            ]);
        }
    }
}