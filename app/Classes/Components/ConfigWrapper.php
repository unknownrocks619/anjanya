<?php

namespace App\Classes\Components;

class ConfigWrapper
{

    protected array $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->data)) {
            if (is_array($this->data[$key])) {
                return new ConfigWrapper($this->data[$key]);
            }
            return $this->data[$key];
        }
        return null;
    }
}
