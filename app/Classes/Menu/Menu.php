<?php

namespace App\Classes\Menu;

class Menu
{
    protected array $config = [
        'main_wrapper' => 'nav',
        'menu_wrapper' => 'ul',
        'wrapper_child' => 'li',
        'link_element' => 'a',
        'caret' => 'span',
    ];
    protected array $configAttributes = [];
    public function menus(){
    }

    public function setConfig(string $key_name, mixed $value) {
        $this->config[$key_name] = $value;
        return $this;
    }

    public function renderMenu(string $label){

        $menu_link = '<'.$this->getLinkElement('wrapper_child');
        $menu_link .=  $this->getConfigAttribute('wrapper_child');
        $menu_link .= '>';

            $menu_link .= ' ' .$this->getConfigAttribute('link_element');
            $menu_link .= '>';
            $menu_link .= $label;
            $menu_link .= '</'.$this->getLinkElement() .'>';
        $menu_link .= '</'. $this->getLinkElement() .'>';
    }

    protected function getLinkElement(string $config_name) : string {
        return $this->config[$config_name];
    }

    public function getConfigAttribute(string $config_name): string {
        $attribute = '';
        if ( ! isset($this->configAttributes[$config_name]) ) {
            return $attribute;
        }

        foreach ($this->configAttributes[$config_name] as $attributeID => $attributeValue ){
            $attributeID .= $attributeID .'='. $attributeValue;
        }

        return $attribute;
    }

}
