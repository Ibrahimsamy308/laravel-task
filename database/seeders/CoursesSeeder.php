<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $faker = Faker::create();
        $types = ['live', 'recorded'];
        $levels = ['beginner', 'intermediate', 'advanced'];
        $admins = Admin::where('type', 'instructor')->pluck('id')->toArray();  
        $videos = [
            'https://www.youtube.com/watch?v=j1eO9UOi-sc', 
            'https://www.youtube.com/watch?v=LOS5WB75gkY', 
        ];     
       
        for ($i = 0; $i < 20; $i++) {
            $course = Course::create([
                'ar' => [
                    'title' => 'كورس ' . $faker->word,
                    'description' => $faker->paragraph,
                    'curriculum' => $faker->text(100),
                 
                ],
                'en' => [
                    'title' => 'Course ' . $faker->word,
                    'description' => $faker->paragraph,
                    'curriculum' => $faker->text(100),
                ],
                
                'admin_id' => $faker->randomElement($admins),
                'price' => $faker->randomFloat(2, 100, 1000),
                'discount' => $faker->numberBetween(0, 50),
                'active' => true,
                'start_date' => now()->addDays(rand(1, 10)),
                'end_date' => now()->addDays(rand(20, 40)),
                'duration_hours' => rand(5, 50),
                'type' => $faker->randomElement($types),
                'level' => $faker->randomElement($levels),
                'introVideo' => $faker->randomElement($videos),
                'language' => $faker->randomElement(['ar', 'en']),

            ]);
            $course->file()->create([
                'url' => 'https://i.pravatar.cc/300?img=' . rand(1, 70)
            ]);

        }
    }
}