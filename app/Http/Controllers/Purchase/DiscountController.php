<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * List semua discount
     */
    public function index()
    {
        $discounts = Discount::with('targets')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('purchase.discounts.index', compact('discounts'));
    }

    /**
     * Form tambah discount
     */
    public function create()
    {
        $products = Product::where('is_active', true)->get();

        return view('purchase.discounts.create', compact('products'));
    }

    /**
     * Simpan discount baru
     */
    public function store(Request $request)
    {
        /**
         * =========================
         * 1. VALIDASI REQUEST
         * =========================
         */
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'code'             => 'nullable|string|max:50|unique:discounts,code',
            'type'             => 'required|in:percentage,fixed',
            'value'            => 'required|numeric|min:0',
            'max_discount'     => 'nullable|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'quota'            => 'nullable|integer|min:1',
            'starts_at'        => 'nullable|date',
            'ends_at'          => 'nullable|date|after:starts_at',
            'is_active'        => 'sometimes|boolean',
            'product_ids'      => 'nullable|array',
            'product_ids.*'    => 'exists:products,id',
        ]);

        /**
         * =========================
         * 2. VALIDASI BISNIS
         * =========================
         */
        if ($data['type'] === 'percentage' && $data['value'] > 100) {
            return back()
                ->withErrors(['value' => 'Discount persentase tidak boleh lebih dari 100%'])
                ->withInput();
        }

        if ($data['type'] === 'fixed') {
            $data['max_discount'] = null;
        }

        /**
         * =========================
         * 3. NORMALISASI DATA
         * =========================
         */
        $data['code'] = $data['code']
            ? strtoupper($data['code'])
            : null;

        $data['is_active'] = $data['is_active'] ?? true;

        /**
         * =========================
         * 4. SIMPAN DISCOUNT
         * =========================
         */
        $discount = Discount::create($data);

        /**
         * =========================
         * 5. ATTACH PRODUCT TARGET
         * =========================
         */
        if (! empty($data['product_ids'])) {
            $discount->targets()->attach($data['product_ids']);
        }

        toast('success', 'Discount berhasil dibuat');

        return redirect()
            ->route('discounts.index');
    }

    /**
     * Form edit discount
     */
    public function edit(Discount $discount)
    {
        $products = Product::where('is_active', true)->get();

        $discount->load('targets');

        return view(
            'purchase.discounts.edit',
            compact('discount', 'products')
        );
    }

    /**
     * Update discount
     */
    public function update(Request $request, Discount $discount)
    {
        /**
         * =========================
         * 1. VALIDASI
         * =========================
         */
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'code'             => 'nullable|string|max:50|unique:discounts,code,' . $discount->id,
            'type'             => 'required|in:percentage,fixed',
            'value'            => 'required|numeric|min:0',
            'max_discount'     => 'nullable|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'quota'            => 'nullable|integer|min:1',
            'starts_at'        => 'nullable|date',
            'ends_at'          => 'nullable|date|after:starts_at',
            'is_active'        => 'sometimes|boolean',
            'product_ids'      => 'nullable|array',
            'product_ids.*'    => 'exists:products,id',
        ]);

        /**
         * =========================
         * 2. VALIDASI BISNIS
         * =========================
         */
        if ($data['type'] === 'percentage' && $data['value'] > 100) {
            return back()
                ->withErrors(['value' => 'Discount persentase tidak boleh lebih dari 100%'])
                ->withInput();
        }

        if ($data['type'] === 'fixed') {
            $data['max_discount'] = null;
        }

        /**
         * =========================
         * 3. NORMALISASI
         * =========================
         */
        $data['code'] = $data['code']
            ? strtoupper($data['code'])
            : $discount->code;

        $data['is_active'] = $data['is_active'] ?? false;

        /**
         * =========================
         * 4. UPDATE DISCOUNT
         * =========================
         */
        $discount->update($data);

        /**
         * =========================
         * 5. SYNC PRODUCT TARGET
         * =========================
         */
        if (array_key_exists('product_ids', $data)) {
            $discount->targets()->sync($data['product_ids'] ?? []);
        }

        toast('success', 'Discount berhasil diperbarui');

        return redirect()
            ->route('discounts.index');
    }

    /**
     * Nonaktifkan discount
     */
    public function destroy(Discount $discount)
    {
        // HAPUS SEMUA PIVOT RELASI (WAJIB UNTUK POLYMORPHIC)
        $discount->targets()->detach();

        // HAPUS PERMANEN RECORD
        $discount->delete();

        toast('success', 'Discount berhasil dihapus permanen');

        return redirect()->route('discounts.index');
    }
    public function show(Discount $discount)
    {
        $discount->load('targets');

        return view('purchase.discounts.show', compact('discount'));
    }
    /**
     * Toggle aktif / nonaktif
     */
    public function toggle(Discount $discount)
    {
        $discount->update([
            'is_active' => ! $discount->is_active,
        ]);

        return back()->with('success', 'Status discount diperbarui');
    }
}
