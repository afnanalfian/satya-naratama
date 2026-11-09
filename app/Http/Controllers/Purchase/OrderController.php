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
    public function approve(Request $request, Order $order, \App\Services\OrderVerificationService $svc)
    {
        try {
            $svc->approve($order, $request->user());
        } catch (\RuntimeException $e) {
            abort(409, $e->getMessage());
        }
        toast('success', 'Pembayaran berhasil diverifikasi dan akses diberikan');

        return redirect()->route('orders.index');
    }

    public function reject(Request $request, Order $order, \App\Services\OrderVerificationService $svc)
    {
        try {
            $svc->reject($order);
        } catch (\RuntimeException $e) {
            abort(409, $e->getMessage());
        }
        toast('info', 'Pembayaran telah ditolak');

        return redirect()->route('orders.index');
    }

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
