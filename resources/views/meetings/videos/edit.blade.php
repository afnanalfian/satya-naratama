<x-layouts.app title="Ubah Video">
<div class="mx-auto max-w-2xl">
    <x-page-header title="Ubah Video" :sub="$meeting->title" :back="route('meeting.show', $meeting)"/>
    <form method="POST" action="{{ route('meetings.video.update', $meeting) }}" class="space-y-4">@csrf @method('PUT')
        @include('meetings.videos.form')
        <div class="flex justify-end gap-2"><a href="{{ route('meeting.show', $meeting) }}" class="btn-soft">Batal</a><button class="btn-primary">Simpan</button></div>
    </form>
    <form method="POST" action="{{ route('meetings.video.destroy', $meeting) }}" data-confirm="Hapus video ini?" class="mt-6 flex justify-end">@csrf @method('DELETE')<button class="btn-danger"><x-icon name="trash" class="h-4 w-4"/> Hapus video</button></form>
</div>
</x-layouts.app>
