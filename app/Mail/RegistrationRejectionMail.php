<?php
// app/Mail/RegistrationRejectionMail.php

namespace App\Mail;

use App\Models\StudentRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationRejectionMail extends Mailable
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
            subject: '❌ Pemberitahuan Penolakan Pendaftaran - Satya Naratama',
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.registration-rejection',
        );
    }

    public function attachments()
    {
        return [];
    }
}