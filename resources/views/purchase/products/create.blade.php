@extends('layouts.app')

@section('content')
<a
    href="{{ route('products.index') }}"
    class="text-sm font-medium text-primary hover:underline dark:text-azwara-lightest">
    ← Kembali
</a>
<div class="max-w-4xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-azwara-lightest">
            Tambah Product
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Buat product baru untuk dijual (meeting, course package, tryout, addon)
        </p>
    </div>

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('products.store') }}"
          class="space-y-6 bg-white dark:bg-azwara-darkest
                 border dark:border-azwara-darker rounded-2xl p-6">

        @csrf

        {{-- NAMA --}}
        <div>
            <label class="block text-sm font-medium mb-1 dark:text-azwara-lightest">
                Nama Product
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   class="w-full rounded-xl border-gray-300 dark:border-azwara-darker
                          dark:bg-secondary/40 dark:text-white">
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- TIPE PRODUCT --}}
        <div>
            <label class="block text-sm font-medium mb-1 dark:text-azwara-lightest">
                Tipe Product
            </label>
            <select name="type"
                    id="product-type"
                    required
                    class="w-full rounded-xl border-gray-300 dark:border-azwara-darker
                           dark:bg-secondary/40 dark:text-white">
                <option value="">-- Pilih Tipe --</option>
                <option value="meeting">Meeting</option>
                <option value="course_package">Course Package</option>
                <option value="tryout">Tryout</option>
                <option value="addon">Addon</option>
            </select>
            @error('type')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- PRODUCTABLE TYPE (HIDDEN) --}}
        <input type="hidden" name="productable_type" id="productable-type">

        {{-- PRODUCTABLE SELECT --}}
        <div id="productable-wrapper" class="hidden">
            <label class="block text-sm font-medium mb-1 dark:text-azwara-lightest">
                Konten
            </label>

            <select name="productable_id"
                    id="productable-select"
                    class="w-full rounded-xl border-gray-300 dark:border-azwara-darker
                           dark:bg-secondary/40 dark:text-white">
                <option value="">-- Pilih Konten --</option>
            </select>

            @error('productable_id')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- DESKRIPSI --}}
        <div>
            <label class="block text-sm font-medium mb-1 dark:text-azwara-lightest">
                Deskripsi (opsional)
            </label>
            <textarea name="description"
                      rows="3"
                      class="w-full rounded-xl border-gray-300 dark:border-azwara-darker
                             dark:bg-secondary/40 dark:text-white">{{ old('description') }}</textarea>
        </div>

        {{-- STATUS --}}
        <div class="flex items-center gap-3 dark:text-azwara-lightest">
            <input type="checkbox"
                   name="is_active"
                   value="1"
                   checked
                   class="rounded border-gray-300">
            <span class="text-sm">Aktifkan product</span>
        </div>

        {{-- ACTIONS --}}
        <div class="flex justify-end gap-3 pt-4 border-t dark:border-azwara-darker">
            <a href="{{ route('products.index') }}"
               class="px-5 py-2.5 rounded-xl border
                      dark:border-azwara-darker
                      text-gray-700 dark:text-gray-300">
                Batal
            </a>

            <button type="submit"
                    class="bg-primary hover:bg-azwara-light
                           text-white font-semibold px-6 py-2.5 rounded-xl transition">
                Simpan Product
            </button>
        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
    const typeSelect = document.getElementById('product-type');
    const productableWrapper = document.getElementById('productable-wrapper');
    const productableSelect = document.getElementById('productable-select');
    const productableTypeInput = document.getElementById('productable-type');

    typeSelect.addEventListener('change', async function () {
        const type = this.value;

        // reset
        productableSelect.innerHTML = '<option value="">-- Pilih Konten --</option>';
        productableSelect.disabled = true;
        productableSelect.required = false;

        if (type === '' || type === 'addon') {
            productableWrapper.classList.add('hidden');
            productableTypeInput.value = 'addon';
            return;
        }

        productableWrapper.classList.remove('hidden');
        productableTypeInput.value = type;
        productableSelect.disabled = false;
        productableSelect.required = true;

        try {
            const response = await fetch(
                `{{ url('admin/products/productables') }}/${type}`
            );
            const items = await response.json();

            items.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.title ?? item.name;
                productableSelect.appendChild(option);
            });
        } catch (e) {
            console.error('Failed to load productables', e);
        }
    });
</script>
@endpush
