<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportIncomeController extends Controller
{
    public function incomeReport(Request $request)
    {
        // Default bulan ini
        $selectedMonth = $request->query('month', now()->format('Y-m'));

        // Parse bulan yang dipilih
        $startDate = Carbon::parse($selectedMonth)->startOfMonth();
        $endDate = Carbon::parse($selectedMonth)->endOfMonth();

        // Ambil semua payment yang sudah verified dalam rentang bulan
        $payments = Payment::with(['order.user'])
            ->where('status', 'verified')
            ->whereBetween('verified_at', [$startDate, $endDate])
            ->orderByDesc('verified_at')
            ->get();

        // Hitung total pemasukan bulan ini
        $totalIncome = $payments->sum(function($payment) {
            return $payment->order->total_amount;
        });

        // Hitung total per metode pembayaran
        $paymentMethods = $payments->groupBy('method')->map(function($group) {
            return [
                'count' => $group->count(),
                'total' => $group->sum(function($payment) {
                    return $payment->order->total_amount;
                })
            ];
        });

        // Generate daftar bulan untuk dropdown (total 13 bulan)
        $months = [];
        $current = now();

        // Tambahkan 6 bulan ke depan
        for ($i = 6; $i >= 1; $i--) {
            $date = $current->copy()->addMonths($i);
            $months[$date->format('Y-m')] = $date->translatedFormat('F Y') ;
        }

        // Tambahkan bulan sekarang
        $months[$current->format('Y-m')] = $current->translatedFormat('F Y') . ' 🟢';

        // Tambahkan 6 bulan lalu
        for ($i = 1; $i <= 6; $i++) {
            $date = $current->copy()->subMonths($i);
            $months[$date->format('Y-m')] = $date->translatedFormat('F Y');
        }

        // Urutkan dari yang paling mendatang ke paling lampau
        krsort($months);

        return view('reports.income', compact(
            'payments',
            'totalIncome',
            'paymentMethods',
            'months',
            'selectedMonth',
            'startDate',
            'endDate'
        ));
    }
    public function exportIncomeReport(Request $request)
    {
        $selectedMonth = $request->query('month', now()->format('Y-m'));
        $startDate = Carbon::parse($selectedMonth)->startOfMonth();
        $endDate = Carbon::parse($selectedMonth)->endOfMonth();

        // Ambil data yang sama dengan report
        $payments = Payment::with(['order.user'])
            ->where('status', 'verified')
            ->whereBetween('verified_at', [$startDate, $endDate])
            ->orderByDesc('verified_at')
            ->get();

        $totalIncome = $payments->sum(function($payment) {
            return $payment->order->total_amount;
        });

        $paymentMethods = $payments->groupBy('method')->map(function($group) {
            return [
                'count' => $group->count(),
                'total' => $group->sum(function($payment) {
                    return $payment->order->total_amount;
                })
            ];
        });

        // Data untuk PDF
        $data = [
            'payments' => $payments,
            'totalIncome' => $totalIncome,
            'paymentMethods' => $paymentMethods,
            'selectedMonth' => $selectedMonth,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'generatedAt' => now(),
            'generatedBy' => auth()->user()->name,
        ];

        // Load view dan generate PDF
        $pdf = PDF::loadView('reports.exports.income-pdf', $data);

        // Set paper size dan orientation
        $pdf->setPaper('A4', 'landscape');

        // Download dengan nama file yang spesifik
        $fileName = 'laporan-pemasukan-' . Carbon::parse($selectedMonth)->format('F-Y') . '.pdf';

        return $pdf->download($fileName);
    }
}
