<?php
// app/Http/Requests/PaymentRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'payment_note' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'payment_proof.required' => 'Bukti pembayaran wajib diupload.',
            'payment_proof.image' => 'File harus berupa gambar (JPEG, PNG, JPG).',
            'payment_proof.max' => 'Ukuran file maksimal 5MB.',
            'payment_note.max' => 'Catatan maksimal 255 karakter.',
        ];
    }
}