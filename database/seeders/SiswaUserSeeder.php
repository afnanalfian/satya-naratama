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
            // [
            //     'name' => 'Muhammad Afnan Alfian, S. Tr. Stat.',
            //     'email' => 'afnan@satya.id',
            //     'password' => Hash::make('password'),
            //     'province_id' => 73,
            //     'regency_id' => 7309,
            //     'phone' => '082169165041',
            //     'avatar' => null,
            //     'is_active' => true,
            //     'email_verified_at' => now(),
            // ],
            // [
            //     'name' => 'Hikmatullah Munibe, S.Tr.I.P.',
            //     'email' => 'atul@satya.id',
            //     'password' => Hash::make('password'),
            //     'province_id' => 73,
            //     'regency_id' => 7309,
            //     'phone' => '085340836335',
            //     'avatar' => null,
            //     'is_active' => true,
            //     'email_verified_at' => now(),
            // ],
            // [
            //     'name' => 'Fadhlan Habib Harahap, S.Tr.K.,M.H.',
            //     'email' => 'habib@satya.id',
            //     'password' => Hash::make('password'),
            //     'province_id' => 73,
            //     'regency_id' => 7309,
            //     'phone' => '082170027312',
            //     'avatar' => null,
            //     'is_active' => true,
            //     'email_verified_at' => now(),
            // ],
            [
                'name' => 'Husni Mubarak',
                'email' => 'husni@satya.id',
                'password' => Hash::make('password'),
                'province_id' => 73,
                'regency_id' => 7309,
                'phone' => null,
                'avatar' => null,
                'is_active' => true,
                'email_verified_at' => now(),
            ],
            // [
            //     'name' => 'Siti Anindya Athiyyah Al Fitrah, S.S.',
            //     'email' => 'cinta@satya.id',
            //     'password' => Hash::make('password'),
            //     'province_id' => 73,
            //     'regency_id' => 7309,
            //     'phone' => '082148019902',
            //     'avatar' => null,
            //     'is_active' => true,
            //     'email_verified_at' => now(),
            // ],
            // [
            //     'name' => 'Muh. Aminuddin',
            //     'email' => 'amin@satya.id',
            //     'password' => Hash::make('password'),
            //     'province_id' => 73,
            //     'regency_id' => 7309,
            //     'phone' => '081340045105',
            //     'avatar' => null,
            //     'is_active' => true,
            //     'email_verified_at' => now(),
            // ],
            // [
            //     'name' => 'Muhammad Tharieq Pahlevi, S. Tr. Stat',
            //     'email' => 'levi@satya.id',
            //     'password' => Hash::make('password'),
            //     'province_id' => 73,
            //     'regency_id' => 7309,
            //     'phone' => '087810909365',
            //     'avatar' => null,
            //     'is_active' => true,
            //     'email_verified_at' => now(),
            // ],
            // [
            //     'name' => 'Andi Muhammad Reza Pahlevi, A. Md. Stat.',
            //     'email' => 'ejak@satya.id',
            //     'password' => Hash::make('password'),
            //     'province_id' => 73,
            //     'regency_id' => 7309,
            //     'phone' => '0895806133149',
            //     'avatar' => null,
            //     'is_active' => true,
            //     'email_verified_at' => now(),
            // ],
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
