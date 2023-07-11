<?php

namespace App\Jobs;

use App\Mail\Frontend\User\InvitationMail;
use App\Mail\Frontend\User\RegistrationMail;
use App\Mail\Frontend\User\ResetLinkMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendResetLink implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $_user = '';

    protected $_reset_link = '';
    public function __construct(User $user, string $reset_link)
    {
        //
        $this->_user = $user;
        $this->_reset_link = $reset_link;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $sentEmail = new ResetLinkMail($this->_user, $this->_reset_link);
        Mail::to($this->_user->email)->send($sentEmail);
    }
}
