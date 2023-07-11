<?php

namespace App\Classes\Import;

use App\Models\Category;
use App\Models\Country;
use App\Models\User;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ImportWPBook
{

    protected array $formattedHeadersArray = [];
    protected array $rawHeadersArray = [];
    protected $headerRowNumber;

    protected string $filepath;

    public function __construct()
    {
        if (!Storage::disk('local')->exists('old-record' . DIRECTORY_SEPARATOR . 'Uploaded Books Details.xlsx')) {
            throw new \Exception("Fiile Not Found", 1);
        }

        $this->filepath = Storage::disk('local')->path('old-record' . DIRECTORY_SEPARATOR . 'Uploaded Books Details.xlsx');
        $this->headerRowNumber = 1;
    }

    public function verifyUser(string $email): User | null
    {
        $user = User::where('email', $email)->first();
        return $user;
    }

    public function categories($categories): array
    {
        $dbCategories = [];
        $toArrayCat = explode(',', $categories);
        $categories = Category::whereIn('category_name', $toArrayCat)->get();

        foreach ($categories as $cat) {
            $dbCategories[] = $cat->getKey();
        }
        return $categories;
    }

    public function processFile()
    {
        ini_set('memory_limit', -1);

        $reader = ReaderEntityFactory::createReaderFromFile($this->filepath);
        $reader->open($this->filepath);
        $categories = [];
        $importedContact = [];
        foreach ($reader->getSheetIterator() as $sheet) {
            $bookStatus = ($sheet->getName() == 'Published Books') ? 'active' : 'pending';
            $spoutHeader = $this->getFormattedHeader($sheet);

            foreach ($sheet->getRowIterator() as $key => $dataRow) {
                if ($key <= $this->headerRowNumber) {
                    continue;
                }

                $recordRow = $this->rowWithFormattedHeaders($dataRow->toArray());
                if (!isset($recordRow['author_email']) && !isset($recordRow['project_name'])) {
                    continue;
                }
                $dbUser = $this->verifyUser($recordRow['author_email']);

                if (!$dbUser) {
                    echo "User Not Found . " . $recordRow['author_email'] . PHP_EOL;
                    continue;
                }

                if (!isset($importedContact[$dbUser->getKey()])) {
                    $importedContact[$dbUser->getKey()] = [];
                }

                $importedContact[$dbUser->getKey()][] = [
                    'book_title'     => $recordRow['book_name'],
                    'slug'          => \Illuminate\Support\Str::slug($recordRow['book_name']),
                    'status'        => $bookStatus,
                    'upload_stage'  => 'complete',
                    'book_validated'    => true,
                    'intro_text'    => $recordRow['book_discription'],
                    'short_description' => $recordRow['book_discription'],
                    'full_description'  => $recordRow['book_discription'],
                    'book_url'      => $recordRow['book_url'],
                    'project_title' => $recordRow['project_name'],
                    'canva_link'    => $recordRow['canva_book_link'],
                    'categories'    => isset($recordRow['categorys_name']) ? $recordRow['categorys_name'] : []
                ];

                if (isset($recordRow['categorys_name'])) {
                    $explode = explode(',', $recordRow['categorys_name']);
                    foreach ($explode as $categoryRecord) {
                        if (in_array($categoryRecord, $categories)) {
                            continue;
                        }
                        $categories[] = trim($categoryRecord);
                    }
                }
            }

            if (!count($importedContact)) {
                break;
            }
            $importUser = new ImportWPBookBlueprint(
                ['categories' => $categories],
                ['books' => $importedContact]
            );

            $importUser->process();
        }
    }

    public function getFormattedHeader($sheet): array
    {

        if (empty($this->formattedHeadersArray)) {
            $this->formattedHeadersArray = $this->getRawHeader($sheet);

            $headerValue = [];

            foreach ($this->formattedHeadersArray as $key => $value) {

                if (is_a($value, 'DateTime')) {
                    $this->formattedHeadersArray[$key] = $value->format('Y-m-d');
                } else {
                    $value = strtolower(str_replace(' ', '_', trim($value)));
                    $value = strtolower(str_replace('-', '_', trim($value)));
                    $value = strtolower(str_replace('(', '_', trim($value)));
                    $value = strtolower(str_replace(')', '', trim($value)));

                    $finalValue = strtolower(trim($value));

                    $this->formattedHeadersArray[$key] = $finalValue;
                    $headerValue[] = $finalValue;
                }
            }
        }
        return $this->formattedHeadersArray;
    }

    public function getRawHeader($sheet): array
    {
        if (empty($this->rawHeadersArray)) {
            foreach ($sheet->getRowIterator() as $key => $row) {

                if ($key == $this->headerRowNumber) {
                    $this->rawHeadersArray = $row->toArray();
                    break;
                }
            }
        }
        return $this->rawHeadersArray;
    }

    public function rowWithFormattedHeaders(array $rowArray): array
    {
        return $this->returnRowWithHeadersAsKey($this->formattedHeadersArray, $rowArray);
    }

    public function returnRowWithHeadersAsKey($headers, $rowArray): array
    {
        $headerColCount = count($headers);
        $rowColCount = count($rowArray);
        $colCountDiff = $headerColCount - $rowColCount;

        if ($colCountDiff > 0) {
            $rowArray = array_pad($rowArray, $headerColCount, '');
        }
        if (count($headers) != count($rowArray)) {
            return $rowArray;
        }
        return array_combine($headers, $rowArray);
    }
}
