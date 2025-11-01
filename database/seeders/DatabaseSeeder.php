<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Vendor;
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
            SettingSeeder::class,
            CategorySeeder::class,
            VendorSeeder::class,
            ExpenseSeeder::class,
        ]);
        
    }
}