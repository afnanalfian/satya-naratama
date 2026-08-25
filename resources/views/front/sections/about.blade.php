<section id="about" class="scroll-mt-20 py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-12 lg:gap-16">
            {{-- Image --}}
            <div class="w-full lg:w-1/2">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img
                        src="{{ asset('front/img/about-1.png') }}"
                        alt="Tentang Satya Naratama"
                        class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-700"
                    >
                    {{-- Accent border --}}
                    <div class="absolute inset-0 border-2 border-primary/20 rounded-2xl pointer-events-none"></div>
                </div>
            </div>

            {{-- Content --}}
            <div class="w-full lg:w-1/2">
                <div class="max-w-2xl">
                    <span class="inline-block px-4 py-2 bg-primary/10 text-primary text-sm font-semibold rounded-full mb-6">
                        Tentang Kami
                    </span>

                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-secondary mb-6 leading-tight">
                        Memberikan Pendidikan Terbaik untuk
                        <span class="text-primary">Masa Depan Cerah</span>
                    </h2>

                    <div class="space-y-4 mb-8">
                        <p class="text-secondary/80 text-md leading-relaxed">
                            Satya Naratama adalah platform bimbingan belajar profesional yang berkomitmen untuk memberikan pendidikan berkualitas tinggi dengan metode pengajaran yang inovatif dan efektif.
                        </p>
                    </div>

                    {{-- Features --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
                        <div class="flex items-start gap-4 group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                    <svg class="w-5 h-5 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-secondary mb-1">Materi Terupdate</h4>
                                <p class="text-secondary/70 text-sm">Kurikulum sesuai dengan perkembangan terbaru pendidikan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                    <svg class="w-5 h-5 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-secondary mb-1">Kelas Interaktif</h4>
                                <p class="text-secondary/70 text-sm">Sesi belajar dua arah dengan diskusi aktif dan interaktif.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                    <svg class="w-5 h-5 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-secondary mb-1">Fleksibel Akses</h4>
                                <p class="text-secondary/70 text-sm">Rekaman Pembelajaran tersimpan dan dapat diakses kapan saja.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 group">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                    <svg class="w-5 h-5 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-secondary mb-1">Practice Everyday</h4>
                                <p class="text-secondary/70 text-sm">Dilengkapi dengan post test dan quiz harian.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
