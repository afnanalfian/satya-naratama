{{-- resources/views/front/sections/about.blade.php --}}
<section id="about" class="scroll-mt-20 py-16 lg:py-24 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-12 lg:gap-16">
            {{-- Image Section --}}
            <div class="w-full lg:w-1/2">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-primary/20">
                    {{-- Decorative border --}}
                    <div class="absolute -inset-1 bg-gradient-to-r from-primary to-red-700 rounded-2xl blur opacity-20"></div>
                    <div class="relative">
                        <img
                            src="{{ asset('front/img/about-1.png') }}"
                            alt="Tentang Satya Naratama"
                            class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-700"
                        >
                        {{-- Overlay gradient --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    </div>
                    {{-- Badge --}}
                    <div class="absolute -bottom-4 -right-4 bg-primary rounded-xl px-6 py-3 shadow-xl shadow-red-500/30">
                        <p class="text-white font-bold text-xl">5+</p>
                        <p class="text-white/80 text-xs">Tahun Pengalaman</p>
                    </div>
                </div>
            </div>

            {{-- Content Section --}}
            <div class="w-full lg:w-1/2">
                <div class="max-w-2xl">
                    {{-- Section Label --}}
                    <span class="inline-block px-4 py-2 bg-primary/20 text-primary text-sm font-semibold rounded-full mb-6 border border-primary/30">
                        Tentang Kami
                    </span>

                    {{-- Title --}}
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-6 leading-tight">
                        Memberikan Pendidikan Terbaik untuk
                        <span class="text-primary">Masa Depan Cerah</span>
                    </h2>

                    {{-- Description --}}
                    <div class="space-y-4 mb-8">
                        <p class="text-gray-300 text-md leading-relaxed">
                            Satya Naratama adalah platform bimbingan belajar profesional yang berkomitmen untuk memberikan pendidikan berkualitas tinggi dengan metode pengajaran yang inovatif dan efektif.
                        </p>
                    </div>

                    {{-- Features List --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
                        <div class="flex items-start gap-4 bg-white/5 p-4 rounded-xl border border-white/10 hover:border-primary/50 transition-all duration-300 group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary transition-colors duration-300">
                                    <svg class="w-5 h-5 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">Materi Terupdate</h4>
                                <p class="text-gray-400 text-sm">Kurikulum sesuai dengan perkembangan terbaru pendidikan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 bg-white/5 p-4 rounded-xl border border-white/10 hover:border-primary/50 transition-all duration-300 group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary transition-colors duration-300">
                                    <svg class="w-5 h-5 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">Kelas Interaktif</h4>
                                <p class="text-gray-400 text-sm">Sesi belajar dua arah dengan diskusi aktif dan interaktif.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 bg-white/5 p-4 rounded-xl border border-white/10 hover:border-primary/50 transition-all duration-300 group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary transition-colors duration-300">
                                    <svg class="w-5 h-5 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">Fleksibel Akses</h4>
                                <p class="text-gray-400 text-sm">Rekaman Pembelajaran tersimpan dan dapat diakses kapan saja.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 bg-white/5 p-4 rounded-xl border border-white/10 hover:border-primary/50 transition-all duration-300 group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary transition-colors duration-300">
                                    <svg class="w-5 h-5 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">Practice Everyday</h4>
                                <p class="text-gray-400 text-sm">Dilengkapi dengan post test dan quiz harian.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
