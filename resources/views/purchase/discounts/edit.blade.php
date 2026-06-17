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
            Edit Discount
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Perbarui detail voucher atau discount
        </p>
    </div>

    <form method="POST"
          action="{{ route('discounts.update', $discount) }}"
          class="space-y-6
                 p-6 rounded-2xl border dark:border-azwara-darker
                 bg-white dark:text-azwara-lightest dark:bg-azwara-darkest">
        @csrf
        @method('PUT')

        {{-- NAMA --}}
        <div>
            <label class="block text-sm font-medium">Nama Discount</label>
            <input type="text" name="name" required
                value="{{ old('name', $discount->name) }}"
                class="mt-1 w-full rounded-xl border-gray-300
                       dark:bg-azwara-darkest dark:border-azwara-darker">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- CODE --}}
        <div>
            <label class="block text-sm font-medium">
                Kode Voucher
            </label>

            <input type="text" readonly
                value="{{ $discount->code }}"
                class="mt-1 w-full rounded-xl bg-gray-100
                        dark:bg-azwara-darker border-gray-300">

            <input type="hidden" name="code" value="{{ $discount->code }}">
        </div>

        {{-- TYPE --}}
        <div>
            <label class="block text-sm font-medium">
                Tipe Discount
            </label>

            <select name="type"
                    class="mt-1 w-full rounded-xl border-gray-300
                           dark:bg-azwara-darkest dark:border-azwara-darker">
                <option value="percentage" @selected(old('type', $discount->type) === 'percentage')>
                    Persentase (%)
                </option>

                <option value="fixed" @selected(old('type', $discount->type) === 'fixed')>
                    Nominal (Rp)
                </option>
            </select>

            @error('type')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- VALUE --}}
        <div>
            <label class="block text-sm font-medium">
                Nilai Discount
            </label>

            <input type="number" name="value" min="0" required
                   value="{{ old('value', $discount->value) }}"
                   class="mt-1 w-full rounded-xl border-gray-300
                          dark:bg-azwara-darkest dark:border-azwara-darker">

            @error('value')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- MAX DISCOUNT --}}
        <div>
            <label class="block text-sm font-medium">
                Maksimal Potongan (opsional untuk persentase)
            </label>

            <input type="number" name="max_discount" min="0"
                   value="{{ old('max_discount', $discount->max_discount) }}"
                   class="mt-1 w-full rounded-xl border-gray-300
                          dark:bg-azwara-darkest dark:border-azwara-darker">

            @error('max_discount')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- MIN ORDER --}}
        <div>
            <label class="block text-sm font-medium">
                Minimal Order (opsional)
            </label>

            <input type="number" name="min_order_amount" min="0"
                   value="{{ old('min_order_amount', $discount->min_order_amount) }}"
                   class="mt-1 w-full rounded-xl border-gray-300
                          dark:bg-azwara-darkest dark:border-azwara-darker">

            @error('min_order_amount')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- QUOTA --}}
        <div>
            <label class="block text-sm font-medium">
                Kuota Pemakaian (opsional)
            </label>

            <input type="number" name="quota" min="1"
                   value="{{ old('quota', $discount->quota) }}"
                   class="mt-1 w-full rounded-xl border-gray-300
                          dark:bg-azwara-darkest dark:border-azwara-darker">

            @error('quota')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- PRODUK --}}
        <div>
            <label class="block text-sm font-medium">Berikan ke Produk (opsional)</label>

            <select name="product_ids[]" id="product-select" multiple
                class="mt-1 w-full rounded-xl border-gray-300 dark:border-azwara-darker">
                @foreach($products as $product)
                    <option value="{{ $product->id }}"
                        @if(collect(old('product_ids', $discount->targets->pluck('id')))
                            ->contains($product->id)) selected @endif>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>

            @error('product_ids')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- DATE --}}
        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="block text-sm font-medium">
                    Mulai Berlaku
                </label>

                <input type="date" name="starts_at"
                       value="{{ old('starts_at', optional($discount->starts_at)->format('Y-m-d')) }}"
                       class="mt-1 w-full rounded-xl border-gray-300
                              dark:bg-azwara-darkest dark:border-azwara-darker">

                @error('starts_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">
                    Berakhir
                </label>

                <input type="date" name="ends_at"
                       value="{{ old('ends_at', optional($discount->ends_at)->format('Y-m-d')) }}"
                       class="mt-1 w-full rounded-xl border-gray-300
                              dark:bg-azwara-darkest dark:border-azwara-darker">

                @error('ends_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- ACTIVE --}}
        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" value="1"
                   @checked(old('is_active', $discount->is_active))
                   class="rounded text-primary focus:ring-primary">

            <span class="text-sm text-gray-700 dark:text-gray-300">
                Aktifkan discount
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
                Update
            </button>

        </div>

    </form>

</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<script>
    new TomSelect("#product-select", {
        plugins: ['remove_button'],
        placeholder: "Pilih produk (opsional)",
        allowEmptyOption: true,
    });
</script>
@endpush
