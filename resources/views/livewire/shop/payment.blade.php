@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); $o = $order; $disc = $o->discounts->sum('amount'); $pay = max(0, $o->total_amount - $disc); @endphp
<div>
    <x-page-header title="Pembayaran" :sub="'Pesanan '.$o->order_code" :back="route('my.orders.index')"/>
    <div class="grid gap-6 lg:grid-cols-5">
        <div class="space-y-6 lg:col-span-3">
            <div class="card-sunrise flex flex-col gap-4 p-6 sm:flex-row sm:items-center sm:justify-between" x-data="{ left: {{ (int) max(0, now()->diffInSeconds($o->expires_at, false)) }}, init() { setInterval(() => this.left = Math.max(0, this.left - 1), 1000) }, get t() { const h = Math.floor(this.left / 3600), m = Math.floor(this.left % 3600 / 60), s = this.left % 60; return [h, m, s].map(v => String(v).padStart(2, '0')).join(':') } }">
                <div><p class="text-sm text-white/80">Total yang harus dibayar</p><p class="font-display text-4xl font-extrabold">{{ $rp($pay) }}</p>@if($disc)<p class="text-xs text-white/80">sudah termasuk potongan {{ $rp($disc) }}</p>@endif</div>
                <div class="rounded-2xl bg-white/15 px-4 py-3 text-center"><p class="text-[11px] font-bold uppercase text-white/80">Batas bayar</p><p class="font-mono text-2xl font-bold" x-text="t"></p></div>
            </div>
            <div class="card card-pad">
                <p class="section-title">Scan QRIS</p>
                <div class="mt-4 grid gap-6 sm:grid-cols-2 sm:items-center">
                    <div class="mx-auto w-full max-w-[260px] rounded-3xl bg-white p-3 shadow-lift ring-1 ring-ink-100">
                        <img src="{{ $qrisImage ? asset('storage/'.$qrisImage) : asset('img/qris-satya-naratama.png') }}" class="w-full rounded-2xl" alt="QRIS Satya Naratama">
                    </div>
                    <div class="prose-soal text-sm text-ink-600">
                        @if($instruction){!! nl2br(e($instruction)) !!}@else
                            <ol class="list-decimal space-y-1 pl-4"><li>Buka aplikasi e-wallet / m-banking.</li><li>Pilih menu bayar/scan QRIS lalu pindai kode.</li><li>Masukkan nominal <b>{{ $rp($pay) }}</b> tepat.</li><li>Simpan bukti lalu unggah di samping.</li></ol>
                        @endif
                        <a href="{{ $qrisImage ? asset('storage/'.$qrisImage) : asset('img/qris-satya-naratama.png') }}" download class="btn-soft btn-sm mt-4"><x-icon name="download" class="h-4 w-4"/> Unduh QRIS</a>
                    </div>
                </div>
            </div>
            <div class="card card-pad">
                <p class="section-title">Rincian pesanan</p>
                <div class="mt-3 divide-y divide-ink-50 text-sm">
                    @foreach($o->items as $it)<div class="flex justify-between py-2"><span>{{ $it->product?->name }} <span class="text-ink-400">×{{ $it->qty }}</span></span><b>{{ $rp($it->price * $it->qty) }}</b></div>@endforeach
                    @foreach($o->discounts as $d)<div class="flex justify-between py-2 text-lagoon-700"><span>{{ $d->discount?->name ?? 'Diskon' }}</span><b>− {{ $rp($d->amount) }}</b></div>@endforeach
                </div>
            </div>
        </div>
        <div class="lg:col-span-2">
            <form wire:submit="submitProof" class="card card-pad lg:sticky lg:top-4">
                <p class="section-title">Unggah bukti pembayaran</p>
                <label class="mt-4 flex cursor-pointer flex-col items-center justify-center gap-2 rounded-3xl border-2 border-dashed border-ink-200 bg-cream p-6 text-center hover:border-garnet-400">
                    @if($proof && method_exists($proof, 'temporaryUrl'))
                        <img src="{{ $proof->temporaryUrl() }}" class="max-h-64 rounded-2xl" alt=""><span class="text-xs font-bold text-ink-500">Klik untuk ganti</span>
                    @else
                        <span class="grid h-14 w-14 place-items-center rounded-2xl bg-ink-900 text-saffron-400"><x-icon name="upload" class="h-7 w-7"/></span><span class="text-sm font-bold">Pilih screenshot bukti</span><span class="text-xs text-ink-400">JPG/PNG · maks 4 MB</span>
                    @endif
                    <input type="file" wire:model="proof" accept="image/*" class="hidden">
                </label>
                <p wire:loading wire:target="proof" class="mt-2 text-xs font-bold text-garnet-600">Mengunggah…</p>
                @error('proof')<p class="error">{{ $message }}</p>@enderror
                <button class="btn-primary btn-lg mt-5 w-full" wire:loading.attr="disabled" wire:target="submitProof,proof">Kirim bukti</button>
                <a href="https://wa.me/{{ config('satya.admin_wa') }}?text={{ urlencode('Halo Admin, saya sudah membayar pesanan '.$o->order_code) }}" target="_blank" class="btn-lagoon mt-2 w-full"><x-icon name="whatsapp" class="h-4 w-4"/> Konfirmasi via WhatsApp</a>
                <p class="mt-3 text-center text-xs text-ink-400">Admin memverifikasi maksimal 1×24 jam. Akses terbuka otomatis setelah disetujui.</p>
            </form>
        </div>
    </div>
</div>
