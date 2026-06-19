<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@nextgentrip.test')],
            [
                'name' => env('ADMIN_NAME', 'NextGenTrip Admin'),
                'mobile' => env('ADMIN_MOBILE', '9999999999'),
                'password' => env('ADMIN_PASSWORD', 'password'),
                'email_verified_at' => now(),
            ],
        );

        $admin->assignRole('super_admin');
    }
}
