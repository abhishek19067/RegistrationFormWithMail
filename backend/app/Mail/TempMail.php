<?php 
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TempMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $abhi;
    public $mains;

    /**
     * Create a new abhi instance.
     */
    public function __construct(string $abhi, string $mains)
    {
        $this->abhi = $abhi;
        $this->mains = $mains;
    }

    /**
     * Get the abhi envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mains,  // Use $this->subject here, not $this->abhi
        );
    }

    /**
     * Get the abhi content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail/abhi',  
            with: [
                'abhi' => $this->abhi,
                'subject' => $this->mains,
            ]
        );
    }

    /**
     * Get the attachments for the abhi.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
