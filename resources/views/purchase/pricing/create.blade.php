<x-layouts.app title="Aturan Harga Baru"><div class="mx-auto max-w-2xl">
<x-page-header title="Aturan harga baru" :back="route('pricing.index')"/>
<form method="POST" action="{{ route('pricing.store') }}" class="card card-pad space-y-4" x-data="{ pt: '{{ old('product_type', 'meeting') }}', scope: '{{ old('price_scope', 'global') }}' }">@csrf
    <x-field label="Jenis produk" name="product_type" required><select name="product_type" x-model="pt" class="select">@foreach($productTypes as $k => $l)<option value="{{ $k }}">{{ $l }}</option>@endforeach</select></x-field>
    <x-field label="Cakupan" name="price_scope">
        <div class="grid grid-cols-2 gap-2">
            <label class="cursor-pointer rounded-2xl border-2 p-3 text-sm font-bold" :class="scope==='global' ? 'border-garnet-500 bg-garnet-50' : 'border-ink-100'"><input type="radio" name="price_scope" value="global" x-model="scope" class="hidden">🌐 Global</label>
            <label class="cursor-pointer rounded-2xl border-2 p-3 text-sm font-bold" :class="scope==='specific' ? 'border-garnet-500 bg-garnet-50' : 'border-ink-100'" x-show="pt !== 'addon'"><input type="radio" name="price_scope" value="specific" x-model="scope" class="hidden">🎯 Khusus</label>
        </div>
    </x-field>
    <template x-if="scope === 'specific' && ['meeting','course_package'].includes(pt)">
        <div><input type="hidden" name="priceable_type" value="{{ \App\Models\Course::class }}"><x-field label="Kelas" name="priceable_id"><select name="priceable_id" class="select">@foreach($courses as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach</select></x-field></div>
    </template>
    <template x-if="scope === 'specific' && pt === 'tryout'">
        <div><input type="hidden" name="priceable_type" value="{{ \App\Models\Exam::class }}"><x-field label="Tryout" name="priceable_id"><select name="priceable_id" class="select">@foreach($tryouts as $t)<option value="{{ $t->id }}">{{ $t->title }}</option>@endforeach</select></x-field></div>
    </template>
    <x-field label="Tipe harga" name="pricing_type"><select name="pricing_type" class="select"><option value="per_unit" @selected(old('pricing_type') === 'per_unit')>Per unit (× jumlah)</option><option value="fixed" @selected(old('pricing_type') === 'fixed')>Harga tetap</option></select></x-field>
    <div class="grid grid-cols-2 gap-4">
        <x-field label="Jumlah minimal" name="min_qty" required><input type="number" name="min_qty" value="{{ old('min_qty', 1) }}" min="1" class="input"></x-field>
        <x-field label="Jumlah maksimal" name="max_qty" hint="Kosongkan = tanpa batas"><input type="number" name="max_qty" value="{{ old('max_qty') }}" class="input"></x-field>
    </div>
    <x-field label="Harga (Rp)" name="price" required><input type="number" name="price" value="{{ old('price') }}" min="0" class="input" required></x-field>
    <label class="flex items-center gap-2 text-sm font-bold"><input type="checkbox" name="is_active" value="1" class="checkbox" checked> Aktif</label>
    <div class="flex justify-end gap-2"><a href="{{ route('pricing.index') }}" class="btn-soft">Batal</a><button class="btn-primary">Simpan</button></div>
</form></div></x-layouts.app>
