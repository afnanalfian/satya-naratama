<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AccountDeletionLog;
use App\Models\Province;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\StudentRegistration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show')->with('title','Profil Saya');
    }

    public function edit()
    {
        $user = auth()->user();
        $provinces = Province::orderBy('id')->get();

        // Load student registration if user is siswa
        $registration = null;
        if ($user->hasRole('siswa')) {
            $registration = StudentRegistration::where('user_id', $user->id)->first();
            $kecamatans = Kecamatan::where('regency_id', 7309)->orderBy('name')->get();
            $kelurahans = Kelurahan::whereIn('kecamatan_id', $kecamatans->pluck('id'))->orderBy('name')->get();
            $classes = ['X', 'XI', 'XII', 'Alumni'];
            $universities = ['STIS', 'STAN', 'IPDN', 'STMKG', 'SSN', 'STIN', 'STTD', 'POLTEKIMIPAS', 'AKPOL', 'AKMIL', 'UNHAN'];
            $shirtSizes = ['S', 'M', 'L', 'XL', 'XXL'];

            return view('profile.edit', compact(
                'user',
                'provinces',
                'registration',
                'kecamatans',
                'kelurahans',
                'classes',
                'universities',
                'shirtSizes'
            ));
        }

        return view('profile.edit', compact('user', 'provinces'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string',
            'province_id' => 'nullable|exists:provinces,id',
            'regency_id' => 'nullable|exists:regencies,id',
            'avatar' => 'nullable|image|max:2048',

            // Registration fields (only for siswa)
            'full_name' => 'nullable|string|max:191',
            'nickname' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date|before:today',
            'gender' => 'nullable|in:L,P',
            'school_origin' => 'nullable|string|max:255',
            'class' => 'nullable|in:X,XI,XII,Alumni',
            'registration_phone' => 'nullable|string|max:20',
            'kecamatan_id' => 'nullable|exists:kecamatans,id',
            'kelurahan_id' => 'nullable|exists:kelurahans,id',
            'height_cm' => 'nullable|integer|min:50|max:300',
            'weight_kg' => 'nullable|integer|min:10|max:500',
            'shirt_size' => 'nullable|in:S,M,L,XL,XXL',
            'priority_university_1' => 'nullable|in:STIS,STAN,IPDN,STMKG,SSN,STIN,STTD,POLTEKIMIPAS,AKPOL,AKMIL,UNHAN',
            'priority_university_2' => 'nullable|in:STIS,STAN,IPDN,STMKG,SSN,STIN,STTD,POLTEKIMIPAS,AKPOL,AKMIL,UNHAN',
            'parent_name' => 'nullable|string|max:191',
            'parent_occupation' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
        ]);

        if (!$request->filled('province_id')) {
            unset($data['province_id'], $data['regency_id']);
        }

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->avatar->store('avatars', 'public');
        }

        $user->update($data);

        // Update registration if user is siswa and has registration data
        if ($user->hasRole('siswa') && $user->studentRegistration) {
            $registrationData = [];

            if ($request->filled('full_name')) $registrationData['full_name'] = $request->full_name;
            if ($request->filled('nickname')) $registrationData['nickname'] = $request->nickname;
            if ($request->filled('birth_date')) $registrationData['birth_date'] = $request->birth_date;
            if ($request->filled('gender')) $registrationData['gender'] = $request->gender;
            if ($request->filled('school_origin')) $registrationData['school_origin'] = $request->school_origin;
            if ($request->filled('class')) $registrationData['class'] = $request->class;
            if ($request->filled('registration_phone')) $registrationData['phone'] = $request->registration_phone;
            if ($request->filled('kecamatan_id')) $registrationData['kecamatan_id'] = $request->kecamatan_id;
            if ($request->filled('kelurahan_id')) $registrationData['kelurahan_id'] = $request->kelurahan_id;
            if ($request->filled('height_cm')) $registrationData['height_cm'] = $request->height_cm;
            if ($request->filled('weight_kg')) $registrationData['weight_kg'] = $request->weight_kg;
            if ($request->filled('shirt_size')) $registrationData['shirt_size'] = $request->shirt_size;
            if ($request->filled('priority_university_1')) $registrationData['priority_university_1'] = $request->priority_university_1;
            if ($request->filled('priority_university_2')) $registrationData['priority_university_2'] = $request->priority_university_2;
            if ($request->filled('parent_name')) $registrationData['parent_name'] = $request->parent_name;
            if ($request->filled('parent_occupation')) $registrationData['parent_occupation'] = $request->parent_occupation;
            if ($request->filled('parent_phone')) $registrationData['parent_phone'] = $request->parent_phone;

            if (!empty($registrationData)) {
                $user->studentRegistration->update($registrationData);
            }
        }

        toast('success', 'Profil berhasil diperbarui.');
        return redirect()->route('profile.show');
    }

    public function password()
    {
        return view('profile.password')->with('title','Ganti Password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            toast('error','Password saat ini salah.');

            return back();
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        toast('success','Password berhasil diubah.');

        return redirect()->route('profile.show');
    }

    public function delete()
    {
        return view('profile.delete')->with('title','Hapus Akun');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'reason_option' => 'required|string',
            'reason_custom' => 'nullable|string',
        ]);

        $user = auth()->user();

        AccountDeletionLog::create([
            'user_id'       => $user->id,
            'reason_option' => $request->reason_option,
            'reason_custom' => $request->reason_option === 'Lainnya'
                                ? $request->reason_custom
                                : null,
            'deactivated_at' => now(),
            'deleted_at'     => null,
        ]);

        $user->is_active = 0;
        $user->save();

        auth()->logout();

        toast('info','Akun dinonaktifkan. Anda bisa mengaktifkan kembali dengan login dalam 10 hari.');

        return redirect('/');
    }
}
