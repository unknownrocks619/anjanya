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

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected array $params;
    public function __construct(array $params)
    {
        $this->params =  $params;
    }

    public function build()
    {

        return $this->from($this->params['email'], $this->params['full_name'])
            ->to(SystemSetting::primary_contact_info('primary_email_address') ?? 'info@siddhamahayog.org')
            ->subject($this->params['subject'])
            ->html($this->params['message']);
    }
}
