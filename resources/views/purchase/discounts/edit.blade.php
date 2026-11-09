<x-layouts.app title="Ubah Diskon">
<x-page-header title="Ubah diskon" :sub="$discount->name" :back="route('discounts.index')"/>
<form method="POST" action="{{ route('discounts.update', $discount) }}">@csrf @method('PUT') @include('purchase.discounts.form', ['discount' => $discount])
<div class="mt-6 flex justify-end gap-2"><a href="{{ route('discounts.index') }}" class="btn-soft">Batal</a><button class="btn-primary">Simpan</button></div></form>
</x-layouts.app>
