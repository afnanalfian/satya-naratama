<?php

namespace App\Livewire\Concerns;

trait Toasts
{
    /** Toast instan di halaman (tanpa reload). */
    protected function notify(string $type, string $message): void
    {
        $this->dispatch('toast', type: $type, message: $message);
    }

    /** Toast yang tampil setelah redirect. */
    protected function flashToast(string $type, string $message): void
    {
        toast($type, $message);
    }
}
