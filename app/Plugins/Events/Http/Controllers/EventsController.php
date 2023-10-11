<?php

namespace App\Plugins\Events\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Plugins\Events\Http\Models\Event;

class EventsController extends Controller
{
    protected $plugin_name = 'Events';
    public function index() {
        $events = Event::all();
        return $this->admin_theme('events.list',['events' => $events]);
    }

    public function add(){
        return $this->admin_theme('events.create');
    }

    public function edit(){

    }
}
