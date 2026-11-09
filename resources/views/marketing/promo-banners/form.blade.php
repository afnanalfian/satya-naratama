@php $p = $promoBanner ?? null; @endphp
<div class="grid gap-6 lg:grid-cols-5" x-data="{ preview: @js($p?->image_path ? $p->image_url : null) }">
    <div class="card card-pad space-y-4 lg:col-span-3">
        <x-field label="Judul" name="title" required><input name="title" value="{{ old('title', $p?->title) }}" class="input" required></x-field>
        <x-field label="Deskripsi" name="description"><textarea name="description" class="textarea">{{ old('description', $p?->description) }}</textarea></x-field>
        <x-field label="Tautan tujuan" name="target_url" hint="URL lengkap (https://…) atau nama route, mis. daftar.form / browse.index"><input name="target_url" value="{{ old('target_url', $p?->target_url) }}" class="input"></x-field>
        <div class="grid grid-cols-2 gap-4">
            <x-field label="Tampilan" name="type"><select name="type" class="select">@foreach(['modal' => 'Modal tengah', 'popup' => 'Popup pojok', 'banner' => 'Banner bawah'] as $k => $l)<option value="{{ $k }}" @selected(old('type', $p?->type ?? 'modal') === $k)>{{ $l }}</option>@endforeach</select></x-field>
            <x-field label="Prioritas (1–10)" name="priority"><input type="number" name="priority" min="1" max="10" value="{{ old('priority', $p?->priority ?? 5) }}" class="input"></x-field>
            <x-field label="Muncul setelah (detik)" name="display_delay"><input type="number" name="display_delay" min="0" value="{{ old('display_delay', $p?->display_delay ?? 2) }}" class="input"></x-field>
            <x-field label="Durasi tampil (detik)" name="display_duration"><input type="number" name="display_duration" min="5" max="300" value="{{ old('display_duration', $p?->display_duration ?? 15) }}" class="input"></x-field>
            <x-field label="Mulai" name="starts_at"><input type="datetime-local" name="starts_at" value="{{ old('starts_at', $p?->starts_at?->format('Y-m-d\TH:i')) }}" class="input"></x-field>
            <x-field label="Berakhir" name="ends_at"><input type="datetime-local" name="ends_at" value="{{ old('ends_at', $p?->ends_at?->format('Y-m-d\TH:i')) }}" class="input"></x-field>
        </div>
        <div class="flex flex-wrap gap-6">
            <label class="flex items-center gap-2 text-sm font-bold"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" class="checkbox" @checked(old('is_active', $p?->is_active ?? true))> Aktif</label>
            <label class="flex items-center gap-2 text-sm font-bold"><input type="hidden" name="show_on_landing" value="0"><input type="checkbox" name="show_on_landing" value="1" class="checkbox" @checked(old('show_on_landing', $p?->show_on_landing ?? true))> Tampilkan di halaman depan</label>
        </div>
    </div>
    <div class="card card-pad lg:col-span-2">
        <p class="label">Gambar {{ $p ? '' : '*' }}</p>
        <label class="block cursor-pointer overflow-hidden rounded-2xl border-2 border-dashed border-ink-200 hover:border-garnet-400">
            <template x-if="preview"><img :src="preview" class="w-full" alt=""></template>
            <div x-show="!preview" class="grid aspect-video place-items-center bg-cream text-sm font-bold text-ink-400">Pilih gambar (maks 5 MB)</div>
            <input type="file" name="image" accept="image/*" class="hidden" @change="preview = URL.createObjectURL($event.target.files[0])" {{ $p ? '' : 'required' }}>
        </label>
        @error('image')<p class="error">{{ $message }}</p>@enderror
    </div>
</div>
