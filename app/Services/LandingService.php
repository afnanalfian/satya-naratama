<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Meeting;
use App\Models\Teacher;
use App\Models\Exam;
use App\Models\Product;
use App\Models\PricingRule;
use App\Models\PromoBanner;
use Illuminate\Support\Carbon;

class LandingService
{
    public function getLandingData(): array
    {
        /* ======================
        * ACTIVE PROMO BANNERS
        * ====================== */
        $activePromo = PromoBanner::query()
            ->active()
            ->forLanding()
            ->currentlyActive()
            ->orderByPriority()
            ->first(); // Ambil yang prioritas tertinggi saja

        /* ======================
         * COURSES
         * ====================== */
        $courses = Course::query()
            ->whereHas('coursePackage')
            ->with(['teachers.user:id,name,avatar'])
            ->withCount('meetings')
            ->latest()
            ->limit(6)
            ->get();

        /* ======================
         * MEETINGS
         * ====================== */
        $meetings = Meeting::query()
            ->with('course:id,name,slug')
            ->whereIn('status', ['upcoming', 'live'])
            ->where('scheduled_at', '>=', Carbon::now()->subDay())
            ->orderBy('scheduled_at')
            ->limit(6)
            ->get();

        /* ======================
         * TEACHERS
         * ====================== */
        $teachers = Teacher::query()
            ->with([
                'user:id,name,avatar',
                'courses:id,name,slug'
            ])
            ->whereRelation('user', 'is_active', true)
            ->latest()
            ->limit(6)
            ->get();

        /* ======================
         * TRYOUTS
         * ====================== */
        $tryouts = Product::query()
            ->where('type', 'tryout')
            ->where('is_active', true)
            ->whereHas('productable', function ($q) {
                $q->whereHasMorph(
                    'productable',
                    [Exam::class],
                    function ($examQuery) {
                        $examQuery->where('status', '!=', 'closed');
                    }
                );
            })
            ->with([
                'productable.productable',
            ])
            ->latest()
            ->limit(6)
            ->get();

        /* ======================
         * PRICING RULES (PRELOAD)
         * ====================== */
        $pricingRules = PricingRule::query()
            ->active()
            ->get()
            ->groupBy('product_type');

        /* ======================
         * PRODUCTS
         * ====================== */
        $products = Product::query()
            ->where('is_active', true)
            ->whereIn('type', ['course_package', 'meeting', 'tryout'])
            ->with([
                'productables.productable',
                'bonuses.tryout:id,title',
                'bonuses.course:id,name',
            ])
            ->latest()
            ->get()
            ->map(fn (Product $product) => [
                'id'          => $product->id,
                'type'        => $product->type,
                'name'        => $product->name,
                'description' => $product->description,
                'context'     => self::resolveContext($product),
                'pricing'     => self::resolvePricing($product, $pricingRules),
                'bonuses'     => $product->bonuses->map(fn ($b) => [
                    'type' => $b->bonus_type,
                    'data' => $b->bonus_type === 'tryout'
                        ? $b->tryout
                        : $b->course,
                ]),
            ])
            ->groupBy('type');

        return compact(
            'courses',
            'meetings',
            'teachers',
            'tryouts',
            'products',
            'activePromo'
        );
    }

    /* =====================================================
     * CONTEXT (SAFE DATA ONLY)
     * ===================================================== */
    protected static function resolveContext(Product $product): ?array
    {
        $model = $product->actual_model;

        if (!$model) {
            return null;
        }

        return match ($product->type) {
            'meeting' => [
                'id'    => $model->id,
                'title' => $model->title,
            ],
            'course_package' => [
                'id'   => $model->id,
                'name' => $model->name,
            ],
            'tryout' => [
                'id'    => $model->id,
                'title' => $model->title,
            ],
            default => null,
        };
    }

    /* =====================================================
     * PRICING (NO N+1)
     * ===================================================== */
    protected static function resolvePricing(Product $product, $pricingRules): array
    {
        $rules = $pricingRules[$product->type] ?? collect();
        $model = $product->actual_model;

        // Specific priceable
        if ($model) {
            $rule = $rules->first(fn ($r) =>
                $r->priceable_type === $model::class &&
                $r->priceable_id === $model->id
            );

            if ($rule) {
                return [
                    'type'  => $rule->pricing_type,
                    'price' => $rule->price,
                ];
            }
        }

        // Global fallback
        $global = $rules->first(fn ($r) =>
            is_null($r->priceable_type) &&
            is_null($r->priceable_id)
        );

        if ($global) {
            return [
                'type'  => $global->pricing_type,
                'price' => $global->price,
            ];
        }

        return [
            'type'  => 'fixed',
            'price' => 0,
        ];
    }
}
