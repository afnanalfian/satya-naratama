<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Productable;
use App\Models\Course;
use App\Models\Meeting;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::with('productable.productable')
            ->orderBy('type')
            ->orderBy('name')
            ->paginate(10);

        return view('purchase.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('purchase.products.create', [
            'courses'  => Course::orderBy('name')->get(),
            'meetings' => Meeting::orderBy('title')->get(),
            'tryouts'  => Exam::where('type', 'tryout')->orderBy('title')->get(),
        ]);
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => [
                'required',
                Rule::in(['meeting', 'course_package', 'tryout', 'addon']),
            ],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',

            // productable (addon boleh null)
            'productable_type' => 'nullable|string',
            'productable_id'   => 'nullable|integer',
        ]);

        $product = Product::create([
            'type'        => $validated['type'],
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_active'   => $validated['is_active'] ?? true,
        ]);

        // addon tidak punya productable
        if ($validated['type'] !== 'addon') {
            Productable::create([
                'product_id'       => $product->id,
                'productable_type' => $this->mapProductableClass($validated['type']),
                'productable_id'   => $validated['productable_id'],
            ]);
        }

        toast('success', 'Product berhasil dibuat.');
        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('purchase.products.edit', [
            'product'  => $product->load('productable.productable'),
            'courses'  => Course::orderBy('name')->get(),
            'meetings' => Meeting::orderBy('title')->get(),
            'tryouts'  => Exam::where('type', 'tryout')->orderBy('title')->get(),
        ]);
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'type' => [
                'required',
                Rule::in(['meeting', 'course_package', 'tryout', 'addon']),
            ],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',

            'productable_type' => 'nullable|string',
            'productable_id'   => 'nullable|integer',
        ]);

        $product->update([
            'type'        => $validated['type'],
            'name'        => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_active'   => $validated['is_active'] ?? true,
        ]);

        // reset productable
        $product->productable()?->delete();

        if ($validated['type'] !== 'addon') {
            Productable::create([
                'product_id'       => $product->id,
                'productable_type' => $this->mapProductableClass($validated['type']),
                'productable_id'   => $validated['productable_id'],
            ]);
        }

        toast('success', 'Product berhasil diperbarui.');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product)
    {
        // if (
        //     $product->cartItems()->exists() ||
        //     $product->orderItems()->exists()
        // ) {
        //     toast('error', 'Product tidak bisa dihapus karena sudah digunakan.');
        //     return back();
        // }

        $product->delete();

        toast('warning', 'Product telah dihapus.');
        return redirect()->route('products.index');
    }

    /**
     * Toggle active status.
     */
    public function toggleStatus(Product $product)
    {
        $product->update([
            'is_active' => ! $product->is_active,
        ]);

        toast('success', 'Status product diperbarui.');
        return back();
    }

    /**
     * Ajax: get selectable productables by type.
     */
    public function productables(string $type)
    {
        return match ($type) {
            'meeting' => Meeting::select('id', 'title')->get(),
            'course_package' => Course::select('id', 'name')->get(),
            'tryout' => Exam::where('type', 'tryout')->select('id', 'title')->get(),
            default => collect(),
        };
    }

    /**
     * Map product type to morph class.
     */
    protected function mapProductableClass(string $type): string
    {
        return match ($type) {
            'meeting'        => Meeting::class,
            'course_package' => Course::class,
            'tryout'         => Exam::class,
            default          => throw new \InvalidArgumentException('Invalid productable type'),
        };
    }
}
