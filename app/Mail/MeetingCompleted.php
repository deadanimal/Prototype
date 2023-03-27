<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetingCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting;


    /**
     * Create a new message instance.
     */
    public function __construct($meeting)
    {
        $this->meeting = $meeting;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statement = 'Meeting Completed: ' . ($this->meeting->name) . ' on ' . ($this->meeting->meeting_date);
        return new Envelope(
            subject: $statement,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.meeting_completed',
            with: [
                'meeting' => $this->meeting,
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
