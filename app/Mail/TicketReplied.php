<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketReplied extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $tmessage;

    public function __construct($ticket, $tmessage)
    {
        $this->ticket = $ticket;
        $this->tmessage = $tmessage;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statement = 'Ticket ID: '.$this->ticket->id.' received a reply ID: '. $this->tmessage->id;
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
            view: 'emails.ticket_replied',
            with: [
                'ticket' => $this->ticket,
                'tmessage' => $this->tmessage,
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
