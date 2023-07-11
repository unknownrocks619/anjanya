<?php

namespace App\Mail\Frontend\User\Membership;

use App\Classes\Helpers\EmailContentTemplate;
use App\Classes\Helpers\SystemSetting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $user;
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    public function build()
    {
        // [__TEMPLATE_RENDER__]
        $subject = SystemSetting::basic_configuration('user_membership_registration_subject');

        if (!$subject) {
            $subject = SystemSetting::welcomeEmailSubject('value') ?? 'Application Received';
        }
        $content = EmailContentTemplate::replaceContent(SystemSetting::member_registration_email('value'), $this->user);
        return $this->from('noreply@anjanyayouthclub.com', SystemSetting::basic_configuration('site_name'))
            ->to($this->user->email, $this->user->getFullName())
            ->subject($subject)
            ->html($content);
    }
}
