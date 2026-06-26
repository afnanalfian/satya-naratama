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
                'name' => 'Hikmatullah Munibe',
                'email' => 'atul@gmail.com',
                'password' => Hash::make('password'),
                'province_id' => 73,
                'regency_id' => 7309,
                'phone' => '082169165041',
                'avatar' => null,
                'is_active' => true,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Fadhlan Habib Harahap',
                'email' => 'habib@gmail.com',
                'password' => Hash::make('password'),
                'province_id' => 73,
                'regency_id' => 7309,
                'phone' => '082169165041',
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
