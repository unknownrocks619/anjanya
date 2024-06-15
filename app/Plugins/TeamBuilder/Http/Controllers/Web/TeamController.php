<?php

namespace App\Plugins\TeamBuilder\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Plugins\TeamBuilder\Http\Models\TeamGroup;
use Illuminate\Http\Request;
use App\Classes\Plugins\Hook;
use App\Models\Menu;
use App\Plugins\TeamBuilder\Http\Models\TeamMember;

class TeamController extends Controller
{
    protected $plugin_name='TeamBuilder';

    public function load(Menu $menu) {

        $teams = TeamGroup::with(['members' => function($query){
            $query->with(['getImage' => function ($query){
                $query->with('image');
            }]);
        }])->withCount('members')->orderBy('default_group','desc')->get();

        $data = [
            'extends'   => 'master',
            'menu'      => $menu,
            'teams'     => $teams
        ];
        return view($this->plugin_name.'::frontend.member',$data);

    }
}
