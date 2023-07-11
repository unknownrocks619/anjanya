<?php

namespace App\Classes\Import;

use App\Models\Organisation;
use App\Models\OrganisationStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ImportBluePrint
{

    protected $params = [];
    protected $data = [];

    public function __construct(array $params = [], array $data = [])
    {
        $this->setParameter($params);
        $this->setData($data);
    }


    public function process(): bool
    {
        try {
            //code...
            $organisation = $this->createOrganisation();
            $users = $this->createUser();
            $this->connectOrganisationWithCreateUser($organisation, $users);
            $this->connectUserWithUploader($users, $organisation);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return true;
    }

    private function createOrganisation(): Organisation
    {


        $uploader = $this->getParams()->get('uploadedByUser');

        if (isset($uploader[0]) && !empty($uploader[0])) {
            $upload = $uploader[0];
            $organisation = $upload->getOrganisation;
            if ($organisation) {
                return $organisation->organisation;
            }
        }

        $organisation = Organisation::where('slug', $this->getParams()->get('organisation')['slug'])->first();

        if (!$organisation) {
            $organisation = new Organisation;

            $organisation->fill($this->getParams()->get('organisation'));

            if (!$organisation->save()) {
                throw new \Exception('Falied to create new Organisaction information.');
            }
        }
        return $organisation;
    }

    private function createUser(): array
    {
        $users = [];
        foreach ($this->getData()->get('students') as $user) {

            $userModel = new User();
            $userModel->fill($user);
            if ($userModel->save()) {
                $users[] = $userModel;
            }
        }
        return $users;
    }

    private function connectOrganisationWithCreateUser(Organisation $organisation, array $users)
    {
        $bulkInsert = [];
        foreach ($users as $user) {
            $bulkInsert[] = [
                'org_id' => $organisation->getKey(),
                'user_id'   => $user->getKey(),
                'active'    => true,
                'role'      => $user->role,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        OrganisationStudent::insert($bulkInsert);
    }

    private function connectUserWithUploader(array $users = [], Organisation $org)
    {
        $uploader = $this->getParams()->get('uploadedByUser');
        if (isset($uploader[0]) && !empty($uploader[0])) {
            $upload = $uploader[0];
            foreach ($users as $user) {
                $userOrg = OrganisationStudent::where('org_id', $org->getKey())
                    ->where('user_id', $user->getKey())
                    ->first();
                if ($userOrg) {
                    $userOrg->shared_through = $upload->invite_token;
                    $userOrg->save();
                }
            }
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setData(array $data)
    {
        $this->data = new Request($data);
    }


    public function setParameter(array $parameters)
    {
        $this->params = new Request($parameters);
    }
}
