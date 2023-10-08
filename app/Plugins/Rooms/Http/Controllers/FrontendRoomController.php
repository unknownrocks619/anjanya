<?php

namespace App\Plugins\Rooms\Http\Controllers;

use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Plugins\Rooms\Http\Models\Rooms;
use App\Plugins\Rooms\Http\Models\RoomsAmenities;
use Illuminate\Http\Request;

class FrontendRoomController extends  Controller
{
    protected $plugin_name='Rooms';

    public function rooms() {
        $menu = Menu::where('slug', 'room')->where('active',true)->first();
        if (! $menu ) {
            abort($menu);
        }
        $rooms = Rooms::where('status','active')->with(['getSeo','getImage','amenities'])->get();
        return view('Rooms::frontend.list',['rooms' => $rooms,'menu' => $menu]);
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

