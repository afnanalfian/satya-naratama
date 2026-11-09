@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); @endphp
<div>
    <div class="card-ink mb-6 p-6 sm:p-8">
        <div class="absolute inset-0 bg-grid-ink [background-size:30px_30px]"></div>
        <div class="blob -right-10 -top-10 h-56 w-56 bg-saffron-500/40"></div>
        <div class="relative flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div><p class="text-xs font-bold uppercase tracking-widest text-saffron-400">Toko belajar</p><h1 class="mt-1 font-display text-3xl font-extrabold">Pilih paket belajarmu</h1><p class="mt-1 text-sm text-ink-300">Ambil paket kelas lengkap, pertemuan satuan, atau tryout.</p></div>
            <a href="{{ route('cart.show') }}" class="btn-gold"><x-icon name="cart" class="h-4 w-4"/> Lihat keranjang</a>
        </div>
    </div>
    <div class="tabs mb-6">
        <button wire:click="$set('tab','course')" class="tab {{ $tab === 'course' ? 'tab-active' : '' }}">Paket kelas ({{ $courses->count() }})</button>
        <button wire:click="$set('tab','tryout')" class="tab {{ $tab === 'tryout' ? 'tab-active' : '' }}">Tryout ({{ $tryouts->count() }})</button>
        @if($addon)<button wire:click="$set('tab','addon')" class="tab {{ $tab === 'addon' ? 'tab-active' : '' }}">Akses kuis</button>@endif
    </div>

    @if($tab === 'course')
        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @forelse($courses as $c)
                @php $product = $c->product?->product; $inCart = $product && in_array($product->id, $cartProductIds); $range = price_range_meeting($c); $price = rescue(fn () => price_for_course_package($c), 0, false); @endphp
                <div wire:key="c{{ $c->id }}" class="card flex flex-col overflow-hidden card-hover">
                    <div class="relative aspect-[16/9] bg-ink-900">
                        @if($c->thumbnail)<img src="{{ asset('storage/'.$c->thumbnail) }}" class="h-full w-full object-cover" alt="">@else<div class="grid h-full place-items-center bg-sunrise"><x-icon :name="$c->type === 'jasmani' ? 'run' : 'book'" class="h-12 w-12 text-white/80"/></div>@endif
                        <div class="absolute left-3 top-3"><x-course-type-badge :type="$c->type" class="!bg-white"/></div>
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <h3 class="font-display text-lg font-bold">{{ $c->name }}</h3>
                        <p class="mt-1 line-clamp-2 text-sm text-ink-500">{{ $c->description }}</p>
                        <p class="mt-2 text-xs font-bold text-ink-400">{{ $c->meetings_count }} pertemuan · {{ $c->teachers->pluck('user.name')->filter()->join(', ') }}</p>
                        @if($product?->bonuses->count())
                            <div class="mt-3 space-y-1">@foreach($product->bonuses as $b)<p class="flex items-center gap-1.5 text-xs font-semibold text-lagoon-700"><x-icon name="gift" class="h-4 w-4"/> Bonus {{ $b->bonus_type === 'tryout' ? 'tryout: '.($b->tryout?->title ?? '-') : 'kelas' }}</p>@endforeach</div>
                        @endif
                        <div class="mt-auto pt-5">
                            <p class="text-[11px] font-bold uppercase text-ink-400">Paket lengkap</p>
                            <p class="whitespace-nowrap font-display text-2xl font-extrabold text-garnet-600">{{ $price > 0 ? $rp($price) : 'Gratis' }}</p>
                            @if($range['max'] > 0)<p class="text-xs text-ink-400">atau satuan <b class="text-ink-700">{{ $rp($range['min']) }}{{ $range['min'] != $range['max'] ? '–'.number_format($range['max'], 0, ',', '.') : '' }}</b> / pertemuan</p>@endif
                            <div class="mt-4 grid grid-cols-2 gap-2">
                                <a href="{{ route('browse.course', $c) }}" class="btn-soft btn-sm">Beli satuan</a>
                                @if($inCart)
                                    <a href="{{ route('cart.show') }}" class="btn-lagoon btn-sm"><x-icon name="check" class="h-4 w-4"/> Di keranjang</a>
                                @elseif($product)
                                    <button wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled" class="btn-primary btn-sm"><x-icon name="cart" class="h-4 w-4"/> Paket</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 xl:col-span-3"><x-empty icon="bag" title="Tidak ada paket kelas tersedia" text="Kamu mungkin sudah memiliki semua paket kelas."/></div>
            @endforelse
        </div>
    @elseif($tab === 'tryout')
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse($tryouts as $t)
                @php $product = $t->productable?->product; $inCart = $product && in_array($product->id, $cartProductIds); $locked = in_array($t->id, $bonusTryoutIdsInCart); $price = rescue(fn () => price_for_tryout($t), 0, false); @endphp
                <div wire:key="t{{ $t->id }}" class="card flex flex-col p-5 card-hover">
                    <div class="flex items-start justify-between"><span class="grid h-12 w-12 place-items-center rounded-2xl bg-garnet-50 text-garnet-600"><x-icon name="trophy" class="h-6 w-6"/></span><span class="badge-ink">{{ strtoupper($t->test_type) }}</span></div>
                    <h3 class="mt-4 font-display text-lg font-bold">{{ $t->title }}</h3>
                    <p class="text-xs text-ink-400">{{ $t->exam_date?->translatedFormat('d M Y') }} · {{ $t->questions_count }} soal · {{ $t->duration_minutes ?? '–' }} menit</p>
                    <div class="mt-auto flex items-center justify-between pt-5">
                        <p class="font-display text-2xl font-extrabold text-garnet-600">{{ $price > 0 ? $rp($price) : 'Gratis' }}</p>
                        @if($locked)<span class="badge-lagoon">Bonus paket</span>
                        @elseif($inCart)<a href="{{ route('cart.show') }}" class="btn-lagoon btn-sm"><x-icon name="check" class="h-4 w-4"/> Di keranjang</a>
                        @elseif($product)<button wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled" class="btn-primary btn-sm"><x-icon name="cart" class="h-4 w-4"/> Tambah</button>@endif
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 xl:col-span-3"><x-empty icon="trophy" title="Tidak ada tryout tersedia"/></div>
            @endforelse
        </div>
    @else
        <div class="card-sunrise max-w-xl p-8">
            <x-icon name="bolt" class="h-10 w-10"/>
            <h3 class="mt-4 font-display text-2xl font-extrabold">Akses semua kuis harian</h3>
            <p class="mt-2 text-white/85">Latihan singkat setiap hari untuk menjaga ritme belajar. Sudah termasuk otomatis jika kamu membeli paket kelas.</p>
            @if($hasQuiz)
                <p class="mt-6 rounded-2xl bg-white/20 p-4 font-bold">✓ Kamu sudah memiliki akses kuis.</p>
            @else
                <div class="mt-6 flex items-center justify-between rounded-2xl bg-white/15 p-4">
                    <p class="font-display text-3xl font-extrabold">{{ $addonPrice !== null ? $rp($addonPrice) : '—' }}</p>
                    <button wire:click="addAddon" class="btn bg-white text-garnet-700 hover:bg-cream"><x-icon name="cart" class="h-4 w-4"/> Tambah</button>
                </div>
            @endif
        </div>
    @endif
</div>
