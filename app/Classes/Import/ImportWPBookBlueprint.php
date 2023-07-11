<?php

namespace App\Classes\Import;

use App\Classes\Helpers\FileUpload;
use App\Models\Book;
use App\Models\Category;
use App\Models\FileRelation;
use App\Models\Image;
use App\Models\Organisation;
use App\Models\OrganisationStudent;
use App\Models\Project;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImportWPBookBlueprint
{

    protected $params = [];
    protected $data = [];

    public function __construct(array $params = [], array $data = [])
    {
        ini_set('memory_limit', -1);
        ini_set('max_execeution_time', -1);
        $this->setParameter($params);
        $this->setData($data);
    }


    public function process(): bool
    {
        try {
            //code...
            // $organisation = $this->createOrganisation();
            // $project = $this->createProject($organisation);
            // $users = $this->createUser();
            $categories = $this->categories();
            $this->userBook($categories);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return true;
    }

    private function createOrganisation(): Organisation
    {
        if ($this->getParams()->get('organisation')['slug'] == null) {
            $organisation = Organisation::latest()->first();
            return $organisation;
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

    private function createProject(Organisation $organisation): Project
    {
        $project = Project::where('slug', $this->getParams()->get('projects')['slug'])->first();
        if (!$project) {
            $project = new Project;
            $project->fill($this->getParams()->get('project'));
            $project->organisation_id = $organisation->getKey();

            if (!$project->save()) {
                throw new \Exception('Failed to save project information.');
            }
        }
        return $project;
    }
    private function createUser(): array
    {
        $users = [];
        foreach ($this->getData()->get('students') as $userrecord) {

            // check for existing user.
            $user = User::where('email', $userrecord['email'])->first();

            if (!$user) {
                $user = new User();
                $user->fill($userrecord);
                $user->save();
            }
            $users[$user->email] = $user;
        }
        return $users;
    }

    private function userBook(array $categories)
    {
        foreach ($this->getData()->get('books') as $userID => $books) {

            foreach ($books as $userBook) {
                echo 'Processing Book : ' . $userBook['book_title'] . PHP_EOL;

                $pdf = $userBook['book_url'];
                unset($userBook['book_url']);

                $project = Project::where('slug', \Illuminate\Support\Str::slug($userBook['project_title']))->first();

                if (!$project) {
                    echo " Project " . $userBook['project_title'] . ' not found. ' . PHP_EOL;
                    continue;
                }

                $book = new Book();
                $book->fill($userBook);

                $book->default_project = $project->getKey();
                $book->user_id = $userID;
                $book->book_validated = true;
                $bookCategory = [];
                if ($userBook['categories']) {
                    $explodeCategory = explode(',', $userBook['categories']);
                    foreach ($explodeCategory as $cat) {
                        $slugCat = \Illuminate\Support\Str::slug(trim($cat));
                        if (!isset($categories[$slugCat])) {
                            continue;
                        }
                        $bookCategory[] = $categories[$slugCat]->getKey();
                    }
                }
                $book->categories = $bookCategory;
                try {
                    $book->save();
                    $pdfSource = $this->downloadPDFFiles($pdf, $book);
                    if ($pdfSource) {
                        $book->book = $pdfSource->getKey();
                        $book->save();
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                    dd($th->getMessage());
                }
            }
        }
    }

    private function downloadPDFFiles(string $pdfURL, Book $book)
    {
        echo '----Downloading PDF Book-----' . PHP_EOL;
        $client = new Client();

        $httpHead = Http::head($pdfURL);

        if ($httpHead->status() !== 200) {
            echo '----REMOTE URL DOES NOT EXISTS-----' . PHP_EOL;
            return;
        }

        $fileExtension = pathinfo($pdfURL, PATHINFO_EXTENSION);
        $filename = \Illuminate\Support\Str::random(40) . '.' . $fileExtension;
        $response = $client->get($pdfURL, [
            'Transfer-Encoding' => 'chunked'
        ]);
        Storage::disk('local')->put('import' . DIRECTORY_SEPARATOR . $filename, $response->getBody());
        $newFile = new Image();
        $newFile->fill([
            'original_filename' => $filename,
            'filename'  => $filename,
            'filepath'  => 'import' . DIRECTORY_SEPARATOR . $filename,
            'information'   => ['folders' => 'import']
        ]);
        $newFile->save();
        // // file relation.
        // $fileRelation = new FileRelation();
        // $fileRelation->fill([
        //     'image_id'  => $newFile->getKey(),
        //     'type'  => 'pdf',
        //     'relation'  => $book::class,
        //     'relation_id'   => $book->getKey()
        // ]);

        // $fileRelation->save();
        echo '----DOWNLOAD COMPLETE-----' . PHP_EOL;
        return $newFile;
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

    private function categories(): array
    {
        $categories = $this->getParams()->get('categories');
        $result = [];
        foreach ($categories as $loopCategory) {
            // check if category exists.
            $slugCategory = \Illuminate\Support\Str::slug(trim($loopCategory));
            if (!$slugCategory) {
                continue;
            }
            $category = Category::where('slug', $slugCategory)->first();

            if (!$category) {
                $category = new Category;
                $category->fill([
                    'category_name' => trim($loopCategory),
                    'slug'          => $slugCategory,
                    'full_description'  => null,
                    'category_type'     => 'books',
                    'active'    => true,
                    'sort_by'   => Category::getSortBy()
                ]);

                $category->save();
            }

            $result[$category->slug] = $category;
        }

        return $result;
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
