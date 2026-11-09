<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\Toasts;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Produk')]
class Products extends Component
{
    use Toasts, WithPagination;

    #[Url] public string $q = '';
    #[Url] public string $type = '';

    public function updating($n) { if (in_array($n, ['q', 'type'])) $this->resetPage(); }

    public function toggle(int $id)
    {
        $p = Product::findOrFail($id);
        $p->update(['is_active' => ! $p->is_active]);
        $this->notify('success', "{$p->name} ".($p->is_active ? 'diaktifkan' : 'dinonaktifkan').'.');
    }

    public function remove(int $id)
    {
        $p = Product::findOrFail($id);
        if ($p->orderItems()->exists()) {
            return $this->notify('error', 'Produk sudah pernah dibeli. Nonaktifkan saja agar riwayat pesanan tetap utuh.');
        }
        $p->delete();
        $this->notify('warning', 'Produk dihapus.');
    }

    public function render()
    {
        $products = Product::with('productable.productable', 'bonuses')
            ->when(trim($this->q), fn ($q) => $q->where('name', 'like', '%'.trim($this->q).'%'))
            ->when($this->type, fn ($q) => $q->where('type', $this->type))
            ->orderBy('type')->orderBy('name')->paginate(20);

        return view('livewire.admin.products', ['products' => $products, 'counts' => Product::selectRaw('type, COUNT(*) n')->groupBy('type')->pluck('n', 'type')]);
    }
}
