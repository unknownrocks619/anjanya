<?php

namespace App\Mail\Frontend\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $_user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
        $this->_user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $verification_url = URL::temporarySignedRoute('frontend.users.verify_email', now()->addHours(12), ['user' => $this->_user]);
        return $this->from('noreply@upschoo.co', 'Upschool.co')
            ->to($this->_user->email, $this->_user->getFullName())
            ->subject('Verify Your Email')
            ->view('emails.registration', ['first_name' => $this->_user->first_name, 'verificationUrl' => $verification_url]);
    }
}
