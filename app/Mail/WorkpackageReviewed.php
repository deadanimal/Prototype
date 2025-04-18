<?php

namespace App\Mail;

use App\Models\Workpackage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WorkpackageReviewed extends Mailable
{
    use Queueable, SerializesModels;

    public $wp;
    public $review;
    /**
     * Create a new message instance.
     */
    public function __construct($wp, $review)
    {
        $this->wp = $wp;
        $this->review = $review;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statement = '('.$this->review->status.')Work Package ID: '.$this->wp->id.' reviewed by '.$this->review->resource->user->name;
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
            view: 'emails.workpackage_reviewed',
            with: [
                'wp' => $this->wp,
                'review' => $this->review,
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
