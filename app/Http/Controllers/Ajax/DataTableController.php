<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Portal\UserModel;
use Illuminate\Http\Request;


class DataTableController
{
    public function getEventRegistrations()
    {
        $request = Request::capture();

        $query = UserModel::query();
    }
}
