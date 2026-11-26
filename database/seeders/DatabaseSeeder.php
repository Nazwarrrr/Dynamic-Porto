<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminUserSeeder::class);

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

        $bagiRasa = Project::firstOrCreate(
            ['title' => 'BagiRasa — Community Food Rescue'],
            [
                'category_id' => $web->id,
                'description' => 'Platform penyelamatan pangan berlebih berbasis komunitas dengan sistem klaim tiket digital #BR-XXX dan integrasi WhatsApp.',
                'tech_stack' => 'React, Vite, Tailwind CSS, Supabase',
                'github_url' => 'https://github.com/Nazwarrrr/Bagi-Rasa',
            ],
        );
        if (blank($bagiRasa->github_url) || rtrim($bagiRasa->github_url, '/') === 'https://github.com') {
            $bagiRasa->update(['github_url' => 'https://github.com/Nazwarrrr/Bagi-Rasa']);
        }

        $jejakHijau = Project::firstOrCreate(
            ['title' => 'JejakHijau — Carbon Footprint Tracker'],
            [
                'category_id' => $web->id,
                'description' => 'Aplikasi pelacak emisi karbon harian dengan kalkulator real-time dan gamifikasi pohon virtual.',
                'tech_stack' => 'React, Tailwind CSS, MySQL, Vercel',
                'demo_url' => 'https://jejak-hijau.vercel.app',
                'github_url' => 'https://github.com/Nazwarrrr/Jejak-Hijau',
            ],
        );
        if (blank($jejakHijau->github_url) || rtrim($jejakHijau->github_url, '/') === 'https://github.com') {
            $jejakHijau->update(['github_url' => 'https://github.com/Nazwarrrr/Jejak-Hijau']);
        }

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
