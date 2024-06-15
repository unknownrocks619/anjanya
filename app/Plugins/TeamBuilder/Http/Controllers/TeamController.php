<?php

namespace App\Plugins\TeamBuilder\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Plugins\TeamBuilder\Http\Models\TeamGroup;
use Illuminate\Http\Request;
use App\Classes\Plugins\Hook;
use App\Plugins\TeamBuilder\Http\Models\TeamMember;

class TeamController extends Controller
{
    protected $plugin_name='TeamBuilder';

    public function __construct() {
        app('hooks')->registerHooks('seo.edit', new Hook('bundle.seo.tab', function () {
            return  [
                'name' => __('admin/posts/edit.seo'),
                'view'  => 'backend.seo.add',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'seo']
            ];
        }));

        app('hooks')->registerHooks('image.image-edit', new Hook('bundle.image.tab', function () {
            return  [
                'name' => __('admin/posts/edit.media'),
                'view'  => 'backend.media.list',
                'data'  => ['modelVar' => 'model', 'modelVar2' => 'content']
            ];
        }));
        app('hooks')->registerHooks('components-component-edit', new Hook('bundle.component.tab', function () {
            return  [
                'name' => __('admin/posts/edit.component'),
                'view'  => 'themes.components.choices',
                'data'  => ['modelVar' => 'model']
            ];
        }));
    }

    public function index() {
        $request = Request::capture();

        if ($request->post() && $request->ajax() ) {
            $team = new TeamGroup();
            $team->fill([
                'name'  => $request->post('team_name'),
                'slug'  => $team->getSlug(str($request->post('team_name'))->slug()->value())
            ]);

            if ( ! $team->save() ) {
                return $this->json(false, 'Unable create new team.');
            }

            return $this->json(true,'New team created.','redirect',['location' => route('admin.teams.edit',['team' => $team,'tab' => 'general'])]);
        }

        $teams = TeamGroup::with(['members'])->get();
        return $this->admin_theme('teams.index',['teams' => $teams]);
    }


    public function indexMember() {
        $members = TeamMember::with('team')->get();
        return $this->admin_theme('members.index',['members' => $members]);

    }

    public function edit(Request $request, TeamGroup $team, string $tab = 'general') {

        if ( $request->post() && $request->ajax() ) {
            $request->validate([
                'name' => 'required',
                'slug'  => 'required'
            ]);
            $team->fill([
                'name' => $request->post('name'),
                'slug'  => $team->getSlug(str($request->post('name'))->slug()->value(),$team),
                'description' => $request->post('description'),
                'default_group'    => $request->post('default_group')
            ]);
            
            if ( ! $team->save() ) {
                return $this->json(false,'Team information failed to update.');
            }
            
            return $this->json(true,'Team information updated.');
        }

        $team->load(['getSeo', 'getImage' => fn ($query) => $query->with('image'),'members']);

        $tabs = ['general' => $team ,'member' => $team->members];

        $tabs = array_merge($tabs,app('hooks')
                                ->catchHooks('bundle.image.tab', []), app('hooks')
                                ->catchHooks('bundle.seo.tab', []), app('hooks')
                                ->catchHooks('bundle.component.tab',[]));
        return $this->admin_theme('teams.edit', ['team' => $team,'tabs' => $tabs,'current_tab' => $tab]);

    }

    public function editMember(Request $request, TeamMember $member, string $tab ='general'){
        if ( $request->post() && $request->ajax() ) {
            $request->validate([
                'name' => 'required',
                'id_team'  => 'required'
            ]);

            $member->fill($request->except(['_token']));
            
            if ( ! $member->save() ) {
                return $this->json(false,'Member information failed to update.');
            }
            
            return $this->json(true,'Member information updated.');
        }

        $member->load(['getSeo', 'getImage' => fn ($query) => $query->with('image')]);

        $tabs = ['general' => $member];

        $tabs = array_merge($tabs,app('hooks')
                                ->catchHooks('bundle.image.tab', []), app('hooks')
                                ->catchHooks('bundle.seo.tab', []), app('hooks')
                                ->catchHooks('bundle.component.tab',[]));
        return $this->admin_theme('members.edit', ['member' => $member,'tabs' => $tabs,'current_tab' => $tab]);
    }

    public function storeMember(Request $request) {
        $request->validate([
            'name'  => 'required|string',
            'id_team'  => 'required'
        ]);

        $member = new TeamMember();
        $member->fill($request->except(['_token','callback']));
        if ( ! $member->save() ) {
            return $this->json(false,'Failed to create new member.');
        }
        $jsCallback = 'reload';
        $params = [];
        if ( $request->post('callback') ) {
            $jsCallback = $request->post('callback');
            $params = ['location' => route('admin.teams.edit',['team' => $request->post('id_team'),'tab' => 'member'])];
        }

        return $this->json(true,'New Member information created.',$jsCallback,$params);
    }


    public function deleteTeam(TeamGroup $group) {
        if ( ! $group->delete()) {
            return $this->json(false,'Failed to delete group.');
        }

        return $this->json(true,'Team group deleted.','reload');
    }

    public function deleteMember(TeamMember $member) {
        if ( ! $member->delete()) {
            return $this->json(false,'Failed to delete team member.');
        }

        return $this->json(true,'Team Member deleted.','reload');
    }
}
