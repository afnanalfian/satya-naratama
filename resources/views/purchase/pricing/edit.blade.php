<x-layouts.app title="Ubah Aturan Harga"><div class="mx-auto max-w-2xl">
<x-page-header title="Ubah aturan harga" :sub="($productTypes[$pricingRule->product_type] ?? $pricingRule->product_type).' · '.($pricingRule->priceable?->name ?? $pricingRule->priceable?->title ?? 'Global')" :back="route('pricing.index')"/>
<form method="POST" action="{{ route('pricing.update', $pricingRule) }}" class="card card-pad space-y-4">@csrf @method('PUT')
    <x-field label="Tipe harga" name="pricing_type"><select name="pricing_type" class="select"><option value="per_unit" @selected($pricingRule->pricing_type === 'per_unit')>Per unit</option><option value="fixed" @selected($pricingRule->pricing_type === 'fixed')>Harga tetap</option></select></x-field>
    <div class="grid grid-cols-2 gap-4">
        <x-field label="Jumlah minimal" name="min_qty"><input type="number" name="min_qty" value="{{ old('min_qty', $pricingRule->min_qty) }}" min="1" class="input"></x-field>
        <x-field label="Jumlah maksimal" name="max_qty"><input type="number" name="max_qty" value="{{ old('max_qty', $pricingRule->max_qty) }}" class="input"></x-field>
    </div>
    <x-field label="Harga (Rp)" name="price"><input type="number" name="price" value="{{ old('price', (int) $pricingRule->price) }}" class="input"></x-field>
    <label class="flex items-center gap-2 text-sm font-bold"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" class="checkbox" @checked($pricingRule->is_active)> Aktif</label>
    <div class="flex justify-end gap-2"><a href="{{ route('pricing.index') }}" class="btn-soft">Batal</a><button class="btn-primary">Simpan</button></div>
</form></div></x-layouts.app>
