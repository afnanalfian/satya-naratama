<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Buat akun admin default
        $admin = User::firstOrCreate(
            ['email' => 'azwaralearning@gmail.com'],  // <-- ganti sesuai kebutuhan
            [
                'name' => 'Admin',
                'password' => Hash::make('nabilacantik'),  // <-- ganti password
                'province_id' => 13,
                'regency_id' => 1305,
                'phone' => '082154734819',
                'avatar' => null,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // Assign role admin
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        echo "Admin user created/updated successfully.\n";
    }
}
