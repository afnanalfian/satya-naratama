{{-- Promo dari admin: type = popup | banner | modal; display_delay & display_duration (detik) --}}
@php $p = $promo; $dur = (int) $p->display_duration; @endphp
<div x-data="{ show: false, init() { if (sessionStorage.getItem('promo-{{ $p->id }}')) return; setTimeout(() => this.show = true, {{ (int) $p->display_delay * 1000 }}); @if($dur > 0) setTimeout(() => this.close(), {{ ((int) $p->display_delay + $dur) * 1000 }}); @endif }, close() { this.show = false; try { sessionStorage.setItem('promo-{{ $p->id }}', 1) } catch (e) {} } }">
    @if($p->type === 'banner')
        <div x-show="show" x-cloak x-transition.opacity.duration.400ms class="fixed inset-x-3 bottom-3 z-[70] mx-auto max-w-3xl">
            <div class="flex items-center gap-4 rounded-3xl bg-ink-900 p-3 pr-4 text-white shadow-lift ring-1 ring-white/10">
                @if($p->image_path)<img src="{{ $p->image_url }}" class="h-16 w-16 shrink-0 rounded-2xl object-cover" alt="">@endif
                <div class="min-w-0 flex-1"><p class="font-bold">{{ $p->title }}</p>@if($p->description)<p class="line-clamp-1 text-xs text-ink-300">{{ $p->description }}</p>@endif</div>
                @if($p->target_url)<a href="{{ $p->resolved_url }}" class="btn-gold btn-sm">Lihat</a>@endif
                <button @click="close()" class="rounded-xl p-1.5 text-ink-300 hover:bg-white/10"><x-icon name="x" class="h-5 w-5"/></button>
            </div>
        </div>
    @elseif($p->type === 'popup')
        <div x-show="show" x-cloak x-transition class="fixed bottom-4 right-4 z-[70] w-[min(92vw,340px)] overflow-hidden rounded-3xl bg-white shadow-lift ring-1 ring-ink-100">
            <button @click="close()" class="absolute right-2 top-2 z-10 grid h-8 w-8 place-items-center rounded-full bg-white/90 shadow"><x-icon name="x" class="h-4 w-4"/></button>
            @if($p->image_path)<img src="{{ $p->image_url }}" class="w-full" alt="{{ $p->title }}">@endif
            <div class="p-4"><p class="font-display font-bold">{{ $p->title }}</p>@if($p->description)<p class="mt-1 text-sm text-ink-500">{{ $p->description }}</p>@endif
                @if($p->target_url)<a href="{{ $p->resolved_url }}" class="btn-primary btn-sm mt-3 w-full">Selengkapnya</a>@endif</div>
        </div>
    @else
        <div x-show="show" x-cloak class="fixed inset-0 z-[85] grid place-items-center p-4">
            <div x-show="show" x-transition.opacity class="absolute inset-0 bg-ink-950/70 backdrop-blur-sm" @click="close()"></div>
            <div x-show="show" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0 scale-90" class="relative w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-lift">
                <button @click="close()" class="absolute right-3 top-3 z-10 grid h-9 w-9 place-items-center rounded-full bg-white/90 shadow"><x-icon name="x" class="h-5 w-5"/></button>
                @if($p->image_path)<img src="{{ $p->image_url }}" class="max-h-[60vh] w-full object-contain bg-ink-50" alt="{{ $p->title }}">@endif
                <div class="p-6 text-center"><p class="font-display text-xl font-bold">{{ $p->title }}</p>@if($p->description)<p class="mt-2 text-sm text-ink-500">{{ $p->description }}</p>@endif
                    @if($p->target_url)<a href="{{ $p->resolved_url }}" class="btn-primary mt-5 w-full">Ambil promo</a>@endif</div>
            </div>
        </div>
    @endif
</div>
