<?php

namespace App\Livewire\Notifications;

use App\Livewire\Concerns\Toasts;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Notifikasi')]
class Index extends Component
{
    use Toasts, WithPagination;

    public string $filter = 'all';

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function markRead(string $id)
    {
        auth()->user()->notifications()->where('id', $id)->first()?->markAsRead();
    }

    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->notify('success', 'Semua notifikasi ditandai sudah dibaca');
    }

    public function remove(string $id)
    {
        auth()->user()->notifications()->where('id', $id)->delete();
        $this->notify('success', 'Notifikasi dihapus');
    }

    public function clear()
    {
        auth()->user()->notifications()->delete();
        $this->notify('success', 'Semua notifikasi dihapus');
    }

    public function render()
    {
        $q = auth()->user()->notifications()->latest();
        if ($this->filter === 'unread') {
            $q->whereNull('read_at');
        }

        return view('livewire.notifications.index', [
            'notifications' => $q->paginate(15),
            'unreadCount' => auth()->user()->unreadNotifications()->count(),
        ]);
    }
}
