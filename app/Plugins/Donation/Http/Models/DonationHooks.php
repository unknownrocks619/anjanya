<?php

namespace App\Plugins\Donation\Http\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationHooks extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'relation_model_id',
        'relation_model_class'
    ];

    public function getDonation(){
        return $this->hasOne(Donation::class,'id','donation_id');
    }
}
