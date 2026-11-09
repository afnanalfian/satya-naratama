<?php

namespace App\Support;

use App\Models\Order;
use App\Models\StudentRegistration;
use Illuminate\Support\Facades\Cache;

/**
 * Struktur menu sidebar per peran (admin / tentor / siswa).
 * Setiap item: [label, route, icon, pola-aktif, badge?]
 */
class Menu
{
    public static function for($user): array
    {
        if (! $user) {
            return [];
        }

        $isAdmin = $user->hasRole('admin');
        $isTentor = $user->hasRole('tentor');

        $common = [
            ['Beranda', 'dashboard.redirect', 'home', 'dashboard.*'],
        ];

        $monitoring = [
            ['Scan Presensi', 'attendance.hub', 'scan', 'attendance.hub'],
            ['Rekap Presensi', 'attendance.index', 'chart', ['attendance.index', 'attendance.student']],
            ['Evaluasi Jasmani', 'jasmani.index', 'run', 'jasmani.*'],
            ['Data Fisik Siswa', 'physical.index', 'scale', ['physical.index', 'physical.student']],
        ];
        if ($isAdmin) {
            $monitoring[] = ['Kartu QR Siswa', 'attendance.qr-cards', 'qr', 'attendance.qr-cards'];
            $monitoring[] = ['Link Orang Tua', 'monitor.links', 'link', ['monitor.*']];
        }

        if ($isAdmin) {
            $pending = Cache::remember('menu.pending-orders', 60, fn () => Order::where('status', 'paid')->count());
            $regs = Cache::remember('menu.pending-regs', 60, fn () => rescue(fn () => StudentRegistration::awaitingVerification()->count(), 0, false));

            return [
                ['Utama', array_merge($common, [
                    ['Jadwal', 'schedule.index', 'calendar', 'schedule.*'],
                    ['Notifikasi', 'notifications.index', 'bell', 'notifications.*'],
                ])],
                ['Pengguna', [
                    ['Pendaftaran', 'admin.registrations.index', 'inbox', 'admin.registrations.*', $regs],
                    ['Siswa', 'siswa.index', 'users', ['siswa.*', 'admin.students.*']],
                    ['Tentor', 'tentor.index', 'teacher', 'tentor.*'],
                    ['Hak Akses Siswa', 'admin.user-entitlements.index', 'key', 'admin.user-entitlements.*'],
                ]],
                ['Akademik', [
                    ['Kelas', 'course.index', 'book', ['course.*', 'meeting.*', 'meetings.*']],
                    ['Tryout', 'tryouts.index', 'trophy', ['tryouts.*']],
                    ['Kuis', 'quizzes.index', 'bolt', ['quizzes.*']],
                    ['Bank Soal', 'bank.category.index', 'stack', 'bank.*'],
                ]],
                ['Monitoring', $monitoring],
                ['Penjualan', [
                    ['Pesanan', 'orders.index', 'receipt', 'orders.*', $pending],
                    ['Produk', 'products.index', 'bag', 'products.*'],
                    ['Aturan Harga', 'pricing.index', 'tag', 'pricing.*'],
                    ['Diskon & Voucher', 'discounts.index', 'percent', 'discounts.*'],
                    ['Bonus Produk', 'bonuses.index', 'gift', 'bonuses.*'],
                    ['Pembayaran', 'payment.settings.edit', 'wallet', 'payment.settings.*'],
                    ['Laporan Pendapatan', 'reports.income', 'trend', 'reports.*'],
                    ['Promo & Banner', 'promo-banners.index', 'megaphone', 'promo-banners.*'],
                ]],
                ['Hiburan', [
                    ['Game Matematika', 'game.math', 'math', 'game.math'],
                    ['Game Snake', 'game.snake', 'gamepad', 'game.snake'],
                ]],
            ];
        }

        if ($isTentor) {
            return [
                ['Utama', array_merge($common, [
                    ['Jadwal', 'schedule.index', 'calendar', 'schedule.*'],
                    ['Notifikasi', 'notifications.index', 'bell', 'notifications.*'],
                ])],
                ['Akademik', [
                    ['Siswa', 'siswa.index', 'users', 'siswa.*'],
                    ['Kelas', 'course.index', 'book', ['course.*', 'meeting.*', 'meetings.*']],
                    ['Tryout', 'tryouts.index', 'trophy', 'tryouts.*'],
                    ['Kuis', 'quizzes.index', 'bolt', 'quizzes.*'],
                    ['Bank Soal', 'bank.category.index', 'stack', 'bank.*'],
                ]],
                ['Monitoring', $monitoring],
                ['Hiburan', [
                    ['Game Matematika', 'game.math', 'math', 'game.math'],
                    ['Game Snake', 'game.snake', 'gamepad', 'game.snake'],
                ]],
            ];
        }

        // siswa
        return [
            ['Utama', array_merge($common, [
                ['Jadwal', 'schedule.index', 'calendar', 'schedule.*'],
                ['Notifikasi', 'notifications.index', 'bell', 'notifications.*'],
            ])],
            ['Belajar', [
                ['Kelas Saya', 'course.index', 'book', ['course.*', 'meeting.*', 'meetings.*']],
                ['Tryout', 'tryouts.index', 'trophy', 'tryouts.*'],
                ['Kuis', 'quizzes.index', 'bolt', 'quizzes.*'],
                ['Tentor', 'tentor.index', 'teacher', 'tentor.*'],
            ]],
            ['Kehadiran & Fisik', [
                ['QR Presensi Saya', 'attendance.my-qr', 'qr', 'attendance.my-qr'],
                ['Data Fisik Bulanan', 'physical.mine', 'scale', 'physical.mine'],
            ]],
            ['Belanja', [
                ['Beli Paket', 'browse.index', 'bag', 'browse.*'],
                ['Keranjang', 'cart.show', 'cart', 'cart.*'],
                ['Pesanan Saya', 'my.orders.index', 'receipt', ['my.orders.*', 'checkout.*']],
            ]],
            ['Hiburan', [
                ['Game Matematika', 'game.math', 'math', 'game.math'],
                ['Game Snake', 'game.snake', 'gamepad', 'game.snake'],
            ]],
        ];
    }

    public static function roleLabel($user): string
    {
        return match (true) {
            $user?->hasRole('admin') => 'Admin',
            $user?->hasRole('tentor') => 'Tentor',
            default => 'Siswa',
        };
    }
}
