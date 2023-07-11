<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'organisation_id',
        'title',
        'slug',
        'intro_text',
        'short_description',
        'full_description',
        'project_country',
        'project_state',
        'project_street_address',
        'donation',
        'active',
        'category',
        'genre',
        'project_type',
        'sort_by'
    ];

    protected $casts = [
        'category'  => 'object',
        'genre'     => 'object'
    ];

    const IMAGE_TYPE = [
        'featured_image'        => 'Featured Image',
        'banner_image'          => 'Banner Image',
        'achievement'           => 'Achievement Banner',
        'gallery_one'           => 'Gallery Layout One',
        'gallery_two'           => 'Gallery Layout Two'
    ];

    const PROJECT_TYPES = [
        'project'   => "Project",
        'library'   => 'Library'
    ];

    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }


    public function sortColumnValue(Organisation $org = null): int
    {
        $order = 0;
        if ($org) {
            $project = Project::where('organisation_id', $org->getKey())->max('sort_by');
        } else {
            $project = Project::max('sort_by');
        }
        $order += $project;
        return $order;
    }

    public function getImage()
    {
        return $this->hasMany(FileRelation::class, 'relation_id')->where('relation', Project::class);
    }

    public function getSeo()
    {
        return $this->hasOne(SeoRelation::class, 'relation_id')->where('relation', Project::class);
    }

    public function getDonationBreaks()
    {
        return $this->hasMany(ProjectDonationBreaks::class, 'project_id');
    }

    public function getDonationPercentage(): int
    {
        $totalAmount = $this->max_donation_amount;

        if (!$totalAmount) {
            return 0;
        }

        $collectedAmount = $this->getProjectTransaction()->sum('transaction_amount');

        if (!$collectedAmount) {
            return 0;
        }

        $percentage =  ($collectedAmount * 100) / $totalAmount;

        if ($percentage > 100) {
            return 100;
        }
        return $percentage;
    }

    public function getProjectTransaction()
    {
        return $this->hasMany(ProjectTransactions::class, 'project_id');
    }
}
