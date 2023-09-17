<?php

namespace App\Plugins\Rooms\Http\Controllers;

use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Plugins\Rooms\Http\Models\Rooms;
use App\Plugins\Rooms\Http\Models\RoomsAmenities;
use Illuminate\Http\Request;

class FrontendRoomController extends  Controller
{
    protected $plugin_name='Rooms';

    public function rooms() {

    }

    public function detail(string $slug) {
        $room = Rooms::where('slug',$slug)->with(['getSeo','getImage','amenities'])->where('status','active')->first();
        if ( ! $room ) {
            abort(404);
        }
        $data = [
            'extends'   => 'master',
            'room'      => $room
        ];
        return view('Rooms::frontend.detail',$data);
    }

    public function bookings(string $slug) {

    }
}

