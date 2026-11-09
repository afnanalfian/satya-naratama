@php $r = $registration; $code = '#'.str_pad($r->id, 6, '0', STR_PAD_LEFT); @endphp
<div class="mx-auto max-w-5xl px-4 py-10 sm:px-6">
    <x-page-header eyebrow="Langkah terakhir" title="Selesaikan pembayaran 💳" :sub="$r->full_name.' · '.$r->email" />
    <div class="grid gap-6 lg:grid-cols-5">
        <div class="space-y-5 lg:col-span-3">
            <div class="card-sunrise p-6">
                <div class="blob -right-10 -top-10 h-40 w-40 bg-white/30"></div>
                <p class="text-sm font-semibold text-white/80">Total biaya pendaftaran</p>
                <p class="mt-1 font-display text-4xl font-extrabold">Rp {{ number_format($r->registration_fee, 0, ',', '.') }}</p>
                <div class="mt-4 flex flex-wrap gap-2 text-xs font-bold">
                    <span class="rounded-full bg-white/20 px-3 py-1">Kode: {{ $code }}</span>
                    @if($r->invoice)<span class="rounded-full bg-white/20 px-3 py-1">Invoice: {{ $r->invoice->invoice_number }}</span>@endif
                </div>
            </div>

            <div class="card card-pad">
                <p class="section-title">🏦 Transfer bank</p>
                <div class="mt-4 rounded-3xl bg-ink-900 p-5 text-white" x-data>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="grid h-12 w-12 place-items-center rounded-2xl bg-saffron-400 font-display text-sm font-extrabold text-ink-900">{{ $bank['code'] }}</span>
                            <div><p class="font-bold">{{ $bank['name'] }}</p><p class="text-xs text-ink-300">a.n. {{ $bank['owner'] }}</p></div>
                        </div>
                        <button type="button" @click="$copy('{{ $bank['number'] }}', 'Nomor rekening disalin')" class="btn-sm btn bg-white/10 text-white hover:bg-white/20"><x-icon name="copy" class="h-4 w-4"/> Salin</button>
                    </div>
                    <p class="mt-5 font-mono text-2xl font-bold tracking-wider">{{ trim(chunk_split($bank['number'], 4, ' ')) }}</p>
                </div>
                <div class="mt-4 flex gap-3 rounded-2xl bg-saffron-50 p-4 text-sm text-saffron-900 ring-1 ring-saffron-200">
                    <x-icon name="info" class="h-5 w-5 shrink-0"/>
                    <p>Transfer tepat <b>Rp {{ number_format($r->registration_fee, 0, ',', '.') }}</b> dan tulis kode <b>{{ $code }}</b> pada berita transfer.</p>
                </div>
                <a href="https://wa.me/{{ config('satya.admin_wa') }}?text={{ urlencode('Halo Admin, saya ingin bertanya tentang promo pendaftaran') }}" target="_blank" class="mt-4 flex items-center gap-3 rounded-2xl bg-lagoon-50 p-4 text-sm font-semibold text-lagoon-800 ring-1 ring-lagoon-100 hover:bg-lagoon-100">
                    <x-icon name="whatsapp" class="h-6 w-6"/> <span class="flex-1">Ada promo atau potongan? Chat admin dulu</span> <x-icon name="arrow-right" class="h-4 w-4"/>
                </a>
            </div>
        </div>

        <div class="lg:col-span-2">
            <form wire:submit="submitProof" class="card card-pad lg:sticky lg:top-24">
                <p class="section-title">Unggah bukti transfer</p>
                <label class="mt-4 flex cursor-pointer flex-col items-center justify-center gap-2 rounded-3xl border-2 border-dashed border-ink-200 bg-cream p-6 text-center transition hover:border-garnet-400">
                    @if($payment_proof && method_exists($payment_proof, 'temporaryUrl'))
                        <img src="{{ $payment_proof->temporaryUrl() }}" class="max-h-56 rounded-2xl object-contain" alt="">
                        <span class="text-xs font-bold text-ink-500">Klik untuk ganti</span>
                    @else
                        <span class="grid h-14 w-14 place-items-center rounded-2xl bg-ink-900 text-saffron-400"><x-icon name="upload" class="h-7 w-7"/></span>
                        <span class="text-sm font-bold">Pilih foto/screenshot bukti</span>
                        <span class="text-xs text-ink-400">JPG/PNG · maks. 5 MB</span>
                    @endif
                    <input type="file" wire:model="payment_proof" accept="image/*" class="hidden">
                </label>
                <p wire:loading wire:target="payment_proof" class="mt-2 text-xs font-bold text-garnet-600">Mengunggah…</p>
                @error('payment_proof')<p class="error">{{ $message }}</p>@enderror
                <x-field label="Catatan (opsional)" name="payment_note" class="mt-4"><input wire:model="payment_note" class="input" placeholder="mis. transfer dari rekening ayah"></x-field>
                <button class="btn-primary btn-lg mt-5 w-full" wire:loading.attr="disabled" wire:target="submitProof,payment_proof">
                    <span wire:loading.remove wire:target="submitProof">Kirim bukti pembayaran</span><span wire:loading wire:target="submitProof">Mengirim…</span>
                </button>
                <a href="{{ route('daftar.payment.nanti', $r->id) }}" class="mt-3 block text-center text-sm font-bold text-ink-500 hover:text-garnet-600">Bayar nanti</a>
            </form>
        </div>
    </div>
</div>
