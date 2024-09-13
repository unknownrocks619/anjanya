<?php

namespace App\Classes\Import;

use App\Models\Country;
use App\Models\User;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EventRegistration
{

    protected array $formattedHeadersArray = [];
    protected array $rawHeadersArray = [];
    protected $headerRowNumber;

    protected string $filepath;
    protected $user = null;

    public function __construct(string $filename, $user = null)
    {
        $this->filepath = $filename;
        $this->headerRowNumber = 1;
        $this->user  = $user;
    }

    public function convertRole()
    {

        // otherwise manually convert user role.
        return 7;
    }

    public function processFile()
    {
        if (!Storage::disk('local')->exists('registration/' . $this->filepath)) {
            throw new \Exception("Fiile Not Found", 1);
        }
        $filepath = Storage::disk('local')->path('registration/' . $this->filepath);

        $reader = ReaderEntityFactory::createReaderFromFile($this->filepath);
        $reader->open($filepath);

        $importedContact = [];

        $country = Country::get();

        foreach ($reader->getSheetIterator() as $sheet) {
            $spoutHeader = $this->getFormattedHeader($sheet);

            foreach ($sheet->getRowIterator() as $key => $dataRow) {
                if ($key <= $this->headerRowNumber) {
                    continue;
                }

                $recordRow = $this->rowWithFormattedHeaders($dataRow->toArray());

                if (User::where('email', $recordRow['email'])->exists()) {
                }

                $importedContact[] = [
                    'first_name' => $recordRow['first_name'],
                    'last_name' => $recordRow['last_name'],
                    'email'     => $recordRow['email'],
                    'country'   => $recordRow['country'],
                    'free_canva'    => $recordRow['free_canva_account_required'],
                    'role' => $this->convertRole($recordRow['role__student_or_teacher']),
                    'password'  => Hash::make(\Illuminate\Support\Str::random(12)),
                    'username'  => \Illuminate\Support\Str::random(8),
                    'invite_token'  => strtoupper(\Illuminate\Support\Str::random(12)),
                    'current_step'  => 'complete',
                    'status'    => 'active',
                    'terms'     => true,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                    'source'        => 'bulk_import'
                ];
            }

            if (!count($importedContact)) {
                break;
            }

            foreach ($sheet->getRowIterator() as $key => $dataRow) {
                if ($key <= $this->headerRowNumber) {
                    continue;
                }
                $recordRow = $this->rowWithFormattedHeaders($dataRow->toArray());

                $importUser = new ImportBluePrint([
                    'organisation' => [
                        'organisation_name'    => $recordRow['school_name'],
                        'slug'                  => \Illuminate\Support\Str::slug($recordRow['school_name']),
                        'active'                => true,
                        'type'                  => 'university',
                    ],
                    'uploadedByUser' => [$this->user]
                ], ['students' => $importedContact]);
                $importUser->process();
            }
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
                    $value = strtolower(str_replace('.', '', str_replace(' ', '_', trim($value))));
                    $value = strtolower(str_replace('.', '', str_replace('-', '_', trim($value))));
                    $value = strtolower(str_replace('.', '', str_replace('(', '_', trim($value))));
                    $value = strtolower(str_replace('.', '', str_replace(')', '', trim($value))));

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
        return array_combine($headers, $rowArray);
    }
}
