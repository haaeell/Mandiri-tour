<?php

namespace App\Mail;

use App\Models\EmailMarketing;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $subscriber;
    /**
     * Create a new message instance.
     */
    public function __construct(EmailMarketing $email, User $subscriber)
    {
        $this->email = $email;
        $this->subscriber = $subscriber;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Promooo!!!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.send_email',
        );
    }

    public function build()
    {
        return $this
        ->subject($this->email->subject)
        ->view('emails.send_email', [
            'email' => $this->email,
            'subscriber' => $this->subscriber,
        ]);
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
