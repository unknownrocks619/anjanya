<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_id',
        'user_id',
        'role',
        'active',
        'shared_through',
        'created_at',
        'updated_at'
    ];

    public function getAllStudent()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getTeacher()
    {
    }

    public function getStudentUnder()
    {
    }

    public function getStudentAbove()
    {
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'org_id');
    }
}
