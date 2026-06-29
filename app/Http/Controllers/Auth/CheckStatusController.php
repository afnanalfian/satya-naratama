<?php
// app/Http/Controllers/Auth/CheckStatusController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;

class CheckStatusController extends Controller
{
    /**
     * Tampilkan form cek status
     */
    public function index()
    {
        return view('auth.check-status');
    }

    /**
     * Proses cek status
     */
    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $registration = StudentRegistration::with(['kecamatan', 'kelurahan'])
            ->where('email', $request->email)
            ->first();

        if (!$registration) {
            return redirect()->route('daftar.status.form')
                ->with('error', 'Email tidak ditemukan. Silakan cek kembali atau daftar sekarang.');
        }

        // Jika status verified dan sudah ada user_id, redirect ke login
        if ($registration->isVerified() && $registration->user_id) {
            return view('auth.status-result', compact('registration'))
                ->with('success', 'Selamat! Pendaftaran Anda telah diverifikasi. Silakan login.');
        }

        return view('auth.status-result', compact('registration'));
    }

    /**
     * Redirect ke halaman pembayaran dari status
     */
    public function goToPayment($registrationId)
    {
        $registration = StudentRegistration::findOrFail($registrationId);

        // Cek apakah bisa melakukan pembayaran
        if (!$registration->canMakePayment()) {
            if ($registration->isExpired()) {
                return redirect()->route('daftar.status.form')
                    ->with('error', 'Waktu pembayaran telah habis. Silakan daftar ulang.');
            }

            if ($registration->isAwaitingVerification()) {
                return redirect()->route('daftar.status.form')
                    ->with('info', 'Pembayaran Anda sedang diverifikasi oleh admin.');
            }

            if ($registration->isVerified()) {
                return redirect()->route('daftar.status.form')
                    ->with('success', 'Pendaftaran Anda sudah diverifikasi. Silakan login.');
            }

            return redirect()->route('daftar.status.form')
                ->with('error', 'Status tidak valid untuk melakukan pembayaran.');
        }

        return redirect()->route('daftar.payment', $registration->id);
    }
}