<?php

namespace App\Classes\Plugins;

class HookQueue
{


    private array $hooks;

    private array $params = [];


    public function __construct(array $hooks = [])
    {
        $this->hooks = $hooks;
    }


    public function getHooks(): array
    {
        return $this->hooks;
    }

    public function setHooks(array $hooks): void
    {
        $this->hooks = $hooks;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function with(array $params): HookQueue
    {
        $this->params = $params;
        return $this;
    }

    public function registerHooks(string $identifier, $callables): bool
    {

        if (is_array($callables)) {
            foreach ($callables as $callback) {
                $this->hooks[$identifier] = $callables;
            }
        } else {
            $this->hooks[$identifier] = $callables;
        }

        return true;
    }

    public function hasHook($name): bool
    {

        foreach ($this->hooks as $hook) {
            if ($hook->getName() == $name) {
                return true;
            }
        }

        return false;
    }

    public function catchHooks($name, $default = null, array $args = []): ?array
    {
        $results = [];

        foreach ($this->hooks as $identifier => $hook) {

            if ($hook->getName() == $name) {
                $results[$identifier] = $hook->run($this->getParams());
            }
        }

        if (count($results)) {
            $this->with([]);
            return $results;
        }


        if (is_callable($default)) {
            if (count($args)) {
                $default = call_user_func_array($default, $args);
            } else {
                $default = call_user_func($default);
            }
        }

        $this->with([]);
        return $default;
    }
}
