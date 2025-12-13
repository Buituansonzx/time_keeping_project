<?php

namespace App\Containers\AppSection\Authentication\Mails;

use App\Ship\Parents\Mails\Mail as ParentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

final class SendOtpMail extends ParentMail implements ShouldQueue
{
    public string $otp;

    public function __construct(string $otp)
    {
        $this->otp = $otp;
    }

    /**
     * The message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mã OTP của bạn',
        );
    }

    /**
     * The message content.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.otp',
            with: [
                'otp' => $this->otp,
            ]
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
}
