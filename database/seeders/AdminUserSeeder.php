<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = config('services.admin.email');
        $adminPassword = config('services.admin.password');

        abort_if(app()->isProduction() && blank($adminPassword), 1, 'ADMIN_PASSWORD wajib diisi di production.');
        abort_if(filled($adminPassword) && blank($adminEmail), 1, 'ADMIN_EMAIL wajib diisi saat ADMIN_PASSWORD diatur.');

        if (User::query()->exists()) {
            $admin = User::query()->sole();

            if (filled($adminEmail)) {
                $admin->email = $adminEmail;
            }

            if (filled($adminPassword)) {
                $admin->password = $adminPassword;
            }

            if ($admin->isDirty()) {
                $admin->save();
            }

            return;
        }

        User::create([
            'name' => 'Nazwar Makarim Mahardhika',
            'email' => filled($adminEmail) ? $adminEmail : 'admin@example.test',
            'password' => filled($adminPassword) ? $adminPassword : Str::random(32),
        ]);
    }
}
