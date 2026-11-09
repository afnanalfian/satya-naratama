<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/** Setujui / tolak pembayaran pesanan. Hak akses diberikan oleh OrderObserver saat status menjadi "verified". */
class OrderVerificationService
{
    public function approve(Order $order, User $admin): Order
    {
        DB::transaction(function () use ($order, $admin) {
            $o = Order::where('id', $order->id)->lockForUpdate()->with(['items.product.productable', 'payment'])->firstOrFail();
            if ($o->status !== 'paid' || $o->payment?->status !== 'paid') {
                throw new RuntimeException('Order tidak dalam status yang bisa diverifikasi');
            }
            $o->payment->update(['status' => 'verified', 'verified_at' => now(), 'verified_by' => $admin->id]);
            $o->update(['status' => 'verified']);
        });
        $order->refresh();
        notify_user($order->user, "Pembayaran Anda untuk Order #{$order->order_code} telah diverifikasi. Akses telah diberikan.", true, route('my.orders.show', $order));

        return $order;
    }

    public function reject(Order $order): Order
    {
        DB::transaction(function () use ($order) {
            $o = Order::where('id', $order->id)->lockForUpdate()->with('payment')->firstOrFail();
            if ($o->status !== 'paid') {
                throw new RuntimeException('Order tidak bisa ditolak');
            }
            $o->payment?->update(['status' => 'rejected']);
            $o->update(['status' => 'rejected']);
        });
        $order->refresh();
        notify_user($order->user, "Pembayaran Order #{$order->order_code} ditolak. Silakan hubungi admin atau buat pesanan baru.", true, route('my.orders.show', $order));

        return $order;
    }
}
