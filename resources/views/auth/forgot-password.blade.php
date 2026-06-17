@extends('layouts.guest')

@section('content')
<div class="w-full min-h-[80vh] flex items-center justify-center px-4">

    <div class="bg-white dark:bg-azwara-darker shadow-xl rounded-2xl p-10 w-full max-w-lg
                border border-gray-100 dark:border-azwara-medium/20">

        <h2 class="text-2xl font-bold text-center text-azwara-darker dark:text-azwara-lighter">
            Lupa Password
        </h2>

        <p class="mt-3 text-center text-gray-600 dark:text-azwara-light/80">
            Masukkan email Anda untuk menerima link reset password.
        </p>

        @if (session('status'))
            <div class="mt-4 p-3 text-green-700 bg-green-100 dark:bg-green-900 dark:text-green-300 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-4">
            @csrf

            <div>
                <label class="text-gray-700 dark:text-gray-300 text-sm font-medium">Email</label>
                <input type="email" name="email" required
                    class="mt-1 w-full px-4 py-3 rounded-xl
                           bg-white dark:bg-gray-800
                           border border-gray-300 dark:border-gray-700
                           text-gray-800 dark:text-white
                           focus:ring-primary focus:border-primary">
            </div>

            <button
                class="w-full py-3 rounded-xl font-bold text-white
                       bg-primary hover:bg-azwara-medium transition">
                Kirim Link Reset Password
            </button>
        </form>

        <a href="{{ route('login') }}"
           class="block text-center mt-4 text-primary dark:text-azwara-light font-medium hover:underline">
            ← Kembali ke Login
        </a>
    </div>

</div>
@endsection
