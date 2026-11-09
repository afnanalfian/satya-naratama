<div>
    <x-page-header title="Notifikasi" :sub="$unreadCount ? $unreadCount.' belum dibaca' : 'Semua sudah dibaca'">
        <x-slot:actions>
            <button wire:click="readAll" class="btn-soft" @disabled(! $unreadCount)><x-icon name="check" class="h-4 w-4"/> Tandai semua dibaca</button>
            <button x-data @click="$confirm('Hapus semua notifikasi?', () => $wire.clear())" class="btn-danger"><x-icon name="trash" class="h-4 w-4"/> Hapus semua</button>
        </x-slot:actions>
    </x-page-header>
    <div class="tabs mb-4">
        <button wire:click="$set('filter','all')" class="tab {{ $filter === 'all' ? 'tab-active' : '' }}">Semua</button>
        <button wire:click="$set('filter','unread')" class="tab {{ $filter === 'unread' ? 'tab-active' : '' }}">Belum dibaca</button>
    </div>
    <div class="card divide-y divide-ink-50 overflow-hidden">
        @forelse($notifications as $n)
            <div wire:key="n-{{ $n->id }}" class="flex items-start gap-4 p-4 {{ $n->read_at ? '' : 'bg-saffron-50/50' }}">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-2xl {{ $n->read_at ? 'bg-ink-50 text-ink-400' : 'bg-garnet-600 text-white shadow-glow' }}"><x-icon name="bell" class="h-5 w-5"/></span>
                <div class="min-w-0 flex-1">
                    <p class="text-sm {{ $n->read_at ? 'text-ink-600' : 'font-semibold' }}">{{ $n->data['message'] ?? '-' }}</p>
                    <p class="mt-1 text-xs text-ink-400">{{ $n->created_at->translatedFormat('d M Y, H:i') }} · {{ $n->created_at->diffForHumans() }}</p>
                </div>
                <div class="flex shrink-0 items-center gap-1">
                    @if(! empty($n->data['url']))<a href="{{ route('notifications.read', $n->id) }}" class="btn-soft btn-sm">Buka</a>@endif
                    @unless($n->read_at)<button wire:click="markRead('{{ $n->id }}')" class="btn-icon btn-ghost" title="Tandai dibaca"><x-icon name="check" class="h-4 w-4"/></button>@endunless
                    <button wire:click="remove('{{ $n->id }}')" class="btn-icon btn-ghost hover:text-garnet-600" title="Hapus"><x-icon name="trash" class="h-4 w-4"/></button>
                </div>
            </div>
        @empty
            <x-empty icon="bell" title="Tidak ada notifikasi" text="Notifikasi tentang kelas, pesanan, dan tryout akan muncul di sini." class="!border-0"/>
        @endforelse
    </div>
    {{ $notifications->links() }}
</div>
