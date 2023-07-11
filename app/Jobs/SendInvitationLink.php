<?php

namespace App\Jobs;

use App\Mail\Frontend\User\InvitationMail;
use App\Mail\Frontend\User\RegistrationMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendInvitationLink implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $_emails = [];

    protected $_invite_link = '';
    public function __construct(array $emails, string $shareableLink)
    {
        //
        $this->_emails = $emails;
        $this->_invite_link = $shareableLink;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $restCode = 1;
        foreach ($this->_emails as $userEmail) {
            $sentEmail = new InvitationMail($userEmail, $this->_invite_link);
            Mail::to($userEmail)->send($sentEmail);
            sleep($restCode);
            $restCode++;
        }
    }
}
