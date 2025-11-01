<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $title_en = [
            'Office Plus Supplies',
            'Techno World',
            'Travel Experts',
            'Green Foods Company',
            'Elite Maintenance Services',
            'Smart Ads Agency',
            'Digital Software Hub',
            'City Transport',
            'Modern Rentals',
            'BizTools Limited',
        ];

        $title_ar = [
            'مستلزمات أوفيس بلس',
            'عالم التقنية',
            'خبراء السفر',
            'شركة الأغذية الخضراء',
            'خدمات الصيانة المميزة',
            'وكالة الإعلانات الذكية',
            'مركز البرمجيات الرقمية',
            'نقل المدينة',
            'الإيجارات الحديثة',
            'أدوات الأعمال المحدودة',
        ];

                    
        for ($i = 0; $i < count($title_ar); $i++) {
           
            $vendor = Vendor::create([
                'ar' => [
                    'title' => $title_ar[$i],
                ],
                'en' => [
                    'title' => $title_en[$i],
                ],
                'contact_info' => 'vendor' . ($i + 1) . '@example.com, +2011000000' . str_pad($i + 1, 2, '0', STR_PAD_LEFT),
                'is_active' => (bool)rand(0, 1),

            ]);
            
        }
    }
}