<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDonationBreaks extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'organisation_id',
        'amount',
        'milestone_text'
    ];
}
