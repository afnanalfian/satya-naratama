@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-azwara-darkest dark:text-azwara-lightest">
            Edit Promo Banner
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Perbarui konten dan pengaturan promo
        </p>
    </div>

    <form action="{{ route('promo-banners.update', $promoBanner) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white dark:bg-azwara-darker rounded-xl shadow-sm border
                 border-azwara-lighter/60 dark:border-white/10 p-6 space-y-6">
        @csrf
        @method('PUT')

        @include('marketing.promo-banners._form', [
            'promo' => $promoBanner,
            'submitLabel' => 'Perbarui Promo'
        ])

    </form>
</div>
@endsection
