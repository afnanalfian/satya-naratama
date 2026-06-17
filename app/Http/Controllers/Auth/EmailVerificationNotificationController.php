<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard.redirect');
        }

        if (
            $user->last_verification_sent_at &&
            now()->diffInSeconds($user->last_verification_sent_at) < 120
        ) {
            toast('warning', 'Harap tunggu sebelum mengirim ulang email verifikasi.');
            return back();
        }
        $user->sendEmailVerificationNotification();
        $user->update([
            'last_verification_sent_at' => now(),
        ]);

        toast('info','Link verifikasi telah dikirim ulang.');
        return back();
    }
}
