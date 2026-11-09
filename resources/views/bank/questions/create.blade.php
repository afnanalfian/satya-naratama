<x-layouts.app title="Soal Baru" :wide="true">
<x-page-header eyebrow="Bank soal" title="Tambah soal" :sub="$material->category?->name.' › '.$material->name" :back="route('bank.material.questions.index', $material)"/>
<form method="POST" action="{{ route('bank.material.questions.store', $material) }}" enctype="multipart/form-data">
    @csrf
    @include('bank.questions.form')
    <div class="sticky bottom-0 z-20 mt-6 flex justify-end gap-2 border-t border-ink-100 bg-cream/90 py-4 backdrop-blur">
        <a href="{{ route('bank.material.questions.index', $material) }}" class="btn-soft">Batal</a>
        <button class="btn-primary"><x-icon name="check" class="h-4 w-4"/> Simpan soal</button>
    </div>
</form>
</x-layouts.app>
