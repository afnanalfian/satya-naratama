{{-- resources/views/front/sections/courses.blade.php --}}
<section id="courses" class="scroll-mt-20 py-16 lg:py-24 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ==================== 01 — HERO ==================== --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 mb-20 lg:mb-28 items-center">

            {{-- Teks --}}
            <div class="lg:col-span-7 order-2 lg:order-1">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-primary/20 rounded-full mb-6 border border-primary/30">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                    <span class="text-[11px] font-bold text-primary uppercase tracking-[0.18em]">EPP‑10 · Program Unggulan</span>
                </div>

                <h1 class="font-bold text-white leading-[1.05] tracking-tight text-[2.5rem] sm:text-5xl lg:text-[3.4rem] mb-5">
                    Siap Tempur Menuju
                    <span class="block text-primary">Kedinasan Impian.</span>
                </h1>

                <p class="text-gray-300 text-base lg:text-lg max-w-lg mb-8 leading-relaxed">
                    Sepuluh bulan pembinaan akademik dan jasmani yang disusun seperti dokumen resmi —
                    terstruktur, terukur, dan diawasi tentor lulusan kedinasan.
                </p>

                {{-- CTA --}}
                <div class="flex flex-col sm:flex-row gap-3 mb-10">
                    <a href="{{ route('daftar.form') }}"
                       class="inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-primary text-white font-semibold rounded-lg hover:bg-red-700 transition-colors duration-300 shadow-lg shadow-red-500/30 hover:shadow-red-500/50">
                        Daftar Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="https://wa.me/6282154734819?text=Halo%20saya%20tertarik%20dengan%20Program%20EPP-10%20di%20Satya%20Naratama"
                       target="_blank"
                       class="inline-flex items-center justify-center gap-2 px-7 py-3.5 border border-primary/50 text-primary font-semibold rounded-lg hover:bg-primary hover:text-white hover:border-primary transition-colors duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.76.982.998-3.675-.236-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.9 6.994c-.004 5.45-4.438 9.88-9.888 9.88m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.333.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.333 11.893-11.893 0-3.18-1.24-6.162-3.495-8.411"/></svg>
                        Konsultasi WA
                    </a>
                </div>

                {{-- Stats --}}
                <div class="flex flex-wrap gap-x-10 gap-y-4 pt-6 border-t border-gray-800">
                    <div>
                        <div class="text-2xl font-bold text-white">160<span class="text-primary">+</span></div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mt-0.5">Sesi Akademik</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-white">120<span class="text-primary">+</span></div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mt-0.5">Sesi Jasmani</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-white">10</div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mt-0.5">Bulan Program</div>
                    </div>
                </div>
            </div>

            {{-- Gambar --}}
            <div class="lg:col-span-5 order-1 lg:order-2">
                <div class="relative max-w-md mx-auto lg:max-w-none">
                    <div class="absolute -top-3 -left-3 right-6 bottom-6 rounded-3xl border-2 border-primary/30 hidden sm:block"></div>
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-primary/20 aspect-[1517/1037] bg-black">
                        <img
                            src="{{ asset('front/img/hero-kedinasan.png') }}"
                            alt="Siswa EPP-10 Azwara Learning"
                            class="w-full h-full object-cover"
                            width="1517" height="1037"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                    </div>
                    {{-- Badge --}}
                    <div class="absolute -bottom-5 -right-2 sm:right-2 bg-black rounded-xl shadow-2xl shadow-primary/30 px-4 py-3 flex items-center gap-3 border border-primary/30">
                        <div class="h-9 w-9 rounded-lg bg-primary/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-white leading-none">Tentor Bersertifikat</div>
                            <div class="text-[11px] text-gray-400 mt-0.5">STIS · STAN · IPDN · AKPOL</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== 02 — PROGRAM ==================== --}}
        <div id="program-details" class="bg-gray-900 rounded-3xl shadow-2xl shadow-primary/10 border border-primary/20 overflow-hidden">

            {{-- Header --}}
            <div class="px-6 sm:px-10 pt-10 pb-8 border-b border-gray-800">
                <div class="flex items-baseline gap-3 mb-2">
                    <span class="text-xs font-bold text-primary tracking-[0.2em] uppercase">Lembar Program</span>
                    <span class="h-px flex-1 bg-gray-800"></span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-white">
                    Elite Preparation Program — 10 Bulan
                </h2>
            </div>

            {{-- Dua jalur --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 divide-y lg:divide-y-0 lg:divide-x divide-gray-800">

                {{-- 01 Akademik --}}
                <div class="px-6 sm:px-10 py-8">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="text-xs font-bold text-primary/60 tracking-widest">01</span>
                        <h3 class="text-lg font-bold text-white">Akademik</h3>
                    </div>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span>SKD (TIU, TWK, TKP), Psikotes, Bahasa Inggris, dan materi akademik dasar</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span><strong class="text-white">160+</strong> kelas tatap muka sepanjang 10 bulan</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span>Tryout CAT dan evaluasi akademik tiap bulan</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span>Pre-test dan post-test di setiap pertemuan</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span>Modul pembelajaran mandiri untuk latihan di rumah</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span>Diajar tentor lulusan STIS, STAN, dan jalur CPNS umum</span>
                        </li>
                    </ul>
                </div>

                {{-- 02 Jasmani --}}
                <div class="px-6 sm:px-10 py-8">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="text-xs font-bold text-primary/60 tracking-widest">02</span>
                        <h3 class="text-lg font-bold text-white">Jasmani</h3>
                    </div>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span><strong class="text-white">120+</strong> sesi bimbingan jasmani sepanjang 10 bulan</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span>Dievaluasi langsung oleh alumni IPDN dan alumni AKPOL</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span>Dilatih oleh trainer fisik profesional</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span>Paket latihan disesuaikan dengan kemampuan tiap siswa</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span>Latihan renang terjadwal minimal sekali per bulan</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 flex-shrink-0"></span>
                            <span>Pendampingan pola makan, istirahat, dan kesehatan harian</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Harga & CTA --}}
            <div class="bg-gradient-to-r from-primary/90 to-red-800 px-6 sm:px-10 py-9">
                <div class="flex flex-col lg:flex-row lg:items-center gap-7 lg:gap-10">

                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 rounded-full mb-3 border border-white/15">
                            <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></span>
                            <span class="text-[11px] font-bold text-white/90 uppercase tracking-widest">Harga yang Pangkep-able</span>
                        </div>
                        <div class="flex items-baseline gap-3 flex-wrap">
                            <span class="text-3xl sm:text-4xl font-bold text-white">Rp 6.000.000</span>
                            <span class="text-sm text-white/60 line-through">Rp 20.000.000</span>
                        </div>
                        <p class="text-white/70 text-xs mt-2">
                            Diskon tambahan Rp 500.000 untuk 10 pendaftar pertama · harga bimbel serupa di Makassar mencapai Rp 20.000.000
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 flex-shrink-0">
                        <a href="https://wa.me/6282154734819?text=Halo%20saya%20tertarik%20dengan%20Program%20EPP-10%20dan%20ingin%20mendaftar%20promo%20pertama"
                           target="_blank"
                           class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white/10 text-white font-semibold rounded-lg hover:bg-white/20 transition-colors duration-300 border border-white/15 text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.76.982.998-3.675-.236-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.9 6.994c-.004 5.45-4.438 9.88-9.888 9.88m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.333.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.333 11.893-11.893 0-3.18-1.24-6.162-3.495-8.411"/></svg>
                            Chat Admin
                        </a>
                        <a href="{{ route('daftar.form') }}"
                           class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-black font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-300 text-sm shadow-lg">
                            Daftar Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
