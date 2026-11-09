<?php

namespace App\Livewire;

use Livewire\Component;

/** Lonceng notifikasi di header (polling ringan setiap 45 detik). */
class NotificationBell extends Component
{
    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        $user = auth()->user();

        return view('livewire.notification-bell', [
            'unread' => $user->unreadNotifications()->count(),
            'latest' => $user->notifications()->latest()->limit(6)->get(),
        ]);
    }
}
