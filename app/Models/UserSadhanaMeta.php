<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSadhanaMeta extends Model
{
    use HasFactory;

    public const SADHANA_TYPE = [
        'shaktipaath_dikshya' => 'Shaktipaath Dikshya',
        'mantra_dikshya'    => 'Mantra Dikshya',
        'saranagati_dikshya'    => 'Saranagati Dikshya',
        'tarak_dikshya'     => 'Tarak Dikshya'
    ];
}
