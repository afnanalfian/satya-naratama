<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\PromoBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoBannerController extends Controller
{
    public function index()
    {
        $promos = PromoBanner::latest()->paginate(10);
        return view('marketing.promo-banners.index', compact('promos'));
    }

    public function create()
    {
        return view('marketing.promo-banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'target_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'show_on_landing' => 'boolean',
            'type' => 'in:popup,banner,modal',
            'display_delay' => 'integer|min:0',
            'display_duration' => 'integer|min:5|max:300',
            'priority' => 'integer|min:1|max:10',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        // Upload image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('promo-banners', 'public');
            $validated['image_path'] = $path;
        }

        PromoBanner::create($validated);

        toast('success', 'Promo banner berhasil ditambahkan');
        return redirect()->route('promo-banners.index');
    }

    public function edit(PromoBanner $promoBanner)
    {
        return view('marketing.promo-banners.edit', compact('promoBanner'));
    }

    public function update(Request $request, PromoBanner $promoBanner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'target_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'show_on_landing' => 'boolean',
            'type' => 'in:popup,banner,modal',
            'display_delay' => 'integer|min:0',
            'display_duration' => 'integer|min:5|max:300',
            'priority' => 'integer|min:1|max:10',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        // Update image jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($promoBanner->image_path) {
                Storage::disk('public')->delete($promoBanner->image_path);
            }

            $path = $request->file('image')->store('promo-banners', 'public');
            $validated['image_path'] = $path;
        }

        $promoBanner->update($validated);

        toast('success', 'Promo banner berhasil diperbarui');
        return redirect()->route('promo-banners.index');
    }

    public function destroy(PromoBanner $promoBanner)
    {
        // Hapus gambar
        if ($promoBanner->image_path) {
            Storage::disk('public')->delete($promoBanner->image_path);
        }

        $promoBanner->delete();
        toast('warning', 'Promo banner berhasil dihapus');
        return redirect()->route('promo-banners.index');
    }

    public function toggleStatus(PromoBanner $promoBanner)
    {
        $promoBanner->update(['is_active' => !$promoBanner->is_active]);
        toast('success', 'Status berhasil diubah');
        return back();
    }
}
