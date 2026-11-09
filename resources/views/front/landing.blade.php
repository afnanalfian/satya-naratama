<x-layouts.public title="Satya Naratama – Bimbel Kedinasan TNI POLRI, Quiz Harian, & Tryout" description="Bimbingan Belajar Persiapan Kedinasan TNI POLRI lengkap paket latihan jasmani dan kelas belajar - Kabupaten Pangkajene dan Kepulauan.">
<x-slot:head>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"EducationalOrganization","name":"Satya Naratama","description":"Bimbel Kedinasan TNI POLRI, tryout beragam, quiz harian, live zoom, materi lengkap, latihan soal terbaru.","url":"{{ url('/') }}","logo":"{{ asset('img/logo.png') }}","address":{"@type":"PostalAddress","addressRegion":"Sulawesi Selatan","addressLocality":"Pangkajene dan Kepulauan","addressCountry":"ID"},"contactPoint":{"@type":"ContactPoint","telephone":"+62-851-4133-9645","contactType":"Customer Service","availableLanguage":"Indonesian"},"sameAs":["https://www.instagram.com/satya.naratama","https://www.tiktok.com/@satya.naratama","https://www.youtube.com/@SatyaNaratama"]}
</script>
</x-slot:head>

@php
    $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.');
    $campuses = ['AKPOL', 'AKMIL', 'STIS', 'STAN', 'IPDN', 'STMKG', 'SSN', 'STIN', 'STTD', 'POLTEKIMIPAS', 'UNHAN', 'BINTARA POLRI', 'TAMTAMA TNI'];
    $photos = collect(range(1, 7))->map(fn ($i) => asset("img/sn/$i.jpg"));
@endphp

