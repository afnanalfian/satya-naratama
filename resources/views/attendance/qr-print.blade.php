<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"><title>Cetak Kartu QR</title>
<script src="{{ asset('vendor/qrcodejs/qrcode.min.js') }}"></script>
<style>
    @page { size: A4; margin: 10mm; }
    * { box-sizing: border-box; } body { font-family: system-ui, sans-serif; margin: 0; color: #22173a; }
    .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 6mm; }
    .card { border: 1.5px solid #22173a; border-radius: 4mm; overflow: hidden; break-inside: avoid; height: 82mm; display: flex; flex-direction: column; }
    .top { background: linear-gradient(135deg, #22173a, #7f1438); color: #fff; padding: 3mm 4mm; display: flex; align-items: center; gap: 2.5mm; }
    .top img { width: 9mm; height: 9mm; background: #fff; border-radius: 2mm; padding: .6mm; }
    .top b { font-size: 3.6mm; } .top small { display: block; font-size: 2.4mm; opacity: .8; }
    .qr { flex: 1; display: grid; place-items: center; padding: 2mm; }
    .name { text-align: center; font-weight: 800; font-size: 3.6mm; padding: 0 3mm; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .meta { text-align: center; font-size: 2.6mm; color: #75589f; padding-bottom: 3mm; }
    .bar { height: 2mm; background: linear-gradient(90deg, #d81b4d, #f99c07); }
    .tools { padding: 10px; text-align: center; } @media print { .tools { display: none; } }
</style>
</head>
<body>
<div class="tools"><button onclick="window.print()">🖨 Cetak</button> · {{ $students->count() }} kartu</div>
<div class="grid">
@foreach($students as $s)
    <div class="card">
        <div class="top"><img src="{{ asset('img/logo.png') }}" alt=""><div><b>SATYA NARATAMA</b><small>Kartu Presensi Siswa</small></div></div>
        <div class="qr"><div id="q{{ $s->id }}"></div></div>
        <div class="name">{{ $s->display_name }}</div>
        <div class="meta">{{ $s->studentRegistration?->school_origin }} {{ $s->studentRegistration?->class ? '· '.$s->studentRegistration->class : '' }}</div>
        <div class="bar"></div>
    </div>
    <script>new QRCode(document.getElementById('q{{ $s->id }}'), { text: @json($s->qr_payload), width: 150, height: 150 });</script>
@endforeach
</div>
<script>window.addEventListener('load', () => setTimeout(() => window.print(), 400));</script>
</body>
</html>
