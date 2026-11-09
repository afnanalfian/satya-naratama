@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); $pkg = $course->coursePackage?->product; @endphp
<div>
    <x-page-header eyebrow="Beli kelas" :title="$course->name" :sub="$course->description" :back="route('browse.index')"/>
    @if($ownedCourse)
        <x-empty icon="check-circle" title="Kamu sudah memiliki kelas ini" text="Semua pertemuan sudah bisa diakses."><a href="{{ route('course.show', $course->slug) }}" class="btn-primary">Buka kelas</a></x-empty>
    @else
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-3 lg:col-span-2">
            <p class="section-title">Beli per pertemuan</p>
            <p class="text-sm text-ink-500">Harga satuan {{ $rp($range['min']) }}{{ $range['min'] != $range['max'] ? ' – '.$rp($range['max']) : '' }} per pertemuan (makin banyak makin hemat).</p>
            @forelse($meetings as $m)
                @php $p = $m->product; $inCart = $p && in_array($p->id, $cartProductIds); @endphp
                <div wire:key="m{{ $m->id }}" class="card flex items-center gap-4 p-4">
                    <div class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-ink-50 text-center"><div><p class="text-[10px] font-bold uppercase">{{ $m->scheduled_at?->translatedFormat('M') }}</p><p class="font-display text-lg font-extrabold leading-none">{{ $m->scheduled_at?->format('d') }}</p></div></div>
                    <div class="min-w-0 flex-1"><p class="truncate font-bold">{{ $m->title }}</p><p class="text-xs text-ink-400">{{ $m->scheduled_at?->translatedFormat('l, H:i') }} · <x-status-badge :status="$m->status"/></p></div>
                    @if($m->is_free)<span class="badge-lagoon">Gratis</span>
                    @elseif($packageInCart)<span class="badge-lagoon">Termasuk paket</span>
                    @elseif($inCart)<a href="{{ route('cart.show') }}" class="btn-soft btn-sm"><x-icon name="check" class="h-4 w-4"/> Di keranjang</a>
                    @elseif($p && $p->is_active)<button wire:click="addToCart({{ $p->id }})" wire:loading.attr="disabled" class="btn-ink btn-sm"><x-icon name="plus" class="h-4 w-4"/> Tambah</button>@endif
                </div>
            @empty
                <x-empty icon="calendar" title="Tidak ada pertemuan untuk dibeli"/>
            @endforelse
        </div>
        <div>
            @if($pkg && $pkg->is_active)
            <div class="card-sunrise p-6 lg:sticky lg:top-4">
                <span class="badge bg-white/20 text-white">Paling hemat</span>
                <p class="mt-3 font-display text-xl font-bold">Paket lengkap {{ $course->name }}</p>
                <p class="mt-1 text-sm text-white/85">Semua pertemuan + akses kuis harian{{ $pkg->bonuses?->count() ? ' + bonus tryout' : '' }}.</p>
                <p class="mt-5 font-display text-4xl font-extrabold">{{ $rp($packagePrice) }}</p>
                @if($packageInCart)
                    <a href="{{ route('cart.show') }}" class="btn mt-5 w-full bg-white text-garnet-700 hover:bg-cream"><x-icon name="check" class="h-4 w-4"/> Sudah di keranjang</a>
                @else
                    <button wire:click="addToCart({{ $pkg->id }})" class="btn mt-5 w-full bg-ink-950 text-white hover:bg-ink-900"><x-icon name="cart" class="h-4 w-4"/> Ambil paket</button>
                @endif
            </div>
            @endif
        </div>
    </div>
    @endif
</div>
