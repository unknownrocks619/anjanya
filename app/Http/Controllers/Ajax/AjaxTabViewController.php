<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Rule\Parameters;
use ReflectionMethod;

class AjaxTabViewController extends Controller
{
    //
    public function loadTab(string $source, string $view)
    {
        $request = Request::capture();
        $params = json_decode($request->post('params'), true);

        if (isset($params['controller']) && isset($params['action'])) {
            $controller = $this->controller($params['controller']);
            $methodName = $params['action'];
            $reflectionController = new ReflectionMethod($controller, $methodName);
            $parameters = $reflectionController->getParameters();


            return ($this->controller($params['controller'])->$methodName($this->model($params['param']['source'], $params['param']['sourceID'])));
            // return $controllerLoader->{$params['action']}($params);
        }
        $filename = (isset($params['filename'])) ? $params['filename'] : $params['name'];

        if (isset($params['reference']) && $params['reference'] == 'plugins') {
            $filename = $params['filename'];
            $view = view($filename, $params)->render();
        } else {
            $view = view($source . '.ajax-tabs/' . $view . '.' . $filename, $params)->render();
        }

        return $this->json(true, 'View Loaded', null, ['view' => $view]);
    }

    public function controller(string $controllerName)
    {
        $controllerPath = 'App\\Http\\Controllers';
        $controllerName = ucwords($controllerName, '.');
        $controllerPath .= '\\' . str_replace('.', '\\', $controllerName) . 'Controller';
        return new $controllerPath;
    }


    public function model(string $modelName, ?int $modelID = null)
    {
        return $modelName::find($modelID);
    }
}
