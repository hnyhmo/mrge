<?php

namespace App\Mail;

use App\Models\MrgeJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class FirstPostNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $mrgeJob;

    /**
     * Create a new message instance.
     */
    public function __construct(MrgeJob $mrgeJob)
    {
        $this->mrgeJob = $mrgeJob;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Job Post',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.first_post',
            with: ['mrgeJob' => $this->mrgeJob]
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
