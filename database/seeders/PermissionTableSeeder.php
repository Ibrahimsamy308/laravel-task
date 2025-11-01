<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           
           'category-list',
           'category-create',
           'category-edit',
           'category-delete',
          
           'setting-edit',

           'admin-list',
           'admin-create',
           'admin-edit',
           'admin-delete',

           'vendor-list',
           'vendor-create',
           'vendor-edit',
           'vendor-delete',

           'expense-list',
           'expense-create',
           'expense-edit',
           'expense-delete',
        ];
        
        Permission::where('guard_name', 'admin')
        ->whereNotIn('name', $permissions)
        ->delete();
        
        foreach ($permissions as $permission) {
             Permission::updateOrCreate(['name' => $permission,'guard_name'=>'admin']);
        }
    }
}