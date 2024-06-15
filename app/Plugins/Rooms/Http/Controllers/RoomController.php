<?php

namespace App\Plugins\Rooms\Http\Controllers;

use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Plugins\Rooms\Http\Models\Rooms;
use App\Plugins\Rooms\Http\Models\RoomsAmenities;
use Illuminate\Http\Request;

class RoomController extends  Controller
{
    protected $plugin_name='Rooms';

    public function __construct() {
        app('hooks')->registerHooks('seo.edit', new Hook('bundle.seo.tab', function () {
            return  [
                'name' => __('admin/posts/edit.seo'),
                'view'  => 'backend.seo.add',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'seo']
            ];
        }));

        app('hooks')->registerHooks('image.image-edit', new Hook('bundle.image.tab', function () {
            return  [
                'name' => __('admin/posts/edit.media'),
                'view'  => 'backend.media.list',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'content']
            ];
        }));
        app('hooks')->registerHooks('components-component-edit', new Hook('bundle.component.tab', function () {
            return  [
                'name' => __('admin/posts/edit.component'),
                'view'  => 'themes.components.choices',
                'data'  => ['modelVar' => 'model']
            ];
        }));
    }
    
    public function index() {
        $rooms = Rooms::get();
        return $this->admin_theme('rooms.list',['rooms' => $rooms]);
    }

    public function create() {
        return $this->admin_theme('rooms.create');
    }

    public function store(Request $request) {
        $request->validate([
            'room_name' => 'required',
            'room_intro' => 'required',
            'full_description'  => 'required'
        ]);

        $room = new Rooms();
        $room->fill([
            'room_name' => $request->post('room_name'),
            'slug'      => $request->post('slug') ? $request->post('slug') : Rooms::getSlug($request->post('room_name'),$room),
            'intro_text' => $request->post('room_intro'),
            'short_description' => $request->post('short_description'),
            'full_description'  => $request->post('full_description'),
            'active'            => false,
            'price'             => $request->post('price'),
            'currency'          => $request->post('currency'),
            'discount'          => false,
            'discount_percentage'   => false
        ]);

        if (! $room->save()) {
            return $this->json(false,'Unable to save.');
        }
//        $this->room_amenities($request,$room);
        return $this->json(true,'New Room Created.','redirect',['location' => route('admin.room.edit',['room' => $room])]);
    }

    private function room_amenities(Request $request, Rooms $room) {
        $room_amenities = new RoomsAmenities();
        $room->amenitiesRelation()->delete();
        $record = [];
        foreach ($request->post('amenities') ?? [] as $amenity){
            $record[] = [
                'amenities_id' => $amenity,
                'room_id'   => $room->getKey(),
                'order' => 0,
                'featured'  => false
            ];
        }

        $room_amenities::insert($record);
    }
    
    public function edit(Rooms $room,$current_tab = 'general')
    {
        $room->load(['getSeo', 'getImage' => fn ($query) => $query->with('image'),'amenities']);
        $tabs = [
            'general' => $room,
        ];
        $tabs = array_merge($tabs,app('hooks')->catchHooks('bundle.image.tab', []), app('hooks')
                                                    ->catchHooks('bundle.seo.tab', []), app('hooks')->catchHooks('bundle.component.tab',[]));
        return $this->admin_theme('rooms.edit', ['room' => $room,'tabs' => $tabs,'current_tab' => $current_tab]);
    }

    public function update(Request $request, Rooms $room) {
        $request->validate([
            'room_name' => 'required',
            'room_intro' => 'required',
        ]);
        $room->fill([
            'room_name' => $request->post('room_name'),
            'slug'      => $request->post('slug') ? $request->post('slug') : Rooms::getSlug($request->post('room_name'),$room),
            'intro_text' => $request->post('room_intro'),
            'short_description' => $request->post('short_description'),
            'full_description'  => $request->post('full_description'),
            'status'            => $request->post('active') ? 'active' : 'draft',
            'price'             => $request->post('price'),
            'currency'          => $request->post('currency'),
            'discount'          => false,
            'discount_percentage'   => false
        ]);
        $this->room_amenities($request,$room);
        $room->save();
        return $this->json(true,'Information updated.');
    }
}

