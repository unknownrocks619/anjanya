<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalCountry extends Model
{
    use HasFactory;

    protected $connection = 'portal_connection';

    protected $table='countries';
}
