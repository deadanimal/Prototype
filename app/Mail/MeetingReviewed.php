<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetingReviewed extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct()
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Meeting Reviewed',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.meeting_reviewed',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
