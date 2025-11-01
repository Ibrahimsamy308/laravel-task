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
                'copyright' => 'Copyright © Ibrahim samy 2025. All rights reserved.',
                'title' => 'Ramadaan Learning',
                'address' => 'Online Platform - Serving Students Worldwide',
                'description' => "Ramadaan Learning is an online educational platform dedicated to delivering high-quality learning content across various fields. Our structured courses and modern teaching methods help learners grow and enhance their skills.",
                'meta_data' => 'Ramadaan Learning - Educational Platform, Skill Development, Online Learning',
            ],                   
            'ar' => [
                'appointment' => '24/7',
                'copyright' => 'حقوق النشر © رمضان ليرنينج 2025. جميع الحقوق محفوظة.',
                'title' => 'رمضان ليرنينج',
                'address' => 'منصة تعليمية عبر الإنترنت - نخدم الطلاب في جميع أنحاء العالم',
                'description' => "رمضان ليرنينج هي منصة تعليمية إلكترونية تهدف إلى تقديم محتوى تعليمي متميز في مختلف المجالات، من خلال دورات منظمة وأساليب حديثة تساعد على تطوير المهارات والمعرفة.",
                'meta_data' => 'رمضان ليرنينج - منصة تعليمية، تطوير مهارات، تعلم عبر الإنترنت',
            ],
            
            
            'logo' => 'images/logo.png',
            'white_logo' => 'images/logo.png',
            'tab' => 'images/logo.png',
            'breadcrumb'=>'images/TZb0eNyyzriIwXIELETQjBS5qdmYXQfmfegHEmQz.png',
            'image' => 'images/vcAP0ZKIaxhLG4yfxbg2XqM4tn24w0SDUNFBynx9.jpg',
            'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55275.18948853619!2d31.18964315!3d30.016788299999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1458469235579697%3A0x4e91d61f9878fc52!2sGiza%2C%20El%20Omraniya%2C%20Giza%20Governorate!5e0!3m2!1sen!2seg!4v1695471231297!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            
        ]);
    }
}