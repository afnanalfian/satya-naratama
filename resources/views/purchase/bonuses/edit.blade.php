@extends('layouts.app')

@section('content')
<a href="{{ route('bonuses.index') }}"
   class="text-sm font-medium text-primary hover:underline dark:text-azwara-lightest">
    ← Kembali
</a>

<div class="max-w-4xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Atur Bonus – {{ $product->name }}
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Bonus akan otomatis diberikan setelah pembayaran diverifikasi
        </p>
    </div>

    <form method="POST"
          action="{{ route('bonuses.update', $product) }}"
          class="space-y-6 p-6 rounded-2xl border
                 dark:border-azwara-darker
                 bg-white dark:bg-azwara-darkest">
        @csrf
        @method('PUT')

        {{-- BONUS QUIZ (GLOBAL) --}}
        <div class="flex items-start gap-3">
            <input type="checkbox"
                   name="bonuses[0][bonus_type]"
                   value="quiz"
                   @checked($product->hasBonus('quiz'))
                   class="rounded text-primary focus:ring-primary mt-1">
            <div>
                <p class="font-medium text-gray-900 dark:text-white">
                    Akses Semua Quiz
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Memberikan akses ke seluruh quiz
                </p>
            </div>
        </div>

        <hr class="dark:border-azwara-darker">

        {{-- BONUS TRYOUT (SPESIFIK) --}}
        <div class="space-y-3">
            <p class="font-medium text-gray-900 dark:text-white">
                Bonus Tryout
            </p>

            @foreach ($availableTryouts as $i => $tryout)
                @php $index = $i + 1; @endphp
                <label class="flex items-center gap-3">
                    <input type="checkbox"
                           name="bonuses[{{ $index }}][bonus_id]"
                           value="{{ $tryout->id }}"
                           @checked($product->hasBonus('tryout', $tryout->id))
                           class="rounded text-primary focus:ring-primary">

                    <input type="hidden"
                           name="bonuses[{{ $index }}][bonus_type]"
                           value="tryout">

                    <span class="text-sm text-gray-800 dark:text-gray-200">
                        {{ $tryout->title ?? 'Tryout #' . $tryout->id }}
                    </span>
                </label>
            @endforeach
        </div>

        <div class="pt-6 flex justify-end gap-3">
            <a href="{{ route('bonuses.index') }}"
               class="px-5 py-2.5 rounded-xl border text-gray-700 dark:text-gray-300">
                Batal
            </a>

            <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-primary text-white font-semibold">
                Simpan Bonus
            </button>
        </div>
    </form>
</div>
@endsection
