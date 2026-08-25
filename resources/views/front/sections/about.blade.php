<!-- resources/views/front/sections/about.blade.php -->
<section id="about" class="scroll-mt-20 py-16 lg:py-24 bg-white">
    <div class="container-custom">
        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-12 lg:gap-16">

            {{-- Image Section --}}
            <div class="w-full lg:w-1/2">
                <div class="relative rounded-2xl overflow-hidden shadow-elegant-lg">
                    <div class="absolute inset-0 bg-gradient-to-tr from-[#2563EB]/10 to-transparent"></div>
                    <img
                        src="{{ asset('front/img/about-1.png') }}"
                        alt="Tentang Satya Naratama"
                        class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-700"
                    >
                    {{-- Decorative accent --}}
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-[#2563EB]/10 rounded-full blur-2xl"></div>
                </div>
            </div>

            {{-- Content Section --}}
            <div class="w-full lg:w-1/2">
                <div class="max-w-2xl">
                    <span class="section-label mb-6 inline-block">
                        Tentang Kami
                    </span>

                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#0F172A] mb-6 leading-tight">
                        Memberikan Pendidikan Terbaik untuk
                        <span class="text-gradient-primary">Masa Depan Cerah</span>
                    </h2>

                    <div class="space-y-4 mb-8">
                        <p class="text-[#475569] text-md leading-relaxed">
                            Satya Naratama adalah platform bimbingan belajar profesional yang berkomitmen untuk memberikan pendidikan berkualitas tinggi dengan metode pengajaran yang inovatif dan efektif.
                        </p>
                    </div>

                    {{-- Features List --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] card-hover">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-[#2563EB]/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#0F172A] mb-1">Materi Terupdate</h4>
                                <p class="text-[#64748B] text-sm">Kurikulum sesuai dengan perkembangan terbaru pendidikan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] card-hover">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-[#2563EB]/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#0F172A] mb-1">Kelas Interaktif</h4>
                                <p class="text-[#64748B] text-sm">Sesi belajar dua arah dengan diskusi aktif dan interaktif.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] card-hover">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-[#2563EB]/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#0F172A] mb-1">Fleksibel Akses</h4>
                                <p class="text-[#64748B] text-sm">Rekaman Pembelajaran tersimpan dan dapat diakses kapan saja dimana saja.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] card-hover">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 bg-[#2563EB]/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#0F172A] mb-1">Practice Everyday</h4>
                                <p class="text-[#64748B] text-sm">Dilengkapi dengan post test dan quiz harian.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
