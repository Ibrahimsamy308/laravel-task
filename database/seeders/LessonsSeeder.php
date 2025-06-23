<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Course;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $courses = Course::all();
                    
        foreach ($courses as $course) {
            $lessonsCount = rand(3, 7); 

            for ($i = 1; $i <= $lessonsCount; $i++) {
                Lesson::create([
                    'ar' => [
                        'title' => 'درس ' . $faker->word,
                        'description' => $faker->paragraph,
                    ],
                    'en' => [
                        'title' => 'Lesson ' . $faker->word,
                        'description' => $faker->paragraph,
                    ],
                    'course_id' => $course->id,
                    'video_url' => 'https://www.youtube.com/watch?v=' . $faker->bothify('???###'),
                    'duration' => rand(5, 30), 
                    'lessonOrder' => $i,
                    'is_free' => $i == 1 ? true : (bool)rand(0, 1),
                ]);
            }
        }
    }
}