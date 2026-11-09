@props(['type' => 'akademik'])
@if($type === 'jasmani')
    <span {{ $attributes->merge(['class' => 'badge-gold']) }}><x-icon name="run" class="h-3 w-3"/> Jasmani</span>
@else
    <span {{ $attributes->merge(['class' => 'badge-ink']) }}><x-icon name="book" class="h-3 w-3"/> Akademik</span>
@endif