{{-- ================= HERO ================= --}}
<section class="relative overflow-hidden">
    <div class="absolute inset-0 -z-10 bg-noise"></div>
    <div class="blob -left-32 top-0 -z-10 h-96 w-96 bg-garnet-300/40"></div>
    <div class="blob right-0 top-40 -z-10 h-96 w-96 bg-saffron-300/40"></div>

    <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 pb-16 pt-8 sm:px-6 lg:grid-cols-2 lg:pb-24 lg:pt-14">
        <div class="animate-fade-up">
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1.5 text-xs font-bold text-ink-700 shadow-soft ring-1 ring-ink-100">
                <span class="relative flex h-2 w-2"><span class="absolute h-2 w-2 animate-ping rounded-full bg-garnet-400"></span><span class="h-2 w-2 rounded-full bg-garnet-600"></span></span>
                Pendaftaran angkatan baru dibuka
            </span>
            <h1 class="mt-6 font-display text-[2.6rem] font-extrabold leading-[1.02] text-ink-950 sm:text-6xl lg:text-7xl">
                Dari <span class="relative whitespace-nowrap text-garnet-600">Pangkep<svg class="absolute -bottom-1 left-0 w-full text-saffron-400" viewBox="0 0 200 14" fill="none"><path d="M2 10c55-8 125-9 196-3" stroke="currentColor" stroke-width="5" stroke-linecap="round"/></svg></span>
                menuju <span class="bg-sunrise bg-clip-text text-transparent">seragam impian.</span>
            </h1>
            <p class="mt-6 max-w-xl text-base leading-relaxed text-ink-600 sm:text-lg">Bimbel persiapan <b>sekolah kedinasan & TNI–POLRI</b> yang melatih otak dan fisik sekaligus: kelas akademik, latihan jasmani terukur, kuis harian, tryout CAT, sampai laporan perkembangan untuk orang tua.</p>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('daftar.form') }}" class="btn-primary btn-lg">Daftar Bimbel Sekarang <x-icon name="arrow-right" class="h-5 w-5"/></a>
                <a href="#program" class="btn-outline btn-lg">Lihat Program</a>
            </div>
            <div class="mt-10 grid max-w-md grid-cols-3 gap-4">
                <div><p class="font-display text-3xl font-extrabold text-ink-900">{{ max($teachers->count(), 1) }}+</p><p class="text-xs font-semibold text-ink-500">Tentor & pelatih</p></div>
                <div><p class="font-display text-3xl font-extrabold text-ink-900">{{ max($courses->count(), 1) }}+</p><p class="text-xs font-semibold text-ink-500">Kelas aktif</p></div>
                <div><p class="font-display text-3xl font-extrabold text-ink-900">CAT</p><p class="text-xs font-semibold text-ink-500">Simulasi ujian</p></div>
            </div>
        </div>

        {{-- Kolase foto --}}
        <div class="relative mx-auto w-full max-w-lg lg:max-w-none">
            <div class="absolute -inset-4 -z-10 rotate-3 rounded-[3rem] bg-ink-900"></div>
            <div class="grid grid-cols-5 grid-rows-6 gap-3 rounded-[2.5rem] bg-ink-900 p-3" style="height: 520px">
                <img src="{{ $photos[0] }}" alt="Siswa Satya Naratama" class="col-span-3 row-span-4 h-full w-full rounded-[2rem] object-cover">
                <img src="{{ $photos[1] }}" alt="" class="col-span-2 row-span-3 h-full w-full rounded-[2rem] object-cover">
                <div class="col-span-2 row-span-3 flex flex-col justify-between rounded-[2rem] bg-sunrise p-4 text-white">
                    <x-icon name="trophy" class="h-8 w-8"/>
                    <p class="font-display text-lg font-extrabold leading-tight">Tryout CAT<br>berperingkat</p>
                </div>
                <img src="{{ $photos[2] }}" alt="" class="col-span-3 row-span-2 h-full w-full rounded-[2rem] object-cover">
            </div>
            <div class="absolute -left-4 top-10 hidden animate-float rounded-2xl bg-white p-3 shadow-lift sm:block">
                <div class="flex items-center gap-2"><span class="grid h-9 w-9 place-items-center rounded-xl bg-lagoon-100 text-lagoon-700"><x-icon name="run" class="h-5 w-5"/></span><div><p class="text-xs font-bold">Lari 12 menit</p><p class="text-[11px] text-ink-400">progres tercatat bulanan</p></div></div>
            </div>
            <div class="absolute -right-3 bottom-16 hidden animate-float rounded-2xl bg-white p-3 shadow-lift [animation-delay:1.5s] sm:block">
                <div class="flex items-center gap-2"><span class="grid h-9 w-9 place-items-center rounded-xl bg-saffron-100 text-saffron-700"><x-icon name="qr" class="h-5 w-5"/></span><div><p class="text-xs font-bold">Presensi QR</p><p class="text-[11px] text-ink-400">orang tua bisa memantau</p></div></div>
            </div>
        </div>
    </div>

    {{-- Marquee kampus --}}
    <div class="relative border-y-2 border-ink-900 bg-saffron-400 py-3">
        <div class="flex w-max animate-marquee gap-10 whitespace-nowrap font-display text-lg font-extrabold uppercase text-ink-900">
            @foreach(array_merge($campuses, $campuses) as $c)<span class="flex items-center gap-10">{{ $c }} <x-icon name="star" class="h-4 w-4"/></span>@endforeach
        </div>
    </div>
</section>

