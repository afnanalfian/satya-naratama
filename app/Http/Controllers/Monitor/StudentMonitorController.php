<?php

namespace App\Http\Controllers\Monitor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\StudentReportService;
use Illuminate\Http\Request;

/**
 * Pantauan perkembangan siswa (tryout, evaluasi jasmani, presensi, data fisik).
 * - parent()   : link PUBLIK untuk orang tua, tanpa login (berbasis token rahasia)
 * - internal() : versi di dalam dashboard untuk admin/tentor
 * - links()    : admin mengelola & membagikan link ke orang tua
 */
class StudentMonitorController extends Controller
{
    public function __construct(protected StudentReportService $reports)
    {
    }

    public function parent(string $token)
    {
        $student = User::where('parent_token', $token)->first();

        abort_if(! $student || ! $student->hasRole('siswa'), 404);

        return response()
            ->view('monitor.public', $this->reports->build($student))
            ->header('X-Robots-Tag', 'noindex, nofollow')
            ->header('Referrer-Policy', 'no-referrer');
    }

    public function internal(User $user)
    {
        abort_unless($user->hasRole('siswa'), 404);

        return view('monitor.internal', $this->reports->build($user));
    }

    public function links(Request $request)
    {
        $q = trim((string) $request->query('q'));

        $students = User::role('siswa')
            ->with('studentRegistration:id,user_id,full_name,parent_name,parent_phone,class')
            ->when($q, fn ($qr) => $qr->where(function ($s) use ($q) {
                $s->where('name', 'like', "%{$q}%")
                  ->orWhereHas('studentRegistration', fn ($r) => $r->where('parent_name', 'like', "%{$q}%"));
            }))
            ->orderByDesc('is_active')
            ->orderBy('name')
            ->paginate(25)
            ->withQueryString();

        $students->getCollection()->each->ensureTokens();

        return view('monitor.links', compact('students', 'q'));
    }

    public function regenerate(User $user)
    {
        abort_unless($user->hasRole('siswa'), 404);
        $user->parent_token = User::newParentToken();
        $user->saveQuietly();

        toast('success', "Link pantauan {$user->name} diperbarui. Link lama tidak bisa diakses lagi.");

        return back();
    }
}
