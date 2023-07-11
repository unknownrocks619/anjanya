<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTransactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'transaction_amount',
        'source_detail',
        'remarks',
        'project_id',
        'organisation_id',
        'additional_text'
    ];

    protected $casts = [
        'source_detail' => 'object',
        'additional_text'   => 'object'
    ];

    protected $with = ['getProject', 'getOrganisation'];


    public function getProject()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function getOrganisation()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }
}
