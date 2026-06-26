<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TryoutSiswaSeeder extends Seeder
{
    public function run()
    {
        $siswaData = [
            [
                'name' => 'MUHAMMAD RADHY SURYAPRAJA',
                'email' => 'radhisurya25102009@gmail.com',
                'password' => 'Pangkep01#',
            ],
            [
                'name' => 'dynta naura danial',
                'email' => 'dyntanaura59@gmail.com',
                'password' => 'Pangkep02#',
            ],
            [
                'name' => 'Muhammad Fatur Rahman',
                'email' => 'fr9550380@gmail.com',
                'password' => 'Pangkep03#',
            ],
            [
                'name' => 'GHINAA WAN AZIZAH',
                'email' => 'ghinaazizah783@gmail.com',
                'password' => 'Pangkep04#',
            ],
            [
                'name' => 'MUHAMMAD NIBRAS',
                'email' => 'muhammadnibras2009@gmail.com',
                'password' => 'Pangkep05#',
            ],
            [
                'name' => 'Sahirah Anasya',
                'email' => 'samsiras86@gmail.com',
                'password' => 'Pangkep06#',
            ],
            [
                'name' => 'Nur Khaerani M.',
                'email' => 'khaeranimn@gmail.com',
                'password' => 'Pangkep07#',
            ],
            [
                'name' => 'Nuri Maulida',
                'email' => 'nurinmaulida27@gmail.com',
                'password' => 'Pangkep08#',
            ],
            [
                'name' => 'Syahkira Aura Magfira',
                'email' => 'firae736@gmail.com',
                'password' => 'Pangkep09#',
            ],
            [
                'name' => 'Nadia Ramadani.r',
                'email' => 'nr8102008@gmail.com',
                'password' => 'Pangkep10#',
            ],
            [
                'name' => 'nurul ramadhani idris',
                'email' => 'nr2698701@gmail.com',
                'password' => 'Pangkep11#',
            ],
            [
                'name' => 'DHIYA FATIHAH AZURA',
                'email' => 'dhiyafatihahazura@gmail.com',
                'password' => 'Pangkep12#',
            ],
            [
                'name' => 'Shabrina Annisa Zada',
                'email' => 'shabrinaannisa715@gmail.com',
                'password' => 'Pangkep13#',
            ],
            [
                'name' => 'Muh sandy raafi',
                'email' => 'snnddyyy@gmail.com',
                'password' => 'Pangkep14#',
            ],
            [
                'name' => 'Nabilah Putri Habibi',
                'email' => 'nabilhptri@gmail.com',
                'password' => 'Pangkep15#',
            ],
            [
                'name' => 'Nurul Fajrina Rizkiyah Ali',
                'email' => 'chosoririn2009@gmail.com',
                'password' => 'Pangkep16#',
            ],
            [
                'name' => 'Muh. Naufal Putra Bhayangkara',
                'email' => 'naufalophank2328@gmail.com',
                'password' => 'Pangkep17#',
            ],
            [
                'name' => 'ALVIAN SULTAN SEKAR',
                'email' => 'iyaanmoo2@gmail.com',
                'password' => 'Pangkep18#',
            ],
            [
                'name' => 'Luthfiyyah khairunnisa',
                'email' => 'luthfiyyahamir2@gmail.com',
                'password' => 'Pangkep19#',
            ],
            [
                'name' => 'Suci Paramidita Rasyid',
                'email' => 'suci.midita@gmail.com',
                'password' => 'Pangkep20#',
            ],
            [
                'name' => 'Muh. Naufal Fajrin Ikhbal',
                'email' => 'naufalfajrin92@gmail.com',
                'password' => 'Pangkep21#',
            ],
            [
                'name' => 'Aisyah Azzahra',
                'email' => 'aisyahazzahra.ica@gmail.com',
                'password' => 'Pangkep22#',
            ],
            [
                'name' => 'Asdar',
                'email' => 'asdarpkp25@gmail.com',
                'password' => 'Pangkep23#',
            ],
            [
                'name' => 'ALVIAN SULTAN SEKAR',
                'email' => 'iynalvian@gmail.com',
                'password' => 'Pangkep24#',
            ],
            [
                'name' => 'Anita Patwa',
                'email' => 'anitapatwa700@gmail.com',
                'password' => 'Pangkep25#',
            ],
            [
                'name' => 'Mustabsyirah',
                'email' => 'almuarif435@gmail.com',
                'password' => 'Pangkep26#',
            ],
            [
                'name' => 'ANUGRAH TRIPUTRA ARISIAH',
                'email' => 'nugiiarisiah23@gmail.com',
                'password' => 'Pangkep27#',
            ],
            [
                'name' => 'rifqah zalsabilah',
                'email' => 'salsabilahrifqah213@gmail.com',
                'password' => 'Pangkep28#',
            ],
        ];

        foreach ($siswaData as $data) {
            $siswa = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'province_id' => 73, // Sulawesi Selatan
                    'regency_id' => 7309, // Pangkep
                    'phone' => null,
                    'avatar' => null,
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );

            // Assign role siswa
            if (!$siswa->hasRole('siswa')) {
                $siswa->assignRole('siswa');
            }
        }

        $this->command->info('28 siswa tryout berhasil ditambahkan!');
    }
}