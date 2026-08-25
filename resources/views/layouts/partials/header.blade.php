<header
    class="w-full min-h-[60px] md:min-h-[72px] lg:min-h-[80px] h-auto
           bg-white/80 dark:bg-primary-950/80
           backdrop-blur-xl backdrop-saturate-150
           border-b border-primary-200/30 dark:border-primary-800/30
           px-2 sm:px-4 md:px-6
           flex justify-between items-center
           sticky top-0 z-30
           transition-all duration-300
           overflow-visible"> {{-- Tambahkan overflow-visible --}}

    {{-- Left Section --}}
    <div class="flex items-center gap-1 sm:gap-3 md:gap-4 min-w-0 flex-1 overflow-visible">
        {{-- Hamburger Button --}}
        <button
            onclick="toggleSidebar()"
            class="p-1.5 sm:p-2 rounded-xl flex-shrink-0
                   text-primary-700 dark:text-primary-300
                   hover:bg-primary-100/50 dark:hover:bg-primary-800/50
                   transition-all duration-200
                   md:hidden
                   relative z-50"> {{-- Tambahkan z-50 --}}
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" class="sm:w-5 sm:h-5">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        {{-- Breadcrumb / Page Title --}}
        <div class="hidden sm:block min-w-0 flex-1">
            <h1 class="text-sm sm:text-base md:text-xl font-semibold text-primary-800 dark:text-primary-100 truncate">
                @yield('page-title', 'Dashboard')
            </h1>
            <p class="text-[10px] sm:text-xs text-secondary-500 dark:text-secondary-400 truncate hidden md:block">
                @yield('page-subtitle', 'Selamat datang kembali, ' . auth()->user()->name)
            </p>
        </div>

        {{-- Mobile page title --}}
        <div class="block sm:hidden min-w-0 flex-1">
            <h1 class="text-sm font-semibold text-primary-800 dark:text-primary-100 truncate">
                @yield('page-title', 'Dashboard')
            </h1>
        </div>
    </div>

    {{-- Right Section --}}
    <div class="flex items-center gap-0.5 sm:gap-1.5 md:gap-3 flex-shrink-0 overflow-visible relative"> {{-- Tambahkan overflow-visible & relative --}}

        {{-- Theme Toggle --}}
        <button onclick="toggleTheme()"
                class="p-1.5 sm:p-2 rounded-xl flex-shrink-0
                       text-primary-700 dark:text-primary-300
                       hover:bg-primary-100/50 dark:hover:bg-primary-800/50
                       transition-all duration-200
                       relative z-40"> {{-- Tambahkan z-40 --}}
            <!-- Moon Icon (Light Mode) -->
            <svg class="block dark:hidden w-4 h-4 sm:w-4.5 sm:h-4.5 md:w-5 md:h-5" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79Z"/>
            </svg>
            <!-- Sun Icon (Dark Mode) -->
            <svg class="hidden dark:block w-4 h-4 sm:w-4.5 sm:h-4.5 md:w-5 md:h-5" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="5"/>
                <path d="M12 1v2m0 18v2m11-11h-2M3 12H1m16.95 7.95-1.41-1.41M6.46 6.46 5.05 5.05m12.9 0-1.41 1.41M6.46 17.54 5.05 18.95"/>
            </svg>
        </button>

        {{-- Notifications --}}
        @php
            $notifications = auth()->user()?->unreadNotifications()->latest()->take(5)->get();
            $unreadCount  = auth()->user()?->unreadNotifications()->count() ?? 0;
        @endphp

        <div x-data="{ open: false }" class="relative overflow-visible" @click.outside="open = false">
            <button @click="open = !open"
                    class="relative p-1.5 sm:p-2 rounded-xl flex-shrink-0
                           text-primary-700 dark:text-primary-300
                           hover:bg-primary-100/50 dark:hover:bg-primary-800/50
                           transition-all duration-200
                           overflow-visible z-40"> {{-- Tambahkan overflow-visible & z-40 --}}
                <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5 md:w-5 md:h-5" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22c1.1 0 2-.9 2-2H10c0 1.1.9 2 2 2Zm6-6v-5a6 6 0 1 0-12 0v5l-2 2v1h16v-1l-2-2Z"/>
                </svg>

                @if($unreadCount)
                    <span class="absolute -top-1 -right-1
                                 bg-red-500 text-white text-[8px] sm:text-[9px] md:text-[10px] font-bold
                                 rounded-full px-1 min-w-[14px] sm:min-w-[16px] md:min-w-[18px]
                                 h-[14px] sm:h-[16px] md:h-[18px]
                                 flex items-center justify-center
                                 shadow-lg shadow-red-500/30
                                 z-50"> {{-- Tambahkan z-50 --}}
                        {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                    </span>
                @endif
            </button>

            {{-- Notifications Dropdown --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute right-0 mt-1 sm:mt-2 md:mt-3
                        w-screen max-w-[calc(100vw-2rem)] sm:max-w-sm md:max-w-md
                        bg-white dark:bg-primary-900
                        rounded-2xl shadow-2xl border
                        dark:border-primary-800/50
                        overflow-visible z-50"
                 style="right: -8px; left: auto;"
                 @click.outside="open = false">

                {{-- Arrow indicator --}}
                <div class="absolute -top-1.5 sm:-top-2 right-3 sm:right-4 w-3 h-3 sm:w-4 sm:h-4
                            bg-white dark:bg-primary-900
                            border-l border-t border-primary-200 dark:border-primary-800/50
                            rotate-45 z-[-1]"></div>

                <div class="p-3 sm:p-4 border-b dark:border-primary-800/50
                            flex items-center justify-between">
                    <h3 class="font-semibold text-sm sm:text-base text-primary-800 dark:text-primary-200">
                        Notifikasi
                    </h3>
                    @if($unreadCount)
                        <span class="text-[10px] sm:text-xs bg-primary-100 dark:bg-primary-800
                                     text-primary-700 dark:text-primary-300
                                     px-2 py-0.5 rounded-full flex-shrink-0 ml-2">
                            {{ $unreadCount }} baru
                        </span>
                    @endif
                </div>

                <div class="max-h-52 sm:max-h-60 md:max-h-80 overflow-y-auto divide-y divide-primary-100/50 dark:divide-primary-800/50
                            overscroll-contain">
                    @forelse($notifications as $notif)
                        <a href="{{ $notif->data['url'] ?? '#' }}"
                           data-notif-id="{{ $notif->id }}"
                           class="notif-link block px-3 sm:px-4 py-2.5 sm:py-3
                                  hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                                  transition-colors duration-150">
                            <p class="text-xs sm:text-sm text-primary-800 dark:text-primary-200 line-clamp-2">
                                {{ $notif->data['message'] }}
                            </p>
                            <p class="text-[10px] sm:text-xs text-secondary-400 dark:text-secondary-500 mt-1">
                                {{ $notif->created_at->diffForHumans() }}
                            </p>
                        </a>
                    @empty
                        <div class="p-6 sm:p-8 text-center">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 mx-auto text-secondary-300 dark:text-secondary-600 mb-3" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 22c1.1 0 2-.9 2-2H10c0 1.1.9 2 2 2Zm6-6v-5a6 6 0 1 0-12 0v5l-2 2v1h16v-1l-2-2Z"/>
                            </svg>
                            <p class="text-xs sm:text-sm text-secondary-500 dark:text-secondary-400">
                                Tidak ada notifikasi
                            </p>
                        </div>
                    @endforelse
                </div>

                <a href="{{ route('notifications.index') }}"
                   class="block text-center text-xs sm:text-sm py-2.5 sm:py-3
                          text-primary-600 dark:text-primary-400
                          hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                          font-medium transition-colors duration-150
                          border-t dark:border-primary-800/50">
                    Lihat semua →
                </a>
            </div>
        </div>

        {{-- User Profile --}}
        <div x-data="{ open: false }" class="relative overflow-visible" @click.outside="open = false">
            <button @click="open = !open"
                    class="flex items-center gap-1 sm:gap-1.5 md:gap-3 p-0.5 sm:p-1 rounded-xl flex-shrink-0
                           hover:bg-primary-100/50 dark:hover:bg-primary-800/50
                           transition-all duration-200
                           border border-transparent hover:border-primary-200/50 dark:hover:border-primary-700/50
                           relative z-40 overflow-visible"> {{-- Tambahkan overflow-visible & z-40 --}}
                <span class="hidden sm:inline-block text-xs sm:text-sm font-medium text-primary-700 dark:text-primary-300 truncate max-w-[60px] sm:max-w-[80px] md:max-w-[120px]">
                    {{ auth()->user()->name }}
                </span>
                <div class="relative flex-shrink-0 overflow-visible"> {{-- Tambahkan wrapper --}}
                    <img src="{{ auth()->user()->avatar_url ?? asset('img/default-avatar.png') }}"
                         class="w-7 h-7 sm:w-8 sm:h-8 md:w-9 md:h-9 rounded-xl border-2 border-primary-200/50 dark:border-primary-700/50
                                object-cover shadow-sm
                                hover:scale-105 transition-transform duration-200
                                block" /> {{-- Tambahkan block --}}
                </div>
            </button>

            {{-- Profile Dropdown --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute right-0 mt-1 sm:mt-2
                        w-44 sm:w-48 md:w-56
                        bg-white dark:bg-primary-900
                        rounded-2xl shadow-2xl border
                        dark:border-primary-800/50
                        overflow-visible z-50 py-1"
                 style="right: -4px;">

                {{-- Arrow indicator --}}
                <div class="absolute -top-1.5 sm:-top-2 right-2 sm:right-3 w-3 h-3 sm:w-4 sm:h-4
                            bg-white dark:bg-primary-900
                            border-l border-t border-primary-200 dark:border-primary-800/50
                            rotate-45 z-[-1]"></div>

                <div class="px-3 sm:px-4 py-2.5 sm:py-3 border-b dark:border-primary-800/50">
                    <p class="text-xs sm:text-sm font-medium text-primary-800 dark:text-primary-200 truncate">
                        {{ auth()->user()->name }}
                    </p>
                    <p class="text-[10px] sm:text-xs text-secondary-500 dark:text-secondary-400 truncate">
                        {{ auth()->user()->email }}
                    </p>
                </div>

                <a href="{{ route('profile.show') }}"
                   class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm
                          text-primary-700 dark:text-primary-300
                          hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                          transition-colors duration-150">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Profil</span>
                </a>

                <a href="{{ route('home') }}"
                   class="flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm
                          text-primary-700 dark:text-primary-300
                          hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                          transition-colors duration-150">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Beranda</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="border-t dark:border-primary-800/50">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-2.5 text-xs sm:text-sm
                                   text-red-600 dark:text-red-400
                                   hover:bg-red-50/50 dark:hover:bg-red-900/20
                                   transition-colors duration-150">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
