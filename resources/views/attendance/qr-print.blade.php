<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Cetak Kartu QR Siswa</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Inter, -apple-system, 'Segoe UI', Roboto, sans-serif; background: #F1F2F4; color: #0D1B0D; }
        .toolbar { position: sticky; top: 0; background: #fff; border-bottom: 1px solid #E3E5E8; padding: 12px 16px; display: flex; gap: 12px; align-items: center; justify-content: space-between; }
        .toolbar button { background: #418741; color: #fff; border: 0; border-radius: 10px; padding: 10px 18px; font-weight: 600; cursor: pointer; }
        .sheet { display: grid; grid-template-columns: repeat(auto-fill, 85.6mm); gap: 6mm; justify-content: center; padding: 10mm; }
        .card { width: 85.6mm; height: 54mm; background: #fff; border-radius: 3.5mm; border: 0.3mm solid #B3CFB3; overflow: hidden; display: flex; break-inside: avoid; page-break-inside: avoid; }
        .card .side { width: 7mm; background: linear-gradient(180deg, #418741, #1A361A); }
        .card .body { flex: 1; padding: 4mm; display: flex; gap: 4mm; align-items: center; }
        .card .info { flex: 1; min-width: 0; display: flex; flex-direction: column; height: 100%; }
        .brand { font-size: 8pt; font-weight: 800; letter-spacing: .02em; color: #418741; text-transform: uppercase; }
        .label { font-size: 6.5pt; color: #6F7276; margin-top: .5mm; }
        .name { font-size: 11pt; font-weight: 700; line-height: 1.15; margin-top: auto; }
        .meta { font-size: 7.5pt; color: #4A4C4F; margin-top: 1mm; }
        .code { font-family: ui-monospace, Menlo, monospace; font-size: 6pt; color: #6F7276; margin-top: 1.5mm; word-break: break-all; }
        .qr { width: 34mm; height: 34mm; display: flex; align-items: center; justify-content: center; }
        .qr img, .qr canvas { width: 34mm !important; height: 34mm !important; }
        @media print {
            body { background: #fff; }
            .toolbar { display: none; }
            .sheet { padding: 0; gap: 4mm; }
            @page { size: A4; margin: 10mm; }
        }
    </style>
</head>
<body>
    <div class="toolbar">
        <span>{{ $students->count() }} kartu siap dicetak · ukuran kartu ID (85,6 × 54 mm)</span>
        <button onclick="window.print()">Cetak</button>
    </div>
    <div class="sheet">
        @foreach($students as $s)
            <div class="card">
                <div class="side"></div>
                <div class="body">
                    <div class="info">
                        <div class="brand">Satya Naratama</div>
                        <div class="label">Kartu Absensi Siswa</div>
                        <div class="name">{{ $s->name }}</div>
                        <div class="meta">
                            {{ $s->studentRegistration?->class ? 'Kelas ' . $s->studentRegistration->class : '' }}
                            {{ $s->studentRegistration?->school_origin ? '· ' . \Illuminate\Support\Str::limit($s->studentRegistration->school_origin, 26) : '' }}
                        </div>
                        <div class="code">{{ $s->qr_payload }}</div>
                    </div>
                    <div class="qr"><div data-qr="{{ $s->qr_payload }}" data-size="256"></div></div>
                </div>
            </div>
        @endforeach
    </div>
    @include('attendance.partials.qr-script')
</body>
</html>
