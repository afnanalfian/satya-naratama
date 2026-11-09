<div class="mx-auto max-w-4xl">
    <x-page-header title="Pengaturan Pembayaran" sub="QRIS & instruksi yang tampil di halaman pembayaran siswa."/>
    <form wire:submit="save" class="grid gap-6 md:grid-cols-5">
        <div class="card card-pad md:col-span-2">
            <p class="section-title">Gambar QRIS</p>
            <label class="mt-4 block cursor-pointer rounded-3xl border-2 border-dashed border-ink-200 bg-white p-3 hover:border-garnet-400">
                <img src="{{ $qris && method_exists($qris, 'temporaryUrl') ? $qris->temporaryUrl() : ($current ? asset('storage/'.$current) : asset('img/qris-satya-naratama.png')) }}" class="w-full rounded-2xl" alt="QRIS">
                <input type="file" wire:model="qris" accept="image/*" class="hidden">
            </label>
            <p class="hint text-center">Klik gambar untuk mengganti</p>
            <p wire:loading wire:target="qris" class="text-center text-xs font-bold text-garnet-600">Mengunggah…</p>
            @error('qris')<p class="error">{{ $message }}</p>@enderror
        </div>
        <div class="card card-pad space-y-4 md:col-span-3">
            <x-field label="Metode aktif" name="method"><select wire:model="method" class="select"><option value="manual_qris">QRIS manual (unggah bukti)</option><option value="midtrans">Midtrans (belum diaktifkan)</option></select></x-field>
            <x-field label="Instruksi pembayaran" name="instruction" hint="Ditampilkan di samping QRIS. Baris baru akan dipertahankan."><textarea wire:model="instruction" rows="10" class="textarea"></textarea></x-field>
            <button class="btn-primary w-full" wire:loading.attr="disabled"><x-icon name="check" class="h-4 w-4"/> Simpan</button>
        </div>
    </form>
</div>
