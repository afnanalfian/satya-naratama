<?php

namespace App\Livewire\Shop;

use App\Livewire\Concerns\Toasts;
use App\Livewire\Shop\Concerns\AddsToCart;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Product;
use App\Services\CartService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Beli Paket')]
class Browse extends Component
{
    use AddsToCart, Toasts;

    #[Url] public string $tab = 'course';

    public function addAddon()
    {
        try {
            app(CartService::class)->addAddonQuiz(auth()->user());
        } catch (\RuntimeException $e) {
            return $this->notify('error', $e->getMessage());
        }
        $this->dispatch('cart-updated', count: (int) auth()->user()->cart?->items()->sum('qty'));
        $this->notify('success', 'Addon Kuis ditambahkan ke keranjang.');
    }

    public function render()
    {
        $user = auth()->user();
        $ownedCourseIds = $user->ownedCourseIds();
        $ownedTryoutIds = $user->ownedTryoutIds();
        [$cartProductIds, $courseIdsInCart, $bonusTryoutIdsInCart] = $this->cartState();

        $courses = Course::query()
            ->whereHas('product', fn ($q) => $q->whereHas('product', fn ($p) => $p->where('type', 'course_package')->where('is_active', true)))
            ->when($ownedCourseIds, fn ($q) => $q->whereNotIn('courses.id', $ownedCourseIds))
            ->with(['product.product.bonuses.tryout:id,title', 'teachers.user:id,name,avatar'])
            ->withCount('meetings')
            ->get();

        $tryouts = Exam::query()->where('type', 'tryout')
            ->whereHas('productable.product', fn ($q) => $q->where('type', 'tryout')->where('is_active', true))
            ->when($ownedTryoutIds, fn ($q) => $q->whereNotIn('exams.id', $ownedTryoutIds))
            ->where('status', '!=', 'closed')
            ->with('productable.product')->withCount('questions')
            ->latest('exam_date')->get();

        $addon = Product::where('type', 'addon')->where('is_active', true)->first();
        $hasQuiz = $user->hasEntitlement('quiz');
        $addonPrice = null;
        if ($addon && ! $hasQuiz) {
            try { $addonPrice = app(\App\Services\PricingService::class)->addonPrice(); } catch (\Throwable $e) { $addonPrice = null; }
        }

        return view('livewire.shop.browse', compact('courses', 'tryouts', 'cartProductIds', 'courseIdsInCart', 'bonusTryoutIdsInCart', 'addon', 'hasQuiz', 'addonPrice'));
    }
}
