<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderInvoiceController extends Controller
{
    public function download(Request $request, Order $order)
    {
        /**
         * AUTHORIZATION
         * - user biasa hanya boleh download miliknya
         * - admin boleh download semua
         */
        if (
            ! $request->user()->hasRole('admin') &&
            $order->user_id !== $request->user()->id
        ) {
            abort(403);
        }

        /**
         * HANYA ORDER VERIFIED
         */
        if ($order->status !== 'verified') {
            abort(403, 'Invoice hanya tersedia untuk order terverifikasi');
        }

        $order->load([
            'user',
            'items.product',
            'discounts.discount',
            'payment',
        ]);

        $pdf = Pdf::loadView('purchase.invoices.order', [
            'order' => $order,
        ])->setPaper('A4');

        return $pdf->download(
            'Invoice-' . $order->order_code . '.pdf'
        );
    }
}
