<?php

namespace App\Plugins\Volunteer\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebVolunteerController extends  Controller
{

    public $plugin_name = 'Volunteer';

    const DEFAULT = 'validateAccount';
    const STEPS =[
        'validateAccount',
        'personal',
        'volunteerParticipation',
        'volunteerData',
        'volunteerInterest',
        'profile',
        'confirmation',
    ];
    public function register(Request $request) {
        $data = [
            'extends'   => 'master',
        ];

        if ( $request->ajax() ) {

            if ( ! session()->has('current_step') ) {
                session()->put('current_step', self::DEFAULT);
            }

            $view = view($this->plugin_name.'::frontend.registration.partials.'. session()->get('current_step'))->render();
            return $this->json(true,'Form Loaded','',['view' => $view]);
        }

        return view($this->plugin_name.'::frontend.registration.main',$data);
    }

    public function volunteerRegistration(Request $request) {

        $methodName = session()->get('current_step');

        if ( ! method_exists($this,$methodName) ) {
            abort(404);
        }

        return $this->{$methodName}($request);
    }

    public function validateAccount(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        session()->put('email_registration', $request->post('email'));
        $this->nextStep();

        $view = view($this->plugin_name.'::frontend.registration.partials.'.session()->get('current_step'))->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);
    }

    public function personal() {
        $this->nextStep();

        $view = view($this->plugin_name.'::frontend.registration.partials.'.session()->get('current_step'))->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);
    }


    public function confirmation() {

    }

    /**
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function nextStep() {
        $nextStep = '';

        foreach (self::STEPS as $key => $step) {

            if (session()->get('current_step') != $step) {
                continue;
            }

            $nextStep    = $key;
        }

        if ( $nextStep && (count(self::STEPS) -1 ) == $nextStep) {
            session()->put('current_step','complete');
            return;
        }
        $nextClass = $nextStep+1;
        session()->put('current_step',self::STEPS[$nextClass]);
    }

    public function volunteerData() {
        $this->nextStep();

        $view = view($this->plugin_name.'::frontend.registration.partials.'.session()->get('current_step'))->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);

    }

    public function volunteerParticipation(){
        $this->nextStep();

        $view = view($this->plugin_name.'::frontend.registration.partials.'.session()->get('current_step'))->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);

    }

    public function stepBack() {

        $currentStep = session()->get('current_step');
        $currentStepKey = 0;

        foreach (self::STEPS as $key => $step) {

            if ( $currentStep == $step) {
                $currentStepKey = $key;
                break;
            }
        }

        if ( $currentStepKey ) {
            $stepBackKey = $currentStepKey-1;
            $currentStep = self::STEPS[$stepBackKey];
        }

        session()->put('current_step', $currentStep);
        $view = view($this->plugin_name.'::'.'frontend.registration.partials.'.$currentStep)->render();
        return $this->json(true,'Data updated',null,['view' => $view]);
    }

    public function volunteerInterest() {
        $this->nextStep();

        $view = view($this->plugin_name.'::frontend.registration.partials.'.session()->get('current_step'))->render();
        return $this->json(true,'Information Updated.',null,['view' => $view]);
    }
}
