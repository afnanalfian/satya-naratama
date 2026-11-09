@php $v = $video ?? null; $src = old('source', $v?->source ?? (config('video.use_cdn') ? 'cdn' : 'youtube')); @endphp
<div class="card card-pad space-y-4" x-data="{ src: '{{ $src }}', yt: @js(old('youtube_video_id', $v?->youtube_video_id)),
    get ytId() { const m = (this.yt || '').match(/(?:v=|youtu\.be\/|embed\/|shorts\/)([\w-]{11})/); return m ? m[1] : (this.yt || '').trim(); } }">
    <x-field label="Judul video" name="title" required><input name="title" value="{{ old('title', $v?->title ?? $meeting->title) }}" class="input" required></x-field>
    <x-field label="Sumber" name="source">
        <div class="grid grid-cols-2 gap-2">
            <label class="cursor-pointer rounded-2xl border-2 p-3 text-sm font-bold" :class="src==='youtube' ? 'border-garnet-500 bg-garnet-50' : 'border-ink-100'"><input type="radio" name="source" value="youtube" x-model="src" class="hidden">▶ YouTube</label>
            <label class="cursor-pointer rounded-2xl border-2 p-3 text-sm font-bold" :class="src==='cdn' ? 'border-garnet-500 bg-garnet-50' : 'border-ink-100'"><input type="radio" name="source" value="cdn" x-model="src" class="hidden">☁ Bunny CDN</label>
        </div>
    </x-field>
    <div x-show="src==='youtube'">
        <x-field label="Link atau ID YouTube" name="youtube_video_id" hint="Tempel link lengkap, ID akan diambil otomatis."><input x-model="yt" class="input" placeholder="https://youtu.be/xxxxxxxxxxx"></x-field>
        <input type="hidden" name="youtube_video_id" :value="ytId">
        <template x-if="ytId && ytId.length === 11"><div class="mt-3 aspect-video overflow-hidden rounded-2xl bg-ink-900"><iframe class="h-full w-full" :src="'https://www.youtube-nocookie.com/embed/' + ytId" allowfullscreen></iframe></div></template>
    </div>
    <div x-show="src==='cdn'" x-cloak>
        <x-field label="ID video Bunny" name="cdn_video_id"><input name="cdn_video_id" value="{{ old('cdn_video_id', $v?->cdn_video_id) }}" class="input" placeholder="xxxxxxxx-xxxx-…"></x-field>
    </div>
</div>
