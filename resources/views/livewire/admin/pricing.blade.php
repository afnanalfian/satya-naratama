@php $rp = fn ($n) => 'Rp '.number_format((float) $n, 0, ',', '.'); $labels = ['meeting' => 'Pertemuan satuan', 'course_package' => 'Paket kelas', 'tryout' => 'Tryout', 'addon' => 'Addon kuis']; @endphp
<div>
    <x-page-header title="Aturan Harga" sub="Harga dihitung otomatis: aturan khusus (per kelas/tryout) diutamakan, lalu aturan global. Pertemuan memakai harga per unit berdasarkan jumlah yang dibeli.">
        <x-slot:actions><a href="{{ route('pricing.create') }}" class="btn-primary"><x-icon name="plus" class="h-4 w-4"/> Aturan baru</a></x-slot:actions>
    </x-page-header>
    <div class="tabs mb-5"><button wire:click="$set('type','')" class="tab {{ $type === '' ? 'tab-active' : '' }}">Semua</button>@foreach($labels as $k => $l)<button wire:click="$set('type','{{ $k }}')" class="tab {{ $type === $k ? 'tab-active' : '' }}">{{ $l }}</button>@endforeach</div>
    <div class="space-y-6">
        @forelse($rules as $ptype => $group)
            <div>
                <p class="section-title mb-3">{{ $labels[$ptype] ?? $ptype }}</p>
                <div class="table-wrap">
                    <table class="table">
                        <thead><tr><th>Berlaku untuk</th><th class="text-center">Jumlah</th><th>Tipe</th><th class="text-right">Harga</th><th>Aktif</th><th></th></tr></thead>
                        <tbody>
                        @foreach($group as $r)
                            <tr wire:key="r{{ $r->id }}">
                                <td>@if($r->priceable_type)<span class="font-bold">{{ $r->priceable?->name ?? $r->priceable?->title ?? '#'.$r->priceable_id }}</span>@else<span class="badge-gold">Global</span>@endif</td>
                                <td class="text-center font-mono text-sm">{{ $r->min_qty }}{{ $r->max_qty ? ' – '.$r->max_qty : '+' }}</td>
                                <td><span class="badge-ink">{{ $r->pricing_type === 'per_unit' ? 'Per unit' : 'Tetap' }}</span></td>
                                <td class="text-right font-display text-lg font-extrabold">{{ $rp($r->price) }}</td>
                                <td><x-toggle :on="$r->is_active" wire:click="toggle({{ $r->id }})"/></td>
                                <td class="whitespace-nowrap text-right"><a href="{{ route('pricing.edit', $r) }}" class="btn-icon btn-ghost"><x-icon name="pencil" class="h-4 w-4"/></a><button x-data @click="$confirm('Hapus aturan harga ini?', () => $wire.remove({{ $r->id }}))" class="btn-icon btn-ghost hover:text-garnet-600"><x-icon name="trash" class="h-4 w-4"/></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <x-empty icon="tag" title="Belum ada aturan harga" text="Tanpa aturan harga, produk tidak bisa dimasukkan ke keranjang."><a href="{{ route('pricing.create') }}" class="btn-primary">Buat aturan</a></x-empty>
        @endforelse
    </div>
</div>
