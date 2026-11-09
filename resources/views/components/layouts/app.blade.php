@props(['title' => null, 'description' => null, 'wide' => false])
@php
    $user = auth()->user();
    $menu = \App\Support\Menu::for($user);
    $isSiswa = $user && ! $user->hasAnyRole(['admin', 'tentor']);
    $cartCount = $isSiswa ? (int) optional($user->cart)->items()?->count() : 0;
@endphp
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    @include('partials.head', ['title' => $title, 'description' => $description, 'robots' => 'noindex, nofollow'])
</head>
<body class="h-full overflow-hidden" x-data="{ nav: false }" @keydown.escape.window="nav = false">
<div class="flex h-full">
    {{-- ============ SIDEBAR ============ --}}
    <div x-show="nav" x-transition.opacity x-cloak class="fixed inset-0 z-40 bg-ink-950/60 backdrop-blur-sm lg:hidden" @click="nav=false"></div>
    <aside class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col bg-ink-900 bg-grid-ink [background-size:28px_28px] text-white transition-transform duration-300 lg:static lg:translate-x-0"
           :class="nav && '!translate-x-0'">
        <div class="blob -left-16 -top-16 h-48 w-48 bg-garnet-600/40"></div>
        <div class="blob -bottom-20 -right-10 h-56 w-56 bg-saffron-500/20"></div>

        <a href="{{ route('dashboard.redirect') }}" class="relative flex items-center gap-3 px-5 pb-4 pt-5">
            <span class="grid h-11 w-11 place-items-center rounded-2xl bg-white p-1.5 shadow-glow-gold"><img src="{{ asset('img/logo.png') }}" alt="Satya Naratama" class="h-full w-full object-contain"></span>
            <span>
                <span class="block font-display text-lg font-extrabold leading-none">Satya<span class="text-saffron-400">Naratama</span></span>
                <span class="mt-1 block text-[11px] font-semibold text-ink-300">Bimbel Kedinasan & TNI–POLRI</span>
            </span>
        </a>

        <nav class="scrollbar-thin relative flex-1 overflow-y-auto px-3 pb-6">
            @foreach($menu as [$group, $items])
                <p class="nav-group">{{ $group }}</p>
                @foreach($items as $item)
                    @php [$label, $route, $icon, $pattern] = $item; $badge = $item[4] ?? 0; $active = request()->routeIs(...(array) $pattern); @endphp
                    @if(Route::has($route))
                    <a href="{{ route($route) }}" class="nav-link {{ $active ? 'active' : '' }}">
                        <x-icon :name="$icon" class="h-5 w-5 shrink-0" />
                        <span class="flex-1 truncate">{{ $label }}</span>
                        @if($badge)<span class="rounded-full bg-garnet-500 px-2 py-0.5 text-[10px] font-extrabold text-white">{{ $badge }}</span>@endif
                    </a>
                    @endif
                @endforeach
            @endforeach
        </nav>

        <div class="relative m-3 rounded-2xl bg-white/5 p-3 ring-1 ring-white/10">
            <div class="flex items-center gap-3">
                <img src="{{ $user->avatar_url }}" class="avatar h-10 w-10 ring-saffron-400/60" alt="">
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-bold">{{ $user->name }}</p>
                    <p class="text-[11px] font-semibold text-saffron-300">{{ \App\Support\Menu::roleLabel($user) }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button class="rounded-xl p-2 text-ink-300 hover:bg-white/10 hover:text-white" title="Keluar"><x-icon name="logout" /></button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ============ MAIN ============ --}}
    <div class="flex min-w-0 flex-1 flex-col">
        <header class="relative z-30 flex h-16 shrink-0 items-center gap-3 border-b border-ink-100/70 bg-cream/80 px-4 backdrop-blur sm:px-6">
            <button class="btn-icon btn-ghost -ml-2 lg:hidden" @click="nav = true" aria-label="Menu"><x-icon name="menu" class="h-6 w-6" /></button>
            <div class="min-w-0 flex-1">
                <p class="truncate font-display text-base font-bold text-ink-900 sm:text-lg">{{ $title ?? 'Satya Naratama' }}</p>
            </div>
            @if($isSiswa)
                <a href="{{ route('cart.show') }}" class="relative btn-icon btn-ghost" title="Keranjang">
                    <x-icon name="cart" class="h-6 w-6" />
                    <span id="cart-count" x-data x-on:cart-updated.window="$el.textContent = $event.detail.count; $el.classList.toggle('hidden', ! $event.detail.count)" class="absolute -right-0.5 -top-0.5 grid h-5 min-w-[20px] place-items-center rounded-full bg-garnet-600 px-1 text-[10px] font-extrabold text-white {{ $cartCount ? '' : 'hidden' }}">{{ $cartCount }}</span>
                </a>
            @endif
            <livewire:notification-bell />
            <div class="relative" x-data="{ o: false }" @click.outside="o=false">
                <button @click="o=!o" class="flex items-center gap-2 rounded-2xl p-1 pr-2 hover:bg-ink-50">
                    <img src="{{ $user->avatar_url }}" class="avatar h-9 w-9 ring-ink-100" alt="">
                    <x-icon name="chevron-down" class="hidden h-4 w-4 text-ink-400 sm:block" />
                </button>
                <div x-show="o" x-transition x-cloak class="absolute right-0 mt-2 w-60 overflow-hidden rounded-2xl bg-white p-1.5 shadow-lift ring-1 ring-ink-100">
                    <div class="px-3 py-2">
                        <p class="truncate text-sm font-bold">{{ $user->name }}</p>
                        <p class="truncate text-xs text-ink-400">{{ $user->email }}</p>
                    </div>
                    <div class="divider my-1"></div>
                    <a href="{{ route('profile.show') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold hover:bg-ink-50"><x-icon name="user" class="h-4 w-4" /> Profil Saya</a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold hover:bg-ink-50"><x-icon name="pencil" class="h-4 w-4" /> Ubah Profil</a>
                    <a href="{{ route('profile.password') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold hover:bg-ink-50"><x-icon name="key" class="h-4 w-4" /> Ganti Password</a>
                    <a href="{{ route('home') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold hover:bg-ink-50"><x-icon name="globe" class="h-4 w-4" /> Halaman Depan</a>
                    <form method="POST" action="{{ route('logout') }}">@csrf
                        <button class="flex w-full items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-garnet-600 hover:bg-garnet-50"><x-icon name="logout" class="h-4 w-4" /> Keluar</button>
                    </form>
                </div>
            </div>
        </header>

        <main class="scrollbar-thin relative flex-1 overflow-y-auto">
            <div class="pointer-events-none absolute inset-x-0 top-0 h-64 bg-grid-soft [background-size:32px_32px] [mask-image:linear-gradient(to_bottom,black,transparent)]"></div>
            <div class="relative mx-auto w-full {{ $wide ? 'max-w-[1600px]' : 'max-w-7xl' }} px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                {{ $slot }}
            </div>
            <footer class="px-6 pb-6 text-center text-xs text-ink-400">© {{ date('Y') }} Satya Naratama · Bimbel Kedinasan & TNI–POLRI</footer>
        </main>
    </div>
</div>

@include('partials.toaster')
@livewireScriptConfig
@stack('scripts')
</body>
</html>
