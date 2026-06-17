<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    /**
     * Daftar order milik user
     */
    public function index(Request $request)
    {
        $orders = Order::with(['payment'])
            ->where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('purchase.my-orders.index', compact('orders'));
    }

    /**
     * Detail order milik user
     */
    public function show(Request $request, Order $order)
    {
        abort_if($order->user_id !== $request->user()->id, 403);

        $order->load([
            'items.product',
            'payment',
            'discounts.discount', // jika relasi ada
        ]);

        return view('purchase.my-orders.show', compact('order'));
    }
}
