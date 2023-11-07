<?php

namespace App\Classes\Components;

use Illuminate\Http\Request;

class ComponentService
{
    protected array|Request $components = [];
    protected string $key;
    protected $nameSpace='\\App\\Classes\\Components\\Services\\';
    public function __construct($key)
    {
        $this->key = $key;
        return $this->configurations();
    }

    public static function allComponents() {
        return array_unique(array_merge(array_keys(app('component')),array_keys(app('themes_config')['components'])));
    }

    public function configurations()
    {
        $components = [];
        $themeComponents = app('themes_config')['components'];

        foreach (app('component') as $componentKey => $componentValue) {

            # If components only exists in default folder
            if (!array_key_exists($componentKey, $themeComponents)) {
                if ( ! is_array($componentValue) ) {
                    $components[$componentKey] = $componentValue;
                    continue;
                }
                foreach ($componentValue as $key => $value) {
                    $components[$componentKey][$key] = 'themes.components.'.$componentKey.'.'.$value;
                }
                if ( ! isset ($componentValue['namespace'])) {
                    $components[$componentKey]['namespace'] = $this->componentNamespace($componentKey);
                }
                continue;
            }

            # for new component or two update configuration for default config replace key value
            $themeConfig = $themeComponents[$componentKey];

            if (!is_array($themeConfig)) {
                $components[$componentKey] = $themeConfig;
                continue;
            }

            $mergeData = array_merge($componentValue,$themeConfig);

            foreach ($mergeData as $key => $value) {

                # If themes doesn't have namespace for given component. use default.
                if ( $key == 'namespace' && ! isset($mergeData[$key])) {
                    $components[$componentKey][$key] = '\\App\\Themes\\default\\Components\\'.$value;
                    continue;
                }

                # use namespace based on theme config
                if ($key == 'namespace' && isset($mergeData[$key]) ) {
                    $components[$componentKey][$key] = '\\App\\Themes\\'.env('APP_THEMES','default').'\\Components\\'.$value;
                    continue;
                }

                if (! array_key_exists($key,$themeConfig)) {
                    $components[$componentKey][$key] = 'themes.components.'.$componentKey.'.'.$value;
                    continue;
                }
                $components[$componentKey][$key] = 'themes.frontend.'.env('APP_THEMES').'.'.$themeConfig[$key];
            }

            if (! isset ($components[$componentKey]['namespace']) ) {
                $components[$componentKey]['namespace'] = $this->componentNamespace($componentKey);
            }
        }

        // check if any new component introduced in themes is missed.
        $themes_components = array_diff(array_keys($themeComponents),array_keys($components));
        if (count( $themes_components ) >= 1) {
            foreach ($themes_components as $theme_component) {
                // check if all required keys are present.
                if ( array_diff_key(array_flip(['view','add','namespace','edit']),$themeComponents[$theme_component]) ) {
                    continue;
                }
                $themeComponents[$theme_component]['view'] = 'themes.frontend.'.env('APP_THEMES').'.'.$themeComponents[$theme_component]['view'];
                $themeComponents[$theme_component]['edit'] = 'themes.frontend.'.env('APP_THEMES').'.'.$themeComponents[$theme_component]['edit'];
                $themeComponents[$theme_component]['add'] = 'themes.frontend.'.env('APP_THEMES').'.'.$themeComponents[$theme_component]['add'];
                $themeComponents[$theme_component]['namespace'] = '\\App\\Themes\\'.env('APP_THEMES').'\\Components\\'.$themeComponents[$theme_component]['namespace'];
                $components[$theme_component] = $themeComponents[$theme_component];
            }
        }
        $this->components = new Request($components);
        return $this;
    }

    public function getConfiguration()
    {
        if ($this->components->get($this->key)) {
            return new ConfigWrapper($this->components->get($this->key));
        }
        return [];
    }


    public function componentNamespace(string $name):string {
       $className = str($name)->camel()->ucfirst()->remove('_',true);
        return $this->nameSpace . $className.'\\'.$className;
    }


}
