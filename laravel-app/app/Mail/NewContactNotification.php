<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $messageModel;

    public function __construct(ContactMessage $messageModel)
    {
        $this->messageModel = $messageModel;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Message - The Boven Foundation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-contact-notification',
            with: [
                'contact' => $this->messageModel,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
