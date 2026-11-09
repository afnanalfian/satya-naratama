<div class="mx-auto max-w-xl">
    <x-page-header title="Ganti Password" sub="Perangkat ini tetap login setelah password diganti." :back="route('profile.show')"/>
    <form wire:submit="save" class="card card-pad space-y-4">
        <x-field label="Password saat ini" name="current_password"><input type="password" wire:model="current_password" class="input" autocomplete="current-password"></x-field>
        <x-field label="Password baru" name="password" hint="Minimal 6 karakter"><input type="password" wire:model="password" class="input" autocomplete="new-password"></x-field>
        <x-field label="Ulangi password baru" name="password_confirmation"><input type="password" wire:model="password_confirmation" class="input" autocomplete="new-password"></x-field>
        <button class="btn-primary w-full" wire:loading.attr="disabled"><x-icon name="key" class="h-4 w-4"/> Simpan password</button>
    </form>
</div>
