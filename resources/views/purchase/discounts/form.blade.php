@php $d = $discount ?? null; $sel = collect(old('product_ids', $d?->targets?->pluck('id')->all() ?? []))->map(fn ($v) => (int) $v)->all(); @endphp
<div class="grid gap-6 lg:grid-cols-5" x-data="{ type: '{{ old('type', $d?->type ?? 'percentage') }}' }">
    <div class="card card-pad space-y-4 lg:col-span-3">
        <x-field label="Nama diskon" name="name" required><input name="name" value="{{ old('name', $d?->name) }}" class="input" required></x-field>
        <x-field label="Kode voucher" name="code" hint="Kosongkan untuk diskon otomatis yang bisa dipilih saat checkout."><input name="code" value="{{ old('code', $d?->code) }}" class="input font-mono uppercase" placeholder="mis. MERDEKA45"></x-field>
        <div class="grid grid-cols-2 gap-4">
            <x-field label="Tipe" name="type"><select name="type" x-model="type" class="select"><option value="percentage">Persentase (%)</option><option value="fixed">Nominal (Rp)</option></select></x-field>
            <x-field label="Nilai" name="value" required><input type="number" step="0.01" name="value" value="{{ old('value', $d?->value) }}" class="input" required></x-field>
            <x-field label="Maks. potongan (Rp)" name="max_discount" x-show="type === 'percentage'"><input type="number" name="max_discount" value="{{ old('max_discount', $d?->max_discount) }}" class="input"></x-field>
            <x-field label="Min. belanja (Rp)" name="min_order_amount"><input type="number" name="min_order_amount" value="{{ old('min_order_amount', $d?->min_order_amount) }}" class="input"></x-field>
            <x-field label="Kuota pemakaian" name="quota" hint="Kosongkan = tanpa batas"><input type="number" name="quota" value="{{ old('quota', $d?->quota) }}" class="input"></x-field>
            <div></div>
            <x-field label="Mulai" name="starts_at"><input type="datetime-local" name="starts_at" value="{{ old('starts_at', $d?->starts_at?->format('Y-m-d\TH:i')) }}" class="input"></x-field>
            <x-field label="Berakhir" name="ends_at"><input type="datetime-local" name="ends_at" value="{{ old('ends_at', $d?->ends_at?->format('Y-m-d\TH:i')) }}" class="input"></x-field>
        </div>
        <label class="flex items-center gap-2 text-sm font-bold"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" class="checkbox" @checked(old('is_active', $d?->is_active ?? true))> Aktif</label>
    </div>
    <div class="card card-pad lg:col-span-2" x-data="{ q: '' }">
        <p class="section-title">Berlaku untuk produk</p>
        <p class="hint">Tidak dicentang sama sekali = berlaku untuk semua produk.</p>
        <input x-model="q" class="input input-sm mt-3" placeholder="Cari produk…">
        <div class="mt-3 max-h-96 space-y-1.5 overflow-y-auto">
            @foreach($products as $p)
                <label x-show="!q || @js(mb_strtolower($p->name)).includes(q.toLowerCase())" class="flex cursor-pointer items-center gap-2 rounded-xl px-2 py-1.5 text-sm hover:bg-cream"><input type="checkbox" name="product_ids[]" value="{{ $p->id }}" class="checkbox" @checked(in_array($p->id, $sel))> <span class="flex-1 truncate">{{ $p->name }}</span><span class="badge-ink">{{ $p->type }}</span></label>
            @endforeach
        </div>
    </div>
</div>
