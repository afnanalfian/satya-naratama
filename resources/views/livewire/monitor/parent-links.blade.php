<div>
    <x-page-header title="Link Pantauan Orang Tua" sub="Bagikan link rahasia ini ke orang tua/wali agar bisa memantau perkembangan anak tanpa login."/>
    <div class="mb-4 max-w-md"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari nama siswa / orang tua…"/></div>

    <div class="grid gap-3">
        @forelse($students as $s)
            @php
                $reg = $s->studentRegistration;
                $wa = $reg?->parent_phone ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $reg->parent_phone)) : null;
                $msg = "Assalamu'alaikum Bapak/Ibu {$reg?->parent_name}, berikut link pantauan belajar {$s->display_name} di Satya Naratama: {$s->parent_monitor_url}";
            @endphp
            <div wire:key="s-{{ $s->id }}" class="card flex flex-col gap-4 p-4 md:flex-row md:items-center">
                <div class="flex min-w-0 flex-1 items-center gap-3">
                    <img src="{{ $s->avatar_url }}" class="h-11 w-11 rounded-2xl object-cover" alt="">
                    <div class="min-w-0">
                        <p class="truncate font-bold">{{ $s->display_name }} @unless($s->is_active)<span class="badge-ink ml-1">Nonaktif</span>@endunless</p>
                        <p class="truncate text-xs text-ink-400">Ortu: {{ $reg?->parent_name ?? '—' }} {{ $reg?->parent_phone ? '· '.$reg->parent_phone : '' }}</p>
                    </div>
                </div>
                <div class="flex min-w-0 items-center gap-2 rounded-2xl bg-cream px-3 py-2 md:w-96" x-data>
                    <x-icon name="link" class="h-4 w-4 shrink-0 text-ink-400"/>
                    <span class="truncate font-mono text-xs text-ink-600">{{ $s->parent_monitor_url }}</span>
                    <button @click="$copy(@js($s->parent_monitor_url), 'Link disalin')" class="ml-auto rounded-lg p-1 text-ink-500 hover:bg-white hover:text-ink-900" title="Salin"><x-icon name="copy" class="h-4 w-4"/></button>
                </div>
                <div class="flex flex-wrap gap-2">
                    @if($wa)<a href="https://wa.me/{{ $wa }}?text={{ urlencode($msg) }}" target="_blank" class="btn-lagoon btn-sm"><x-icon name="whatsapp" class="h-4 w-4"/> Kirim</a>@endif
                    <a href="{{ route('monitor.student', $s) }}" class="btn-soft btn-sm"><x-icon name="eye" class="h-4 w-4"/> Rapor</a>
                    <button x-data @click="$confirm('Buat link baru? Link lama akan langsung tidak berlaku.', () => $wire.regenerate({{ $s->id }}), { okText: 'Buat ulang' })" class="btn-danger btn-sm"><x-icon name="refresh" class="h-4 w-4"/></button>
                </div>
            </div>
        @empty
            <x-empty icon="users" title="Siswa tidak ditemukan"/>
        @endforelse
    </div>
    {{ $students->links() }}
</div>
