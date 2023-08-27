<?php

namespace App\Classes\Components\Services;

interface ComponentInterface {
    public function store($componentBinder);
    public function update();
    public function delete($component);
}
