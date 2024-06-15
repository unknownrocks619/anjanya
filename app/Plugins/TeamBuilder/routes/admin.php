<?php

use App\Plugins\TeamBuilder\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
        ->name('admin.')
        ->middleware(['admin'])
        ->group(function() {
            Route::prefix('teams')
                ->name('teams.')
                ->controller(TeamController::class)
                ->group(function() {
                    
                    Route::match(['get','post'],'list','index')->name('index');
                    Route::match('get','list-member','indexMember')->name('index.member');
                    Route::match(['get','post'],'edit/{team}/{tab?}','edit')->name('edit');
                    Route::match(['post'],'store/member','storeMember')->name('store.member');
                    Route::match(['get','post'],'member/edit/{member}/{tab?}','editMember')->name('edit.member');

                    Route::match(['post','delete'],'delete/team/{team}','deleteTeam')->name('delete.team');
                    Route::match(['post','delete'],'delete/member/{member}','deleteMember')->name('delete.member');
                });

        });
