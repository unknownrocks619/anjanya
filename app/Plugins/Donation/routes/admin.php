<?php

use App\Plugins\Donation\Http\Controllers\AdminDonationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin','web'])
        ->group(function() {
            Route::get('index',[AdminDonationController::class,'index'])->name('admin.donation.list');
        });
