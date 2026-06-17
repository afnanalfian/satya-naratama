<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrowseController extends Controller
{
    /**
     * =====================================================
     * MARKETPLACE UTAMA
     * =====================================================
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $ownedCourseIds   = $user?->ownedCourseIds() ?? [];
        $ownedTryoutIds = $user?->ownedTryoutIds() ?? [];

        $courses = Course::query()
            ->whereNull('courses.deleted_at')

            // HARUS punya product course_package yang aktif
            ->whereHas('product', function ($q) {
                $q->whereHas('product', function ($p) {
                    $p->where('type', 'course_package')
                    ->where('is_active', true);
                });
            })

            // exclude course yang sudah dimiliki user
            ->when(
                ! empty($ownedCourseIds),
                fn ($q) => $q->whereNotIn('courses.id', $ownedCourseIds)
            )

            ->with([
                'product.product', // productable + product
            ])

            ->get();

        $tryouts = Exam::query()
            ->where('type', 'tryout')
            ->whereNull('exams.deleted_at')

            // HARUS punya product tryout yang aktif
            ->whereHas('productable.product', function ($q) {
                $q->where('type', 'tryout')
                ->where('is_active', true);
            })

            // exclude tryout yang sudah dimiliki user
            ->when(
                ! empty($ownedTryoutIds),
                fn ($q) => $q->whereNotIn('exams.id', $ownedTryoutIds)
            )

            ->with([
                'productable.product',
            ])

            ->get();


        /* ==========================
         * CART (UI ONLY)
         * ========================== */
        $cart = $user?->cart;

        $cartProductIds = $cart
            ? $cart->items()->pluck('product_id')->toArray()
            : [];

        /**
         * Course ID yang sedang ADA DI CART
         * (untuk blok meeting di halaman detail)
         */
        $courseIdsInCart = $cart
            ? $cart->items()
                ->whereHas('product', fn ($q) =>
                    $q->where('type', 'course_package')
                )
                ->with('product.productable.productable')
                ->get()
                ->filter(fn ($item) =>
                    $item->product->type === 'course_package'
                    && $item->product->productable
                    && $item->product->productable->productable instanceof Course
                )
                ->map(fn ($item) =>
                    $item->product->productable->productable->id
                )
                ->unique()
                ->values()
                ->toArray()
            : [];
        /**
         * BONUS TRYOUT DARI COURSE PACKAGE YANG ADA DI CART
         */
        $bonusTryoutIdsInCart = [];

        if ($cart) {
            $coursePackageProducts = $cart->items()
                ->whereHas('product', fn ($q) =>
                    $q->where('type', 'course_package')
                )
                ->with('product.bonuses')
                ->get()
                ->pluck('product');

            foreach ($coursePackageProducts as $coursePackage) {
                foreach ($coursePackage->bonuses as $bonus) {
                    if ($bonus->bonus_type === 'tryout' && $bonus->bonus_id) {
                        $bonusTryoutIdsInCart[] = $bonus->bonus_id;
                    }
                }
            }
        }

        $bonusTryoutIdsInCart = array_unique($bonusTryoutIdsInCart);
        return view('purchase.browse.index', compact(
            'courses',
            'tryouts',
            'cartProductIds',
            'courseIdsInCart',
            'bonusTryoutIdsInCart'
        ));
    }

    /**
     * =====================================================
     * DETAIL COURSE + MEETINGS
     * =====================================================
     */
    public function course(Course $course)
    {
        $course->load('coursePackage.product');
        $user = Auth::user();

        $ownedCourseIds  = $user?->ownedCourseIds() ?? [];
        $ownedMeetingIds = $user?->ownedMeetingIds() ?? [];

        $meetings = Meeting::query()
            ->with('productRelation') // GANTI: product menjadi productable.product
            ->where('course_id', $course->id)
            ->whereNull('deleted_at')

            // FULL COURSE OWNED → TIDAK TAMPIL
            ->when(
                in_array($course->id, $ownedCourseIds),
                fn ($q) => $q->whereRaw('1 = 0')
            )

            // MEETING INDIVIDUAL YANG SUDAH DIMILIKI
            ->when(
                ! empty($ownedMeetingIds),
                fn ($q) => $q->whereNotIn('id', $ownedMeetingIds)
            )

            ->orderBy('scheduled_at')
            ->get();

        $cart = $user?->cart;

        $cartProductIds = $cart
            ? $cart->items()->pluck('product_id')->toArray()
            : [];

        $courseIdsInCart = $cart
            ? $cart->items()
                ->whereHas('product', fn ($q) =>
                    $q->where('type', 'course_package')
                )
                ->with('product.productable.productable')
                ->get()
                ->pluck('product.productable.productable.id')
                ->filter()
                ->unique()
                ->values()
                ->toArray()
            : [];

        return view('purchase.browse.course', compact(
            'course',
            'meetings',
            'cartProductIds',
            'courseIdsInCart'
        ));
    }
}
