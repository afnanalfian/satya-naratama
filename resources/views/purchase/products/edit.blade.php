<x-layouts.app title="Ubah Produk"><div class="mx-auto max-w-2xl">
<x-page-header title="Ubah produk" :sub="$product->name" :back="route('products.index')"/>
<form method="POST" action="{{ route('products.update', $product) }}" class="space-y-4">@csrf @method('PUT') @include('purchase.products.form', ['product' => $product])
<div class="flex justify-end gap-2"><a href="{{ route('products.index') }}" class="btn-soft">Batal</a><button class="btn-primary">Simpan</button></div></form>
</div></x-layouts.app>
