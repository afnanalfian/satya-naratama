<?php
// app/Http/Requests/StudentRegistrationRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Data Pribadi
            'full_name' => 'required|string|max:191',
            'nickname' => 'nullable|string|max:100',
            'birth_date' => 'required|date|before:today|after:1950-01-01',
            'gender' => 'required|in:L,P',
            'school_origin' => 'required|string|max:255',
            'class' => 'required|in:X,XI,XII,Alumni',
            'phone' => 'required|string|max:20|regex:/^[0-9]+$/',
            
            // Wilayah
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'kelurahan_id' => 'required|exists:kelurahans,id',
            
            // Fisik
            'height_cm' => 'nullable|integer|min:50|max:300',
            'weight_kg' => 'nullable|integer|min:10|max:500',
            
            // Kampus Impian
            'priority_university_1' => 'required|in:STIS,STAN,IPDN,STMKG,SSN,STIN,STTD,POLTEKIMIPAS,AKPOL,AKMIL,UNHAN',
            'priority_university_2' => 'nullable|in:STIS,STAN,IPDN,STMKG,SSN,STIN,STTD,POLTEKIMIPAS,AKPOL,AKMIL,UNHAN',
            
            // Orangtua
            'parent_name' => 'required|string|max:191',
            'parent_occupation' => 'nullable|string|max:255',
            'parent_phone' => 'required|string|max:20|regex:/^[0-9]+$/',
            
            // Akun
            'email' => 'required|email|max:191|unique:student_registrations,email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            
            // Upload
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'birth_date.before' => 'Tanggal lahir harus sebelum hari ini.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'school_origin.required' => 'Asal sekolah wajib diisi.',
            'class.required' => 'Kelas wajib dipilih.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'phone.regex' => 'Nomor WhatsApp harus berupa angka.',
            'kecamatan_id.required' => 'Kecamatan wajib dipilih.',
            'kelurahan_id.required' => 'Kelurahan/Desa wajib dipilih.',
            'priority_university_1.required' => 'Kampus impian prioritas 1 wajib dipilih.',
            'parent_name.required' => 'Nama orangtua wajib diisi.',
            'parent_phone.required' => 'Nomor telepon orangtua wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Password dan konfirmasi password tidak cocok.',
            'avatar.image' => 'File harus berupa gambar.',
            'avatar.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}