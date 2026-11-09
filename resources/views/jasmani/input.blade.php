<x-layouts.app :title="'Input Hasil · '.$evaluation->title" :wide="true">
<x-page-header :title="'Input hasil: '.$evaluation->title" :sub="$evaluation->period->translatedFormat('F Y').' · desimal boleh pakai koma (mis. 19,5). Kosongkan seluruh baris untuk menghapus hasil siswa.'" :back="route('jasmani.show', $evaluation)"/>
<form method="POST" action="{{ route('jasmani.input.save', $evaluation) }}" x-data="{ q: '', g: '' }">
    @csrf @method('PUT')
    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center">
        <input x-model="q" class="input sm:w-64" placeholder="Cari nama…">
        <div class="tabs"><button type="button" @click="g=''" class="tab" :class="!g && 'tab-active'">Semua</button><button type="button" @click="g='L'" class="tab" :class="g==='L' && 'tab-active'">Putra</button><button type="button" @click="g='P'" class="tab" :class="g==='P' && 'tab-active'">Putri</button></div>
        <div class="flex-1"></div>
        <button class="btn-primary"><x-icon name="check" class="h-4 w-4"/> Simpan semua</button>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead><tr><th class="sticky left-0 z-10 bg-ink-50">Siswa</th>@foreach($items as $k => $it)<th class="text-center">{{ $it['label'] }}<span class="block text-[10px] normal-case text-ink-400">{{ $it['unit'] }} · {{ $it['better'] === 'high' ? 'makin tinggi makin baik' : 'makin cepat makin baik' }}</span></th>@endforeach<th>Catatan</th></tr></thead>
            <tbody>
            @foreach($students as $s)
                @php $r = $existing->get($s->id); $g = $s->studentRegistration?->gender; @endphp
                <tr x-show="(!q || @js(mb_strtolower($s->name)).includes(q.toLowerCase())) && (!g || g === '{{ $g }}')">
                    <td class="sticky left-0 z-10 bg-white"><div class="flex items-center gap-2"><span class="badge {{ $g === 'P' ? 'badge-garnet' : 'badge-ink' }}">{{ $g ?? '?' }}</span><span class="whitespace-nowrap font-bold">{{ $s->name }}</span>@unless($s->is_active)<span class="badge-ink">nonaktif</span>@endunless</div></td>
                    @foreach($items as $k => $it)
                        <td class="px-2"><input name="results[{{ $s->id }}][{{ $k }}]" value="{{ old("results.$s->id.$k", $r?->{$k} !== null ? str_replace('.', ',', str_contains((string) $r->{$k}, '.') ? rtrim(rtrim((string) $r->{$k}, '0'), '.') : (string) $r->{$k}) : '') }}" inputmode="decimal" class="input input-sm w-24 text-center" placeholder="{{ $k === 'pull_up_chinning' ? ($g === 'P' ? 'chin' : 'pull') : '–' }}"></td>
                    @endforeach
                    <td class="px-2"><input name="results[{{ $s->id }}][notes]" value="{{ old("results.$s->id.notes", $r?->notes) }}" class="input input-sm w-48"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 flex justify-end"><button class="btn-primary btn-lg"><x-icon name="check" class="h-4 w-4"/> Simpan semua</button></div>
</form>
</x-layouts.app>
