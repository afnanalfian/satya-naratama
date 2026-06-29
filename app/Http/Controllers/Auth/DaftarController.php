<?php
// app/Http/Controllers/Auth/DaftarController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRegistrationRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\StudentRegistration;
use App\Models\Invoice;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DaftarController extends Controller
{
    /**
     * Tampilkan halaman pendaftaran
     */
    public function showForm()
    {
        $kecamatans = Kecamatan::where('regency_id', 7309)
            ->orderBy('name')
            ->get();

        $universities = [
            'STIS', 'STAN', 'IPDN', 'STMKG', 'SSN', 
            'STIN', 'STTD', 'POLTEKIMIPAS', 'AKPOL', 'AKMIL', 'UNHAN'
        ];

        $classes = ['X', 'XI', 'XII', 'Alumni'];

        return view('auth.daftar', compact('kecamatans', 'universities', 'classes'));
    }

    /**
     * Get kelurahan by kecamatan ID (for AJAX)
     */
    public function getKelurahan(Request $request)
    {
        $kelurahans = Kelurahan::where('kecamatan_id', $request->kecamatan_id)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($kelurahans);
    }

    /**
     * Proses penyimpanan pendaftaran
     */
    public function store(StudentRegistrationRequest $request)
    {
        // Upload avatar
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars/pendaftaran', 'public');
        }

        // Set expiration date (7 days from now)
        $paymentExpiresAt = Carbon::now()->addDays(7);

        // Create registration
        $registration = StudentRegistration::create([
            // Data Pribadi
            'full_name' => $request->full_name,
            'nickname' => $request->nickname,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'school_origin' => $request->school_origin,
            'class' => $request->class,
            'phone' => $request->phone,
            
            // Wilayah
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
            
            // Fisik
            'height_cm' => $request->height_cm,
            'weight_kg' => $request->weight_kg,
            
            // Kampus Impian
            'priority_university_1' => $request->priority_university_1,
            'priority_university_2' => $request->priority_university_2,
            
            // Orangtua
            'parent_name' => $request->parent_name,
            'parent_occupation' => $request->parent_occupation,
            'parent_phone' => $request->parent_phone,
            
            // Akun
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
            
            // Pembayaran
            'registration_fee' => 6000000,
            'payment_status' => 'pending',
            'payment_expires_at' => $paymentExpiresAt,
            
            // Meta
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            
            // Status
            'registration_status' => 'pending_payment',
        ]);

        // Create invoice
        $invoice = Invoice::create([
            'registration_id' => $registration->id,
            'invoice_number' => Invoice::generateNumber(),
            'amount' => 6000000,
            'description' => 'Biaya Pendaftaran Satya Naratama - ' . $registration->full_name,
            'status' => 'pending',
        ]);

        // Redirect ke halaman pembayaran
        return redirect()->route('daftar.payment', $registration->id)
            ->with('success', 'Pendaftaran berhasil! Silakan lakukan pembayaran.');
    }

    /**
     * Tampilkan halaman pembayaran
     */
    public function showPayment($registrationId)
    {
        $registration = StudentRegistration::with(['kecamatan', 'kelurahan'])
            ->findOrFail($registrationId);

        // Cek apakah pendaftaran sudah expired
        if ($registration->isExpired()) {
            $registration->update([
                'payment_status' => 'expired',
                'registration_status' => 'rejected',
            ]);
            
            return redirect()->route('daftar.status.form')
                ->with('error', 'Waktu pembayaran telah habis. Silakan daftar ulang.');
        }

        // Cek apakah sudah bayar dan diverifikasi
        if ($registration->isVerified()) {
            return redirect()->route('daftar.status.form')
                ->with('success', 'Pendaftaran Anda sudah diverifikasi. Silakan login.');
        }

        // Cek apakah sudah upload bukti (menunggu verifikasi)
        if ($registration->isAwaitingVerification()) {
            return redirect()->route('daftar.status.form')
                ->with('info', 'Pembayaran Anda sedang diverifikasi oleh admin.');
        }

        $invoice = $registration->invoice;

        return view('auth.payment', compact('registration', 'invoice'));
    }

    /**
     * Upload bukti pembayaran
     */
    public function uploadPayment(PaymentRequest $request, $registrationId)
    {
        $registration = StudentRegistration::findOrFail($registrationId);

        // Cek apakah bisa upload bukti
        if (!$registration->canUploadProof()) {
            if ($registration->isExpired()) {
                return redirect()->route('daftar.status.form')
                    ->with('error', 'Waktu pembayaran telah habis.');
            }
            
            return redirect()->route('daftar.status.form')
                ->with('error', 'Status pendaftaran tidak valid untuk upload bukti.');
        }

        // Upload bukti pembayaran
        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Update registration
        $registration->update([
            'payment_proof' => $proofPath,
            'payment_status' => 'paid',
            'registration_status' => 'awaiting_verification',
        ]);

        // Update invoice
        $invoice = $registration->invoice;
        if ($invoice) {
            $invoice->markAsPaid($proofPath);
        }

        // Notify admin (gunakan helper)
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            notify_user(
                $admin,
                "📝 Pendaftaran baru dari {$registration->full_name} menunggu verifikasi pembayaran.",
                true,
                route('admin.registrations.show', $registration->id)
            );
        }

        return redirect()->route('daftar.success', $registration->id)
            ->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');
    }

    /**
     * Tampilkan halaman sukses (menunggu verifikasi)
     */
    public function showSuccess($registrationId)
    {
        $registration = StudentRegistration::with(['kecamatan', 'kelurahan'])
            ->findOrFail($registrationId);

        return view('auth.payment-success', compact('registration'));
    }

    /**
     * Bayar nanti - langsung ke halaman status
     */
    public function bayarNanti($registrationId)
    {
        $registration = StudentRegistration::findOrFail($registrationId);
        
        return redirect()->route('daftar.status.form')
            ->with('info', 'Anda dapat melakukan pembayaran kapan saja sebelum batas waktu berakhir.');
    }

    /**
     * Cek status pendaftaran (form)
     */
    public function statusForm()
    {
        return view('auth.check-status');
    }

    /**
     * Cek status pendaftaran (result)
     */
    public function statusResult(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:student_registrations,email',
        ]);

        $registration = StudentRegistration::with(['kecamatan', 'kelurahan'])
            ->where('email', $request->email)
            ->first();

        if (!$registration) {
            return redirect()->route('daftar.status.form')
                ->with('error', 'Email tidak ditemukan dalam sistem pendaftaran.');
        }

        return view('auth.status-result', compact('registration'));
    }
}