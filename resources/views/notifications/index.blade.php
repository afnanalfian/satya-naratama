@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6 px-4 sm:px-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Notifikasi
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Semua aktivitas dan informasi terbaru
            </p>
        </div>

        <div class="flex gap-2">
            <form method="POST" action="{{ route('notifications.readAll') }}">
                @csrf
                <button class="px-4 py-2 rounded-xl text-sm
                               bg-primary text-white hover:opacity-90">
                    Tandai Semua Dibaca
                </button>
            </form>

            <form method="POST" action="{{ route('notifications.clear') }}"
                  class="sweet-confirm"
                  data-message="Yakin ingin menghapus semua notifikasi?">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 rounded-xl text-sm
                               bg-red-600 text-white hover:bg-red-700">
                    Kosongkan
                </button>
            </form>
        </div>
    </div>

    {{-- LIST --}}
    <div class="rounded-2xl overflow-hidden
                bg-azwara-lightest dark:bg-azwara-darker
                border dark:border-azwara-darkest">

        @forelse($notifications as $notification)

            <div class="flex gap-4 p-4
                        border-b last:border-b-0
                        dark:border-azwara-darkest
                        {{ is_null($notification->read_at)
                            ? 'bg-primary/5 dark:bg-primary/10'
                            : '' }}">

                {{-- ICON --}}
                <div class="shrink-0 mt-1">
                    <div class="w-9 h-9 rounded-full
                                bg-primary/10 text-primary
                                flex items-center justify-center">
                        🔔
                    </div>
                </div>

                {{-- CONTENT --}}
                <div class="flex-1 min-w-0">
                    <a href="{{ $notification->data['url'] ?? '#' }}"
                    data-notif-id="{{ $notification->id }}"
                    class="notif-link block font-medium
                            text-gray-900 dark:text-white hover:underline">
                        {{ $notification->data['title'] ?? 'Notifikasi' }}
                    </a>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ $notification->data['message'] ?? '-' }}
                    </p>

                    <p class="mt-2 text-xs text-gray-400">
                        {{ $notification->created_at->diffForHumans() }}
                    </p>
                </div>

                {{-- ACTION --}}
                <form method="POST"
                      action="{{ route('notifications.destroy', $notification->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-gray-400 hover:text-red-600">
                        ✕
                    </button>
                </form>

            </div>

        @empty
            <div class="p-10 text-center text-gray-500 dark:text-gray-400">
                Tidak ada notifikasi.
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div>
        {{ $notifications->links() }}
    </div>

</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.notif-link').forEach(link => {
        link.addEventListener('click', () => {
            const id = link.dataset.notifId;
            if (!id) return;

            fetch(`/notifications/${id}/mark-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                keepalive: true
            });
        });
    });
});
</script>
@endpush
