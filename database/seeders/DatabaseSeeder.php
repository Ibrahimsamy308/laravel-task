<?php

namespace Database\Seeders;

use App\Http\Requests\Dashboard\OrderproductRequest;
use App\Http\Requests\Dashboard\ReviewRequest;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Careerrequest;
use App\Models\CategoryNews;
use App\Models\News;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Solutionrequest;
use App\Models\Team;
use App\Models\TrainerAppointment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call([
          
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            CategorySeeder::class,
            // BrandsSeeder::class,
            // StoresSeeder::class,
            // SizesSeeder::class,
            // ColorsSeeder::class,
            SubcategoriesSeeder::class,
            // ProductOffersSeeder::class,
            ProductSeeder::class,
            // ProductVariationsSeeder::class,
            // BannersSeeder::class,
            SlidersSeeder::class,
            // ItemRequestSeeder::class,

            
            NewslettersSeeder::class,
            ContactsSeeder::class,
            PagesSeeder::class,
            SettingSeeder::class,
            UsersSeeder::class,
            // FaqsSeeder::class,
            // OffersSeeder::class,
        ]);
        
    }
}