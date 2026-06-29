<?php
// app/Http/Requests/AdminVerificationRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminVerificationRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasRole('admin');
    }

    public function rules()
    {
        return [
            'verification_notes' => 'nullable|string|max:500',
            'action' => 'sometimes|in:approve,reject',
        ];
    }

    public function messages()
    {
        return [
            'verification_notes.max' => 'Catatan verifikasi maksimal 500 karakter.',
            'action.in' => 'Aksi tidak valid.',
        ];
    }
}