<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->order_code }} - AZWARA LEARNING</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1f2937;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .header .title,
        .header .subtitle,
        .header .muted {
            text-align: left;
        }

        .logo {
            width: 90px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
        }
        .subtitle {
            font-size: 13px;
            font-weight: bold;
        }
        .muted {
            color: #6b7280;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        th, td {
            border-bottom: 1px solid #e5e7eb;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f9fafb;
        }
        .right {
            text-align: right;
        }
        .total {
            font-size: 14px;
            font-weight: bold;
        }
        .signature {
            width: 140px;
            margin-top: 8px;
        }
    </style>
</head>
<body>

<div class="header">
    <table style="width:100%;">
        <tr>
            <td style="text-align:left;">
                <div class="title">INVOICE</div>
                <div class="subtitle">Pembelian Paket Belajar - AZWARA LEARNING</div>
                <div class="muted">Order #{{ $order->order_code }}</div>
            </td>
            <td style="text-align:right; width:100px;">
                <img src="{{ public_path('img/logo.png') }}" class="logo" alt="AZWARA LEARNING">
            </td>
        </tr>
    </table>
</div>

<table>
    <tr>
        <td>
            <strong>Nama Siswa</strong><br>
            {{ $order->user->name }}<br>
            {{ $order->user->email }}
        </td>
        <td>
            <strong>Tanggal</strong><br>
            {{ $order->created_at->format('d M Y H:i') }}<br><br>

            <strong>Status</strong><br>
            {{ strtoupper($order->status) }}
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th class="right">Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td>
                    {{ $item->product->name }}<br>
                    <span class="muted">{{ ucfirst($item->product->type) }}</span>
                </td>
                <td>{{ $item->qty }}</td>
                <td class="right">
                    Rp {{ number_format($item->price, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@if ($order->discounts->isNotEmpty())
    <table>
        <tr>
            <td>
                <strong>Diskon</strong>
                <ul>
                    @foreach ($order->discounts as $od)
                        <li>
                            {{ $od->discount->name }}
                            @if ($od->discount->code)
                                ({{ $od->discount->code }})
                            @endif
                        </li>
                    @endforeach
                </ul>
            </td>
            <td class="right">
                − Rp {{ number_format($order->discounts->sum('amount'), 0, ',', '.') }}
            </td>
        </tr>
    </table>
@endif

<table>
    <tr>
        <td class="right total">
            TOTAL: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
        </td>
    </tr>
</table>

<br><br>

<table>
    <tr>
        <td></td>
        <td class="right">
            <span class="muted">Hormat kami,</span><br>
            {{-- <img src="{{ public_path('img/signature.png') }}" class="signature" alt="Tanda Tangan"><br> --}}
            <strong>Tim Azwara Learning</strong><br>
            {{-- <span class="muted">Owner Azwara Learning</span> --}}
        </td>
    </tr>
</table>

<br>

<div class="muted">
    Invoice ini dibuat secara otomatis dan sah.
</div>

</body>
</html>
