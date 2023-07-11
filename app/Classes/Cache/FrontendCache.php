<?php

namespace App\Classes\Cache;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class FrontendCache
{

    protected $model = null;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function setCache(string $keyName, mixed $values)
    {

        Cache::put($this->model::CACHE_NAME . '_' . strtoupper(str_replace('-', '_', $keyName)), $values);
    }


    public function getCache($keyName)
    {
        if (!Cache::has($this->model::CACHE_NAME . '_' . strtoupper(str_replace('-', '_', $keyName)))) {
            return null;
        }
        return Cache::get($this->model::CACHE_NAME . '_' . strtoupper(str_replace('-', '_', $keyName)));
    }
}
