<?php

namespace App\Classes\Helpers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Connector;
use App\Models\Page;
use Illuminate\Http\Request;

class ModelConnector extends Controller
{



    public function store(Request $request)
    {
        // $request->validate([
        //     'model' => 'required',
        //     'model_id'  => 'required_id',
        // ]);

        return $this->{$request->get('type')}($request);
    }

    public function page(Request $request)
    {
        $model = $request->post('model');
        $model = $model::find($request->post('model_id'));
        $connector = new Connector();
        $connector->fill([
            'connectors_class'  => $model::class,
            'connector_id'      => $model->getKey(),
            'connected_class'   => Page::class,
            'connected_id'      => $request->post('pages')
        ]);

        try {
            $connector->save();
        } catch (\Throwable $th) {
            return $this->json(false, 'Unable to connect plugins.', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'Linked Successfully.', 'reload');
    }

    public function category(Request $request)
    {
        $model = $request->post('model');
        $model = $model::find($request->post('model_id'));
        $connector = new Connector();
        $connector->fill([
            'connectors_class'  => $model::class,
            'connector_id'      => $model->getKey(),
            'connected_class'   => Category::class,
            'connected_id'      => $request->post('category')
        ]);

        try {
            $connector->save();
        } catch (\Throwable $th) {
            return $this->json(false, 'Unable to connect plugins.', '', ['errors' => $th->getMessage()]);
        }

        return $this->json(true, 'Linked Successfully.', 'reload');
    }

    public function remove(Connector $connector, $current_tab = null)
    {
        $connector->delete();
        return $this->json(true, 'Connection Removed.', 'reload');
    }
}
