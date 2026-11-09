<x-layouts.app title="Pertemuan Baru">
<div class="mx-auto max-w-2xl">
    <x-page-header title="Pertemuan Baru" :sub="$course->name" :back="route('course.show', $course->slug)"/>
    <form method="POST" action="{{ route('meeting.store', $course) }}" class="space-y-4">@csrf
        @include('meetings.partials.form', ['scheduledAt' => now()->addDay()->setTime(16, 0)->format('Y-m-d\TH:i')])
        <div class="flex justify-end gap-2"><a href="{{ route('course.show', $course->slug) }}" class="btn-soft">Batal</a><button class="btn-primary"><x-icon name="check" class="h-4 w-4"/> Simpan</button></div>
    </form>
</div>
</x-layouts.app>