{{-- ================= PROGRAM ================= --}}
<section id="program" class="mx-auto max-w-7xl scroll-mt-24 px-4 py-20 sm:px-6">
    <div class="max-w-2xl">
        <p class="eyebrow">Program lengkap</p>
        <h2 class="mt-2 font-display text-3xl font-extrabold sm:text-5xl">Satu tempat untuk semua tes seleksi.</h2>
        <p class="mt-4 text-ink-500">Seleksi kedinasan & TNI–POLRI menguji akademik, jasmani, dan mental. Kami menyiapkan ketiganya dengan sistem yang terukur.</p>
    </div>
    <div class="mt-12 grid gap-4 md:grid-cols-6">
        <div class="card-ink p-7 md:col-span-4">
            <div class="absolute inset-0 bg-grid-ink [background-size:30px_30px]"></div>
            <div class="blob -right-10 -top-10 h-56 w-56 bg-garnet-600/50"></div>
            <div class="relative">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-saffron-400 text-ink-900"><x-icon name="book" class="h-6 w-6"/></span>
                <h3 class="mt-5 font-display text-2xl font-bold">Kelas Akademik</h3>
                <p class="mt-2 max-w-md text-sm text-ink-200">TIU, TWK, TKP, Matematika STIS/TKA, TPA & Bahasa Inggris. Tatap muka & live Zoom, materi PDF, rekaman video, dan post-test di setiap pertemuan.</p>
                <div class="mt-6 flex flex-wrap gap-2">@foreach(['TIU','TWK','TKP','MTK STIS','MTK TKA','TPA','TBI'] as $t)<span class="rounded-full bg-white/10 px-3 py-1 text-xs font-bold ring-1 ring-white/15">{{ $t }}</span>@endforeach</div>
            </div>
        </div>
        <div class="card-sunrise p-7 md:col-span-2">
            <span class="grid h-12 w-12 place-items-center rounded-2xl bg-white/20"><x-icon name="run" class="h-6 w-6"/></span>
            <h3 class="mt-5 font-display text-2xl font-bold">Latihan Jasmani</h3>
            <p class="mt-2 text-sm text-white/85">Lari 12 menit, pull up, push up, sit up, shuttle run — dievaluasi tiap bulan dengan grafik perkembangan.</p>
        </div>
        @foreach([
            ['trophy', 'Tryout CAT', 'Simulasi ujian berbasis komputer, timer server, peringkat, dan pembahasan lengkap.', 'garnet'],
            ['bolt', 'Kuis Harian', 'Latihan singkat setiap hari agar materi menempel lebih lama.', 'gold'],
            ['qr', 'Presensi QR', 'Absensi cepat dengan kartu QR, rekap otomatis per pertemuan.', 'lagoon'],
            ['heart', 'Pantauan Orang Tua', 'Link khusus orang tua: nilai tryout, kehadiran, dan perkembangan fisik.', 'ink'],
        ] as [$ic, $t, $d, $tone])
            <div class="card card-hover p-6 md:col-span-3 lg:col-span-{{ $loop->index < 2 ? 3 : 3 }}">
                <span class="grid h-11 w-11 place-items-center rounded-2xl {{ ['garnet'=>'bg-garnet-50 text-garnet-600','gold'=>'bg-saffron-50 text-saffron-700','lagoon'=>'bg-lagoon-50 text-lagoon-700','ink'=>'bg-ink-50 text-ink-700'][$tone] }}"><x-icon :name="$ic" class="h-6 w-6"/></span>
                <h3 class="mt-4 font-display text-xl font-bold">{{ $t }}</h3>
                <p class="mt-1.5 text-sm text-ink-500">{{ $d }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- ================= KELAS ================= --}}
@if($courses->count())
<section class="bg-white py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div><p class="eyebrow">Kelas pilihan</p><h2 class="mt-2 font-display text-3xl font-extrabold sm:text-4xl">Kelas yang sedang berjalan</h2></div>
            <a href="{{ route('browse.index') }}" class="btn-soft">Lihat semua paket <x-icon name="arrow-right" class="h-4 w-4"/></a>
        </div>
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($courses as $course)
                <article class="group card overflow-hidden card-hover">
                    <div class="relative aspect-[16/9] overflow-hidden bg-ink-900">
                        @if($course->thumbnail)
                            <img src="{{ asset('storage/'.$course->thumbnail) }}" alt="{{ $course->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                        @else
                            <div class="flex h-full items-center justify-center bg-sunrise"><x-icon name="book" class="h-14 w-14 text-white/80"/></div>
                        @endif
                        <div class="absolute left-3 top-3 flex gap-1.5"><x-course-type-badge :type="$course->type" class="!bg-white"/>@if($course->is_free)<span class="badge-lagoon !bg-white">Gratis</span>@endif</div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-display text-lg font-bold">{{ $course->name }}</h3>
                        <p class="mt-1 line-clamp-2 text-sm text-ink-500">{{ strip_tags($course->description) }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex -space-x-2">
                                @foreach($course->teachers->take(4) as $t)<img src="{{ $t->user?->avatar_url ?? asset('img/user.png') }}" title="{{ $t->user?->name }}" class="h-8 w-8 rounded-full object-cover ring-2 ring-white" alt="">@endforeach
                            </div>
                            <span class="text-xs font-bold text-ink-400">{{ $course->meetings_count }} pertemuan</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ================= JADWAL ================= --}}
