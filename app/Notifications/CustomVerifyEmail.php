<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

class CustomVerifyEmail extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    public function toMail($notifiable)
    {
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Email Akun Azwara Learning')
            ->view('emails.verify', [
                'user' => $notifiable,
                'verificationUrl' => $url,
            ]);
    }
}
