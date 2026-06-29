@extends('layouts.guest')

@section('title', 'Cek Status Pendaftaran – Satya Naratama')
@section('content')

<div class="w-full py-12 sm:py-20 px-4 flex items-center justify-center">

    <div
        class="w-full max-w-md mx-auto
            p-6 sm:p-8
            rounded-3xl shadow-xl
            bg-azwara-lightest dark:bg-azwara-darker
            border border-azwara-light/30
            transition-colors">

        {{-- Title --}}
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-3 mb-2">
                <span class="h-px w-8 bg-primary/60"></span>
                <p class="text-xs font-semibold tracking-[0.2em] text-primary uppercase">Cek Status</p>
                <span class="h-px w-8 bg-primary/60"></span>
            </div>
            <h2 class="text-2xl font-extrabold text-azwara-darker dark:text-white">
                Cek Pendaftaran 🔍
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Masukkan email untuk melihat status pendaftaran
            </p>
        </div>

        {{-- Form --}}
        <form action="{{ route('daftar.status.check') }}" method="POST" class="space-y-4">
            @csrf

            @if(session('error'))
                <div class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-xl p-3 text-sm border border-red-200 dark:border-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-xl p-3 text-sm border border-green-200 dark:border-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-xl p-3 text-sm border border-blue-200 dark:border-blue-800">
                    {{ session('info') }}
                </div>
            @endif

            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" required
                    value="{{ old('email') }}"
                    placeholder="email@example.com"
                    class="mt-1 w-full px-4 py-3 rounded-xl
                            bg-white dark:bg-gray-800
                            border-gray-300 dark:border-gray-700
                            text-gray-800 dark:text-white
                            focus:ring-primary focus:border-primary">
            </div>

            <button type="submit"
                class="w-full py-3 rounded-xl font-bold text-white
                    bg-gradient-to-r from-primary to-azwara-medium
                    hover:shadow-xl hover:scale-[1.01] transition-all duration-300">
                Cek Status
            </button>
        </form>

        {{-- Links --}}
        <div class="mt-6 text-center space-y-2">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Belum mendaftar?
                <a href="{{ route('daftar.form') }}"
                   class="text-primary font-semibold hover:underline">
                    Daftar Sekarang
                </a>
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                <a href="{{ route('login') }}"
                   class="hover:underline">
                    Login
                </a>
            </p>
        </div>

    </div>
</div>

@endsection