@extends('layouts.app')

@section('content')
<a
    href="{{ route('discounts.index') }}"
    class="text-sm font-medium text-primary hover:underline dark:text-azwara-lightest">
    ← Kembali
</a>
<div class="max-w-4xl mx-auto space-y-8">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Detail Discount
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Informasi lengkap tentang discount ini
            </p>
        </div>

        <a href="{{ route('discounts.edit', $discount) }}"
           class="px-5 py-2.5 rounded-xl
                  bg-primary hover:bg-azwara-medium
                  text-white font-semibold">
            Edit Discount
        </a>
    </div>

    {{-- DETAIL CARD --}}
    <div class="p-6 rounded-2xl border dark:border-azwara-darker
                bg-white dark:bg-azwara-darkest space-y-6">

        {{-- NAME --}}
        <div>
            <h2 class="text-lg font-bold dark:text-white">Nama Discount</h2>
            <p class="text-gray-700 dark:text-gray-300">
                {{ $discount->name }}
            </p>
        </div>

        {{-- CODE --}}
        <div>
            <h2 class="text-lg font-bold dark:text-white">Kode Voucher</h2>
            <p class="font-mono text-gray-900 dark:text-white text-lg">
                {{ $discount->code ?? '—' }}
            </p>
        </div>

        {{-- TYPE --}}
        <div>
            <h2 class="text-lg font-bold dark:text-white">Tipe Discount</h2>
            <p class="text-gray-700 dark:text-gray-300">
                {{ $discount->type_label }}
            </p>
        </div>

        {{-- VALUE --}}
        <div>
            <h2 class="text-lg font-bold dark:text-white">Nilai Discount</h2>

            @if($discount->type === 'percentage')
                <p class="text-gray-900 dark:text-white font-semibold">
                    {{ $discount->value }}%
                </p>
            @else
                <p class="text-gray-900 dark:text-white font-semibold">
                    Rp {{ number_format($discount->value, 0, ',', '.') }}
                </p>
            @endif
        </div>

        {{-- MAX DISCOUNT --}}
        <div>
            <h2 class="text-lg font-bold dark:text-white">Maksimal Potongan</h2>
            <p class="text-gray-700 dark:text-gray-300">
                {{ $discount->max_discount
                    ? 'Rp ' . number_format($discount->max_discount, 0, ',', '.')
                    : 'Tidak dibatasi'
                }}
            </p>
        </div>

        {{-- MIN ORDER --}}
        <div>
            <h2 class="text-lg font-bold dark:text-white">Minimal Order</h2>
            <p class="text-gray-700 dark:text-gray-300">
                {{ $discount->min_order_amount
                    ? 'Rp ' . number_format($discount->min_order_amount, 0, ',', '.')
                    : 'Tidak ada minimum'
                }}
            </p>
        </div>

        {{-- QUOTA --}}
        <div>
            <h2 class="text-lg font-bold dark:text-white">Kuota Pemakaian</h2>
            <p class="text-gray-700 dark:text-gray-300">
                {{ $discount->quota ? $discount->used . ' / ' . $discount->quota : 'Tanpa batas' }}
            </p>
        </div>

        {{-- DATE --}}
        <div>
            <h2 class="text-lg font-bold dark:text-white">Tanggal Berlaku</h2>
            <p class="text-gray-700 dark:text-gray-300">
                {{ $discount->starts_at?->format('d M Y') ?? '—' }}
                —
                {{ $discount->ends_at?->format('d M Y') ?? '—' }}
            </p>
        </div>

        {{-- STATUS --}}
        <div>
            <h2 class="text-lg font-bold dark:text-white">Status</h2>
            <span class="inline-flex px-3 py-1 rounded-lg text-xs font-semibold
                {{ $discount->is_currently_active
                    ? 'bg-green-100 text-green-700'
                    : 'bg-gray-100 text-gray-600' }}">
                {{ $discount->is_currently_active ? 'AKTIF' : 'NONAKTIF' }}
            </span>
        </div>

        {{-- TARGET PRODUCTS --}}
        <div>
            <h2 class="text-lg font-bold dark:text-white">Produk Target</h2>

            @if($discount->targets->count())
                <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300">
                    @foreach($discount->targets as $product)
                        <li>{{ $product->name }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 italic">
                    Berlaku untuk semua produk
                </p>
            @endif
        </div>

    </div>

    {{-- DELETE FORM --}}
    <form method="POST"
          action="{{ route('discounts.destroy', $discount) }}"
          class="sweet-confirm"
          data-message="Yakin ingin menghapus discount ini secara permanen?">
        @csrf
        @method('DELETE')

        <button type="submit"
                class="px-5 py-2.5 rounded-xl
                    bg-red-600 hover:bg-red-700
                    text-white font-semibold">
            Hapus Permanen
        </button>
    </form>

</div>
@endsection
