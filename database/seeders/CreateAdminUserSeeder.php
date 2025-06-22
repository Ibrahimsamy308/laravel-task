<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Faker\Factory as Faker;


class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Super Admin
        $user = Admin::updateOrCreate(
            [
                'email' => 'admin@gmail.com',
                'phone' => '01126785910', 
            ],
            [
            'name' => 'Super Admin',
            'password' => bcrypt('123456789'),
            'type' => 'admin',
            ]);

        $role1 = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);
      

        $permissions1 = Permission::pluck('id', 'id')->all();
      

        $role1->syncPermissions($permissions1);
       

        $user->assignRole([$role1->id]);

        $faker = Faker::create();
        $instructorRole = Role::firstOrCreate(['name' => 'instructor', 'guard_name' => 'admin']);
        
        for ($i = 1; $i <= 15; $i++) {
            $instructor = Admin::updateOrCreate(
            [
                'email' => "instructor$i@gmail.com",
                'phone' => '010' . rand(10000000, 99999999),
            ],
            [
                'name' => $faker->name,
                'password' => bcrypt('123456789'),
                'type' => 'instructor',
                'active' => true,
                'bio' => $faker->paragraph,
                'specialization' => $faker->jobTitle,
                'experience' =>  rand(1, 15),
                'facebook' => 'https://facebook.com/instructor' . $i,
                'instagram' => 'https://instagram.com/instructor' . $i,
                'twitter' => 'https://twitter.com/instructor' . $i,
                'linkedin' => 'https://linkedin.com/in/instructor' . $i,
                'whatsapp' => 'https://wa.me/2010' . rand(10000000, 99999999),
            ]);
            $instructor->file()->create(["url"=>'https://i.pravatar.cc/300?img=' . rand(1, 70)]);
        
            $instructor->assignRole([$instructorRole->id]);
        }
    }
}