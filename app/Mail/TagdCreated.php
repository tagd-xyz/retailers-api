<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Tagd\Core\Models\Item\Tagd;

class TagdCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $item;

    public $retailer;

    public $consumer;

    public $signUpUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Tagd $tagd)
    {
        $this->item = $tagd->item;
        $this->retailer = $tagd->item->retailer;
        $this->consumer = $tagd->consumer;
        $this->signUpUrl = 'https://www.tagd.co.uk';
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Claim your Tagd',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.tagd.created',
            with: [
                'message' => $this,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
