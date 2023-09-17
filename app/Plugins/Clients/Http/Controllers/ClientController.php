<?php

namespace App\Plugins\Clients\Http\Controllers;

use App\Classes\Helpers\Image;
use App\Http\Controllers\Controller;
use App\Plugins\Clients\Http\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $plugin_name = 'Clients';
    public function index() {
        $clients = Client::get();
        return $this->admin_theme('clients.index',['clients' => $clients]);
    }

    public function edit(Client $client) {
        return $this->admin_theme('clients.edit',['client' => $client]);
    }
    public function update(Request $request, Client $client) {
        $request->validate([
            'client_name' => 'required',
        ]);
        $client->fill(['client_name' => $request->post('client_name')]);
        if ($request->file('image') ) {
            $image = Image::uploadOnly($request->file('image'));
            $client->image = $image[0]->filepath;
        }
        if ( ! $client->save() ) {
            return back();
        }

        return back();
    }
    public function store(Request $request) {
        $request->validate([
            'client_name' => 'required',
            'image' => 'required'
        ]);

        $client = new Client();
        $client->fill(['client_name' => $request->post('client_name')]);

        $image = Image::uploadOnly($request->file('image'));
        $client->image = $image[0]->filepath;

        if ( ! $client->save() ) {
            return back();
        }

        return back();
    }

    public function delete(Client $client) {
        $client->delete();
        return $this->json(true,'Client info deleted','reload');
    }

}
