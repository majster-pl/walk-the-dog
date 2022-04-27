<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PendingEditReviewToUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $user)
    {
        $this->details = $details;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Place pending review - WalkTheDog.info')
        ->markdown('emails.PendingEditReviewToUserEmail')
        ->with([
            'details' => $this->details,
            'user' => $this->user
        ]);
    }
}
