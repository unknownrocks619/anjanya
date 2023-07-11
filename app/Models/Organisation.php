<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Organisation extends AdminModel
{
    use HasFactory;


    protected $fillable = [
        'organisation_name',
        'slug',
        'short_description',
        'full_description',
        'active',
        'type'
    ];

    /**
     * ORG_TYPES
     *
     * @var [array]
     */
    const ORG_TYPES = [
        'university'        => 'University / School / College',
        'not-for-profit'    => 'Not for Profit',
        'private'           => 'Private',
        'charity'           => 'Charity'
    ];


    const IMAGE_TYPES = [
        'logo'      => 'Logo',
        'banner'    => 'Banner',
        'seo'       => 'SEO'
    ];

    /**
     *
     * @param string $slug
     * @return string
     */
    public static function validateSlug(string $slug, $org = null): string
    {
        $slug = Str::slug($slug);
        $slug_check = Organisation::where('slug', $slug);

        if ($org) {
            $slug_check->where('id', '!=', $org->getKey());
        }

        if ($slug_check->exists()) {
            $slug .= $slug . Str::slug(Str::random(6));
        }

        return Str::slug($slug);
    }

    public function getImage()
    {
        return $this->hasMany(FileRelation::class, 'relation_id')->where('relation', Organisation::class);
    }

    public function getSeo()
    {
        return $this->hasOne(SeoRelation::class, 'relation_id')->where('relation', Organisation::class);
    }

    public function getProjects()
    {
        return $this->hasMany(Project::class, 'organisation_id')->orderBy('sort_by', 'asc');
    }

    public function getAllStaff()
    {
        return $this->hasMany(OrganisationStudent::class, 'org_id');
    }

    public function getTeachers()
    {
        return $this->hasMany(OrganisationStudent::class, 'org_id')->where('role', 'teacher');
    }
    public function getStudent()
    {
        return $this->hasMany(OrganisationStudent::class, 'org_id')->where('role', '!=', 'teacher');
    }
}
