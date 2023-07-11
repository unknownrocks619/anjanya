<?php

namespace App\Mail\Frontend\User\Membership;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Classes\Helpers\EmailContentTemplate;
use App\Classes\Helpers\SystemSetting;

class ApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $user;
    public function __construct(User $user)
    {
        $this->user =  $user;
    }

    public function build()
    {
        $subject = SystemSetting::member_registration_approved_email_subject('value') ?? 'Application Approved.';
        $content = EmailContentTemplate::replaceContent(SystemSetting::member_registration_approved_email('value'), $this->user);


        return $this->from('noreply@anjanyayouthclub.com', SystemSetting::basic_configuration('site_name'))
            ->to($this->user->email, $this->user->getFullName())
            ->subject($subject)
            ->html($content);
    }

    public function button()
    {
        $route = route('frontend.users.resubmit_application');
        $button = '<a href="' . $route . '" style="background: #67C100 !important; border: #67C100 !important;border-radius: 2px; padding: 8px 12px;
        border: 1px solid #ED2939;
        border-radius: 2px;
        font-family: Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #ffffff;
        text-decoration: none;
        font-weight: bold;
        display: inline-block;  ">';
        $button .= "Resubmit My Application";
        $button .= '</a>';

        return $button;
    }
}
