@php $m = $meeting ?? null; @endphp
<div class="card card-pad space-y-4">
    <x-field label="Judul pertemuan" name="title" required><input name="title" value="{{ old('title', $m?->title) }}" class="input" required placeholder="mis. Pertemuan 5 – Deret Angka"></x-field>
    <x-field label="Jadwal" name="scheduled_at" required hint="Zona waktu server (Asia/Jakarta)"><input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at', $scheduledAt ?? '') }}" class="input" required></x-field>
    <x-field label="Link Zoom / Meet" name="zoom_link" hint="Opsional, untuk kelas online"><input type="url" name="zoom_link" value="{{ old('zoom_link', $m?->zoom_link) }}" class="input" placeholder="https://zoom.us/j/…"></x-field>
    <label class="flex items-center justify-between rounded-2xl bg-cream p-4">
        <span><span class="block text-sm font-bold">Pertemuan gratis</span><span class="text-xs text-ink-400">Bisa diakses tanpa membeli.</span></span>
        <input type="hidden" name="is_free" value="0"><input type="checkbox" name="is_free" value="1" class="checkbox h-5 w-5" @checked(old('is_free', $m?->is_free))>
    </label>
</div>
