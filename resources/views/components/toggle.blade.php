@props(['on' => false])
{{-- Tombol switch visual; pasang wire:click / @click di atribut --}}
<button type="button" {{ $attributes->merge(['class' => 'switch '.($on ? 'bg-lagoon-500' : 'bg-ink-200')]) }} role="switch" aria-checked="{{ $on ? 'true' : 'false' }}">
    <span class="pointer-events-none inline-block h-5 w-5 translate-y-0.5 rounded-full bg-white shadow transition {{ $on ? 'translate-x-[22px]' : 'translate-x-0.5' }}"></span>
</button>
