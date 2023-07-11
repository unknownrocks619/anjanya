<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\CanvaRegistration;
use Illuminate\Http\Request;

class CanvaRegistrationController extends Controller
{
    //

    public function convertUserToCanva(array $fillable)
    {
        $canvaUser = new CanvaRegistration();
        $canvaUser->fill($fillable);

        try {
            $canvaUser->save();
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }

        return;
    }
}
