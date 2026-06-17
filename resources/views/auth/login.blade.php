@extends('layouts.guest')

@section('title', 'Login – Azwara Learning')
@section('content')
<div class="w-full min-h-[85vh]
            flex items-center justify-center px-4">

    <div
        class="w-full max-w-md mx-auto
            p-5 sm:p-8
            rounded-3xl shadow-xl
            bg-azwara-lightest dark:bg-azwara-darker
            border border-azwara-light/30
            transition-colors">

        {{-- Title --}}
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-azwara-darker dark:text-white">
                Selamat Datang 👋
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Masuk untuk melanjutkan pembelajaranmu
            </p>
        </div>

        {{-- Status --}}
        @if(session('status'))
            <div class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300
                        p-3 rounded-lg mb-4 text-sm">
                {{ session('status') }}
            </div>
        @endif

        {{-- Error --}}
        @if ($errors->any())
            <div class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300
                        p-3 rounded-lg mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
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

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
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

            {{-- Remember --}}
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                    <input type="checkbox" name="remember"
                           class="rounded border-gray-300 text-primary focus:ring-primary">
                    Ingat saya
                </label>

                <a href="{{ route('password.request') }}" class="text-primary font-medium hover:underline">
                    Lupa password?
                </a>
            </div>

            {{-- Submit --}}
            <button
                class="w-full py-3 rounded-xl font-bold text-white
                       bg-gradient-to-r from-primary to-azwara-medium
                       hover:shadow-xl hover:scale-[1.02] transition">
                Masuk
            </button>
        </form>

        {{-- Footer --}}
        <p class="text-sm text-center mt-6 text-gray-600 dark:text-gray-400">
            Belum punya akun?
            <a href="{{ route('register') }}"
               class="text-primary font-semibold hover:underline">
                Daftar sekarang
            </a>
        </p>
    </div>

</div>
@endsection
