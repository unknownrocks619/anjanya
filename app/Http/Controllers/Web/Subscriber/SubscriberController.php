<?php

namespace App\Http\Controllers\Web\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $subscriber = new Subscriber;
        $subscriber->fill(['email' => $request->post('email'), 'active' => true]);

        if (!$subscriber->save()) {
            return $this->json(false, 'Failed.');
        }
        return $this->json(true, 'Thank-you, subscription success.');
    }

    public function delete(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $subscriber = Subscriber::where('email', $request->post('email'))->where('active', true)->first();
        $subscriber->active = false;
        $subscriber->save();
        return $this->json(true, 'Unsubscribed. !');
    }
}
