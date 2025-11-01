<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = Vendor::pluck('id')->toArray();
        $categories = Category::where('is_active', true)->pluck('id')->toArray();
        $users = Admin::pluck('id')->toArray(); 

        if (empty($vendors) || empty($categories) || empty($users)) {
            $this->command->warn('⚠️ Vendors, categories, or users are missing. Run their seeders first.');
            return;
        }


        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Expense::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $desc_en = [
            'Purchased office supplies and stationery.',
            'Paid monthly utility bills (electricity, water, internet).',
            'Business travel expenses for client meeting.',
            'Processed monthly employee salaries.',
            'Performed office maintenance services.',
            'Executed a digital marketing campaign.',
            'Renewed annual software subscriptions.',
            'Covered transportation and fuel costs.',
            'Paid office rent for this month.',
            'Other operational expenses.',
        ];

        $desc_ar = [
            'شراء مستلزمات وقرطاسية المكتب.',
            'دفع فواتير المرافق الشهرية (كهرباء، مياه، إنترنت).',
            'مصاريف سفر للأعمال لاجتماع مع عميل.',
            'صرف رواتب الموظفين الشهرية.',
            'تنفيذ خدمات الصيانة للمكتب.',
            'تنفيذ حملة تسويق رقمي.',
            'تجديد اشتراكات البرامج السنوية.',
            'تغطية تكاليف النقل والوقود.',
            'دفع إيجار المكتب لهذا الشهر.',
            'مصروفات تشغيلية أخرى.',
        ];
        
                    
        for ($i = 0; $i < 20; $i++) {
           
            $expense = Expense::create([
                'ar' => [
                    'description' => $desc_en[array_rand($desc_ar)],
                ],
                'en' => [
                    'description' => $desc_en[array_rand($desc_en)],
                ],
                'category_id' => $categories[array_rand($categories)],
                'vendor_id' => rand(0, 1) ? $vendors[array_rand($vendors)] : null,
                'amount' => rand(100, 5000),
                'date' => now()->subDays(rand(0, 90)),
                'createdBy_id' => $users[array_rand($users)],


            ]);
            
        }
    }
}