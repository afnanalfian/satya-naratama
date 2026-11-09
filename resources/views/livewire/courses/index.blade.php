<div>
    <x-page-header :title="auth()->user()->hasRole('siswa') ? 'Kelas' : 'Manajemen Kelas'" sub="Kelas akademik & latihan jasmani beserta seluruh pertemuannya.">
        <x-slot:actions>
            @role('admin')<a href="{{ route('course.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4"/> Kelas baru</a>@endrole
            @role('siswa')<a href="{{ route('browse.index') }}" class="btn-gold"><x-icon name="bag" class="h-4 w-4"/> Beli paket</a>@endrole
        </x-slot:actions>
    </x-page-header>
    <div class="mb-5 flex flex-col gap-3 sm:flex-row">
        <div class="flex-1"><x-search wire:model.live.debounce.400ms="q" placeholder="Cari kelas…"/></div>
        <div class="tabs">
            @foreach(['' => 'Semua', 'akademik' => 'Akademik', 'jasmani' => 'Jasmani'] as $k => $v)
                <button wire:click="$set('type','{{ $k }}')" class="tab {{ $type === $k ? 'tab-active' : '' }}">{{ $v }}</button>
            @endforeach
        </div>
    </div>
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3" wire:loading.class="opacity-60">
        @forelse($courses as $c)
            <a wire:key="c{{ $c->id }}" href="{{ route('course.show', $c->slug) }}" class="group card overflow-hidden card-hover">
                <div class="relative aspect-[16/9] overflow-hidden bg-ink-900">
                    @if($c->thumbnail)
                        <img src="{{ asset('storage/'.$c->thumbnail) }}" alt="" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                    @else
                        <div class="flex h-full items-center justify-center {{ $c->type === 'jasmani' ? 'bg-gradient-to-br from-saffron-400 to-garnet-600' : 'bg-gradient-to-br from-ink-700 to-ink-950' }}"><x-icon :name="$c->type === 'jasmani' ? 'run' : 'book'" class="h-14 w-14 text-white/70"/></div>
                    @endif
                    <div class="absolute left-3 top-3 flex gap-1.5"><x-course-type-badge :type="$c->type" class="!bg-white"/>@if($c->is_free)<span class="badge-lagoon !bg-white">Gratis</span>@endif</div>
                    @if($c->live_count)<span class="absolute right-3 top-3 badge bg-garnet-600 text-white"><span class="dot animate-pulse bg-white"></span> {{ $c->live_count }} live</span>@endif
                    @if(in_array($c->id, $owned))<span class="absolute bottom-3 right-3 badge bg-lagoon-500 text-white"><x-icon name="check" class="h-3 w-3"/> Dimiliki</span>@endif
                </div>
                <div class="p-5">
                    <h3 class="font-display text-lg font-bold group-hover:text-garnet-600">{{ $c->name }}</h3>
                    <p class="mt-1 line-clamp-2 text-sm text-ink-500">{{ strip_tags($c->description) }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex -space-x-2">@foreach($c->teachers->take(4) as $t)<img src="{{ $t->user?->avatar_url }}" title="{{ $t->user?->name }}" class="h-8 w-8 rounded-full object-cover ring-2 ring-white" alt="">@endforeach</div>
                        <span class="text-xs font-bold text-ink-400">{{ $c->meetings_count }} pertemuan</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="sm:col-span-2 lg:col-span-3"><x-empty icon="book" title="Belum ada kelas" :text="$isTentor ? 'Anda belum ditugaskan ke kelas mana pun.' : null"/></div>
        @endforelse
    </div>
    {{ $courses->links() }}
</div>
