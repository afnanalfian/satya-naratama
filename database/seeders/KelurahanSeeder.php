<?php
// database/seeders/KelurahanSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelurahan;
use App\Models\Kecamatan;

class KelurahanSeeder extends Seeder
{
    public function run()
    {
        $kelurahans = [
            // Liukang Tangaya (7309010)
            ['code' => '7309010001', 'name' => 'Sabalana'],
            ['code' => '7309010002', 'name' => 'Balo Baloang'],
            ['code' => '7309010003', 'name' => 'Sabaru'],
            ['code' => '7309010004', 'name' => 'Sapuka'],
            ['code' => '7309010005', 'name' => 'Tampaang'],
            ['code' => '7309010006', 'name' => 'Sailus'],
            ['code' => '7309010007', 'name' => 'Satanger'],
            ['code' => '7309010008', 'name' => 'Kapoposan Bali'],
            ['code' => '7309010009', 'name' => 'Poleonro'],
            
            // Liukang Kalmas (7309020)
            ['code' => '7309020001', 'name' => 'Doang Doangan'],
            ['code' => '7309020002', 'name' => 'Dewakang'],
            ['code' => '7309020003', 'name' => 'Marasende'],
            ['code' => '7309020004', 'name' => 'Kanyurang'],
            ['code' => '7309020005', 'name' => 'Kalu-kalukuang'],
            ['code' => '7309020006', 'name' => 'Sabaru'],
            ['code' => '7309020007', 'name' => 'Pammantauan Masalima'],
            
            // Liukang Tupabbiring (7309030)
            ['code' => '7309030001', 'name' => 'Mattiro Deceng'],
            ['code' => '7309030002', 'name' => 'Mattiro Sompe'],
            ['code' => '7309030003', 'name' => 'Mattiro Bone'],
            ['code' => '7309030004', 'name' => 'Mattiro Dolangeng'],
            ['code' => '7309030012', 'name' => 'Mattiro Langi'],
            ['code' => '7309030013', 'name' => 'Mattiro Matae'],
            ['code' => '7309030014', 'name' => 'Mattiro Ujung'],
            ['code' => '7309030015', 'name' => 'Mattaro Adae'],
            ['code' => '7309030016', 'name' => 'Mattiro Bintang'],
            
            // Liukang Tupabbiring Utara (7309031)
            ['code' => '7309031001', 'name' => 'Mattiro Bulu'],
            ['code' => '7309031002', 'name' => 'Mattiro Labangeng'],
            ['code' => '7309031003', 'name' => 'Mattiro Uleng'],
            ['code' => '7309031004', 'name' => 'Mattiro Kanja'],
            ['code' => '7309031005', 'name' => 'Mattiro Baji'],
            ['code' => '7309031006', 'name' => 'Mattiro Bombang'],
            ['code' => '7309031007', 'name' => 'Mattiro Walie'],
            
            // Pangkajene (7309040)
            ['code' => '7309040007', 'name' => 'Sibatua'],
            ['code' => '7309040008', 'name' => 'Bonto Perak'],
            ['code' => '7309040009', 'name' => 'Anrong Appaka'],
            ['code' => '7309040010', 'name' => 'Tekolabbua'],
            ['code' => '7309040011', 'name' => 'Jagong'],
            ['code' => '7309040012', 'name' => 'Tumampua'],
            ['code' => '7309040013', 'name' => 'Paddoang Doangan'],
            ['code' => '7309040016', 'name' => 'Pabundukang'],
            ['code' => '7309040017', 'name' => 'Mappasaile'],
            
            // Minasatene (7309041)
            ['code' => '7309041001', 'name' => 'Bonto Langkasa'],
            ['code' => '7309041002', 'name' => 'Kabba'],
            ['code' => '7309041003', 'name' => 'Panaikang'],
            ['code' => '7309041004', 'name' => 'Bontokio'],
            ['code' => '7309041005', 'name' => 'Biraeng'],
            ['code' => '7309041006', 'name' => 'Minasatene'],
            ['code' => '7309041007', 'name' => 'Kalabbirang'],
            ['code' => '7309041008', 'name' => 'Bontoa'],
            
            // Balocci (7309050)
            ['code' => '7309050001', 'name' => 'Kassi'],
            ['code' => '7309050002', 'name' => 'Tonasa'],
            ['code' => '7309050003', 'name' => 'Balocci Baru'],
            ['code' => '7309050004', 'name' => 'Balleangin'],
            ['code' => '7309050005', 'name' => 'Tompo Bulu'],
            
            // Tondong Tallasa (7309051)
            ['code' => '7309051001', 'name' => 'Bulu Tellue'],
            ['code' => '7309051002', 'name' => 'Malaka'],
            ['code' => '7309051003', 'name' => 'Bantimurung'],
            ['code' => '7309051004', 'name' => 'Tondongkura'],
            ['code' => '7309051005', 'name' => 'Lanne'],
            ['code' => '7309051006', 'name' => 'Bonto Birao'],
            
            // Bungoro (7309060)
            ['code' => '7309060001', 'name' => 'Boriappaka'],
            ['code' => '7309060002', 'name' => 'Bulu Cindea'],
            ['code' => '7309060003', 'name' => 'Bowong Cindea'],
            ['code' => '7309060004', 'name' => 'Samalewa'],
            ['code' => '7309060005', 'name' => 'Sapanang'],
            ['code' => '7309060006', 'name' => 'Biring Ere'],
            ['code' => '7309060007', 'name' => 'Mangilu'],
            ['code' => '7309060009', 'name' => 'Tabo-tabo'],
            
            // Labakkang (7309070)
            ['code' => '7309070001', 'name' => 'Borimasunggu'],
            ['code' => '7309070002', 'name' => 'Mangallekana'],
            ['code' => '7309070003', 'name' => 'Batara'],
            ['code' => '7309070004', 'name' => 'Taraweang'],
            ['code' => '7309070005', 'name' => 'Bara Batu'],
            ['code' => '7309070006', 'name' => 'Kassi Loe'],
            ['code' => '7309070007', 'name' => 'Patallassang'],
            ['code' => '7309070008', 'name' => 'Labakkang'],
            ['code' => '7309070009', 'name' => 'Pundata Baji'],
            ['code' => '7309070010', 'name' => 'Bonto Manai'],
            ['code' => '7309070011', 'name' => 'Manakku'],
            ['code' => '7309070012', 'name' => 'Gentung'],
            ['code' => '7309070013', 'name' => 'Kanaungan'],
            
            // Ma'rang (7309080)
            ['code' => '7309080001', 'name' => 'Talaka'],
            ['code' => '7309080002', 'name' => 'Attang Salo'],
            ['code' => '7309080003', 'name' => 'Padang Lampe'],
            ['code' => '7309080004', 'name' => 'Alesipitto'],
            ['code' => '7309080005', 'name' => 'Ma`rang'],
            ['code' => '7309080006', 'name' => 'Bonto-bonto'],
            ['code' => '7309080007', 'name' => 'Pitue'],
            ['code' => '7309080008', 'name' => 'Pitu Sunggu'],
            ['code' => '7309080009', 'name' => 'Tamangapa'],
            ['code' => '7309080010', 'name' => 'Punranga'],
            
            // Segeri (7309091)
            ['code' => '7309091001', 'name' => 'Bonto Matene'],
            ['code' => '7309091002', 'name' => 'Baring'],
            ['code' => '7309091003', 'name' => 'Parenreng'],
            ['code' => '7309091004', 'name' => 'Segeri'],
            ['code' => '7309091005', 'name' => 'Bawasalo'],
            ['code' => '7309091006', 'name' => 'Bone'],
            
            // Mandalle (7309092)
            ['code' => '7309092001', 'name' => 'Benteng'],
            ['code' => '7309092002', 'name' => 'Manggalung'],
            ['code' => '7309092003', 'name' => 'Boddie'],
            ['code' => '7309092004', 'name' => 'Tamarupa'],
            ['code' => '7309092005', 'name' => 'Coppo Tompong'],
            ['code' => '7309092006', 'name' => 'Mandalle'],
        ];

        foreach ($kelurahans as $kelurahan) {
            // Ambil 7 digit pertama dari code untuk mendapatkan kode kecamatan
            $kecamatanCode = substr($kelurahan['code'], 0, 7);
            
            $kecamatan = Kecamatan::where('code', $kecamatanCode)->first();
            
            if ($kecamatan) {
                Kelurahan::updateOrCreate(
                    ['code' => $kelurahan['code']],
                    [
                        'kecamatan_id' => $kecamatan->id,
                        'name' => $kelurahan['name'],
                    ]
                );
            } else {
                $this->command->error("Kecamatan with code {$kecamatanCode} not found for kelurahan {$kelurahan['name']}");
            }
        }

        $this->command->info('Kelurahan seeded successfully!');
    }
}