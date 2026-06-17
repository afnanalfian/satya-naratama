<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SiswaUserSeeder extends Seeder
{
    public function run()
    {
        $siswaData = [
            [
                'name' => 'Muhammad Afnan Alfian, S. Tr. Stat.',
                'email' => 'afnan.02alf@gmail.com',
                'password' => Hash::make('password'),
                'province_id' => 73,
                'regency_id' => 7309,
                'phone' => '082169165041',
                'avatar' => null,
                'is_active' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Afied Akhmad, S. Tr. Stat.',
                'email' => 'afiedakhmad@gmail.com',
                'password' => Hash::make('password'),
                'province_id' => 73,
                'regency_id' => 7307,
                'phone' => '085242529403',
                'avatar' => null,
                'is_active' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Ainul Baharuddin, A. Md. Stat.',
                'email' => 'ainulbaharuddin7@gmail.com',
                'password' => Hash::make('password'),
                'province_id' => 73,
                'regency_id' => 7312,
                'phone' => '082257777892',
                'avatar' => null,
                'is_active' => true,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($siswaData as $data) {
            $siswa = User::firstOrCreate(
                ['email' => $data['email']],
                $data
            );

            if (!$siswa->hasRole('siswa')) {
                $siswa->assignRole('siswa');
            }
        }

        echo "3 siswa users created/updated successfully.\n";
    }
}
