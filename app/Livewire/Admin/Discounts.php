<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\Toasts;
use App\Models\Discount;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Diskon & Voucher')]
class Discounts extends Component
{
    use Toasts, WithPagination;

    #[Url] public string $q = '';
    #[Url] public string $kind = '';

    public function updating($n) { if (in_array($n, ['q', 'kind'])) $this->resetPage(); }

    public function toggle(int $id)
    {
        $d = Discount::findOrFail($id);
        $d->update(['is_active' => ! $d->is_active]);
        $this->notify('success', 'Status diskon diperbarui.');
    }

    public function remove(int $id)
    {
        $d = Discount::findOrFail($id);
        $d->targets()->detach();
        $d->delete();
        $this->notify('success', 'Diskon dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.discounts', [
            'discounts' => Discount::with('targets')
                ->when(trim($this->q), fn ($q) => $q->where(fn ($w) => $w->where('name', 'like', '%'.trim($this->q).'%')->orWhere('code', 'like', '%'.trim($this->q).'%')))
                ->when($this->kind === 'voucher', fn ($q) => $q->whereNotNull('code'))
                ->when($this->kind === 'auto', fn ($q) => $q->whereNull('code'))
                ->latest()->paginate(15),
        ]);
    }
}
