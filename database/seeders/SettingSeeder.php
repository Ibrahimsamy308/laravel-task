<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'en' => [
                'appointment' => 'Available: 24/7',
                'copyright' => 'All rights reserved. © Ibrahim Samy 2025.',
                'title' => 'Expense Management System',
                'address' => 'Web-based platform for managing vendors and expenses efficiently',
                'description' => "Expense Management System is a smart solution designed to help businesses organize and track their vendors, expense categories, and financial transactions with ease. It provides a clear overview, secure access, and detailed reports to support better decision-making.",
                'meta_data' => 'Expense Management System - Vendors, Expenses, Reports, Financial Management, Dashboard',
            ],
        
            'ar' => [
                'appointment' => 'متاح على مدار الساعة طوال أيام الأسبوع',
                'copyright' => '© 2025 إبراهيم سامي. جميع الحقوق محفوظة.',
                'title' => 'نظام إدارة المصروفات',
                'address' => 'منصة إلكترونية لإدارة الموردين والمصروفات بكفاءة',
                'description' => "نظام إدارة المصروفات هو حل ذكي مصمم لمساعدة الشركات على تنظيم وتتبع الموردين وفئات المصروفات والمعاملات المالية بسهولة. يوفر رؤية واضحة وإمكانية وصول آمنة وتقارير تفصيلية لدعم اتخاذ القرارات بشكل أفضل.",
                'meta_data' => 'نظام إدارة المصروفات - الموردين، المصروفات، التقارير، الإدارة المالية، لوحة التحكم',
            ],
            
            'logo' => 'images/logo.png',
            'white_logo' => 'images/logo.png',
            'tab' => 'images/logo.png',
            'breadcrumb'=>'images/TZb0eNyyzriIwXIELETQjBS5qdmYXQfmfegHEmQz.png',
            'loginImage'=>'fxpUgNZM91XpS3wD59FEloR7To84ggPL7nw71ugt.jpg',
            'image' => 'images/vcAP0ZKIaxhLG4yfxbg2XqM4tn24w0SDUNFBynx9.jpg',
            'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55275.18948853619!2d31.18964315!3d30.016788299999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1458469235579697%3A0x4e91d61f9878fc52!2sGiza%2C%20El%20Omraniya%2C%20Giza%20Governorate!5e0!3m2!1sen!2seg!4v1695471231297!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            
        ]);
    }
}