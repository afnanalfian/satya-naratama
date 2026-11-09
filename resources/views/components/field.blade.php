@props(['label' => null, 'name' => null, 'hint' => null, 'required' => false])
<div {{ $attributes->merge(['class' => '']) }}>
    @if($label)<label class="label">{{ $label }} @if($required)<span class="text-garnet-500">*</span>@endif</label>@endif
    {{ $slot }}
    @if($hint)<p class="hint">{{ $hint }}</p>@endif
    @if($name)@error($name)<p class="error">{{ $message }}</p>@enderror @endif
</div>
