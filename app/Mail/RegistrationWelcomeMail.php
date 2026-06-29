<?php
// app/Mail/RegistrationWelcomeMail.php

namespace App\Mail;

use App\Models\User;
use App\Models\StudentRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $registration;

    public function __construct(User $user, StudentRegistration $registration)
    {
        $this->user = $user;
        $this->registration = $registration;
    }

    public function envelope()
    {
        return new Envelope(
            subject: '🎉 Selamat! Pendaftaran Anda Diterima - Satya Naratama',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.registration-welcome',
        );
    }

    public function attachments()
    {
        return [];
    }
}