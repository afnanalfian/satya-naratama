<x-layouts.app title="Diskon Baru">
<x-page-header title="Diskon / voucher baru" :back="route('discounts.index')"/>
<form method="POST" action="{{ route('discounts.store') }}">@csrf @include('purchase.discounts.form')
<div class="mt-6 flex justify-end gap-2"><a href="{{ route('discounts.index') }}" class="btn-soft">Batal</a><button class="btn-primary">Simpan</button></div></form>
</x-layouts.app>
