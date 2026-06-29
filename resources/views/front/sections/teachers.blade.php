{{-- resources/views/front/sections/teachers.blade.php --}}
<section id="teachers" class="scroll-mt-20 py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-azwara-medium/10 rounded-full mb-5 border border-azwara-medium/20">
                <span class="w-1.5 h-1.5 bg-azwara-medium rounded-full"></span>
                <span class="text-[11px] font-bold text-azwara-medium uppercase tracking-[0.18em]">Tim Pengajar</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-azwara-darkest mb-4 tracking-tight">
                Tentor <span class="text-azwara-medium">Profesional</span>
            </h2>
            <p class="text-base lg:text-lg text-secondary/80 max-w-xl mx-auto leading-relaxed">
                Belajar langsung dari tentor berpengalaman yang membimbing kamu mencapai hasil belajar terbaik.
            </p>
        </div>

        @if($teachers->count() > 0)
            {{-- Teachers Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($teachers as $teacher)
                    <div class="teacher-card group relative rounded-2xl overflow-hidden border border-azwara-lighter/70 bg-azwara-lightest shadow-sm hover:shadow-xl hover:shadow-azwara-darkest/10 transition-shadow duration-500">

                        {{-- Foto --}}
                        <div class="relative aspect-[4/5] overflow-hidden bg-azwara-darker">
                            @if($teacher->user->avatar)
                                <img
                                    src="{{ Storage::url($teacher->user->avatar) }}"
                                    alt="{{ $teacher->user->name }}"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                                >
                            @else
                                <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-azwara-medium to-azwara-darkest flex items-center justify-center">
                                    <span class="text-6xl font-bold text-white/90">
                                        {{ substr($teacher->user->name, 0, 1) }}
                                    </span>
                                </div>
                            @endif

                            {{-- gradient dasar selalu ada supaya nama terbaca --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-azwara-darkest/90 via-azwara-darkest/10 to-transparent"></div>

                            {{-- Nama — selalu terlihat --}}
                            <div class="absolute inset-x-0 bottom-0 p-5 transition-transform duration-500 ease-out group-hover:-translate-y-1">
                                <h3 class="text-lg font-bold text-white leading-tight">
                                    {{ $teacher->user->name }}
                                </h3>
                                <p class="text-azwara-lighter text-xs font-medium mt-0.5 flex items-center gap-1.5">
                                    Tentor Satya Naratama
                                    <svg class="w-3.5 h-3.5 transition-transform duration-500 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </p>
                            </div>

                            {{-- Panel bio — reveal dari bawah saat hover / tap --}}
                            <div
                                tabindex="0"
                                class="absolute inset-0 bg-azwara-darkest/95 backdrop-blur-sm px-5 py-6 flex flex-col justify-center opacity-0 translate-y-3 pointer-events-none transition-all duration-500 ease-out group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto group-focus-within:opacity-100 group-focus-within:translate-y-0 group-focus-within:pointer-events-auto"
                            >
                                <p class="text-xs font-bold text-azwara-light uppercase tracking-widest mb-2">
                                    {{ $teacher->user->name }}
                                </p>
                                <p class="text-white/90 text-sm leading-relaxed whitespace-pre-line max-h-full overflow-y-auto pr-1">
                                    @if($teacher->bio)
                                        {{ $teacher->bio }}
                                    @else
                                        Tentor berpengalaman dengan metode pengajaran yang mudah dipahami dan fokus pada pemahaman konsep dasar.
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{-- Hint tap untuk mobile --}}
                        <button
                            type="button"
                            aria-label="Lihat profil {{ $teacher->user->name }}"
                            class="sm:hidden absolute top-3 right-3 h-8 w-8 rounded-full bg-white/90 flex items-center justify-center shadow-md"
                            onclick="this.closest('.group').classList.toggle('is-open'); this.closest('.group').querySelector('[tabindex]').classList.toggle('opacity-100'); this.closest('.group').querySelector('[tabindex]').classList.toggle('translate-y-0'); this.closest('.group').querySelector('[tabindex]').classList.toggle('pointer-events-auto');"
                        >
                            <svg class="w-4 h-4 text-azwara-medium" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-azwara-lighter text-azwara-medium mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5 0c-.66 0-1.293.092-1.892.262M10.5 21c.66 0 1.293-.092 1.892-.262M7 10.5h.01M21 10.5h.01"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-azwara-darkest mb-2">
                    Tim Tentor Sedang Disiapkan
                </h3>
                <p class="text-secondary max-w-md mx-auto">
                    Tim tentor profesional kami sedang mempersiapkan materi terbaik untuk kamu.
                </p>
            </div>
        @endif
    </div>
</section>