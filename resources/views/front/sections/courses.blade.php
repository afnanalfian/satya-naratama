{{-- resources/views/front/sections/courses.blade.php --}}
<section id="courses" class="scroll-mt-20 py-16 lg:py-24 bg-azwara-lightest">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ==================== 01 — HERO ==================== --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 mb-20 lg:mb-28 items-center">

            {{-- Teks --}}
            <div class="lg:col-span-7 order-2 lg:order-1">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-azwara-medium/10 rounded-full mb-6 border border-azwara-medium/20">
                    <span class="w-1.5 h-1.5 bg-azwara-medium rounded-full"></span>
                    <span class="text-[11px] font-bold text-azwara-medium uppercase tracking-[0.18em]">EPP&#8209;10 · Program Unggulan</span>
                </div>

                <h1 class="font-bold text-azwara-darkest leading-[1.05] tracking-tight text-[2.5rem] sm:text-5xl lg:text-[3.4rem] mb-5">
                    Siap Tempur Menuju
                    <span class="block text-azwara-medium">Kedinasan Impian.</span>
                </h1>

                <p class="text-secondary/80 text-base lg:text-lg max-w-lg mb-8 leading-relaxed">
                    Sepuluh bulan pembinaan akademik dan jasmani yang disusun seperti dokumen resmi —
                    terstruktur, terukur, dan diawasi tentor lulusan kedinasan.
                </p>

                {{-- CTA --}}
                <div class="flex flex-col sm:flex-row gap-3 mb-10">
                    <a href="{{ route('daftar.form') }}"
                       class="inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-azwara-medium text-white font-semibold rounded-lg hover:bg-azwara-darker transition-colors duration-300 shadow-md shadow-azwara-medium/20">
                        Daftar Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="https://wa.me/6282154734819?text=Halo%20saya%20tertarik%20dengan%20Program%20EPP-10%20di%20Azwara%20Learning"
                       target="_blank"
                       class="inline-flex items-center justify-center gap-2 px-7 py-3.5 border border-azwara-medium/30 text-azwara-medium font-semibold rounded-lg hover:bg-azwara-medium hover:text-white hover:border-azwara-medium transition-colors duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.76.982.998-3.675-.236-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.9 6.994c-.004 5.45-4.438 9.88-9.888 9.88m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.333.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.333 11.893-11.893 0-3.18-1.24-6.162-3.495-8.411"/></svg>
                        Konsultasi WA
                    </a>
                </div>

                {{-- Stats sebagai garis "dokumen" --}}
                <div class="flex flex-wrap gap-x-10 gap-y-4 pt-6 border-t border-azwara-lighter">
                    <div>
                        <div class="text-2xl font-bold text-azwara-darkest">160<span class="text-azwara-medium">+</span></div>
                        <div class="text-xs text-secondary/70 uppercase tracking-wide mt-0.5">Sesi Akademik</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-azwara-darkest">120<span class="text-azwara-medium">+</span></div>
                        <div class="text-xs text-secondary/70 uppercase tracking-wide mt-0.5">Sesi Jasmani</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-azwara-darkest">10</div>
                        <div class="text-xs text-secondary/70 uppercase tracking-wide mt-0.5">Bulan Program</div>
                    </div>
                </div>
            </div>

            {{-- Gambar — elemen nyata, bukan background --}}
            <div class="lg:col-span-5 order-1 lg:order-2">
                <div class="relative max-w-md mx-auto lg:max-w-none">
                    {{-- frame aksen ala dokumen resmi --}}
                    <div class="absolute -top-3 -left-3 right-6 bottom-6 rounded-3xl border-2 border-azwara-medium/25 hidden sm:block"></div>
                    <div class="relative rounded-3xl overflow-hidden shadow-xl shadow-azwara-darkest/15 aspect-[1517/1037] bg-azwara-darker">
                        <img
                            src="{{ asset('front/img/hero-kedinasan.png') }}"
                            alt="Siswa EPP-10 Azwara Learning"
                            class="w-full h-full object-cover"
                            width="1517" height="1037"
                        >
                    </div>
                    {{-- badge mengambang --}}
                    <div class="absolute -bottom-5 -right-2 sm:right-2 bg-white rounded-xl shadow-lg px-4 py-3 flex items-center gap-3 border border-azwara-lighter">
                        <div class="h-9 w-9 rounded-lg bg-azwara-medium/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4.5 h-4.5 text-azwara-medium" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-azwara-darkest leading-none">Tentor Bersertifikat</div>
                            <div class="text-[11px] text-secondary/70 mt-0.5">STIS · STAN · IPDN · AKPOL . DLL</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ==================== 02 — PROGRAM, HARGA & CTA ==================== --}}
        <div id="program-details" class="bg-white rounded-3xl shadow-xl shadow-azwara-darkest/5 border border-azwara-lighter/60 overflow-hidden">

            {{-- Header dokumen --}}
            <div class="px-6 sm:px-10 pt-10 pb-8 border-b border-azwara-lighter/60">
                <div class="flex items-baseline gap-3 mb-2">
                    <span class="text-xs font-bold text-azwara-medium tracking-[0.2em] uppercase">Lembar Program</span>
                    <span class="h-px flex-1 bg-azwara-lighter"></span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-azwara-darkest">
                    Elite Preparation Program — 10 Bulan
                </h2>
            </div>

            {{-- Dua jalur: akademik & jasmani --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 divide-y lg:divide-y-0 lg:divide-x divide-azwara-lighter/60">

                {{-- 01 Akademik --}}
                <div class="px-6 sm:px-10 py-8">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="text-xs font-bold text-azwara-medium/60 tracking-widest">01</span>
                        <h3 class="text-lg font-bold text-azwara-darkest">Akademik</h3>
                    </div>
                    <ul class="space-y-3 text-sm text-secondary/90">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span>SKD (TIU, TWK, TKP), Psikotes, Bahasa Inggris, dan materi akademik dasar</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span><strong class="text-azwara-darkest">160+</strong> kelas tatap muka sepanjang 10 bulan</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span>Tryout CAT dan evaluasi akademik tiap bulan</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span>Pre-test dan post-test di setiap pertemuan</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span>Modul pembelajaran mandiri untuk latihan di rumah</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span>Diajar tentor lulusan STIS, STAN, dan jalur CPNS umum</span>
                        </li>
                    </ul>
                </div>

                {{-- 02 Jasmani --}}
                <div class="px-6 sm:px-10 py-8">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="text-xs font-bold text-azwara-medium/60 tracking-widest">02</span>
                        <h3 class="text-lg font-bold text-azwara-darkest">Jasmani</h3>
                    </div>
                    <ul class="space-y-3 text-sm text-secondary/90">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span><strong class="text-azwara-darkest">120+</strong> sesi bimbingan jasmani sepanjang 10 bulan</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span>Dievaluasi langsung oleh alumni IPDN dan alumni AKPOL</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span>Dilatih oleh trainer fisik profesional</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span>Paket latihan disesuaikan dengan kemampuan tiap siswa</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span>Latihan renang terjadwal minimal sekali per bulan</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-azwara-medium mt-1.5 flex-shrink-0"></span>
                            <span>Pendampingan pola makan, istirahat, dan kesehatan harian</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Harga & CTA — penutup dokumen --}}
            <div class="bg-brand-gradient px-6 sm:px-10 py-9">
                <div class="flex flex-col lg:flex-row lg:items-center gap-7 lg:gap-10">

                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 rounded-full mb-3 border border-white/15">
                            <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></span>
                            <span class="text-[11px] font-bold text-white/90 uppercase tracking-widest">Harga yang Pangkep-able</span>
                        </div>
                        <div class="flex items-baseline gap-3 flex-wrap">
                            <span class="text-3xl sm:text-4xl font-bold text-white">Rp 6.000.000</span>
                            <span class="text-sm text-azwara-lighter/70 line-through">Rp 20.000.000</span>
                        </div>
                        <p class="text-azwara-lighter/80 text-xs mt-2">
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
                           class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-azwara-darkest font-semibold rounded-lg hover:bg-azwara-lightest transition-colors duration-300 text-sm shadow-md">
                            Daftar Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>