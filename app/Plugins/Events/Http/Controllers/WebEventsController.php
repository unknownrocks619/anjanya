<?php

namespace App\Plugins\Events\Http\Controllers;

use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Plugins\Events\Http\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class WebEventsController extends Controller
{
    protected $plugin_name = 'Events';

    public function index(string $slug) {
        $event = Event::where('event_slug',$slug)
                        ->where('active',true)
                        ->with(['getImage' => function($query){
                            $query->with('image');
                        },'getSeo'])
                        ->firstOrFail();
        $data = [
            'extends'   => 'master',
            'event'      => $event,
            'events'    => $this->getEvents()
        ];
        return view('Events::frontend.detail',$data);

    }

    public function events() {
        $data = [
            'extends'   => 'master',
            'events'    => $this->getEvents()
        ];
        return view('Events::frontend.list',$data);
    }

    public function getEvents() {
        if (Cache::has('FRONTEND_EVENTS_LISTS') ) {
            return Cache::get('FRONTEND_EVENTS_LISTS');
        }
        $events = Event::with(['getImage'=> function($query){
                            $query->with('image');
                        },'getComponents'])
                        ->where('active',true)
                        ->orderBy('event_start_date','asc')
                        ->get();
        Cache::put('FRONTEND_EVENTS_LISTS',$events);
        return $events;
    }
}
