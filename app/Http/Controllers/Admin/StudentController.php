<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentRegistration;
use App\Models\Province;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function edit($id)
    {
        $user = User::role('siswa')
            ->with(['province', 'regency', 'studentRegistration.kecamatan', 'studentRegistration.kelurahan'])
            ->findOrFail($id);

        $provinces = Province::orderBy('name')->get();
        $kecamatans = Kecamatan::where('regency_id', 7309)->orderBy('name')->get(); // Pangkep
        $kelurahans = Kelurahan::whereIn('kecamatan_id', $kecamatans->pluck('id'))->orderBy('name')->get();

        $classes = ['X', 'XI', 'XII', 'Alumni'];
        $universities = ['STIS', 'STAN', 'IPDN', 'STMKG', 'SSN', 'STIN', 'STTD', 'POLTEKIMIPAS', 'AKPOL', 'AKMIL', 'UNHAN'];
        $shirtSizes = ['S', 'M', 'L', 'XL', 'XXL'];

        return view('admin.students.edit', compact(
            'user',
            'provinces',
            'kecamatans',
            'kelurahans',
            'classes',
            'universities',
            'shirtSizes'
        ));
    }

    public function update(Request $request, $id)
    {
        $user = User::role('siswa')->findOrFail($id);
        $registration = StudentRegistration::where('user_id', $user->id)->firstOrFail();

        $rules = [
            // User fields
            'name' => 'required|string|max:191',
            'email' => ['required', 'email', 'max:191', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'province_id' => 'nullable|exists:provinces,id',
            'regency_id' => 'nullable|exists:regencies,id',
            'is_active' => 'boolean',
            'avatar' => 'nullable|image|max:2048',

            // Registration fields
            'full_name' => 'required|string|max:191',
            'nickname' => 'nullable|string|max:100',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:L,P',
            'school_origin' => 'required|string|max:255',
            'class' => 'required|in:X,XI,XII,Alumni',
            'registration_phone' => 'required|string|max:20',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'kelurahan_id' => 'required|exists:kelurahans,id',
            'height_cm' => 'nullable|integer|min:50|max:300',
            'weight_kg' => 'nullable|integer|min:10|max:500',
            'shirt_size' => 'nullable|in:S,M,L,XL,XXL',
            'priority_university_1' => 'required|in:STIS,STAN,IPDN,STMKG,SSN,STIN,STTD,POLTEKIMIPAS,AKPOL,AKMIL,UNHAN',
            'priority_university_2' => 'nullable|in:STIS,STAN,IPDN,STMKG,SSN,STIN,STTD,POLTEKIMIPAS,AKPOL,AKMIL,UNHAN',
            'parent_name' => 'required|string|max:191',
            'parent_occupation' => 'nullable|string|max:255',
            'parent_phone' => 'required|string|max:20',

            // Password
            'password' => 'nullable|string|min:8|confirmed',
        ];

        $request->validate($rules);

        // Update User
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'province_id' => $request->province_id,
            'regency_id' => $request->regency_id,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $userData['avatar'] = $request->avatar->store('avatars', 'public');
        }

        $user->update($userData);

        // Update Registration
        $registrationData = [
            'full_name' => $request->full_name,
            'nickname' => $request->nickname,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'school_origin' => $request->school_origin,
            'class' => $request->class,
            'phone' => $request->registration_phone,
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
            'height_cm' => $request->height_cm,
            'weight_kg' => $request->weight_kg,
            'shirt_size' => $request->shirt_size,
            'priority_university_1' => $request->priority_university_1,
            'priority_university_2' => $request->priority_university_2,
            'parent_name' => $request->parent_name,
            'parent_occupation' => $request->parent_occupation,
            'parent_phone' => $request->parent_phone,
        ];

        $registration->update($registrationData);

        toast('success', 'Data siswa berhasil diperbarui.');
        return redirect()->route('siswa.show', $user->id);
    }
}
