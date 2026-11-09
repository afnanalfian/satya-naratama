<x-layouts.app title="Ubah Pertemuan">
<div class="mx-auto max-w-2xl">
    <x-page-header title="Ubah Pertemuan" :sub="$meeting->course?->name" :back="route('meeting.show', $meeting)"/>
    <form method="POST" action="{{ route('meeting.update', $meeting) }}" class="space-y-4">@csrf @method('PUT')
        @include('meetings.partials.form')
        <div class="flex justify-end gap-2"><a href="{{ route('meeting.show', $meeting) }}" class="btn-soft">Batal</a><button class="btn-primary"><x-icon name="check" class="h-4 w-4"/> Simpan</button></div>
    </form>
    <form method="POST" action="{{ route('meeting.destroy', $meeting) }}" data-confirm="Hapus pertemuan ini?" class="mt-6 flex justify-end">@csrf @method('DELETE')<button class="btn-danger"><x-icon name="trash" class="h-4 w-4"/> Hapus pertemuan</button></form>
</div>
</x-layouts.app>
