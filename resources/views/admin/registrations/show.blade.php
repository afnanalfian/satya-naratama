<x-layouts.app :title="'Pendaftaran · '.$registration->full_name">
@php $r = $registration; @endphp
<x-page-header :title="$r->full_name" :sub="'#'.str_pad($r->id, 6, '0', STR_PAD_LEFT).' · daftar '.$r->created_at->translatedFormat('d F Y H:i')" :back="route('admin.registrations.index')">
    <x-slot:actions>
        <x-status-badge :status="$r->registration_status" class="!text-xs"/>
        <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/\D/', '', $r->phone)) }}" target="_blank" class="btn-lagoon btn-sm"><x-icon name="whatsapp" class="h-4 w-4"/> Siswa</a>
        <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/\D/', '', $r->parent_phone)) }}" target="_blank" class="btn-soft btn-sm"><x-icon name="whatsapp" class="h-4 w-4"/> Ortu</a>
        @if(in_array($r->registration_status, ['draft', 'rejected']))
            <form method="POST" action="{{ route('admin.registrations.destroy', $r->id) }}" data-confirm="Hapus data pendaftaran ini?">@csrf @method('DELETE')<button class="btn-ghost btn-icon hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/></button></form>
        @endif
    </x-slot:actions>
</x-page-header>
<div class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <div class="card card-pad">
            <div class="flex items-center gap-4"><img src="{{ $r->avatar ? asset('storage/'.$r->avatar) : asset('img/user.png') }}" class="h-20 w-20 rounded-3xl object-cover" alt=""><div><p class="font-display text-xl font-bold">{{ $r->full_name }} @if($r->nickname)<span class="text-ink-400">({{ $r->nickname }})</span>@endif</p><p class="text-sm text-ink-500">{{ $r->email }}</p></div></div>
            <dl class="mt-6 grid gap-x-6 gap-y-3 text-sm sm:grid-cols-2">
                @foreach(['Tanggal lahir' => $r->birth_date?->translatedFormat('d F Y').' ('.$r->birth_date?->age.' th)', 'Jenis kelamin' => $r->gender_label, 'Sekolah' => $r->school_origin.' · '.$r->class, 'No. WA' => $r->phone, 'Domisili' => $r->full_address, 'Tinggi / berat' => ($r->height_cm ?: '–').' cm / '.($r->weight_kg ?: '–').' kg', 'Ukuran baju' => $r->shirt_size_label, 'Kampus impian' => $r->priority_university_1.($r->priority_university_2 ? ' / '.$r->priority_university_2 : ''), 'Orang tua' => $r->parent_name.($r->parent_occupation ? ' · '.$r->parent_occupation : ''), 'HP orang tua' => $r->parent_phone, 'IP' => $r->ip_address] as $k => $v)
                    <div class="flex justify-between gap-3 border-b border-dashed border-ink-50 pb-2"><dt class="text-ink-400">{{ $k }}</dt><dd class="text-right font-bold">{{ $v ?: '—' }}</dd></div>
                @endforeach
            </dl>
        </div>
        @if($r->isVerified())
            <div class="rounded-3xl bg-lagoon-50 p-5 text-sm text-lagoon-900 ring-1 ring-lagoon-100"><b>Terverifikasi</b> oleh {{ $r->verifiedBy?->name ?? '—' }} pada {{ $r->verified_at?->translatedFormat('d M Y H:i') }}. @if($r->user_id)<a href="{{ route('siswa.show', $r->user_id) }}" class="link">Lihat akun siswa →</a>@endif @if($r->verification_notes)<br>Catatan: {{ $r->verification_notes }}@endif</div>
        @elseif($r->isRejected())
            <div class="rounded-3xl bg-garnet-50 p-5 text-sm text-garnet-900 ring-1 ring-garnet-100"><b>Ditolak</b> {{ $r->rejected_at?->translatedFormat('d M Y H:i') }}. Alasan: {{ $r->rejection_reason }}</div>
        @endif
    </div>
    <div class="space-y-6">
        <div class="card card-pad">
            <p class="section-title">Pembayaran</p>
            <p class="mt-2 font-display text-3xl font-extrabold">Rp {{ number_format($r->registration_fee, 0, ',', '.') }}</p>
            <p class="text-xs text-ink-400">{{ $r->payment_status_label }} {{ $r->invoice ? '· '.$r->invoice->invoice_number : '' }}</p>
            @if($r->payment_proof)
                <a href="{{ asset('storage/'.$r->payment_proof) }}" target="_blank"><img src="{{ asset('storage/'.$r->payment_proof) }}" class="mt-4 w-full rounded-2xl object-contain ring-1 ring-ink-100" alt="Bukti"></a>
                <a href="{{ route('admin.registrations.download-proof', $r->id) }}" class="btn-soft btn-sm mt-2 w-full"><x-icon name="download" class="h-4 w-4"/> Unduh bukti</a>
            @else
                <p class="mt-4 rounded-2xl bg-cream p-4 text-center text-sm text-ink-400">Belum ada bukti pembayaran.</p>
            @endif
        </div>
        @if($r->registration_status === 'awaiting_verification')
            <form method="POST" action="{{ route('admin.registrations.verify', $r->id) }}" class="card card-pad" data-confirm="Verifikasi & buat akun siswa untuk {{ $r->full_name }}?" data-danger="0" data-ok="Verifikasi">@csrf
                <p class="section-title">Verifikasi</p>
                <textarea name="verification_notes" class="textarea mt-3 !min-h-[70px]" placeholder="Catatan (opsional)"></textarea>
                <button class="btn-lagoon mt-3 w-full"><x-icon name="check" class="h-4 w-4"/> Verifikasi & buat akun</button>
            </form>
        @endif
        @unless($r->isVerified() || $r->isRejected())
            <form method="POST" action="{{ route('admin.registrations.reject', $r->id) }}" class="card card-pad" data-confirm="Tolak pendaftaran ini? Email pemberitahuan akan dikirim.">@csrf
                <p class="section-title">Tolak</p>
                <textarea name="rejection_reason" class="textarea mt-3 !min-h-[70px]" required minlength="10" placeholder="Alasan penolakan (min. 10 karakter)">{{ old('rejection_reason') }}</textarea>
                @error('rejection_reason')<p class="error">{{ $message }}</p>@enderror
                <button class="btn-danger mt-3 w-full">Tolak pendaftaran</button>
            </form>
        @endunless
    </div>
</div>
</x-layouts.app>
