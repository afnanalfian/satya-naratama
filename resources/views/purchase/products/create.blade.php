<x-layouts.app title="Produk Baru"><div class="mx-auto max-w-2xl">
<x-page-header title="Produk baru" :back="route('products.index')"/>
<form method="POST" action="{{ route('products.store') }}" class="space-y-4">@csrf @include('purchase.products.form')
<div class="flex justify-end gap-2"><a href="{{ route('products.index') }}" class="btn-soft">Batal</a><button class="btn-primary">Simpan</button></div></form>
</div></x-layouts.app>
