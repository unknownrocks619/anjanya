<?php

namespace App\Jobs;

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

class sendVerificationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $_user;
    public function __construct(User $user)
    {
        //
        $this->_user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $email = new RegistrationMail($this->_user);
        Mail::to($this->_user->email, $this->_user->getFullName())->send($email);
    }
}
