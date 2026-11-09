@php
    $flash = collect(session('toasts', []));
    foreach (['success', 'error', 'warning', 'info'] as $k) { if (session($k) && is_string(session($k))) $flash->push(['type' => $k, 'message' => session($k)]); }
    if (isset($errors) && $errors->any() && ! ($noErrorToast ?? false)) $flash->push(['type' => 'error', 'message' => $errors->first()]);
@endphp
<div x-data="toaster(@js($flash->values()))" class="pointer-events-none fixed inset-x-0 top-3 z-[90] flex flex-col items-center gap-2 px-3 sm:items-end sm:right-4 sm:left-auto">
    <template x-for="t in items" :key="t.id">
        <div x-show="t.show" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
             x-transition:leave="transition duration-200" x-transition:leave-end="opacity-0 translate-x-6"
             class="pointer-events-auto flex w-full max-w-sm items-start gap-3 rounded-2xl bg-ink-900 p-3.5 pr-2 text-sm text-white shadow-lift ring-1 ring-white/10">
            <span class="mt-0.5 grid h-7 w-7 shrink-0 place-items-center rounded-xl"
                  :class="{'bg-lagoon-500': t.type==='success', 'bg-garnet-500': t.type==='error', 'bg-saffron-400 text-ink-900': t.type==='warning', 'bg-ink-600': t.type==='info'}">
                <svg x-show="t.type==='success'" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12.5 10 17 19 7"/></svg>
                <svg x-show="t.type==='error'" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 6l12 12M18 6 6 18"/></svg>
                <svg x-show="t.type==='warning' || t.type==='info'" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 8v5M12 16.5h.01"/></svg>
            </span>
            <p class="flex-1 pt-1 font-medium leading-snug" x-text="t.message"></p>
            <button @click="remove(t.id)" class="rounded-lg p-1 text-ink-300 hover:bg-white/10 hover:text-white"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6 6 18"/></svg></button>
        </div>
    </template>
</div>

{{-- Dialog konfirmasi global --}}
<div x-data x-show="$store.confirm.open" x-cloak class="fixed inset-0 z-[95] grid place-items-center p-4" @keydown.escape.window="$store.confirm.answer(false)">
    <div x-show="$store.confirm.open" x-transition.opacity class="absolute inset-0 bg-ink-950/60 backdrop-blur-sm" @click="$store.confirm.answer(false)"></div>
    <div x-show="$store.confirm.open" x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0 scale-90"
         class="relative w-full max-w-sm rounded-3xl bg-white p-6 text-center shadow-lift">
        <div class="mx-auto mb-4 grid h-14 w-14 place-items-center rounded-2xl" :class="$store.confirm.danger ? 'bg-garnet-50 text-garnet-600' : 'bg-saffron-50 text-saffron-600'">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v4M12 17h.01M10.3 3.9 2 18a2 2 0 0 0 1.7 3h16.6a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
        </div>
        <h3 class="font-display text-lg font-bold" x-text="$store.confirm.title"></h3>
        <p class="mt-1.5 text-sm text-ink-500" x-text="$store.confirm.message"></p>
        <div class="mt-6 grid grid-cols-2 gap-2">
            <button type="button" class="btn-soft" @click="$store.confirm.answer(false)">Batal</button>
            <button type="button" x-ref="ok" :class="$store.confirm.danger ? 'btn-primary' : 'btn-ink'" @click="$store.confirm.answer(true)" x-text="$store.confirm.okText"></button>
        </div>
    </div>
</div>
