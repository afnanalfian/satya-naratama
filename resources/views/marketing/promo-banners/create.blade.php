<x-layouts.app title="Promo Baru">
<x-page-header title="Promo baru" :back="route('promo-banners.index')"/>
<form method="POST" action="{{ route('promo-banners.store') }}" enctype="multipart/form-data">@csrf @include('marketing.promo-banners.form')
<div class="mt-6 flex justify-end gap-2"><a href="{{ route('promo-banners.index') }}" class="btn-soft">Batal</a><button class="btn-primary">Simpan</button></div></form>
</x-layouts.app>
