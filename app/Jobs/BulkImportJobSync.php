<?php

namespace App\Jobs;

use App\Classes\Import\BulkImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BulkImportJobSync implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $filename = '';
    protected $uploadedByUser = null;

    public function __construct($filename, $byUser = null)
    {
        //
        $this->uploadedByUser = $byUser;
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //

        if (!$this->filename) {
            return;
        }
        $bulkImport = new BulkImport($this->filename, $this->uploadedByUser);
        $bulkImport->processFile();
    }
}
