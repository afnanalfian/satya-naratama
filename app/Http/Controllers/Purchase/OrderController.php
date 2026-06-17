<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserEntitlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * List order yang perlu ditangani admin
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'payment'])
            ->orderByDesc('created_at');

        // SEARCH BY USER NAME
        if ($request->filled('q')) {
            $q = $request->q;

            $query->whereHas('user', function ($user) use ($q) {
                $user->where('name', 'like', "%{$q}%");
            });
        }

        $orders = $query->paginate(50)
            ->withQueryString(); // biar pagination tetap bawa parameter search

        return view('purchase.orders.index', compact('orders'));
    }

    /**
     * Detail order
     */
    public function show(Order $order)
    {
        $order->load([
            'user',
            'items.product.productable',
            'payment.verifier',
        ]);

        return view('purchase.orders.show', compact('order'));
    }

    /**
     * APPROVE pembayaran + grant akses
     */
    public function approve(Request $request, Order $order)
    {
        DB::transaction(function () use ($order, $request) {

            /** LOCK ORDER */
            $order = Order::where('id', $order->id)
                ->lockForUpdate()
                ->with(['items.product.productable', 'payment'])
                ->firstOrFail();

            /** VALIDASI STATUS */
            if (
                $order->status !== 'paid' ||
                $order->payment->status !== 'paid'
            ) {
                abort(409, 'Order tidak dalam status yang bisa diverifikasi');
            }

            /** UPDATE PAYMENT */
            $order->payment->update([
                'status'      => 'verified',
                'verified_at' => now(),
                'verified_by' => $request->user()->id,
            ]);

            /** UPDATE ORDER */
            $order->update([
                'status' => 'verified',
            ]);
        });

        notify_user(
            $order->user,
            "Pembayaran Anda untuk Order #{$order->order_code} telah diverifikasi. Akses telah diberikan.",
            true,
            route('my.orders.show', $order)
        );

        toast('success', 'Pembayaran berhasil diverifikasi dan akses diberikan');
        return redirect()->route('orders.index');
    }

    /**
     * REJECT pembayaran
     */
    public function reject(Request $request, Order $order)
    {
        DB::transaction(function () use ($order) {

            $order = Order::where('id', $order->id)
                ->lockForUpdate()
                ->with('payment')
                ->firstOrFail();

            if (! in_array($order->status, ['paid'])) {
                abort(409, 'Order tidak bisa ditolak');
            }

            $order->payment->update([
                'status' => 'rejected',
            ]);

            $order->update([
                'status' => 'rejected',
            ]);
        });

        notify_user(
            $order->user,
            "Pembayaran Order #{$order->order_code} ditolak. Silakan upload ulang bukti pembayaran.",
            true,
            route('checkout.payment', $order)
        );

        toast('info', 'Pembayaran telah ditolak');
        return redirect()->route('orders.index');
    }
    /**
     * DELETE order (admin only)
     */
    public function destroy(Order $order)
    {
        // Order yang sudah diverifikasi tidak boleh dihapus
        if ($order->status === 'verified') {
            toast('error', 'Order yang sudah diverifikasi tidak dapat dihapus');
            return back();
        }

        // Safety tambahan (opsional)
        if ($order->payment && $order->payment->status === 'verified') {
            toast('error', 'Payment sudah diverifikasi, order tidak dapat dihapus');
            return back();
        }

        DB::transaction(function () use ($order) {
            $order->delete(); // cascade ke items & payment
        });

        toast('warning', 'Order berhasil dihapus');
        return redirect()->route('orders.index');
    }

}
