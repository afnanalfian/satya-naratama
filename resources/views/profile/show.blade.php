<x-layouts.app title="Profil Saya">
@php $u = auth()->user(); $r = $u->studentRegistration; @endphp
<div class="card overflow-hidden">
    <div class="relative h-40 bg-sunrise sm:h-48"><div class="absolute inset-0 bg-grid-ink [background-size:30px_30px] opacity-40"></div></div>
    <div class="relative px-6 pb-6">
        <div class="-mt-16 flex flex-col gap-4 sm:flex-row sm:items-end">
            <img src="{{ $u->avatar_url }}" class="h-32 w-32 rounded-[2rem] object-cover ring-8 ring-white" alt="">
            <div class="flex-1">
                <span class="badge-dark">{{ \App\Support\Menu::roleLabel($u) }}</span>
                <h1 class="mt-2 font-display text-3xl font-extrabold">{{ $u->display_name }}</h1>
                <p class="text-sm text-ink-500">{{ $u->email }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('profile.edit') }}" class="btn-ink"><x-icon name="pencil" class="h-4 w-4"/> Ubah profil</a>
                <a href="{{ route('profile.password') }}" class="btn-soft"><x-icon name="key" class="h-4 w-4"/> Password</a>
            </div>
        </div>
    </div>
</div>
<div class="mt-6 grid gap-6 lg:grid-cols-3">
    <div class="card card-pad">
        <p class="section-title">Kontak & wilayah</p>
        <dl class="mt-4 space-y-3 text-sm">
            <div class="flex justify-between gap-3"><dt class="text-ink-400">No. HP</dt><dd class="font-bold">{{ $u->phone ?: '—' }}</dd></div>
            <div class="flex justify-between gap-3"><dt class="text-ink-400">Provinsi</dt><dd class="text-right font-bold">{{ $u->province?->name ?? '—' }}</dd></div>
            <div class="flex justify-between gap-3"><dt class="text-ink-400">Kab/Kota</dt><dd class="text-right font-bold">{{ $u->regency?->name ?? '—' }}</dd></div>
            <div class="flex justify-between gap-3"><dt class="text-ink-400">Bergabung</dt><dd class="font-bold">{{ $u->created_at?->translatedFormat('d F Y') }}</dd></div>
            <div class="flex justify-between gap-3"><dt class="text-ink-400">Email</dt><dd>@if($u->hasVerifiedEmail())<span class="badge-lagoon">Terverifikasi</span>@else<span class="badge-gold">Belum verifikasi</span>@endif</dd></div>
        </dl>
    </div>
    @if($r)
    <div class="card card-pad lg:col-span-2">
        <p class="section-title">Data pendaftaran bimbel</p>
        <dl class="mt-4 grid gap-x-6 gap-y-3 text-sm sm:grid-cols-2">
            @foreach([
                'Nama lengkap' => $r->full_name, 'Panggilan' => $r->nickname, 'Tanggal lahir' => $r->birth_date?->translatedFormat('d F Y'),
                'Jenis kelamin' => $r->gender_label, 'Sekolah' => $r->school_origin.' · '.$r->class, 'No. WA' => $r->phone,
                'Domisili' => $r->full_address, 'Tinggi / berat' => ($r->height_cm ?: '–').' cm / '.($r->weight_kg ?: '–').' kg', 'Ukuran baju' => $r->shirt_size_label,
                'Kampus impian' => trim($r->priority_university_1.' '.($r->priority_university_2 ? '/ '.$r->priority_university_2 : '')),
                'Orang tua' => $r->parent_name.($r->parent_occupation ? ' ('.$r->parent_occupation.')' : ''), 'HP orang tua' => $r->parent_phone,
            ] as $k => $v)
                <div class="flex justify-between gap-3 border-b border-dashed border-ink-50 pb-2"><dt class="text-ink-400">{{ $k }}</dt><dd class="text-right font-bold">{{ $v ?: '—' }}</dd></div>
            @endforeach
        </dl>
    </div>
    @else
    <div class="card card-pad lg:col-span-2 flex flex-col justify-center">
        <p class="section-title">Keamanan akun</p>
        <p class="mt-2 text-sm text-ink-500">Kamu tetap masuk di perangkat ini sampai menekan tombol <b>Keluar</b>. Jika memakai perangkat umum, jangan lupa keluar setelah selesai.</p>
    </div>
    @endif
</div>
<div class="mt-6 flex justify-end">
    <a href="{{ route('profile.delete') }}" class="text-sm font-bold text-ink-400 hover:text-garnet-600">Nonaktifkan akun</a>
</div>
</x-layouts.app>
