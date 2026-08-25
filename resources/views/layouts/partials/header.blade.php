<header
    class="w-full h-20
           bg-white/80 dark:bg-primary-950/80
           backdrop-blur-xl backdrop-saturate-150
           border-b border-primary-200/30 dark:border-primary-800/30
           px-6
           flex justify-between items-center
           sticky top-0 z-30
           transition-all duration-300">

    {{-- Left Section --}}
    <div class="flex items-center gap-4">
        {{-- Hamburger Button --}}
        <button
            onclick="toggleSidebar()"
            class="p-2 rounded-xl
                   text-primary-700 dark:text-primary-300
                   hover:bg-primary-100/50 dark:hover:bg-primary-800/50
                   transition-all duration-200
                   md:hidden">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        {{-- Breadcrumb / Page Title --}}
        <div class="hidden md:block">
            <h1 class="text-xl font-semibold text-primary-800 dark:text-primary-100">
                @yield('page-title', 'Dashboard')
            </h1>
            <p class="text-xs text-secondary-500 dark:text-secondary-400">
                @yield('page-subtitle', 'Selamat datang kembali, ' . auth()->user()->name)
            </p>
        </div>
    </div>

    {{-- Right Section --}}
    <div class="flex items-center gap-4">

        {{-- Search Bar --}}
        <div class="hidden lg:flex items-center gap-2
                    bg-primary-50/50 dark:bg-primary-800/30
                    rounded-xl px-4 py-2
                    border border-primary-200/30 dark:border-primary-700/30
                    focus-within:border-primary-500 dark:focus-within:border-primary-400
                    transition-all duration-200">
            <svg class="w-4 h-4 text-secondary-400 dark:text-secondary-500" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text"
                   placeholder="Cari..."
                   class="bg-transparent border-none outline-none text-sm
                          text-primary-800 dark:text-primary-200
                          placeholder:text-secondary-400 dark:placeholder:text-secondary-500
                          w-48 focus:w-64 transition-all duration-300">
        </div>

        {{-- Theme Toggle --}}
        <button onclick="toggleTheme()"
                class="p-2 rounded-xl
                       text-primary-700 dark:text-primary-300
                       hover:bg-primary-100/50 dark:hover:bg-primary-800/50
                       transition-all duration-200">
            <!-- Moon Icon (Light Mode) -->
            <svg class="block dark:hidden w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79Z"/>
            </svg>
            <!-- Sun Icon (Dark Mode) -->
            <svg class="hidden dark:block w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="5"/>
                <path d="M12 1v2m0 18v2m11-11h-2M3 12H1m16.95 7.95-1.41-1.41M6.46 6.46 5.05 5.05m12.9 0-1.41 1.41M6.46 17.54 5.05 18.95"/>
            </svg>
        </button>

        {{-- Notifications --}}
        @php
            $notifications = auth()->user()?->unreadNotifications()->latest()->take(5)->get();
            $unreadCount  = auth()->user()?->unreadNotifications()->count() ?? 0;
        @endphp

        <div x-data="{ open:false }" class="relative">
            <button @click="open = !open"
                    class="relative p-2 rounded-xl
                           text-primary-700 dark:text-primary-300
                           hover:bg-primary-100/50 dark:hover:bg-primary-800/50
                           transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22c1.1 0 2-.9 2-2H10c0 1.1.9 2 2 2Zm6-6v-5a6 6 0 1 0-12 0v5l-2 2v1h16v-1l-2-2Z"/>
                </svg>

                @if($unreadCount)
                    <span class="absolute -top-1 -right-1
                                 bg-red-500 text-white text-[10px] font-bold
                                 rounded-full px-1.5 min-w-[18px] h-[18px]
                                 flex items-center justify-center
                                 shadow-lg shadow-red-500/30">
                        {{ $unreadCount }}
                    </span>
                @endif
            </button>

            {{-- Notifications Dropdown --}}
            <div x-show="open" @click.outside="open=false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute right-0 mt-3 w-96
                        bg-white dark:bg-primary-900
                        rounded-2xl shadow-2xl border
                        dark:border-primary-800/50
                        overflow-hidden z-50">

                <div class="p-4 border-b dark:border-primary-800/50
                            flex items-center justify-between">
                    <h3 class="font-semibold text-primary-800 dark:text-primary-200">
                        Notifikasi
                    </h3>
                    @if($unreadCount)
                        <span class="text-xs bg-primary-100 dark:bg-primary-800
                                     text-primary-700 dark:text-primary-300
                                     px-2 py-0.5 rounded-full">
                            {{ $unreadCount }} baru
                        </span>
                    @endif
                </div>

                <div class="max-h-80 overflow-y-auto divide-y divide-primary-100/50 dark:divide-primary-800/50">
                    @forelse($notifications as $notif)
                        <a href="{{ $notif->data['url'] ?? '#' }}"
                           data-notif-id="{{ $notif->id }}"
                           class="notif-link block px-4 py-3
                                  hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                                  transition-colors duration-150">
                            <p class="text-sm text-primary-800 dark:text-primary-200">
                                {{ $notif->data['message'] }}
                            </p>
                            <p class="text-xs text-secondary-400 dark:text-secondary-500 mt-1">
                                {{ $notif->created_at->diffForHumans() }}
                            </p>
                        </a>
                    @empty
                        <div class="p-8 text-center">
                            <svg class="w-12 h-12 mx-auto text-secondary-300 dark:text-secondary-600 mb-3" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 22c1.1 0 2-.9 2-2H10c0 1.1.9 2 2 2Zm6-6v-5a6 6 0 1 0-12 0v5l-2 2v1h16v-1l-2-2Z"/>
                            </svg>
                            <p class="text-sm text-secondary-500 dark:text-secondary-400">
                                Tidak ada notifikasi
                            </p>
                        </div>
                    @endforelse
                </div>

                <a href="{{ route('notifications.index') }}"
                   class="block text-center text-sm py-3
                          text-primary-600 dark:text-primary-400
                          hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                          font-medium transition-colors duration-150">
                    Lihat semua →
                </a>
            </div>
        </div>

        {{-- User Profile --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                    class="flex items-center gap-3 p-1.5 rounded-xl
                           hover:bg-primary-100/50 dark:hover:bg-primary-800/50
                           transition-all duration-200
                           border border-transparent hover:border-primary-200/50 dark:hover:border-primary-700/50">
                <span class="hidden md:block text-sm font-medium text-primary-700 dark:text-primary-300">
                    {{ auth()->user()->name }}
                </span>
                <img src="{{ auth()->user()->avatar_url }}"
                     class="w-9 h-9 rounded-xl border-2 border-primary-200/50 dark:border-primary-700/50
                            object-cover shadow-sm
                            hover:scale-105 transition-transform duration-200" />
            </button>

            {{-- Profile Dropdown --}}
            <div x-show="open"
                 @click.outside="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute right-0 mt-2 w-48
                        bg-white dark:bg-primary-900
                        rounded-2xl shadow-2xl border
                        dark:border-primary-800/50
                        overflow-hidden z-50 py-1">

                <div class="px-4 py-3 border-b dark:border-primary-800/50">
                    <p class="text-sm font-medium text-primary-800 dark:text-primary-200">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">
                        {{ auth()->user()->email }}
                    </p>
                </div>

                <a href="{{ route('profile.show') }}"
                   class="flex items-center gap-3 px-4 py-2.5 text-sm
                          text-primary-700 dark:text-primary-300
                          hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                          transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil
                </a>

                <a href="{{ route('home') }}"
                   class="flex items-center gap-3 px-4 py-2.5 text-sm
                          text-primary-700 dark:text-primary-300
                          hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                          transition-colors duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Beranda
                </a>

                <form method="POST" action="{{ route('logout') }}" class="border-t dark:border-primary-800/50">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-2.5 text-sm
                                   text-red-600 dark:text-red-400
                                   hover:bg-red-50/50 dark:hover:bg-red-900/20
                                   transition-colors duration-150">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.notif-link').forEach(link => {
        link.addEventListener('click', () => {
            const id = link.dataset.notifId;
            if (!id) return;

            fetch(`/notifications/${id}/mark-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                keepalive: true
            });
        });
    });
});
</script>
@endpush
