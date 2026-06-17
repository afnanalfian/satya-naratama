<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pemasukan</title>
    <style>
        @page {
            margin: 20px;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #1f2937;
            margin: 0;
            font-size: 22px;
        }
        .header p {
            color: #6b7280;
            margin: 5px 0 0 0;
        }
        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .info-label {
            font-weight: 600;
            color: #4b5563;
        }
        .info-value {
            font-weight: 600;
            color: #1f2937;
        }
        .summary-cards {
            display: flex;
            justify-content: space-between; /* bagi rata */
            gap: 12px;                      /* jarak antar card */
            margin-bottom: 24px;
        }

        .summary-card {
            flex: 1;                        /* semua card ambil lebar sama */
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px;
        }
        .summary-card-title {
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 5px;
        }
        .summary-card-value {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table th {
            background: #3b82f6;
            color: white;
            text-align: left;
            padding: 10px;
            font-size: 11px;
            border: 1px solid #2563eb;
        }
        .table td {
            padding: 10px;
            border: 1px solid #e5e7eb;
            font-size: 11px;
        }
        .table tr:nth-child(even) {
            background: #f9fafb;
        }
        .total-row {
            background: #dcfce7 !important;
            font-weight: bold;
        }
        .method-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
        }
        .qris-badge {
            background: #dbeafe;
            color: #1e40af;
        }
        .midtrans-badge {
            background: #f3e8ff;
            color: #5b21b6;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            background: #d1fae5;
            color: #065f46;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
        .page-break {
            page-break-before: always;
        }
        .currency {
            text-align: right;
            font-family: 'Courier New', monospace;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    {{-- HEADER --}}
    <div class="header">
        <h1>LAPORAN PEMASUKAN</h1>
        <p>Azwara Learning Center</p>
        <p>Periode: {{ \Carbon\Carbon::parse($selectedMonth)->translatedFormat('F Y') }}</p>
    </div>

    {{-- INFO BOX --}}
    <div class="info-box">
        <div class="info-row">
            <span class="info-label">Periode Laporan:</span>
            <span class="info-value">{{ $startDate->translatedFormat('d M Y') }} - {{ $endDate->translatedFormat('d M Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Tanggal Cetak:</span>
            <span class="info-value">{{ $generatedAt->translatedFormat('d M Y H:i') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Dicetak Oleh:</span>
            <span class="info-value">{{ $generatedBy }}</span>
        </div>
    </div>

    <table style="width:100%; border-collapse:separate; border-spacing:8px;">
        <tr>
            <td style="border:1px solid #e5e7eb; border-radius:8px; padding:12px;">
                <div class="summary-card-title">TOTAL PEMASUKAN</div>
                <div class="summary-card-value">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
            </td>
            <td style="border:1px solid #e5e7eb; border-radius:8px; padding:12px;">
                <div class="summary-card-title">QRIS</div>
                <div class="summary-card-value">Rp {{ number_format($paymentMethods['manual_qris']['total'] ?? 0, 0, ',', '.') }}</div>
                <div style="font-size:10px; color:#6b7280;">
                    {{ $paymentMethods['manual_qris']['count'] ?? 0 }} transaksi
                </div>
            </td>
            <td style="border:1px solid #e5e7eb; border-radius:8px; padding:12px;">
                <div class="summary-card-title">MIDTRANS</div>
                <div class="summary-card-value">Rp {{ number_format($paymentMethods['midtrans']['total'] ?? 0, 0, ',', '.') }}</div>
                <div style="font-size:10px; color:#6b7280;">
                    {{ $paymentMethods['midtrans']['count'] ?? 0 }} transaksi
                </div>
            </td>
            <td style="border:1px solid #e5e7eb; border-radius:8px; padding:12px;">
                <div class="summary-card-title">TOTAL TRANSAKSI</div>
                <div class="summary-card-value">{{ $payments->count() }}</div>
                <div style="font-size:10px; color:#6b7280;">
                    pembayaran verified
                </div>
            </td>
        </tr>
    </table>

    {{-- DETAIL TABLE --}}
    <table class="table">
        <thead>
            <tr>
                <th width="30">No</th>
                <th width="80">Tanggal</th>
                <th>Customer</th>
                <th width="80">Metode</th>
                <th width="90">No Order</th>
                <th width="120" class="currency">Jumlah</th>
                <th width="70">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $index => $payment)
                @php
                    $order = $payment->order;
                    $methodClass = $payment->method == 'manual_qris' ? 'qris-badge' : 'midtrans-badge';
                    $methodLabel = $payment->method == 'manual_qris' ? 'QRIS' : 'Midtrans';
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $payment->verified_at->format('d/m/Y') }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        <span class="method-badge {{ $methodClass }}">
                            {{ $methodLabel }}
                        </span>
                    </td>
                    <td>#{{ $order->order_code }}</td>
                    <td class="currency">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td>
                        <span class="status-badge">VERIFIED</span>
                    </td>
                </tr>
            @endforeach

            {{-- TOTAL ROW --}}
            @if($payments->count() > 0)
                <tr class="total-row">
                    <td colspan="5" class="text-center"><strong>TOTAL</strong></td>
                    <td class="currency"><strong>Rp {{ number_format($totalIncome, 0, ',', '.') }}</strong></td>
                    <td class="text-center"><strong>{{ $payments->count() }} transaksi</strong></td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- EMPTY STATE --}}
    @if($payments->count() == 0)
        <div style="text-align: center; padding: 40px; color: #6b7280;">
            <h3 style="margin-bottom: 10px;">Tidak Ada Data Transaksi</h3>
            <p>Tidak ada pembayaran yang sudah diverifikasi pada periode ini.</p>
        </div>
    @endif

    {{-- DAILY SUMMARY --}}
    @if($payments->count() > 0)
        @php
            $dailySummary = $payments->groupBy(function($payment) {
                return $payment->verified_at->format('Y-m-d');
            })->map(function($group) {
                return [
                    'date' => $group->first()->verified_at,
                    'count' => $group->count(),
                    'total' => $group->sum(function($payment) {
                        return $payment->order->total_amount;
                    })
                ];
            })->sortBy('date');
        @endphp

        <div style="margin-top: 30px;">
            <h3 style="color: #1f2937; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px; font-size: 14px;">
                Ringkasan Harian
            </h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="background: #f3f4f6;">
                        <th style="padding: 8px; text-align: left; border: 1px solid #e5e7eb;">Tanggal</th>
                        <th style="padding: 8px; text-align: right; border: 1px solid #e5e7eb;">Jumlah Transaksi</th>
                        <th style="padding: 8px; text-align: right; border: 1px solid #e5e7eb;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dailySummary as $day)
                        <tr>
                            <td style="padding: 8px; border: 1px solid #e5e7eb;">
                                {{ $day['date']->translatedFormat('d M Y') }}
                            </td>
                            <td style="padding: 8px; text-align: right; border: 1px solid #e5e7eb;">
                                {{ $day['count'] }}
                            </td>
                            <td style="padding: 8px; text-align: right; border: 1px solid #e5e7eb;">
                                Rp {{ number_format($day['total'], 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- FOOTER --}}
    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem Azwara Learning Center</p>
        <p>© {{ date('Y') }} Azwara Learning Center • www.azwaralearning.com</p>
    </div>
</body>
</html>
