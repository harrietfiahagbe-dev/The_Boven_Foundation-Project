<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewDonationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Donation $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Donation Received - The Boven Foundation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-donation-notification',
            with: [
                'donation' => $this->donation,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
