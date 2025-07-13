<?php

namespace Database\Seeders;


use App\Models\Lesson;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
        $lessons = Lesson::all();
    
        foreach ($lessons as $lesson) {
            $videosCount = rand(3, 5); // على الأقل 3 فيديوهات، وممكن لحد 5

            for ($i = 1; $i <= $videosCount; $i++) {
                Video::create([
                    'ar' => [
                        'title' => 'درس ' . $lesson->id . ' - فيديو ' . $i,
                        'description' => $faker->sentence(10),
                    ],
                    'en' => [
                        'title' => 'Lesson ' . $lesson->id . ' - Video ' . $i,
                        'description' => $faker->sentence(10),
                    ],
                    'lesson_id' => $lesson->id,
                    'url' => 'https://www.youtube.com/watch?v=' . Str::random(10),
                    'duration' => rand(5, 15) * 60, 
                    'provider' => 'youtube',
                    'is_active' => true,
                ]);
            }
        }
    }
}