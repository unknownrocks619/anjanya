<?php

namespace App\Plugins\Events\Http\Controllers;

use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Plugins\Events\Http\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventsController extends Controller
{
    protected $plugin_name = 'Events';

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
        $events = Event::all();
        return $this->admin_theme('events.list',['events' => $events]);
    }

    public function add(Request $request){
        if($request->ajax() && $request->post()) {
            $request->validate([
                'event_name'   => 'required',
                'intro_description' => 'required',
                'event_start'    => 'required',
                'event_end'  => 'required'
            ]);
            $event_start_carbon = Carbon::createFromFormat('Y-m-d\TH:i',$request->post('event_start'));
            $event_end_carbon = Carbon::createFromFormat('Y-m-d\TH:i',$request->post('event_end'));
            $event = new Event();
            $event->fill([
                'event_title'   => $request->post('event_name'),
                'active'    => false,
                'paid_event'    => false,
                'intro_description' => $request->post('intro_description'),
                'short_description' => $request->post('short_description'),
                'full_description'  => $request->post('full_description'),
                'event_slug'        => Event::getSlug($request->post('event_name'),$event),
                'event_start_date'  => $request->post('event_start'),
                'event_end_date'    => $request->post('event_end'),
                'event_start_time'  => $event_start_carbon->format('H:i:s'),
                'event_end_time'  => $event_end_carbon->format('H:i:s'),
                'glitter_background'  => $request->post('glitter_background')
            ]);

            if (! $event->save()) {
                return $this->json(false,'Unable to create new event.');
            }
            return $this->json(true,'Event Created.','redirect',['location' => route('admin.events.edit',['event' => $event])]);
        }
        return $this->admin_theme('events.create');
    }

    public function edit(Request $request, Event $event, $current_tab='general'){


        if ($request->ajax()  && $request->post()) {
            // check if slug already exists.
            $request->validate([
                'event_name'   => 'required',
                'intro_description' => 'required',
                'event_start'    => 'required',
                'event_end'  => 'required',
                'event_value'   => 'required'
            ]);

            $event_start_carbon = Carbon::createFromFormat('Y-m-d\TH:i',$request->post('event_start'));
            $event_end_carbon = Carbon::createFromFormat('Y-m-d\TH:i',$request->post('event_end'));

            $event->fill([
                'event_title'   => $request->post('event_name'),
                'active'    => (bool) $request->post('active'),
                'intro_description' => $request->post('intro_description'),
                'short_description' => $request->post('short_description'),
                'full_description'  => $request->post('full_description'),
                'event_slug'        => Event::getSlug($request->post('event_value'),$event),
                'event_start_date'  => $request->post('event_start'),
                'event_end_date'    => $request->post('event_end'),
                'event_start_time'  => $event_start_carbon->format('H:i:s'),
                'event_end_time'  => $event_end_carbon->format('H:i:s'),
                'event_contact_person'  => $request->post('event_contact_person'),
                'event_contact_number'  => $request->post('event_contact_number'),
                'event_contact_email'   => $request->post('event_contact_email'),
                'event_location'    => $request->post('event_location'),
                'event_location_iframe' => $request->post('event_map'),
                'glitter_background'  => $request->post('glitter_background')
            ]);

            if (! $event->save()) {
                return $this->json(false,'Unable to update');
            }
            return $this->json(true,'Record Upated');
        }



        $event->load(['getSeo', 'getImage' => fn ($query) => $query->with('image')]);
        $tabs = [
            'general' => $event,
        ];
        $tabs = array_merge($tabs,app('hooks')->catchHooks('bundle.image.tab', []), app('hooks')
            ->catchHooks('bundle.seo.tab', []), app('hooks')->catchHooks('bundle.component.tab',[]));

        return $this->admin_theme('events.edit', ['event' => $event,'tabs' => $tabs,'current_tab' => $current_tab]);

    }
}
