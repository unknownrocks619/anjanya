<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $plugin_name='';
    /**
     * Admin Panel Access Theme
     *
     * @param string $view
     * @param array $data
     *
     * @return View
     *
     */
    public function admin_theme(string $view, array $data = []): View
    {
        $base_path = 'backend.';
        if ($this->plugin_name) {
            $base_path = $this->plugin_name.'::'.$base_path;
        }
        return view($base_path . $view, $data);
    }

    public function learning_module_theme(string $view, array $data = []): View
    {
        $base_path = '.';
        return view($base_path . $view, $data);
    }

    public function user_theme(string $view, array $data = []): View
    {
        $base_path = 'frontend.';
        return view($base_path . $view, $data);
    }

    public function frontend_theme(string $layout, string $view, array $data = []): View
    {
        $data['theme_view'] = $view;
        $data['extends'] = $layout;
        $base_layout = 'themes.frontend.' . $this->theme_name() . '.views.' . $view;
        if ($this->plugin_name) {
            $base_layout = $this->plugin_name .':'.$base_layout;
        }
        return view($base_layout, $data);
    }

    public function components($view, array $data = []) {
        $base_path = env('APP_THEMES') ?? 'default';
        return view('themes.frontend.' . $base_path . '.components.' . $view, $data);
    }
    public function theme_name(): string
    {
        return env('APP_THEMES') ?? 'default';
    }
    public function frontend_layout(string $layout)
    {

        $base_path = env('APP_THEMES') ?? 'default';
        return 'themes.frontend.' . $base_path . '.layout.' . $layout;
    }

    public function partials($view, array $data = [])
    {
        $base_path = env('APP_THEMES') ?? 'default';
        return view('themes.frontend.' . $base_path . '.partials.' . $view, $data);
    }
    public function widget($view, array $data = [])
    {
        $base_path = env('APP_THEMES') ?? 'default';
        return view('themes.frontend.' . $base_path . '.widgets.' . $view, $data);
    }

    public function links($view, array $data = [])
    {
        $base_path = env('APP_THEMES') ?? 'default';
        return view('themes.frontend.' . $base_path . '.links.' . $view, $data);
    }

    public function modals($view, array $data = [])
    {
        $base_path = env('APP_THEMES') ?? 'default';
        return view('frontend.' . $base_path . '.modals.' . $view, $data);
    }
    /**
     * return json response
     *
     * @param bool $state
     * @param string|null $msg
     * @param mixed $jsCallback
     * @param array $params
     * @param int $status
     * @param int $errorStatus
     * @return \Illuminate\Support\Facades\Response
     */
    public function json(bool $state, ?string $msg = null, $jsCallback = null, array $params = [], int $status = 200, int $errorStatus = 422): HttpResponse
    {
        $response = [
            'state' => $state,
            'status' => $status,
            'msg' => $msg,
            'params' => $params,
            'callback' => $jsCallback
        ];

        $response = Response::make($response, (($state) ? $status : $errorStatus));
        $response->header('Content-Type', 'application/json');
        return $response;
    }

    public function generateValidationError(mixed $name = [], string $message = null)
    {
        $error = [];
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                $error[][$key][] = $value;
            }
        } else {
            $error = [
                'message' => $message,
                'errors'    => [$name => [$message]]
            ];
        }

        return response($error, 422);
    }

    public function header() {
        $base_path = env('APP_THEMES') ?? 'default';
         $setting = Setting::where('name','header')->first();
        $view = view('themes.frontend.'.$base_path.'.' . $setting?->value ?? 'header/default/header')->render();
        return $view;
    }

    public function footer() {
        $base_path = env('APP_THEMES') ?? 'default';
        $setting = Setting::where('name','footer')->first();
        $view = view('themes.frontend.'.$base_path.'.' . $setting?->value ?? 'footer.default.footer')->render();
        return $view;
    }
}
