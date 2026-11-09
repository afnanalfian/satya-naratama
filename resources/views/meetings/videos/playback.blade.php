<x-layouts.app :title="$video->title">
<x-page-header :title="$video->title" :sub="$meeting->course?->name.' · '.$meeting->title" :back="route('meeting.show', $meeting)"/>
<div class="overflow-hidden rounded-3xl bg-ink-950 shadow-lift" oncontextmenu="return false">
    <div class="aspect-video"><iframe src="{{ $video->embed_url }}" class="h-full w-full" allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen loading="lazy"></iframe></div>
</div>
<div class="mt-4 flex flex-wrap items-center gap-2 text-sm text-ink-500"><span class="badge-ink">{{ $video->platform }}</span> Video hanya untuk siswa Satya Naratama. Mohon tidak disebarluaskan.</div>
</x-layouts.app>
