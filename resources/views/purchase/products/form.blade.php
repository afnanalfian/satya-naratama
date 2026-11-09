@php
    $p = $product ?? null;
    $cur = old('productable_id', $p?->productable?->productable_id);
    $opts = ['course_package' => $courses->map(fn ($c) => ['id' => $c->id, 'name' => $c->name]), 'meeting' => $meetings->map(fn ($m) => ['id' => $m->id, 'name' => $m->title]), 'tryout' => $tryouts->map(fn ($t) => ['id' => $t->id, 'name' => $t->title])];
@endphp
<div class="card card-pad space-y-4" x-data="{ type: '{{ old('type', $p?->type ?? 'course_package') }}', opts: @js($opts), cur: '{{ $cur }}' }">
    <x-field label="Jenis produk" name="type" required>
        <select name="type" x-model="type" class="select"><option value="course_package">Paket kelas</option><option value="meeting">Pertemuan</option><option value="tryout">Tryout</option><option value="addon">Addon kuis (global)</option></select>
    </x-field>
    <template x-if="type !== 'addon'">
        <x-field label="Terhubung ke" name="productable_id" required>
            <select name="productable_id" class="select" x-model="cur"><option value="">Pilih…</option><template x-for="o in opts[type]" :key="o.id"><option :value="o.id" x-text="o.name" :selected="o.id == cur"></option></template></select>
        </x-field>
    </template>
    <x-field label="Nama produk" name="name" required><input name="name" value="{{ old('name', $p?->name) }}" class="input" required></x-field>
    <x-field label="Deskripsi" name="description"><textarea name="description" class="textarea">{{ old('description', $p?->description) }}</textarea></x-field>
    <label class="flex items-center gap-2 text-sm font-bold"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" class="checkbox" @checked(old('is_active', $p?->is_active ?? true))> Aktif dijual</label>
    <p class="hint">Harga diatur di menu <a href="{{ route('pricing.index') }}" class="link">Aturan Harga</a>.</p>
</div>
