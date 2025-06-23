<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $courses = Course::all();
        $users = User::pluck('id')->toArray();
        
        foreach ($courses as $course) {
            $randomUsers = collect($users)->random(rand(5, 20))->toArray();
            $course->students()->syncWithoutDetaching($randomUsers);
        }
    }
}