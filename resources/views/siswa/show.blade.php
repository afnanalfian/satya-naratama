<x-layouts.app :title="'Siswa · '.$user->name">
@php $r = $user->studentRegistration; @endphp
<x-page-header :title="$user->display_name" :sub="$user->email" :back="route('siswa.index')">
    <x-slot:actions>
        @if($user->whatsapp_phone)<a href="https://wa.me/{{ $user->whatsapp_phone }}" target="_blank" class="btn-lagoon"><x-icon name="whatsapp" class="h-4 w-4"/> WhatsApp</a>@endif
        <a href="{{ route('monitor.student', $user) }}" class="btn-soft"><x-icon name="chart" class="h-4 w-4"/> Rapor</a>
        @role('admin')<a href="{{ route('admin.students.edit', $user->id) }}" class="btn-ink"><x-icon name="pencil" class="h-4 w-4"/> Ubah data</a>@endrole
        <form method="POST" action="{{ route('siswa.toggle', $user->id) }}" data-confirm="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }} akun {{ $user->name }}?">@csrf
            <button class="{{ $user->is_active ? 'btn-danger' : 'btn-lagoon' }}"><x-icon name="power" class="h-4 w-4"/> {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button>
        </form>
    </x-slot:actions>
</x-page-header>
<div class="grid gap-6 lg:grid-cols-3">
    <div class="card overflow-hidden">
        <div class="bg-ink-900 p-6 text-center text-white">
            <img src="{{ $user->avatar_url }}" class="mx-auto h-28 w-28 rounded-[2rem] object-cover ring-4 ring-white/10" alt="">
            <p class="mt-4 font-display text-xl font-bold">{{ $user->display_name }}</p>
            <div class="mt-2 flex justify-center gap-1.5">
                <span class="badge {{ $user->is_active ? 'bg-lagoon-500 text-white' : 'bg-white/10 text-ink-200' }}">{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                @if($r?->class)<span class="badge bg-saffron-400 text-ink-900">Kelas {{ $r->class }}</span>@endif
            </div>
        </div>
        <dl class="space-y-3 p-6 text-sm">
            <div class="flex justify-between gap-2"><dt class="text-ink-400">HP</dt><dd class="font-bold">{{ $user->phone ?: '—' }}</dd></div>
            <div class="flex justify-between gap-2"><dt class="text-ink-400">Wilayah</dt><dd class="text-right font-bold">{{ $user->regency?->name ?? '—' }}</dd></div>
            <div class="flex justify-between gap-2"><dt class="text-ink-400">Bergabung</dt><dd class="font-bold">{{ $user->created_at?->translatedFormat('d M Y') }}</dd></div>
            <div class="flex justify-between gap-2"><dt class="text-ink-400">Email</dt><dd>{!! $user->hasVerifiedEmail() ? '<span class="badge-lagoon">Terverifikasi</span>' : '<span class="badge-gold">Belum</span>' !!}</dd></div>
        </dl>
        <div class="grid grid-cols-2 gap-2 border-t border-ink-50 p-4">
            <a href="{{ route('attendance.student', $user) }}" class="btn-soft btn-sm"><x-icon name="clipboard" class="h-4 w-4"/> Presensi</a>
            <a href="{{ route('physical.student', $user) }}" class="btn-soft btn-sm"><x-icon name="scale" class="h-4 w-4"/> Data fisik</a>
        </div>
    </div>
    <div class="card card-pad lg:col-span-2">
        <p class="section-title">Data pendaftaran</p>
        @if($r)
            <dl class="mt-4 grid gap-x-6 gap-y-3 text-sm sm:grid-cols-2">
                @foreach([
                    'Nama lengkap' => $r->full_name, 'Panggilan' => $r->nickname, 'Tanggal lahir' => $r->birth_date?->translatedFormat('d F Y').($r->birth_date ? ' ('.$r->birth_date->age.' th)' : ''),
                    'Jenis kelamin' => $r->gender_label, 'Asal sekolah' => $r->school_origin, 'No. WA siswa' => $r->phone,
                    'Kecamatan' => $r->kecamatan?->name, 'Kelurahan/Desa' => $r->kelurahan?->name, 'Tinggi / Berat' => ($r->height_cm ?: '–').' cm / '.($r->weight_kg ?: '–').' kg',
                    'Ukuran baju' => $r->shirt_size_label, 'Kampus impian 1' => $r->priority_university_1, 'Kampus impian 2' => $r->priority_university_2,
                    'Nama orang tua' => $r->parent_name, 'Pekerjaan' => $r->parent_occupation, 'HP orang tua' => $r->parent_phone,
                    'Status pendaftaran' => $r->registration_status_label,
                ] as $k => $v)
                    <div class="flex justify-between gap-3 border-b border-dashed border-ink-50 pb-2"><dt class="text-ink-400">{{ $k }}</dt><dd class="text-right font-bold">{{ $v ?: '—' }}</dd></div>
                @endforeach
            </dl>
        @else
            <x-empty icon="doc" title="Tidak ada data pendaftaran bimbel" text="Akun ini dibuat melalui pendaftaran akun umum (tryout/kuis)." class="mt-4"/>
        @endif
    </div>
</div>
</x-layouts.app>
