<?php

/*
| Informasi kontak & pembayaran pendaftaran bimbel.
| Ubah lewat .env tanpa menyentuh kode.
*/
return [
    'admin_wa' => env('SATYA_ADMIN_WA', '6282154734819'),
    'cs_wa' => env('SATYA_CS_WA', '6285141339645'),
    'email' => env('SATYA_EMAIL', 'satyanaratama@gmail.com'),
    'registration_fee' => (int) env('SATYA_REGISTRATION_FEE', 6000000),
    'bank' => [
        'code' => env('SATYA_BANK_CODE', 'BRI'),
        'name' => env('SATYA_BANK_NAME', 'Bank Rakyat Indonesia'),
        'number' => env('SATYA_BANK_NUMBER', '022301059553505'),
        'owner' => env('SATYA_BANK_OWNER', 'Muhammad Afnan Alfian'),
    ],
    'universities' => ['STIS', 'STAN', 'IPDN', 'STMKG', 'SSN', 'STIN', 'STTD', 'POLTEKIMIPAS', 'AKPOL', 'AKMIL', 'UNHAN'],
    'classes' => ['X', 'XI', 'XII', 'Alumni'],
    'shirt_sizes' => ['S', 'M', 'L', 'XL', 'XXL'],
];
