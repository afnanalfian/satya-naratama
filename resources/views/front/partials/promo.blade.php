@if(isset($activePromo) && $activePromo->isCurrentlyActive())
    @switch($activePromo->type)
        @case('popup')
            @include('front.partials.promo-popup')
            @break
        @case('banner')
            @include('front.partials.promo-banner')
            @break
        @case('modal')
            @include('front.partials.promo-modal')
            @break
    @endswitch
@endif
