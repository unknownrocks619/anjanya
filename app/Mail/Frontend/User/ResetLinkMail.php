<?php

namespace App\Mail\Frontend\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ResetLinkMail extends Mailable
{
    use Queueable, SerializesModels;
    public $_user;

    public $_token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $token)
    {
        //
        $this->_user = $user;
        $this->_token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@upschoo.co', 'Upschool.co')
            ->to($this->_user->email, $this->_user->getFullName())
            ->subject('Reset Your Password')
            ->view('emails.reset_password', ['user' => $this->_user, 'token' => $this->_token]);
    }
}
