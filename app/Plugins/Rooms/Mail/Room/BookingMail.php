<?php

namespace App\Plugins\Rooms\Mail\Room;

use App\Classes\Helpers\SystemSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected array $body;
    public function __construct(array $body)
    {
        $this->body = $body;
    }

    public function build(){
        return $this->from('webmaster@belleviehotel', SystemSetting::basic_configuration('site_name'))
            ->to(SystemSetting::primary_contact_info('primary_email_address'),SystemSetting::basic_configuration('site_name'))
            ->subject('Booking Request')
            ->view('Rooms::emails.booking', ['params' => $this->body]);
    }
}
