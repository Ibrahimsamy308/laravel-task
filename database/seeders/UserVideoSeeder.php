<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

class UserVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::inRandomOrder()->take(10)->get();
        $videos = Video::all();

        foreach ($users as $user) {
            foreach ($videos->random(5) as $video) {
                DB::table('userVideos')->insert([
                    'user_id' => $user->id,
                    'video_id' => $video->id,
                    'watched_at' => now()->subDays(rand(0, 10))->subMinutes(rand(0, 60)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}