<?php 
use Illuminate\Support\Facades\Route;
use App\Classes\Helpers\Components;

    Route::prefix('admin/component/iframe')
            ->middleware(['web','admin'])
            ->group(function(){
                Route::get('{component_name}',[Components::class,'previewComponent'])->name('component.iframe.get');
            });
?>