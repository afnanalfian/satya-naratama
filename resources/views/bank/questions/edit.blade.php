<x-layouts.app title="Ubah Soal" :wide="true">
<x-page-header eyebrow="Bank soal" title="Ubah soal #{{ $question->id }}" :sub="$question->material?->category?->name.' › '.$question->material?->name" :back="route('bank.material.questions.index', $question->material)"/>
@if($question->examQuestions()->count())
    <div class="mb-6 flex gap-3 rounded-2xl bg-saffron-50 p-4 text-sm text-saffron-900 ring-1 ring-saffron-200"><x-icon name="alert" class="h-5 w-5 shrink-0"/> Soal ini dipakai di {{ $question->examQuestions()->count() }} ujian. Jika kunci jawaban diubah, nilai siswa akan dihitung ulang otomatis.</div>
@endif
<form method="POST" action="{{ route('bank.question.update', $question) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('bank.questions.form', ['question' => $question])
    <div class="sticky bottom-0 z-20 mt-6 flex justify-end gap-2 border-t border-ink-100 bg-cream/90 py-4 backdrop-blur">
        <a href="{{ route('bank.material.questions.index', $question->material) }}" class="btn-soft">Batal</a>
        <button class="btn-primary"><x-icon name="check" class="h-4 w-4"/> Simpan perubahan</button>
    </div>
</form>
</x-layouts.app>
