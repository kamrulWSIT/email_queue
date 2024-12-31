<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;
    protected  $otp;

    /**
     * Create a new message instance.
     */
    public function __construct($otp)
    {
        $this->otp = $otp;
        // dd($this->otp);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // dd('envelope');
        return new Envelope(
            subject: 'Send Otp Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // dd(gettype((array)$this->otp));
        return new Content(
            view: 'mail.send_otp',
            // with: [
            //     'otp' => $this->otp,
            // ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // dd('attachments');
        return [];
    }
}
