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
           
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
          
           'image-list',
           'image-create',
           'image-edit',          
           'image-delete',
            
           'category-list',
           'category-create',
           'category-edit',
           'category-delete',
          
           'setting-edit',

           'admin-list',
           'admin-create',
           'admin-edit',
           'admin-delete',
           
           'message-list',
           'message-delete',
           'message-reply',
           
           'newsletter-list',
           'newsletter-delete',
           'newsletter-reply',


           'newsletter-list',
           'newsletter-delete',

           'message-list',
           'message-delete',

           'contact-list',
           'contact-create',
           'contact-edit',
           'contact-delete',

           'video-list',
           'video-create',
           'video-edit',
           'video-delete',
           
           'lesson-list',
           'lesson-create',
           'lesson-edit',
           'lesson-delete',
           
           'course-list',
           'course-create',
           'course-edit',
           'course-delete',

           'material-list',
           'material-create',
           'material-edit',
           'material-delete',

           'exam-list',
           'exam-create',
           'exam-edit',
           'exam-delete',
           
        ];
        
        Permission::where('guard_name', 'admin')
        ->whereNotIn('name', $permissions)
        ->delete();
        
        foreach ($permissions as $permission) {
             Permission::updateOrCreate(['name' => $permission,'guard_name'=>'admin']);
        }
    }
}