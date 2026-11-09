@props(['title' => null, 'description' => null, 'heading' => null, 'sub' => null, 'wide' => false])
<!DOCTYPE html>
<html lang="id">
<head>@include('partials.head', ['title' => $title, 'description' => $description])</head>
<body class="min-h-screen bg-cream">
<div class="grid min-h-screen lg:grid-cols-[1.05fr_1fr]">
    {{-- Panel artistik --}}
    <div class="relative hidden overflow-hidden bg-ink-950 lg:block">
        <div class="absolute inset-0 bg-grid-ink [background-size:40px_40px]"></div>
        <div class="blob -left-20 top-10 h-96 w-96 bg-garnet-600/50"></div>
        <div class="blob bottom-0 right-0 h-96 w-96 bg-saffron-500/30"></div>
        <div class="relative flex h-full flex-col justify-between p-12 text-white">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="grid h-14 w-14 place-items-center rounded-2xl bg-white p-2 shadow-glow-gold"><img src="{{ asset('img/logo.png') }}" alt="" class="h-full w-full object-contain"></span>
                <span class="font-display text-2xl font-extrabold">Satya<span class="text-saffron-400">Naratama</span></span>
            </a>
            <div>
                <p class="eyebrow !text-saffron-400">Bimbel Kedinasan & TNI–POLRI</p>
                <h2 class="mt-3 max-w-md font-display text-5xl font-extrabold leading-[1.05]">Latih otak, <span class="text-garnet-400">tempa fisik,</span> raih <span class="relative inline-block text-saffron-400">seragam impian.<svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 200 12" fill="none"><path d="M2 9c50-6 120-7 196-3" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg></span></h2>
                <div class="mt-10 grid max-w-md grid-cols-3 gap-3">
                    @foreach([['trophy','Tryout CAT'],['run','Jasmani'],['bolt','Kuis Harian']] as [$i,$l])
                        <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10"><x-icon :name="$i" class="h-6 w-6 text-saffron-400"/><p class="mt-2 text-sm font-bold">{{ $l }}</p></div>
                    @endforeach
                </div>
            </div>
            <p class="text-xs text-ink-400">© {{ date('Y') }} Satya Naratama · Pangkep, Sulawesi Selatan</p>
        </div>
    </div>
    {{-- Form --}}
    <div class="flex flex-col">
        <div class="flex items-center justify-between p-5 lg:hidden">
            <a href="{{ route('home') }}" class="flex items-center gap-2"><img src="{{ asset('img/logo.png') }}" class="h-10 w-10 object-contain" alt=""><span class="font-display text-lg font-extrabold">Satya<span class="text-garnet-600">Naratama</span></span></a>
        </div>
        <div class="flex flex-1 items-center justify-center px-5 pb-10 sm:px-10">
            <div class="w-full {{ $wide ? 'max-w-2xl' : 'max-w-md' }} animate-fade-up">
                @if($heading)
                    <h1 class="font-display text-3xl font-extrabold text-ink-900">{{ $heading }}</h1>
                    @if($sub)<p class="mt-2 text-sm text-ink-500">{{ $sub }}</p>@endif
                    <div class="mt-8"></div>
                @endif
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
@include('partials.toaster')
@livewireScriptConfig
@stack('scripts')
</body>
</html>
