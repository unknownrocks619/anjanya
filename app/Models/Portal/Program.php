<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $connection = 'portal_connection';
    protected $table = 'programs';

    protected  $fillable = [
        'program_duration',
        'program_access',
        'admission_fee',
        'monthly_fee',
        'program_start_date',
        'program_end_date',
        'promote',
        'description',
        'overdue_allowed',
        'batch',
        'zoom',
        'slug',
        'program_name',
        'program_type',
        'admin_access_permission',
        'admin_detail_permission'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'zoom',
        'admission_fee',
        'monthly_fee',
        'program_access',
    ];

    protected $casts = [
        'admin_detail_permission' => 'array',
        'admin_access_permission'   => 'array'
    ];

     /**
     * Active Batch Group
     */
    public function active_batch()
    {
        return $this->hasOne(ProgramBatch::class, 'program_id')->where('active', true)->latest();
    }

    /**
     * List current rule for fee structure.
     */
    public function active_fees()
    {
        return $this->hasOne(ProgramCourseFee::class, 'program_id')->latest();
    }

     /**
     * Active Section for a program.
     */
    public function active_sections()
    {
        return $this->hasOne(ProgramSection::class, 'program_id')->where('default', true);
    }
    
}
