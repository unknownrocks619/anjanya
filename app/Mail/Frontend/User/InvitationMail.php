<?php

namespace App\Mail\Frontend\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $_link;
    public $_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $email, string $invitation_link)
    {
        //
        $this->_link = $invitation_link;
        $this->_email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('noreply@upschoo.co', 'Upschool.co')
            ->to($this->_email)
            ->subject('You are Invited !')
            ->view('emails.invitation', ['url' => $this->_link]);
    }
}
