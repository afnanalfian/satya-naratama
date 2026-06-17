<?php

namespace App\Services;

use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderDiscount;
use App\Models\UserDiscount;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class DiscountService
{
    /**
     * APPLY DISCOUNT KE ORDER (FINAL / COMMIT)
     * Dipanggil SAAT checkout
     */
    public function applyDiscountToOrder(
        Order $order,
        Discount $discount,
        int $userId
    ): float {
        $this->validateDiscountForOrder($discount, $order, $userId);

        $amount = $this->calculateDiscountAmount(
            $discount,
            $order->total_amount
        );

        if ($amount <= 0) {
            return 0;
        }

        // snapshot ke order_discounts
        OrderDiscount::create([
            'order_id'    => $order->id,
            'discount_id' => $discount->id,
            'amount'      => $amount,
        ]);

        // update total order
        $order->update([
            'total_amount' => max(0, $order->total_amount - $amount),
        ]);

        // tandai discount dipakai user
        UserDiscount::updateOrCreate(
            [
                'user_id'     => $userId,
                'discount_id' => $discount->id,
            ],
            [
                'used_at' => Carbon::now(),
            ]
        );

        // update quota global
        if ($discount->quota !== null) {
            $discount->increment('used');
        }

        return $amount;
    }

    /**
     * APPLY VIA KODE VOUCHER
     * Wrapper convenience
     */
    public function applyVoucher(
        Order $order,
        string $code,
        int $userId
    ): float {
        $discount = Discount::where('code', $code)
            ->where('is_active', true)
            ->first();

        if (! $discount) {
            throw new ModelNotFoundException('Kode voucher tidak ditemukan');
        }

        return $this->applyDiscountToOrder(
            $order,
            $discount,
            $userId
        );
    }

    /**
     * VALIDASI DISCOUNT TERHADAP ORDER
     * Dipakai saat COMMIT
     */
    public function validateDiscountForOrder(
        Discount $discount,
        Order $order,
        int $userId
    ): void {
        $now = Carbon::now();

        if (! $discount->is_active) {
            throw new Exception('Diskon tidak aktif');
        }

        if ($discount->starts_at && $now->lt($discount->starts_at)) {
            throw new Exception('Diskon belum berlaku');
        }

        if ($discount->ends_at && $now->gt($discount->ends_at)) {
            throw new Exception('Diskon sudah berakhir');
        }

        if (
            $discount->quota !== null &&
            $discount->used >= $discount->quota
        ) {
            throw new Exception('Kuota diskon sudah habis');
        }

        if (
            $discount->min_order_amount !== null &&
            $order->total_amount < $discount->min_order_amount
        ) {
            throw new Exception('Minimal pembelian tidak terpenuhi');
        }

        if (
            UserDiscount::where('user_id', $userId)
                ->where('discount_id', $discount->id)
                ->whereNotNull('used_at')
                ->exists()
        ) {
            throw new Exception('Diskon sudah pernah digunakan');
        }
    }

    /**
     * HITUNG NOMINAL DISKON
     * Bisa dipakai untuk preview
     */
    public function calculateDiscountAmount(
        Discount $discount,
        float $orderTotal
    ): float {
        $amount = match ($discount->type) {
            'percentage' => $orderTotal * ($discount->value / 100),
            'fixed'      => $discount->value,
            default      => 0,
        };

        if ($discount->max_discount !== null) {
            $amount = min($amount, $discount->max_discount);
        }

        return round(max(0, $amount), 2);
    }
    public function preview(
        ?string $voucherCode,
        ?int $discountId,
        float $subtotal,
        int $userId
    ): array {
        if ($voucherCode && $discountId) {
            throw new Exception('Silakan pilih salah satu: kode voucher atau diskon.');
        }
        if ($voucherCode) {
            $discount = Discount::where('code', $voucherCode)
                ->where('is_active', true)
                ->first();

            if (! $discount) {
                throw new Exception('Kode voucher tidak valid atau sudah tidak tersedia.');
            }
        } elseif ($discountId) {
                $discount = Discount::where('id', $discountId)
                    ->whereNull('code')
                    ->where('is_active', true)
                    ->first();

                if (! $discount) {
                    throw new Exception('Diskon yang dipilih tidak tersedia.');
                }
        } else {
            return [
                'discount_amount' => 0,
                'final_total'     => $subtotal,
                'label'           => null,
            ];
        }

        // VALIDASI TANPA SIDE EFFECT
        $this->validateDiscountPreview($discount, $subtotal, $userId);

        $amount = $this->calculateDiscountAmount($discount, $subtotal);

        return [
            'discount_amount' => $amount,
            'final_total'     => max(0, $subtotal - $amount),
            'label'           => $discount->name,
        ];
    }

    protected function validateDiscountPreview(
        Discount $discount,
        float $subtotal,
        int $userId
    ): void {
        $now = Carbon::now();

        if ($discount->starts_at && $now->lt($discount->starts_at)) {
            throw new Exception('Diskon belum berlaku');
        }

        if ($discount->ends_at && $now->gt($discount->ends_at)) {
            throw new Exception('Diskon sudah berakhir');
        }

        if ($discount->quota !== null && $discount->used >= $discount->quota) {
            throw new Exception('Kuota diskon sudah habis');
        }

        if ($discount->min_order_amount &&
            $subtotal < $discount->min_order_amount) {
            throw new Exception('Minimal pembelian tidak terpenuhi');
        }

        if ($discount->code &&
            UserDiscount::where('user_id', $userId)
                ->where('discount_id', $discount->id)
                ->whereNotNull('used_at')
                ->exists()) {
            throw new Exception('Voucher sudah pernah digunakan');
        }
        if (
            UserDiscount::where('user_id', $userId)
                ->where('discount_id', $discount->id)
                ->whereNotNull('used_at')
                ->exists()
        ) {
            throw new Exception('Diskon sudah pernah digunakan');
        }
    }
}
