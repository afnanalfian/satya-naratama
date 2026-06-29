<?php
// database/seeders/KecamatanSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kecamatan;
use App\Models\Regency;

class KecamatanSeeder extends Seeder
{
    public function run()
    {
        // Cari Kabupaten Pangkajene dan Kepulauan (Pangkep)
        // ID regency untuk Pangkep adalah 7309
        $regency = Regency::where('id', 7309)->first();
        
        if (!$regency) {
            $this->command->error('Regency with ID 7309 not found!');
            $this->command->info('Please make sure regencies table has been seeded.');
            return;
        }

        $kecamatans = [
            [
                'code' => '7309010',
                'name' => 'Liukang Tangaya',
            ],
            [
                'code' => '7309020',
                'name' => 'Liukang Kalmas',
            ],
            [
                'code' => '7309030',
                'name' => 'Liukang Tupabbiring',
            ],
            [
                'code' => '7309031',
                'name' => 'Liukang Tupabbiring Utara',
            ],
            [
                'code' => '7309040',
                'name' => 'Pangkajene',
            ],
            [
                'code' => '7309041',
                'name' => 'Minasatene',
            ],
            [
                'code' => '7309050',
                'name' => 'Balocci',
            ],
            [
                'code' => '7309051',
                'name' => 'Tondong Tallasa',
            ],
            [
                'code' => '7309060',
                'name' => 'Bungoro',
            ],
            [
                'code' => '7309070',
                'name' => 'Labakkang',
            ],
            [
                'code' => '7309080',
                'name' => 'Ma\'rang',
            ],
            [
                'code' => '7309091',
                'name' => 'Segeri',
            ],
            [
                'code' => '7309092',
                'name' => 'Mandalle',
            ],
        ];

        foreach ($kecamatans as $kecamatan) {
            Kecamatan::updateOrCreate(
                ['code' => $kecamatan['code']],
                [
                    'regency_id' => $regency->id,
                    'name' => $kecamatan['name'],
                ]
            );
        }

        $this->command->info('Kecamatan seeded successfully!');
    }
}