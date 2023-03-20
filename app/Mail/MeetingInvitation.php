<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetingInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting;
    public $attendee;

    /**
     * Create a new message instance.
     */
    public function __construct($meeting, $attendee)
    {
        $this->meeting = $meeting;
        $this->attendee = $attendee;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statement = 'Meeting Invitation: ' . ($this->meeting->name) . ' on ' . ($this->meeting->meeting_date);
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
            view: 'emails.meeting_invitation',
            with: [
                'meeting' => $this->meeting,
                'attendee' => $this->attendee,
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
