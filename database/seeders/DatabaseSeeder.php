<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@nazwar.dev'],
            [
                'name' => 'Nazwar Makarim Mahardhika',
                'password' => Hash::make('password123'),
            ],
        );

        $web = Category::firstOrCreate(
            ['slug' => 'web-development'],
            ['name' => 'Web Development'],
        );
        $iot = Category::firstOrCreate(
            ['slug' => 'iot-robotics'],
            ['name' => 'IoT & Robotics'],
        );
        Category::firstOrCreate(
            ['slug' => 'mobile-app'],
            ['name' => 'Mobile App'],
        );

        Project::firstOrCreate(
            ['title' => 'BagiRasa — Community Food Rescue'],
            [
                'category_id' => $web->id,
                'description' => 'Platform penyelamatan pangan berlebih berbasis komunitas dengan sistem klaim tiket digital #BR-XXX dan integrasi WhatsApp.',
                'tech_stack' => 'React, Vite, Tailwind CSS, Supabase',
            ],
        );

        Project::firstOrCreate(
            ['title' => 'JejakHijau — Carbon Footprint Tracker'],
            [
                'category_id' => $web->id,
                'description' => 'Aplikasi pelacak emisi karbon harian dengan kalkulator real-time dan gamifikasi pohon virtual.',
                'tech_stack' => 'React, Tailwind CSS, MySQL, Vercel',
                'demo_url' => 'https://jejak-hijau.vercel.app',
            ],
        );

        Project::firstOrCreate(
            ['title' => 'WALL-Z — Assistive Smart Vest & Watch'],
            [
                'category_id' => $iot->id,
                'description' => 'Prototipe rompi dan jam pintar bantu mobilitas berbasis ESP32 dengan sensor ultrasonik, motor getar, dan aplikasi monitoring Android.',
                'tech_stack' => 'ESP32, C++, OLED, Android Studio',
            ],
        );
    }
}
