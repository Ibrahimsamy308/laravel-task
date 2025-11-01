<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $title_en = [
            'Office Supplies',
            'Utilities',
            'Travel Expenses',
            'Employee Salaries',
            'Maintenance',
            'Marketing',
            'Software Subscriptions',
            'Transportation',
            'Rent',
            'Miscellaneous',
        ];

        $title_ar = [
            'مستلزمات المكتب',
            'المرافق (كهرباء، مياه، إنترنت)',
            'مصاريف السفر',
            'رواتب الموظفين',
            'الصيانة',
            'التسويق',
            'اشتراكات البرامج',
            'النقل والمواصلات',
            'الإيجار',
            'مصروفات متنوعة',
        ];
                    
        for ($i = 0; $i < count($title_ar); $i++) {
           
            $category = Category::create([
                'ar' => [
                    'title' => $title_ar[$i],
                ],
                'en' => [
                    'title' => $title_en[$i],
                ],
                
                'is_active' => (bool)rand(0, 1),

            ]);
            
        }
    }
}