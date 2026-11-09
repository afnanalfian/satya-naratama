<x-layouts.app title="Tambah Video">
<div class="mx-auto max-w-2xl">
    <x-page-header title="Tambah Video Pembelajaran" :sub="$meeting->title" :back="route('meeting.show', $meeting)"/>
    <form method="POST" action="{{ route('meetings.video.store', $meeting) }}" class="space-y-4">@csrf
        @include('meetings.videos.form')
        <div class="flex justify-end gap-2"><a href="{{ route('meeting.show', $meeting) }}" class="btn-soft">Batal</a><button class="btn-primary">Simpan video</button></div>
    </form>
</div>
</x-layouts.app>
