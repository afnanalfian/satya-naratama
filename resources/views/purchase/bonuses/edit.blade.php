<x-layouts.app title="Atur Bonus">
<div class="mx-auto max-w-2xl">
<x-page-header title="Atur bonus" :sub="$product->name" :back="route('bonuses.index')"/>
@php $courses = \App\Models\Course::orderBy('name')->get(['id', 'name']); $init = $product->bonuses->map(fn ($b) => ['bonus_type' => $b->bonus_type, 'bonus_id' => $b->bonus_id])->values(); @endphp
<form method="POST" action="{{ route('bonuses.update', $product) }}" class="card card-pad" x-data="{ rows: @js($init) }">@csrf @method('PUT')
    <div class="space-y-3">
        <template x-for="(r, i) in rows" :key="i">
            <div class="flex flex-col gap-2 rounded-2xl border border-ink-100 p-3 sm:flex-row">
                <select :name="`bonuses[${i}][bonus_type]`" x-model="r.bonus_type" class="select sm:w-40">@foreach($bonusTypes as $k => $l)<option value="{{ $k }}">{{ $l }}</option>@endforeach</select>
                <select x-show="r.bonus_type === 'tryout'" :name="r.bonus_type === 'tryout' ? `bonuses[${i}][bonus_id]` : ''" x-model="r.bonus_id" class="select"><option value="">Pilih tryout…</option>@foreach($availableTryouts as $t)<option value="{{ $t->id }}">{{ $t->title }}</option>@endforeach</select>
                <select x-show="r.bonus_type === 'course'" :name="r.bonus_type === 'course' ? `bonuses[${i}][bonus_id]` : ''" x-model="r.bonus_id" class="select"><option value="">Pilih kelas…</option>@foreach($courses as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach</select>
                <p x-show="r.bonus_type === 'quiz'" class="flex-1 self-center text-sm text-ink-500">Akses semua kuis (global)</p>
                <button type="button" @click="rows.splice(i, 1)" class="btn-danger btn-icon self-end sm:self-auto"><x-icon name="trash" class="h-4 w-4"/></button>
            </div>
        </template>
        <p x-show="!rows.length" class="py-4 text-center text-sm text-ink-400">Belum ada bonus.</p>
    </div>
    <button type="button" @click="rows.push({ bonus_type: 'tryout', bonus_id: '' })" class="btn-soft btn-sm mt-4"><x-icon name="plus" class="h-4 w-4"/> Tambah bonus</button>
    <div class="mt-6 flex justify-end gap-2"><a href="{{ route('bonuses.index') }}" class="btn-soft">Batal</a><button class="btn-primary">Simpan</button></div>
</form>
</div>
</x-layouts.app>
