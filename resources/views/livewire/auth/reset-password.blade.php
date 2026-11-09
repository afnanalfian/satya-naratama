<div>
    <div class="mb-6 grid h-14 w-14 place-items-center rounded-2xl bg-garnet-50 text-garnet-600"><x-icon name="lock" class="h-7 w-7"/></div>
    <h1 class="font-display text-3xl font-extrabold">Buat password baru</h1>
    <p class="mt-2 text-sm text-ink-500">Gunakan minimal 6 karakter. Kombinasikan huruf & angka agar lebih aman.</p>
    <form wire:submit="save" class="mt-8 space-y-4">
        <x-field label="Email" name="email"><input wire:model="email" type="email" class="input"></x-field>
        <x-field label="Password baru" name="password"><input wire:model="password" type="password" class="input" autocomplete="new-password"></x-field>
        <x-field label="Ulangi password" name="password_confirmation"><input wire:model="password_confirmation" type="password" class="input" autocomplete="new-password"></x-field>
        <button class="btn-primary btn-lg w-full" wire:loading.attr="disabled">Simpan password</button>
    </form>
</div>
