<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\Toasts;
use App\Models\PricingRule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Aturan Harga')]
class Pricing extends Component
{
    use Toasts;

    #[Url] public string $type = '';

    public function toggle(int $id)
    {
        $r = PricingRule::findOrFail($id);
        $r->update(['is_active' => ! $r->is_active]);
        $this->notify('success', 'Status aturan harga diperbarui.');
    }

    public function remove(int $id)
    {
        PricingRule::findOrFail($id)->delete();
        $this->notify('success', 'Aturan harga dihapus.');
    }

    public function render()
    {
        $rules = PricingRule::with('priceable')
            ->when($this->type, fn ($q) => $q->where('product_type', $this->type))
            ->orderBy('product_type')->orderBy('priceable_type')->orderBy('min_qty')->get()
            ->groupBy('product_type');

        return view('livewire.admin.pricing', compact('rules'));
    }
}