<section id="jadwal" class="mx-auto max-w-7xl scroll-mt-24 px-4 py-20 sm:px-6">
    <div class="grid gap-10 lg:grid-cols-5">
        <div class="lg:col-span-2">
            <p class="eyebrow">Jadwal terdekat</p>
            <h2 class="mt-2 font-display text-3xl font-extrabold sm:text-4xl">Pertemuan & live class minggu ini</h2>
            <p class="mt-4 text-ink-500">Siswa terdaftar bisa langsung bergabung ke ruang Zoom dari dashboard saat kelas dimulai.</p>
            <img src="{{ $photos[3] }}" alt="" class="mt-8 hidden h-64 w-full rounded-[2rem] object-cover lg:block" loading="lazy">
        </div>
        <div class="space-y-3 lg:col-span-3">
            @forelse($meetings as $m)
                <div class="card flex items-center gap-4 p-4">
                    <div class="grid h-16 w-16 shrink-0 place-items-center rounded-2xl bg-ink-900 text-center text-white">
                        <div><p class="text-[10px] font-bold uppercase text-saffron-400">{{ $m->scheduled_at->translatedFormat('M') }}</p><p class="font-display text-2xl font-extrabold leading-none">{{ $m->scheduled_at->format('d') }}</p></div>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate font-bold">{{ $m->title }}</p>
                        <p class="truncate text-xs text-ink-500">{{ $m->course?->name }} · {{ $m->scheduled_at->translatedFormat('l, H:i') }}</p>
                    </div>
                    <x-status-badge :status="$m->status"/>
                </div>
            @empty
                <x-empty icon="calendar" title="Jadwal segera hadir" text="Pertemuan berikutnya sedang disiapkan oleh tentor."/>
            @endforelse
        </div>
    </div>
</section>

{{-- ================= PAKET & TRYOUT ================= --}}
@php $tryoutProducts = $products['tryout'] ?? collect(); $packages = $products['course_package'] ?? collect(); @endphp
@if($packages->count() || $tryoutProducts->count())
<section class="relative overflow-hidden bg-ink-950 py-20 text-white">
    <div class="absolute inset-0 bg-grid-ink [background-size:36px_36px]"></div>
    <div class="blob left-1/3 top-0 h-96 w-96 bg-garnet-700/40"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6">
        <p class="eyebrow !text-saffron-400">Paket belajar</p>
        <h2 class="mt-2 font-display text-3xl font-extrabold sm:text-4xl">Pilih paket sesuai target</h2>
        <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($packages->concat($tryoutProducts)->take(6) as $p)
                <div class="flex flex-col rounded-3xl bg-white/5 p-6 ring-1 ring-white/10 backdrop-blur transition hover:bg-white/10">
                    <span class="badge w-fit {{ $p['type'] === 'tryout' ? 'bg-garnet-600 text-white' : 'bg-saffron-400 text-ink-900' }}">{{ $p['type'] === 'tryout' ? 'Tryout' : 'Paket Kelas' }}</span>
                    <h3 class="mt-4 font-display text-xl font-bold">{{ $p['name'] }}</h3>
                    @if($p['description'])<p class="mt-2 line-clamp-3 text-sm text-ink-300">{{ strip_tags($p['description']) }}</p>@endif
                    @if(collect($p['bonuses'])->count())
                        <ul class="mt-4 space-y-1.5 text-sm">
                            @foreach($p['bonuses'] as $b)<li class="flex gap-2"><x-icon name="gift" class="h-4 w-4 shrink-0 text-saffron-400"/> Bonus: {{ $b['data']->title ?? $b['data']->name ?? '-' }}</li>@endforeach
                        </ul>
                    @endif
                    <div class="mt-auto pt-6">
                        <p class="font-display text-3xl font-extrabold text-saffron-400">{{ ($p['pricing']['price'] ?? 0) > 0 ? $rp($p['pricing']['price']) : 'Gratis' }}</p>
                        @if(($p['pricing']['type'] ?? '') === 'per_unit')<p class="text-xs text-ink-400">per pertemuan</p>@endif
                        <a href="{{ auth()->check() ? route('browse.index') : route('login') }}" class="btn-white mt-4 w-full">Ambil paket</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ================= TENTOR ================= --}}
