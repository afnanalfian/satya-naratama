<?php
// app/Mail/RegistrationStatusMail.php

namespace App\Mail;

use App\Models\StudentRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    public function __construct(StudentRegistration $registration)
    {
        $this->registration = $registration;
    }

    public function envelope()
    {
        return new Envelope(
            subject: '📝 Status Pendaftaran Anda - Satya Naratama',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.registration-status',
        );
    }

    public function attachments()
    {
        return [];
    }
}