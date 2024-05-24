<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBatch extends Model
{
    use HasFactory;
    protected $connection = 'portal_connection';
    protected $table = 'program_batches';

    
    public function batch()
    {
        return $this->belongsTo(Batch::class, "batch_id");
    }
}
