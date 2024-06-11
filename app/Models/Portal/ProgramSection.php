<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramSection extends Model
{
    use HasFactory;
    protected $connection = 'portal_connection';
    protected $table = 'program_sections';
    
}
