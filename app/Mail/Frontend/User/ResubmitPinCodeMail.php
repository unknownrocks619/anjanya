<?php

namespace App\Mail\Frontend\User;

use App\Classes\Helpers\EmailContentTemplate;
use App\Classes\Helpers\SystemSetting;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResubmitPinCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $user;
    protected $code;
    public function __construct(User $user, $code)
    {
        //
        $this->user = $user;
        $this->code = $code;
    }

    public function build()
    {
        $subject = 'Application Pin Code';
        $content = "Your Pin Code is <br /><br />";
        $explode  = str_split($this->code);
        foreach ($explode as $key => $value) {
            $content .= "<span style='border:1px solid #000;margin-left:2px; margin-right:2px; padding:5px'>";
            $content .= $value;
            $content .= "</span>";
        }

        return $this->from('noreply@anjanyayouthclub.com', SystemSetting::basic_configuration('site_name'))
            ->to($this->user->email, $this->user->getFullName())
            ->subject($subject)
            ->html($content);
    }
}
