<?php

namespace App\Jobs;

use App\Mail\Frontend\User\Membership\ApprovedMail;
use App\Mail\Frontend\User\Membership\ContactMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProductEnquiry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $params;
    public function __construct(array $params)
    {
        //
        $this->params = $params;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $approvedEmail = new ContactMail($this->params);
        Mail::send($approvedEmail);
    }
}
