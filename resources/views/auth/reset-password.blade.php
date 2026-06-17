@extends('layouts.guest')

@section('content')
<div class="w-full min-h-[80vh] flex items-center justify-center px-4">

    <div class="bg-white dark:bg-azwara-darker shadow-xl rounded-2xl p-10 w-full max-w-lg
                border border-gray-100 dark:border-azwara-medium/20">

        <h2 class="text-2xl font-bold text-center text-azwara-darker dark:text-azwara-lighter">
            Reset Password
        </h2>

        <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" required
                       class="mt-1 w-full px-4 py-3 rounded-xl
                              bg-white dark:bg-gray-800
                              border border-gray-300 dark:border-gray-700
                              text-gray-800 dark:text-white
                              focus:ring-primary focus:border-primary">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Password Baru</label>
                <input type="password" name="password" required
                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800
                              border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-white
                              focus:ring-primary focus:border-primary">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800
                              border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-white
                              focus:ring-primary focus:border-primary">
            </div>

            <button
                class="w-full py-3 rounded-xl font-bold text-white
                       bg-primary hover:bg-azwara-medium transition">
                Reset Password
            </button>
        </form>

        <a href="{{ route('login') }}"
           class="block text-center mt-4 text-primary dark:text-azwara-light font-medium hover:underline">
            ← Kembali ke Login
        </a>
    </div>

</div>
@endsection
