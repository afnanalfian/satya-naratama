<?php
// app/Http/Controllers/Admin/RegistrationManagementController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminVerificationRequest;
use App\Models\StudentRegistration;
use App\Models\Invoice;
use App\Models\User;
use App\Mail\RegistrationWelcomeMail;
use App\Mail\RegistrationStatusMail;
use App\Mail\RegistrationRejectionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegistrationManagementController extends Controller
{
    /**
     * Middleware untuk admin
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * List semua pendaftaran
     */
    public function index(Request $request)
    {
        $query = StudentRegistration::with(['user', 'kecamatan', 'kelurahan'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('registration_status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status') && $request->payment_status != 'all') {
            $query->where('payment_status', $request->payment_status);
        }

        // Search by name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $registrations = $query->paginate(20);

        $statuses = [
            'pending_payment' => 'Menunggu Pembayaran',
            'awaiting_verification' => 'Menunggu Verifikasi',
            'verified' => 'Terverifikasi',
            'rejected' => 'Ditolak',
        ];

        $paymentStatuses = [
            'pending' => 'Belum Dibayar',
            'paid' => 'Sudah Bayar',
            'verified' => 'Diverifikasi',
            'rejected' => 'Ditolak',
            // 'expired' => 'Kadaluarsa',
        ];

        $stats = [
            'total' => StudentRegistration::count(),
            'pending_payment' => StudentRegistration::pendingPayment()->count(),
            'awaiting_verification' => StudentRegistration::awaitingVerification()->count(),
            'verified' => StudentRegistration::verified()->count(),
            'rejected' => StudentRegistration::rejected()->count(),
        ];

        return view('admin.registrations.index', compact(
            'registrations',
            'statuses',
            'paymentStatuses',
            'stats'
        ));
    }

    /**
     * Detail pendaftaran
     */
    public function show($id)
    {
        $registration = StudentRegistration::with([
            'user',
            'kecamatan',
            'kelurahan',
            'verifiedBy',
            'invoice'
        ])->findOrFail($id);

        return view('admin.registrations.show', compact('registration'));
    }

    /**
     * Form verifikasi
     */
    public function verifyForm($id)
    {
        $registration = StudentRegistration::with(['kecamatan', 'kelurahan'])
            ->findOrFail($id);

        return view('admin.registrations.verify', compact('registration'));
    }

    /**
     * Proses verifikasi (terima)
     */
    public function verify(AdminVerificationRequest $request, $id)
    {
        $registration = StudentRegistration::findOrFail($id);

        // Cek apakah sudah diverifikasi
        if ($registration->isVerified()) {
            return redirect()->route('admin.registrations.index')
                ->with('error', 'Pendaftaran ini sudah diverifikasi.');
        }

        // Cek apakah status valid untuk diverifikasi
        if ($registration->registration_status !== 'awaiting_verification') {
            return redirect()->route('admin.registrations.index')
                ->with('error', 'Status pendaftaran tidak valid untuk diverifikasi.');
        }

        // Buat akun user
        $user = User::create([
            'name' => $registration->full_name,
            'email' => $registration->email,
            'password' => $registration->password, // Sudah di-hash dari pendaftaran
            'phone' => $registration->phone,
            'avatar' => $registration->avatar,
            'province_id' => 73, // Sulawesi Selatan
            'regency_id' => 7309, // Pangkep
            'is_active' => true,
            'email_verified_at' => now(), // Langsung verified
        ]);

        // Assign role siswa
        $user->assignRole('siswa');

        // Update registration
        $registration->update([
            'user_id' => $user->id,
            'verified_by' => auth()->id(),
            'verification_notes' => $request->verification_notes,
            'verified_at' => now(),
            'payment_status' => 'verified',
            'payment_verified_at' => now(),
            'registration_status' => 'verified',
        ]);

        // Update invoice
        $invoice = $registration->invoice;
        if ($invoice) {
            $invoice->markAsVerified(auth()->id(), $request->verification_notes);
        }

        // Kirim email selamat datang
        Mail::to($user->email)->send(new RegistrationWelcomeMail($user, $registration));

        // Notifikasi ke user (via database notification)
        notify_user(
            $user,
            "🎉 Selamat! Pendaftaran Anda di Satya Naratama telah diterima. Silakan login menggunakan email dan password yang Anda daftarkan.",
            false,
            route('login')
        );

        // Notifikasi ke admin lain
        $admins = User::role('admin')->where('id', '!=', auth()->id())->get();
        foreach ($admins as $admin) {
            notify_user(
                $admin,
                "✅ Pendaftaran {$registration->full_name} telah diverifikasi oleh " . auth()->user()->name,
                false,
                route('admin.registrations.show', $registration->id)
            );
        }

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Pendaftaran berhasil diverifikasi. Akun siswa telah dibuat.');
    }

    /**
     * Form penolakan
     */
    public function rejectForm($id)
    {
        $registration = StudentRegistration::with(['kecamatan', 'kelurahan'])
            ->findOrFail($id);

        return view('admin.registrations.reject', compact('registration'));
    }

    /**
     * Proses penolakan
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|min:10',
        ]);

        $registration = StudentRegistration::findOrFail($id);

        // Cek apakah sudah diverifikasi
        if ($registration->isVerified()) {
            return redirect()->route('admin.registrations.index')
                ->with('error', 'Pendaftaran ini sudah diverifikasi, tidak bisa ditolak.');
        }

        // Update registration
        $registration->update([
            'verified_by' => auth()->id(),
            'rejected_at' => now(),
            'rejection_reason' => $request->rejection_reason,
            'payment_status' => 'rejected',
            'registration_status' => 'rejected',
        ]);

        // Update invoice
        $invoice = $registration->invoice;
        if ($invoice) {
            $invoice->markAsCancelled();
        }

        // Kirim email penolakan
        Mail::to($registration->email)->send(new RegistrationRejectionMail($registration));

        // Notifikasi ke user
        // Pendaftar belum punya akun, pemberitahuan dikirim lewat email (RegistrationRejectionMail) di atas.


        // Notifikasi ke admin lain
        $admins = User::role('admin')->where('id', '!=', auth()->id())->get();
        foreach ($admins as $admin) {
            notify_user(
                $admin,
                "❌ Pendaftaran {$registration->full_name} ditolak oleh " . auth()->user()->name,
                false,
                route('admin.registrations.show', $registration->id)
            );
        }

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Pendaftaran berhasil ditolak.');
    }

    /**
     * Download bukti pembayaran
     */
    public function downloadProof($id)
    {
        $registration = StudentRegistration::findOrFail($id);

        if (!$registration->payment_proof) {
            return redirect()->back()->with('error', 'Bukti pembayaran tidak ditemukan.');
        }

        $path = storage_path('app/public/' . $registration->payment_proof);

        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File bukti pembayaran tidak ditemukan.');
        }

        return response()->download($path);
    }

    /**
     * Export data pendaftaran
     */
    public function export(Request $request)
    {
        $rows = StudentRegistration::with(['kecamatan', 'kelurahan'])
            ->when($request->filled('status') && $request->status !== 'all', fn ($q) => $q->where('registration_status', $request->status))
            ->orderByDesc('created_at')->get();

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, ['No', 'Tanggal', 'Nama', 'Panggilan', 'L/P', 'Tgl Lahir', 'Sekolah', 'Kelas', 'WA', 'Email', 'Kecamatan', 'Kelurahan', 'TB', 'BB', 'Baju', 'Kampus 1', 'Kampus 2', 'Orang Tua', 'Pekerjaan', 'HP Ortu', 'Status', 'Pembayaran'], ';');
            foreach ($rows as $i => $r) {
                fputcsv($out, [$i + 1, $r->created_at?->format('Y-m-d H:i'), $r->full_name, $r->nickname, $r->gender, $r->birth_date?->format('Y-m-d'), $r->school_origin, $r->class, $r->phone, $r->email,
                    $r->kecamatan?->name, $r->kelurahan?->name, $r->height_cm, $r->weight_kg, $r->shirt_size, $r->priority_university_1, $r->priority_university_2,
                    $r->parent_name, $r->parent_occupation, $r->parent_phone, $r->registration_status_label, $r->payment_status_label], ';');
            }
            fclose($out);
        }, 'pendaftaran-'.now()->format('Ymd-His').'.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function destroy($id)
    {
        $registration = StudentRegistration::findOrFail($id);

        // Hanya bisa hapus jika status draft atau rejected
        if (!in_array($registration->registration_status, ['draft', 'rejected'])) {
            return redirect()->back()
                ->with('error', 'Tidak bisa menghapus pendaftaran dengan status ini.');
        }

        $registration->delete();

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Pendaftaran berhasil dihapus.');
    }
}
