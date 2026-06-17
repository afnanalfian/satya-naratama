<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * LIST NOTIFICATION USER
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $notifications = $user->notifications()
            ->latest()
            ->paginate(15);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * MARK SINGLE AS READ + REDIRECT
     */
    public function read(string $id)
    {
        $notification = auth()->user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return redirect(
            $notification->data['url'] ?? route('notifications.index')
        );
    }
    public function markRead(string $id)
    {
        $notification = auth()->user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return response()->json(['status' => 'ok']);
    }

    /**
     * MARK ALL AS READ
     */
    public function readAll()
    {
        auth()->user()
            ->unreadNotifications
            ->markAsRead();

        toast('success', 'Semua notifikasi ditandai sudah dibaca');
        return back();
    }

    /**
     * DELETE SINGLE
     */
    public function destroy(string $id)
    {
        auth()->user()
            ->notifications()
            ->where('id', $id)
            ->delete();

        toast('success', 'Notifikasi dihapus');
        return back();
    }

    /**
     * CLEAR ALL
     */
    public function clear()
    {
        auth()->user()
            ->notifications()
            ->delete();

        toast('success', 'Semua notifikasi dihapus');
        return back();
    }
}
