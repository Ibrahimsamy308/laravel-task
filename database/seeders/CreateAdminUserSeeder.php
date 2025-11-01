<?php
    
    namespace Database\Seeders;

    use App\Models\Admin;
    use Illuminate\Database\Seeder;
    use Spatie\Permission\Models\Role;
    use Spatie\Permission\Models\Permission;


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
                    'phone' => '01289189890', 
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




            $staffUser = Admin::updateOrCreate(
                [
                    'email' => 'staff@gmail.com',
                    'phone' => '01289189891',
                ],
                [
                    'name' => 'Staff',
                    'password' => bcrypt('123456789'),
                    'type' => 'staff',
                ]
            );
    
            $staffRole = Role::firstOrCreate(['name' => 'staff', 'guard_name' => 'admin']);
    
            $allowedPermissions = [
                'expense-list',
                'expense-create',
            ];
    
            $staffPermissions = Permission::whereIn('name', $allowedPermissions)->pluck('id', 'id')->all();
            $staffRole->syncPermissions($staffPermissions);
            $staffUser->assignRole([$staffRole->id]);

        
        }
    }