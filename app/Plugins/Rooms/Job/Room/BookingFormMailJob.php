<?php

namespace App\Plugins\Rooms\Job\Room;

use App\Plugins\Rooms\Mail\Room\BookingMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BookingFormMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected array $bodyContent;
    public function __construct(array $bodyContent)
    {
        //
        return $this->bodyContent = $bodyContent;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $bookingEmail = new BookingMail($this->bodyContent);
        Mail::send($bookingEmail);
    }
}
