<x-layouts.app title="Ubah Promo">
<x-page-header title="Ubah promo" :sub="$promoBanner->title" :back="route('promo-banners.index')"/>
<form method="POST" action="{{ route('promo-banners.update', $promoBanner) }}" enctype="multipart/form-data">@csrf @method('PUT') @include('marketing.promo-banners.form', ['promoBanner' => $promoBanner])
<div class="mt-6 flex justify-end gap-2"><a href="{{ route('promo-banners.index') }}" class="btn-soft">Batal</a><button class="btn-primary">Simpan</button></div></form>
</x-layouts.app>
