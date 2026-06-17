<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PangeranSeeder extends Seeder
{
    public function run()
    {
        $siswaData = [
            [
                'name' => 'Andi Pangeran Maulana Ibrahin',
                'email' => 'erannpangeran@gmail.com',
                'password' => Hash::make('password'),
                'province_id' => 73,
                'regency_id' => 7371,
                'phone' => '082169165041',
                'avatar' => null,
                'is_active' => true,
                'email_verified_at' => now(),
            ]
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

        echo "Pangeran users created/updated successfully.\n";
    }
}
