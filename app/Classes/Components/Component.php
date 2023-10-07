<?php

namespace App\Classes\Components;

use App\Models\ComponentBuilder;
use App\Providers\ComponentServiceProvider;
use Illuminate\Database\Eloquent\Model;

class Component
{
    protected ConfigWrapper|array $config=[];
    protected ComponentService $componentService;
    protected $component;
    protected array $params=[];
    public function __construct(string $component_name) {
        $this->componentService = new ComponentService($component_name);
        $this->config = $this->componentService->getConfiguration();
    }
    protected function classLoader(): void{
        $this->component = new $this->config->namespace();
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return Component
     */
    public function setParams(string $key, mixed $value): Component {
        $this->params[$key] = $value;
        return $this;
    }

    public function loader() {
        $this->classLoader();
        return $this->component;
    }

    public function previewBuilder($params = []) {
        if ( is_array($this->config) &&  isset($this->config['view'])) {
            return view($this->config['view'],$params);
        }
        if (view()->exists($this->config->view)) {
            return view($this->config->view,$params);
        }
    }
    public function builder() {
        return view($this->config->add,$this->params);
    }


    public function editBuilder() {
        return view($this->config->edit,$this->params);
    }

    public function getConfig(): ConfigWrapper {
        return $this->config;
    }

}
