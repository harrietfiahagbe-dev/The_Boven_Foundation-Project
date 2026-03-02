<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ThankYouEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Donation $donation;

    /**
     * Create a new message instance.
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank You for Your Donation - The Boven Foundation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.thank-you',
            with: [
                'donation' => $this->donation,
                'donorName' => $this->donation->name,
                'amount' => number_format($this->donation->amount, 2),
                'paymentMethod' => $this->getPaymentMethodLabel($this->donation->payment_method),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Get human-readable payment method label
     */
    private function getPaymentMethodLabel(string $method): string
    {
        return match($method) {
            'bank_transfer' => 'Bank Transfer',
            'mtn_mobile_money' => 'MTN Mobile Money',
            'telecel_cash' => 'Telecel Cash',
            'atmoney' => 'ATMoney',
            default => ucfirst(str_replace('_', ' ', $method)),
        };
    }
}
