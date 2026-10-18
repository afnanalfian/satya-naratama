<?php

return [
    /*
    | Toleransi keterlambatan (menit) setelah jadwal pertemuan dimulai.
    | Scan setelah batas ini tetap tercatat "hadir" namun ditandai terlambat.
    */
    'late_tolerance_minutes' => env('ATTENDANCE_LATE_TOLERANCE', 15),

    /*
    | Batas persentase kehadiran yang dianggap "perlu perhatian".
    */
    'warning_threshold' => env('ATTENDANCE_WARNING_THRESHOLD', 75),

    /*
    | Prefix isi QR code kartu siswa. Isi QR = PREFIX + qr_token.
    */
    'qr_prefix' => 'SN-',
];
