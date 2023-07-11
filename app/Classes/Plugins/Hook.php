<?php

namespace App\Classes\Plugins;

class Hook
{
    private string $name;


    private $callback;

    public function __construct(string $name, $callable)
    {
        $this->name = $name;
        $this->callback = $callable;
    }

    public function getCallBack()
    {
        return $this->callback;
    }

    public function run($params = [])
    {
        return call_user_func_array($this->getCallBack(), $params);
    }

    public function  setCallBack($callables): void
    {
        $this->callback = $callables;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
