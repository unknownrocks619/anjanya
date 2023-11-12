<?php

namespace App\Plugins\Donation\Http\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DonationTransactionCollection extends AdminModel
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() : HasMany {
        return $this->hasMany(DonationTransactionDetail::class,'collection_id');
    }

}
