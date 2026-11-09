<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\Toasts;
use App\Models\PromoBanner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Promo & Banner')]
class PromoBanners extends Component
{
    use Toasts, WithPagination;

    public function toggle(int $id)
    {
        $p = PromoBanner::findOrFail($id);
        $p->update(['is_active' => ! $p->is_active]);
        Cache::forget('landing_page_v1');
        $this->notify('success', 'Status promo diubah.');
    }

    public function remove(int $id)
    {
        $p = PromoBanner::findOrFail($id);
        if ($p->image_path) Storage::disk('public')->delete($p->image_path);
        $p->delete();
        Cache::forget('landing_page_v1');
        $this->notify('warning', 'Promo dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.promo-banners', ['promos' => PromoBanner::orderByDesc('priority')->latest()->paginate(12)]);
    }
}
