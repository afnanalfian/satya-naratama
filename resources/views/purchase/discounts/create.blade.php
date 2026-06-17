@extends('layouts.app')

@section('content')
<a
    href="{{ route('discounts.index') }}"
    class="text-sm font-medium text-primary hover:underline dark:text-azwara-lightest">
    ← Kembali
</a>
<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-azwara-lightest">
            Tambah Discount
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Buat kode voucher atau potongan harga baru
        </p>
    </div>

    <form method="POST"
          action="{{ route('discounts.store') }}"
          class="space-y-6
                 p-6 rounded-2xl border dark:border-azwara-darker
                 bg-white dark:bg-azwara-darkest">
        @csrf

        {{-- NAMA --}}
        <div>
            <label class="block text-sm font-medium dark:text-azwara-lightest">Nama Discount</label>
            <input type="text" name="name" required
                value="{{ old('name') }}"
                class="mt-1 w-full rounded-xl border-gray-300 dark:text-white
                       dark:bg-azwara-darkest dark:border-azwara-darker">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- CODE --}}
        <div>
            <label class="block text-sm font-medium dark:text-azwara-lightest">
                Kode Voucher (opsional)
            </label>
            <input type="text" name="code"
                   value="{{ old('code') }}"
                   placeholder="Contoh: HEMAT50"
                   class="mt-1 w-full rounded-xl border-gray-300 dark:text-white
                          dark:bg-azwara-darkest dark:border-azwara-darker">
            @error('code')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- TYPE --}}
        <div>
            <label class="block text-sm font-medium dark:text-azwara-lightest">
                Tipe Discount
            </label>

            <select name="type"
                    class="mt-1 w-full rounded-xl border-gray-300 dark:text-white
                           dark:bg-azwara-darkest dark:border-azwara-darker">
                <option value="percentage"
                    {{ old('type') == 'percentage' ? 'selected' : '' }}>
                    Persentase (%)
                </option>

                <option value="fixed"
                    {{ old('type') == 'fixed' ? 'selected' : '' }}>
                    Nominal (Rp)
                </option>
            </select>

            @error('type')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- VALUE --}}
        <div>
            <label class="block text-sm font-medium dark:text-azwara-lightest">
                Nilai Discount
            </label>

            <input type="number" name="value" min="0" required
                   value="{{ old('value') }}"
                   class="mt-1 w-full rounded-xl border-gray-300 dark:text-white
                          dark:bg-azwara-darkest dark:border-azwara-darker">

            @error('value')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- MAX DISCOUNT --}}
        <div>
            <label class="block text-sm font-medium dark:text-azwara-lightest">
                Maksimal Potongan (opsional untuk persentase)
            </label>

            <input type="number" name="max_discount" min="0"
                   value="{{ old('max_discount') }}"
                   class="mt-1 w-full rounded-xl border-gray-300 dark:text-white
                          dark:bg-azwara-darkest dark:border-azwara-darker">

            @error('max_discount')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- MIN ORDER --}}
        <div>
            <label class="block text-sm font-medium dark:text-azwara-lightest">
                Minimal Order (opsional)
            </label>

            <input type="number" name="min_order_amount" min="0"
                   value="{{ old('min_order_amount') }}"
                   class="mt-1 w-full rounded-xl border-gray-300 dark:text-white
                          dark:bg-azwara-darkest dark:border-azwara-darker">

            @error('min_order_amount')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- QUOTA --}}
        <div>
            <label class="block text-sm font-medium dark:text-azwara-lightest">
                Kuota Pemakaian (opsional)
            </label>

            <input type="number" name="quota" min="1"
                   value="{{ old('quota') }}"
                   class="mt-1 w-full rounded-xl border-gray-300 dark:text-white
                          dark:bg-azwara-darkest dark:border-azwara-darker">

            @error('quota')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- PRODUK --}}
        <div>
            <label class="block text-sm font-medium dark:text-azwara-lightest">Berikan ke Produk (opsional)</label>

            <select name="product_ids[]" id="product-select" multiple
                class="mt-1 w-full rounded-xl border-gray-300 dark:text-white
                    dark:border-azwara-darker dark:bg-azwara-darkest">
                @foreach($products as $product)
                    <option value="{{ $product->id }}"
                        @if(collect(old('product_ids'))->contains($product->id)) selected @endif>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>

            @error('product_ids')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- DATE RANGE --}}
        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block text-sm font-medium dark:text-azwara-lightest">
                    Mulai Berlaku
                </label>

                <input type="date" name="starts_at"
                       value="{{ old('starts_at') }}"
                       class="mt-1 w-full rounded-xl border-gray-300 dark:text-white
                              dark:bg-azwara-darkest dark:border-azwara-darker">

                @error('starts_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium dark:text-azwara-lightest">
                    Berakhir
                </label>

                <input type="date" name="ends_at"
                       value="{{ old('ends_at') }}"
                       class="mt-1 w-full rounded-xl border-gray-300 dark:text-white
                              dark:bg-azwara-darkest dark:border-azwara-darker">

                @error('ends_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- ACTIVE --}}
        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" value="1"
                   {{ old('is_active', 1) ? 'checked' : '' }}
                   class="rounded text-primary focus:ring-primary">

            <span class="text-sm text-gray-700 dark:text-gray-300">
                Aktifkan discount sekarang
            </span>
        </div>

        {{-- BUTTONS --}}
        <div class="pt-4 flex justify-end gap-3">

            <a href="{{ route('discounts.index') }}"
               class="px-5 py-2.5 rounded-xl border
                      text-gray-700 dark:text-gray-300">
                Batal
            </a>

            <button type="submit"
                    class="px-6 py-2.5 rounded-xl
                           bg-primary hover:bg-azwara-medium
                           text-white font-semibold transition">
                Simpan
            </button>

        </div>

    </form>

</div>
@endsection
@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<style>
    .ts-control {
        border-radius: 0.75rem !important;
        padding: 10px !important;
        min-height: 48px;
    }

    .ts-control input {
        color: inherit !important;
    }

    .ts-dropdown {
        border-radius: 0.75rem !important;
    }

    html.dark .ts-control,
    html.dark .ts-dropdown {
        background-color: #0f172a !important;
        border-color: #334155 !important;
        color: #e2e8f0 !important;
    }

    html.dark .ts-dropdown .option {
        color: #e2e8f0 !important;
    }

    html.dark .ts-dropdown .option.active {
        background-color: #1e293b !important;
    }
</style>

<script>
    new TomSelect("#product-select", {
        plugins: ['remove_button'],
        placeholder: "Pilih produk (opsional)",
        allowEmptyOption: true,
    });
</script>
@endpush