@if($teachers->count())
<section id="tentor" class="mx-auto max-w-7xl scroll-mt-24 px-4 py-20 sm:px-6">
    <div class="text-center">
        <p class="eyebrow">Tim pengajar</p>
        <h2 class="mt-2 font-display text-3xl font-extrabold sm:text-4xl">Tentor & pelatih berpengalaman</h2>
    </div>
    <div class="mt-12 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        @foreach($teachers as $t)
            <div class="group card overflow-hidden text-center card-hover">
                <div class="relative aspect-square overflow-hidden bg-gradient-to-br from-ink-100 to-saffron-100">
                    <img src="{{ $t->user?->avatar_url ?? asset('img/user.png') }}" alt="{{ $t->user?->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                    <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-ink-950/80 to-transparent"></div>
                    <p class="absolute inset-x-3 bottom-3 font-display text-base font-bold text-white sm:text-lg">{{ $t->user?->name }}</p>
                </div>
                <div class="p-4">
                    <p class="line-clamp-2 text-xs text-ink-500">{{ $t->bio ?: 'Tentor Satya Naratama' }}</p>
                    <div class="mt-2 flex flex-wrap justify-center gap-1">@foreach($t->courses->take(2) as $c)<span class="badge-ink">{{ \Illuminate\Support\Str::limit($c->name, 18) }}</span>@endforeach</div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

{{-- ================= GALERI ================= --}}
<section class="overflow-hidden py-10">
    <div class="flex w-max animate-marquee gap-4 [animation-duration:60s]">
        @foreach($photos->concat($photos) as $ph)
            <img src="{{ $ph }}" alt="Kegiatan Satya Naratama" class="h-56 w-80 rounded-[2rem] object-cover sm:h-72 sm:w-96" loading="lazy">
        @endforeach
    </div>
</section>

{{-- ================= CARA DAFTAR ================= --}}
<section class="mx-auto max-w-7xl px-4 py-20 sm:px-6">
    <div class="relative overflow-hidden rounded-[2.5rem] bg-sunrise p-8 text-white sm:p-14">
        <div class="absolute -right-20 -top-20 h-80 w-80 animate-spin-slow rounded-full border-[40px] border-white/10"></div>
        <div class="relative grid gap-10 lg:grid-cols-2 lg:items-center">
            <div>
                <h2 class="font-display text-3xl font-extrabold sm:text-5xl">Siap mulai berlatih?</h2>
                <p class="mt-4 max-w-md text-white/90">Daftar online dalam 5 menit. Setelah pembayaran diverifikasi, akun belajar langsung aktif dan kamu bisa ikut kelas, kuis, dan tryout.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('daftar.form') }}" class="btn-lg btn bg-ink-950 text-white hover:bg-ink-900">Daftar Sekarang <x-icon name="arrow-right" class="h-5 w-5"/></a>
                    <a href="https://wa.me/{{ config('satya.cs_wa') }}" target="_blank" class="btn-lg btn bg-white/15 text-white ring-1 ring-white/30 hover:bg-white/25"><x-icon name="whatsapp" class="h-5 w-5"/> Tanya Admin</a>
                </div>
            </div>
            <ol class="grid gap-3">
                @foreach(['Isi formulir pendaftaran online', 'Transfer biaya & unggah bukti', 'Admin verifikasi, akun aktif', 'Mulai kelas, kuis & tryout'] as $i => $s)
                    <li class="flex items-center gap-4 rounded-2xl bg-white/10 p-4 ring-1 ring-white/20 backdrop-blur">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-white font-display text-lg font-extrabold text-garnet-600">{{ $i + 1 }}</span>
                        <span class="font-bold">{{ $s }}</span>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>

@if($activePromo)
    @include('front.partials.promo', ['promo' => $activePromo])
@endif
</x-layouts.public>
