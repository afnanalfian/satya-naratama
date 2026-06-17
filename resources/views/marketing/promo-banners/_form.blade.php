@php
    $isEdit = !is_null($promo);
@endphp

{{-- TITLE --}}
<div>
    <label class="block text-sm font-medium mb-1 text-azwara-darkest dark:text-gray-200">
        Judul Promo
    </label>
    <input type="text"
           name="title"
           value="{{ old('title', $promo->title ?? '') }}"
           class="w-full rounded-lg border border-azwara-lighter/60
                  bg-white dark:bg-azwara-darkest
                  text-azwara-darkest dark:text-gray-100
                  focus:ring-primary focus:border-primary"
           required>
    @error('title')
        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- DESCRIPTION --}}
<div>
    <label class="block text-sm font-medium mb-1 text-azwara-darkest dark:text-gray-200">
        Deskripsi
    </label>
    <textarea name="description"
              rows="3"
              class="w-full rounded-lg border border-azwara-lighter/60
                     bg-white dark:bg-azwara-darkest
                     text-azwara-darkest dark:text-gray-100
                     focus:ring-primary focus:border-primary">{{ old('description', $promo->description ?? '') }}</textarea>
</div>

{{-- IMAGE --}}
<div>
    <label class="block text-sm font-medium mb-2 text-azwara-darkest dark:text-gray-200">
        Gambar Promo
    </label>

    <div class="flex items-start gap-4">
        <div class="w-40 h-24 rounded-lg border border-dashed border-azwara-lighter
                    flex items-center justify-center overflow-hidden bg-azwara-lightest dark:bg-azwara-darkest">
            <img id="imagePreview"
                 src="{{ $isEdit ? $promo->image_url : '' }}"
                 class="{{ $isEdit ? '' : 'hidden' }} w-full h-full object-cover">
        </div>

        <div class="flex-1">
            <input type="file"
                   name="image"
                   accept="image/*"
                   onchange="previewImage(event)"
                   class="block w-full text-sm text-gray-600 dark:text-gray-300">
            <p class="text-xs text-gray-500 mt-1">
                JPG, PNG, WEBP. Maks 5MB.
            </p>
        </div>
    </div>

    @error('image')
        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- TARGET URL --}}
<div>
    <label class="block text-sm font-medium mb-1 text-azwara-darkest dark:text-gray-200">
        Target URL
    </label>
    <input type="text"
        name="target_url"
        value="{{ old('target_url', $promo->target_url ?? '') }}"
        placeholder="/browse atau browse.index atau https://..."
        class="w-full rounded-lg border border-azwara-lighter/60
                bg-white dark:bg-azwara-darkest
                text-azwara-darkest dark:text-gray-100
                focus:ring-primary focus:border-primary">

</div>

{{-- SETTINGS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    {{-- TYPE --}}
    <div>
        <label class="block text-sm font-medium mb-1">Tipe</label>
        <select name="type" class="w-full rounded-lg border border-azwara-lighter/60">
            @foreach(['popup','banner','modal'] as $type)
                <option value="{{ $type }}"
                    @selected(old('type', $promo->type ?? 'popup') === $type)>
                    {{ ucfirst($type) }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- PRIORITY --}}
    <div>
        <label class="block text-sm font-medium mb-1">Priority</label>
        <input type="number"
               name="priority"
               min="1" max="10"
               value="{{ old('priority', $promo->priority ?? 1) }}"
               class="w-full rounded-lg border border-azwara-lighter/60">
    </div>

    {{-- DURATION --}}
    <div>
        <label class="block text-sm font-medium mb-1">Durasi (detik)</label>
        <input type="number"
               name="display_duration"
               min="5" max="300"
               value="{{ old('display_duration', $promo->display_duration ?? 30) }}"
               class="w-full rounded-lg border border-azwara-lighter/60">
    </div>
</div>

{{-- DATE RANGE --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Mulai</label>
        <input type="datetime-local"
               name="starts_at"
               value="{{ old('starts_at', optional($promo->starts_at ?? null)->format('Y-m-d\TH:i')) }}"
               class="w-full rounded-lg border border-azwara-lighter/60">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Berakhir</label>
        <input type="datetime-local"
               name="ends_at"
               value="{{ old('ends_at', optional($promo->ends_at ?? null)->format('Y-m-d\TH:i')) }}"
               class="w-full rounded-lg border border-azwara-lighter/60">
    </div>
</div>

{{-- TOGGLES --}}
<div class="flex flex-col sm:flex-row gap-6">
    <label class="inline-flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1"
               @checked(old('is_active', $promo->is_active ?? true))>
        <span class="text-sm">Aktif</span>
    </label>

    <label class="inline-flex items-center gap-2">
        <input type="checkbox" name="show_on_landing" value="1"
               @checked(old('show_on_landing', $promo->show_on_landing ?? true))>
        <span class="text-sm">Tampilkan di Landing</span>
    </label>
</div>

{{-- ACTION --}}
<div class="flex justify-end gap-3 pt-4 border-t border-azwara-lighter/60">
    <a href="{{ route('promo-banners.index') }}"
       class="px-4 py-2 rounded-lg border border-azwara-lighter text-sm">
        Batal
    </a>
    <button type="submit"
            class="px-6 py-2 rounded-lg bg-primary text-white text-sm font-medium">
        {{ $submitLabel }}
    </button>
</div>
@push('scripts')
{{-- IMAGE PREVIEW SCRIPT --}}
<script>
function previewImage(event) {
    const img = document.getElementById('imagePreview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.classList.remove('hidden');
}
</script>
@endpush
