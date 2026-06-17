<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PaymentSetting;

class PaymentSettingController extends Controller
{
    /**
     * Form pengaturan pembayaran
     */
    public function edit()
    {
        $settings = PaymentSetting::pluck('value', 'key');

        return view('purchase.payment_settings.edit', compact('settings'));
    }

    /**
     * Simpan pengaturan pembayaran
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'qris_image'            => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'payment_instruction'  => 'nullable|string',
            'active_payment_method'=> 'required|in:manual_qris,midtrans',
        ]);

        // upload QRIS
        if ($request->hasFile('qris_image')) {
            $path = $request->file('qris_image')
                ->store('payment/qris', 'public');

            PaymentSetting::updateOrCreate(
                ['key' => 'qris_image'],
                ['value' => $path]
            );
        }

        // instruction
        PaymentSetting::updateOrCreate(
            ['key' => 'payment_instruction'],
            ['value' => $data['payment_instruction'] ?? '']
        );

        // active payment method
        PaymentSetting::updateOrCreate(
            ['key' => 'active_payment_method'],
            ['value' => $data['active_payment_method']]
        );

        return back()->with('success', 'Pengaturan pembayaran berhasil diperbarui');
    }
}
