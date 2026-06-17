@extends('layouts.guest')

@section('title', 'Register – Azwara Learning')
@section('content')

<div class="w-full py-12 sm:py-20 px-4 flex items-center justify-center">

    <div
        class="w-full max-w-2xl mx-auto
            p-6 sm:p-8
            rounded-3xl shadow-xl
            bg-azwara-lightest dark:bg-azwara-darker
            border border-azwara-light/30
            transition-colors">

        {{-- Title --}}
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-azwara-darker dark:text-white">
                Buat Akun Baru ✨
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Daftar dan mulai perjalanan belajarmu
            </p>
        </div>

        {{-- Form --}}
        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Errors --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 rounded p-4">
                    <ul class="text-sm">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Nama --}}
                <div class="md:col-span-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" required
                        placeholder="Nama lengkap"
                        class="mt-1 w-full px-4 py-3 rounded-xl
                                bg-white dark:bg-gray-800
                                border-gray-300 dark:border-gray-700
                                text-gray-800 dark:text-white
                                focus:ring-primary focus:border-primary">
                </div>

                {{-- Email --}}
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="email" name="email" required
                        placeholder="Masukkan email..."
                        class="mt-1 w-full px-4 py-3 rounded-xl
                                bg-white dark:bg-gray-800
                                border-gray-300 dark:border-gray-700
                                text-gray-800 dark:text-white
                                focus:ring-primary focus:border-primary">
                </div>

                {{-- Phone --}}
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        No. HP
                    </label>
                    <input type="text" name="phone"
                        placeholder="08xxxxxxxxxx"
                        class="mt-1 w-full px-4 py-3 rounded-xl
                                bg-white dark:bg-gray-800
                                border-gray-300 dark:border-gray-700
                                text-gray-800 dark:text-white
                                focus:ring-primary focus:border-primary">
                </div>

                {{-- Password --}}
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Password
                    </label>
                    <input type="password" name="password" required
                        placeholder="••••••••"
                        class="mt-1 w-full px-4 py-3 rounded-xl
                                bg-white dark:bg-gray-800
                                border-gray-300 dark:border-gray-700
                                text-gray-800 dark:text-white
                                focus:ring-primary focus:border-primary">
                </div>

                {{-- Confirm --}}
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Konfirmasi Password
                    </label>
                    <input type="password" name="password_confirmation" required
                        placeholder="••••••••"
                        class="mt-1 w-full px-4 py-3 rounded-xl
                                bg-white dark:bg-gray-800
                                border-gray-300 dark:border-gray-700
                                text-gray-800 dark:text-white
                                focus:ring-primary focus:border-primary">
                </div>

                {{-- PROVINCE --}}
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Provinsi
                    </label>
                    <select id="province_id" name="province_id" class="select2 input-primary">
                        <option value="">-- pilih provinsi --</option>
                        @foreach ($provinces as $prov)
                            <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- REGENCY --}}
                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Kabupaten / Kota
                    </label>
                    <select id="regency_id" name="regency_id" class="select2 input-primary">
                        <option value="">-- pilih kab/kota --</option>
                    </select>
                </div>

                {{-- Avatar --}}
                <div class="md:col-span-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        Foto Profil (Opsional)
                    </label>
                    <input type="file" name="avatar"
                        class="mt-1 block w-full text-sm
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-xl file:border-0
                                file:bg-primary file:text-white
                                hover:file:bg-azwara-medium
                                bg-white dark:bg-gray-800
                                border border-gray-300 dark:border-gray-700
                                rounded-xl cursor-pointer">
                </div>

            </div>

            {{-- Submit --}}
            <button
                class="w-full py-3 rounded-xl font-bold text-white
                    bg-gradient-to-r from-primary to-azwara-medium
                    hover:shadow-xl hover:scale-[1.02] transition">
                Daftar
            </button>

        </form>

        <p class="text-sm text-center mt-6 text-gray-600 dark:text-gray-400">
            Sudah punya akun?
            <a href="{{ route('login') }}"
               class="text-primary font-semibold hover:underline">
                Login
            </a>
        </p>
    </div>
</div>

@endsection

@push('scripts')
{{-- jQuery + Select2 --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {

    $('.select2').select2();

    $('#province_id').on('change', function () {
        let provinceId = $(this).val();
        let regencySelect = $('#regency_id');

        regencySelect.empty().append('<option>Loading...</option>');

        if (!provinceId) {
            regencySelect.empty().append('<option value="">-- pilih kab/kota --</option>');
            return;
        }

        $.get(`/api/regencies/${provinceId}`, function (data) {
            regencySelect.empty().append('<option value="">-- pilih kab/kota --</option>');

            data.forEach(function (item) {
                regencySelect.append(new Option(item.name, item.id));
            });

            regencySelect.trigger('change');
        });
    });

});
</script>
@endpush
