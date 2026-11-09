<div class="relative" x-data="{ o: false }" @click.outside="o=false" wire:poll.45s.visible>
    <button @click="o=!o" class="relative btn-icon btn-ghost" title="Notifikasi">
        <x-icon name="bell" class="h-6 w-6 {{ $unread ? 'animate-wiggle text-garnet-600' : '' }}"/>
        @if($unread)<span class="absolute -right-0.5 -top-0.5 grid h-5 min-w-[20px] place-items-center rounded-full bg-garnet-600 px-1 text-[10px] font-extrabold text-white ring-2 ring-cream">{{ $unread > 99 ? '99+' : $unread }}</span>@endif
    </button>
    <div x-show="o" x-transition x-cloak class="absolute right-0 mt-2 w-[min(92vw,360px)] overflow-hidden rounded-3xl bg-white shadow-lift ring-1 ring-ink-100">
        <div class="flex items-center justify-between bg-ink-900 px-4 py-3 text-white">
            <p class="font-display font-bold">Notifikasi</p>
            @if($unread)<button wire:click="readAll" class="text-xs font-bold text-saffron-300 hover:text-white">Tandai semua dibaca</button>@endif
        </div>
        <div class="max-h-96 divide-y divide-ink-50 overflow-y-auto">
            @forelse($latest as $n)
                <a href="{{ route('notifications.read', $n->id) }}" class="flex gap-3 px-4 py-3 hover:bg-cream {{ $n->read_at ? '' : 'bg-saffron-50/60' }}">
                    <span class="mt-1.5 dot shrink-0 {{ $n->read_at ? 'bg-ink-200' : 'bg-garnet-500' }}"></span>
                    <span class="min-w-0 flex-1">
                        <span class="line-clamp-2 text-sm {{ $n->read_at ? 'text-ink-500' : 'font-semibold text-ink-900' }}">{{ $n->data['message'] ?? '-' }}</span>
                        <span class="text-[11px] text-ink-400">{{ $n->created_at->diffForHumans() }}</span>
                    </span>
                </a>
            @empty
                <div class="px-4 py-10 text-center text-sm text-ink-400">Belum ada notifikasi 🎉</div>
            @endforelse
        </div>
        <a href="{{ route('notifications.index') }}" class="block border-t border-ink-50 py-3 text-center text-sm font-bold text-garnet-600 hover:bg-cream">Lihat semua</a>
    </div>
</div>
