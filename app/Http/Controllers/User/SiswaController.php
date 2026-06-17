<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->query('q'));

        $perPage = (int) $request->query('per_page', 12);

        $allowed = [10, 20, 30, 50, 100];
        if (! in_array($perPage, $allowed)) {
            $perPage = 12;
        }

        $query = User::role('siswa')
            ->with(['province', 'regency'])
            ->when($q, function ($qr) use ($q) {
                $qr->where(function ($s) use ($q) {
                    $s->where('name', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhereHas('province', fn ($p) =>
                        $p->where('name', 'like', "%{$q}%")
                    )
                    ->orWhereHas('regency', fn ($r) =>
                        $r->where('name', 'like', "%{$q}%")
                    );
                });
            })
            ->orderBy('name', 'asc');

        $siswa = $query->paginate($perPage)->withQueryString();

        return view('siswa.index', compact('siswa', 'q', 'perPage'));
    }

    public function show($id)
    {
        $user = User::role('siswa')->with(['province', 'regency'])->findOrFail($id);
        return view('siswa.show', compact('user'));
    }

    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        toast('warning','Status akun telah diubah diubah.');

        return back();
    }
}
