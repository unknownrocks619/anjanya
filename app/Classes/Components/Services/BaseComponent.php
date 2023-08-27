<?php

namespace App\Classes\Components\Services;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class BaseComponent
{
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
}
