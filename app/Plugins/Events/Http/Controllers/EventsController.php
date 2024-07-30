<?php

namespace App\Plugins\Events\Http\Controllers;

use App\Classes\Plugins\Hook;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\User\SiddhamahayogPortalUserController;
use App\Models\Portal\PortalCountry;
use App\Models\Portal\UserModel;
use App\Plugins\Events\Http\Models\Event;
use App\Rules\Unicode;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EventsController extends Controller
{
    protected $plugin_name = 'Events';

    public function __construct()
    {
        //         'type' => 'ajax-tab',
        //         'name' => 'media',
        //         'category' => $category,
        //         'ajax-view' => 'media',
        //         'data'  => ['categoryID' => $category->getKey(), 'name' => 'category', 'class' => 'Menu\MenuCategory', 'filename' => 'list', 'ID' => $category->getKey()],
        //         'label' => 'Media',
        //         'link'  => route('users.settings.menu.edit', ['category' => $category, 'tab' => 'media']),
        //         'modelName' => 'category'

        app('hooks')->registerHooks('seo', new Hook('bundle.seo.tab', function () {
            return  [
                'name' => 'seo',
                'view'  => 'backend.seo.add',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'seo', 'type' => 'plugin', 'filename' => 'backend.seo.add', 'reference' => 'plugins'],
                'type'  => 'ajax-tab',
                'label'  => __('admin/posts/edit.seo'),
                'ajax-view' => 'seo',
                'base'  => 'backend.seo',
                'reference' => 'plugins'
            ];
        }));

        app('hooks')->registerHooks('image.image-edit', new Hook('bundle.image.tab', function () {
            return  [
                'name'  => 'media',
                'label' => __('admin/posts/edit.media'),
                'view'  => 'backend.media.list',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'content', 'type' => 'plugin', 'filename' => 'backend.media.list', 'reference' => 'plugins'],
                'type'  => 'ajax-tab',
                'base'  => 'backend.media',
                'ajax-view' => 'media',
                'reference' => 'plugins',
            ];
        }));
        app('hooks')->registerHooks('components-component-edit', new Hook('bundle.component.tab', function () {
            return  [
                'name'  => 'components',
                'label' => __('admin/posts/edit.component'),
                'view'  => 'themes.components.choices',
                'data'  => ['modelVar' => 'model', 'type' => 'plugin', 'filename' => 'themes.components.choices', 'reference' => 'plugins'],
                'ajax-view' => 'components',
                'reference' => 'plugins',
                'base'  => 'themes.components',
                'type'  => 'ajax-tab'

            ];
        }));
    }
    public function index()
    {
        $events = Event::all();
        return $this->admin_theme('events.list', ['events' => $events]);
    }

    public function add(Request $request)
    {
        if ($request->ajax() && $request->post()) {
            $request->validate([
                'event_name'   => 'required',
                'intro_description' => 'required',
                'event_start'    => 'required',
                'event_end'  => 'required'
            ]);
            $event_start_carbon = Carbon::createFromFormat('Y-m-d\TH:i', $request->post('event_start'));
            $event_end_carbon = Carbon::createFromFormat('Y-m-d\TH:i', $request->post('event_end'));
            $event = new Event();
            $event->fill([
                'event_title'   => $request->post('event_name'),
                'active'    => false,
                'paid_event'    => false,
                'intro_description' => $request->post('intro_description'),
                'short_description' => $request->post('short_description'),
                'full_description'  => $request->post('full_description'),
                'event_slug'        => Event::getSlug($request->post('event_name'), $event),
                'event_start_date'  => $request->post('event_start'),
                'event_end_date'    => $request->post('event_end'),
                'event_start_time'  => $event_start_carbon->format('H:i:s'),
                'event_end_time'  => $event_end_carbon->format('H:i:s'),
                'glitter_background'  => $request->post('glitter_background')
            ]);

            if (!$event->save()) {
                return $this->json(false, 'Unable to create new event.');
            }
            return $this->json(true, 'Event Created.', 'redirect', ['location' => route('admin.events.edit', ['event' => $event])]);
        }
        return $this->admin_theme('events.create');
    }

    public function edit(Request $request, Event $event, $current_tab = 'general')
    {


        if ($request->ajax()  && $request->post()) {
            // check if slug already exists.
            $request->validate([
                'event_name'   => 'required',
                'intro_description' => 'required',
                'event_start'    => 'required',
                'event_end'  => 'required',
                'event_value'   => 'required'
            ]);

            $event_start_carbon = Carbon::createFromFormat('Y-m-d\TH:i', $request->post('event_start'));
            $event_end_carbon = Carbon::createFromFormat('Y-m-d\TH:i', $request->post('event_end'));

            $event->fill([
                'event_title'   => $request->post('event_name'),
                'active'    => (bool) $request->post('active'),
                'intro_description' => $request->post('intro_description'),
                'short_description' => $request->post('short_description'),
                'full_description'  => $request->post('full_description'),
                'event_slug'        => Event::getSlug($request->post('event_value'), $event),
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

            if (!$event->save()) {
                return $this->json(false, 'Unable to update');
            }
            return $this->json(true, 'Record Upated');
        }



        $event->load(['getSeo', 'getImage' => fn ($query) => $query->with('image')]);
        $tabs = [
            'general' => $event,
        ];

        $tabs = [
            'general' => [
                'type' => 'tab',
                'name' => 'general',
                'event'   => $event,
                'data' => ['category' => $event],
                'label' => 'General',
                'default' => true,
                'link'  => route('admin.events.edit', ['event' => $event, 'tab' => 'general']),
                'modelName' => 'event'
            ],
            'user-registrations' => [
                'type' => 'ajax-tab',
                'name' => 'user-registrations',
                'event'   => $event,
                'data' => ['modalVar' => 'model', 'type' => 'plugin', 'event' => $event, 'filename' => 'Events::backend.events.tabs.user-registrations', 'reference' => 'plugins'],
                'label' => 'Registrations',
                'default' => false,
                'base'  => 'ssd/sdfs',
                'link'  => route('admin.events.edit', ['event' => $event, 'tab' => 'user-registrations']),
                'modelName' => 'event',
                'view'  => 'users/som',
                'ajax-view' => 'user-registrations',

            ]
        ];

        $tabs = collect(array_merge(
            $tabs,
            app('hooks')->catchHooks('bundle.seo.tab', []),
            app('hooks')->catchHooks('bundle.image.tab', []),
            app('hooks')->catchHooks('bundle.component.tab', []),
        ))->map(function ($item, $index) use ($event) {

            if (isset($item['reference']) && $item['reference'] == 'plugins') {
                $item['link'] = route('admin.events.edit', ['event' => $event, 'tab' => $index]);
                $item['modelName']  = 'event';
                $item['data']['modelName'] = 'event';
                $item['data']['namespace'] = 'App\Plugins\Events\Http\Models';
                $item['data']['event'] = $event;
                $item['event'] = $event;
            }

            return $item;
        })->toArray();

        return $this->admin_theme('events.edit', [
            'event' => $event,
            'tabs' => $tabs,
            'current_tab' => $current_tab,
            'base'  => 'Events::backend.events',
        ]);
    }

    public function registration(Event $event, string $type = 'registration', ?UserModel $currentUser = null)
    {

        $request = Request::capture();

        // if ($type != 'registration') {
        //     $type = 'old-registration';
        // }

        if ($request->post()) {

            if (!session()->get('registration-email')) {
                session()->put('registration-email', $request->post('email') ?? 'random_email_' . time() . uniqid() . '@siddhamahayog.org');
            }
            $registrationProcess  =  $this->registrationProcess($event);

            if (!$registrationProcess) {
                return $this->json(false, 'Failed to save information.');
            }

            $callback = 'redirect';
            $location = route('admin.events.registration', ['event' => $event, 'type' => 'registration']);

            if ($request->post('submission_type') == 'new') {
                $location = route('admin.events.registration', ['event' => $event, 'type' => 'old-registration']);
                // dd($location);
            }

            if ($request->post('submission_type') == 'print') {
                $location = route('admin.events.print', ['event' => $event, 'user' => $registrationProcess['userDetail']->getKey()]);
            }

            session()->forget('registration_detail');
            session()->forget('new_registration');
            session()->forget('registration-email', '');

            return $this->json(true, 'Registration Success.', $callback, ['location' => $location]);
        }

        $users = collect();
        if ($request->get('term')) {
            $term = '%' . strip_tags($request->get('term')) . '%';
            $users = UserModel::where('first_name', 'LIKE', $term)
                ->orWhere('middle_name', 'LIKE', $term)
                ->orWhere('last_name', 'LIKE', $term)
                ->orWhere('full_name', 'LIKE', $term)
                ->orWhere('phone_number', 'LIKE', $term)
                ->orWhere('email', 'LIKE', $term)
                ->get();
        }

        if (!$currentUser?->getKey()) {
            $currentUser = null;
        }

        if ($currentUser) {
            $newPostRequest = new Request(['email' => $currentUser->email], ['email' => $currentUser->email]);
            $emailResponse = (new SiddhamahayogPortalUserController())->userResponse($newPostRequest);
            session()->put('registration_detail', $emailResponse);
            session()->put('registration-email', $currentUser->email);
            $type = 'registration.old-registration';
        }
        if (!$currentUser && $type == 'old-registration' && !$request->get('term')) {
            session()->forget('registration_detail');
            session()->forget('new_registration');
            session()->forget('registration-email', '');

            $password = uniqid('TEMP_');
            // dd($password);
            $sessionRecord = [
                'password'  => true,
                'validated' => true,
                'has_password'  => true,
                'full_name' => '',
                'first_name'    => '',
                'middle_name'   => '',
                'last_name'     => '',
                'gender'        => '',
                'country'       => '',
                'city'          => '',
                'street_address'    => '',
                'phone_number'  => '',
                'date_of_birth' => '',
                'place_of_birth' => '',
                'birth_time'    => '',
                'father_name'   => '',
                'mother_name'   => '',
                'meta'  => [],
                'dikshya'   => []
            ];
            $sessionRecord['user_password'] = Hash::make($password);

            session()->put('new_registration', true);
            session()->put('registration_detail', $sessionRecord);
            $type = 'registration.old-registration';
        }
        return $this->admin_theme('events.' . $type, [
            'event' => $event,
            'users' => $users,
            'type' => $type,
            'currentUser' => $currentUser
        ]);
    }

    public function registrationProcess(Event $event)
    {
        $request = Request::capture();


        $request->validate([
            'first_name'    => ['required', new  Unicode()],
            'last_name'     => ['required', new Unicode()],
            'gotra'         => ['required', new Unicode()],
            'gender'        => ['required', Rule::in(['male', 'female']), new Unicode()],
            'phone_number'  => ['required', 'numeric', new Unicode()],
            'country'       => ['required', 'numeric', new Unicode()],
            'state'         => ['required', new Unicode()],
            'street_address'    => ['required', new Unicode()],
            'date_of_birth' => ['required', 'date:Y-m-d', new Unicode()],
            'place_of_birth'    => ['required', new Unicode()],
            'education'     => ['required', new Unicode()],
            'profession'    => ['required', new Unicode()],
            'emergency_contact_person'  => ['required', new Unicode()],
            'emergency_phone' => ['required', new Unicode()],
            'emergency_contact_person_relation' => ['required', new Unicode()],
            'reference_source' => ['required', new Unicode()],
            'dikshya_type'  => ['required', Rule::in(['dikshit', 'non-dikshit']), new Unicode()]
        ], [
            'emergency_contact_person_relation.required' => 'Please provide Your relation with emergency contact.',
            'emergency_phone.required' => 'Please provide phone number for emergency contact.',
            'emergency_contact_person.required' => 'Please provide emergency contact person full name.',
            'country.numeric.numeric' => 'Invalid Country selected.',
            'phone_number.numeric' => 'Invalid Phone Number.'
        ]);

        if ($request->post('reference_source') == 'other') {
            $request->validate(['reference_source_detail' => ['required', 'min:3', new Unicode()]], ['reference_source_detail.min' => 'Please provide valid source detail.']);
        }

        if ($request->post('father_name')) {
            $request->validate(['father_name' => [new Unicode()]]);
        }

        if ($request->post('mother_name')) {
            $request->validate(['mother_name' => [new Unicode()]]);
        }

        if ($request->post('reference_source') == 'friend') {
            $request->validate(['referer_name' => ['required', new Unicode()]]);
        }

        if (!in_array($request->post('education'), ['primary', 'secondary'])) {
            $request->validate([
                'field_of_study' => ['required', new Unicode()]
            ], [
                'field_of_study' => 'Please provide your education major.'
            ]);
        }

        if ($request->post('dikshya_type') == 'dikshit') {
            $request->validate(['dikshya_category' => 'required|in:tarak,saranagati,sadhana,sadhana&saranagati,sadhana&saranagati&tarak']);
        }


        $registrationDetail = session()->get('registration_detail');
        $registrationDetail['first_name'] = $request->post('first_name');
        $registrationDetail['middle_name']  = $request->post('middle_name');
        $registrationDetail['last_name'] = $request->post('last_name');
        $registrationDetail['gotra']    = $request->post('gotra');
        $registrationDetail['gender'] = $request->post('gender');
        $registrationDetail['phone_number'] = $request->post('phone_number');
        $registrationDetail['country'] = $request->post('country');
        $registrationDetail['city']    = $request->post('state');
        $registrationDetail['street_address'] = $request->post('street_address');
        $registrationDetail['date_of_birth'] = $request->post('date_of_birth');
        $registrationDetail['place_of_birth'] = $request->post('place_of_birth');
        $registrationDetail['birth_time'] = $request->post('birth_time');
        $registrationDetail['father_name']  =  $request->post('father_name');
        $registrationDetail['mother_name']  = $request->post('mother_name');
        $registrationDetail['education'] = $request->post('education');
        $registrationDetail['education_major'] = $request->post('field_of_study');
        $registrationDetail['reference_source'] = $request->post('reference_source');
        $registrationDetail['referer_name'] = $request->post('referer_name');
        $registrationDetail['referer_relation'] = $request->post('referer_relation');
        $registrationDetail['reference_source_detail'] = $request->post('reference_source');
        $full_name = $request->post('first_name');

        if ($request->post('middle_name')) {
            $full_name .= ' ' . $request->post('middle_name');
        }
        $full_name .= ' ' . $request->post('last_name');

        $registrationDetail['full_name'] = $full_name;

        $registrationDetail['meta']['personal']['place_of_birth'] = $request->post('place_of_birth');
        $registrationDetail['meta']['personal']['date_of_birth'] = $request->post('date_of_birth');
        $registrationDetail['meta']['personal']['birth_time'] = $request->post('birth_time');
        $registrationDetail['meta']['personal']['street_address'] = $request->post('street_address');
        $registrationDetail['meta']['personal']['gender'] = $request->post('gender');
        $registrationDetail['meta']['personal']['state'] = $request->post('state');
        $registrationDetail['meta']['history']['medicine_history'] = $request->post('medication_information');
        $registrationDetail['meta']['education']['education'] = $request->post('education');
        $registrationDetail['meta']['education']['education_major'] = $request->post('field_of_study');
        $registrationDetail['meta']['education']['profession'] = $request->post('profession');

        $registrationDetail['emergency']['full_name'] = $request->post('emergency_contact_person');
        $registrationDetail['emergency']['phone_number'] = $request->post('emergency_phone');
        $registrationDetail['emergency']['relation'] = $request->post('emergency_contact_person_relation');


        $registrationDetail['dikshit']['type'] = $request->post('dikshya_type');
        $registrationDetail['dikshit']['category'] = $request->post('dikshya_category');

        // get country data

        $user = PortalCountry::where('id', $request->post('country'))->first();

        if ($user) {

            $registrationDetail['country_label'] = $user->name;
        }
        session()->put('registration_detail', $registrationDetail);
        $insertRecord = (new WebEventsController())->complete($request, $event);

        if (!$insertRecord) {
            return false;
        }

        return $insertRecord;
    }

    public function print(Event $event, UserModel $user)
    {
        return $this->admin_theme('events.print', [
            'event' => $event,
            'user' => $user
        ]);
    }
}
