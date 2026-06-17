<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBonus;
use App\Models\Exam;
use Illuminate\Http\Request;

class ProductBonusController extends Controller
{
    /**
     * List bonus per product
     */
    public function index()
    {
        $products = Product::with([
            'bonuses.tryout',
            'bonuses.course',
        ])
            ->orderBy('name')
            ->paginate(10);

        return view('purchase.bonuses.index', compact('products'));
    }

    /**
     * Form edit bonus untuk product
     */
    public function edit(Product $product)
    {
        $product->load('bonuses');

        $availableTryouts = Exam::where('type', 'tryout')->get();

        $bonusTypes = [
            'tryout' => 'Tryout',
            'quiz'   => 'Quiz',
            'course' => 'Course',
        ];

        return view('purchase.bonuses.edit', compact(
            'product',
            'availableTryouts',
            'bonusTypes'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'bonuses' => 'nullable|array',

            'bonuses.*.bonus_type' => 'required|in:course,tryout,quiz',

            'bonuses.*.bonus_id' => [
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
                    $index = explode('.', $attribute)[1] ?? null;
                    $type  = $request->bonuses[$index]['bonus_type'] ?? null;

                    if (in_array($type, ['course', 'tryout']) && empty($value)) {
                        // biarkan, akan di-skip saat create
                        return;
                    }

                    if ($type === 'quiz' && ! empty($value)) {
                        $fail('Bonus quiz bersifat global, tidak boleh memilih item.');
                    }
                },
            ],
        ]);

        // hapus bonus lama
        $product->bonuses()->delete();

        foreach ($data['bonuses'] ?? [] as $bonus) {

            $bonusType = $bonus['bonus_type'];
            $bonusId   = $bonus['bonus_id'] ?? null;

            /**
             * FIX UTAMA:
             * Skip bonus tryout / course yang tidak dipilih
             */
            if (in_array($bonusType, ['tryout', 'course']) && empty($bonusId)) {
                continue;
            }

            // quiz = global (bonus_id harus null)
            if ($bonusType === 'quiz') {
                $bonusId = null;
            }

            ProductBonus::create([
                'product_id' => $product->id,
                'bonus_type' => $bonusType,
                'bonus_id'   => $bonusId,
            ]);
        }

        toast('success', 'Bonus product berhasil diperbarui');

        return redirect()->route('bonuses.index');
    }



    /**
     * Hapus satu bonus
     */
    public function destroy(ProductBonus $productBonus)
    {
        $productBonus->delete();
        toast('info', 'Bonus berhasil dihapus');
        return back();
    }
}
