<?php

namespace App\Plugins\Rooms\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Plugins\Rooms\Http\Models\Rooms;
use App\Plugins\Rooms\Job\Room\BookingFormMailJob;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function booking(string $slug = null) {
        $request = Request::capture();
        $request->validate([
            'full_name' => 'required|string',
            'email_address' => 'required|email',
            'check_in'      => 'required|date',
            'check_out'     => 'required|date',
            'adult_count'   => 'required|int|min:1',
            'child_count'   => 'required|int',
        ]);
        if ( is_null($slug) ) {
            $request->validate(['room' => 'required']);
        }
        $room = Rooms::where('slug',$request->post('room'))
                    ->where('status','active')
                    ->first();
        if (! $room ) {
            return $this->json(false,'Unable to complete your request.');
        }
        $params = $request->except(['_token']);
        $params['room'] = "<a href='".route('room.detail',['slug' => $room->slug])."'>{$room->room_name}</a>";
        BookingFormMailJob::dispatchSync($params);
        return $this->json(true,'Enquiry has been sent. Our Team Will contact you soon. Thank-you');
    }
}
