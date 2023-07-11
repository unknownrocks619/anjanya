<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'additional_text'
    ];
    const IMAGE_TYPES  = [
        'footer-insta-gallery' => 'Gallery'
    ];
    const BASIC_CONFIGURATION = [
        'site_name' => 'Site Name',
        'tagline'   => "Tagline",
        'host'      => "Host",
        'email_official'    => 'Official Contact Email',
    ];

    const SOCIAL_CONFIURATION = [
        'social_facebook'   => 'Facebook',
        'social_instagram'  => 'Instagram',
    ];

    const PRIMARY_ADDRESS = [
        'primary_address' => 'Full Address',
        'primary_contact_person'    => "Contact Person",
        'primary_contact_number'    => 'Contact Number',
        'primary_email_address' => 'Primary Email Address',
        'primary_contact_map'   => 'Iframe Map'
    ];

    protected $casts = [
        'additional_text' => 'array'
    ];

    const BASIC_CONFIGURATION_CACHE_NAME = '_FRONTEND_BASIC_CONFIGURATION_';
    const BASIC_SOCIAL_CONFIGURATION_CACHE_NAME = '_FRONTEND_SOCIAL_BASIC_CONFIGURATION_';
    const SITE_LOGO_CACHE_NAME = '_SYSTEM_LOGO_';
    const SITE_MENU_CACHE_NAME = '_FRONTEND_MENU_CACHE_';
    const SITE_PRIMARY_CONTACT_CACHE_NAME = '_FRONTEND_PRIMARY_CONTACT_CACHE_NAME_';
    const MEMBERSHIP_REGISTRATION_EMAIL_CACHE_NAME = '_MEMBERSHIP_WELCOME_EMAIL_';
    const MEMBERSHIP_REGISTRATION_EMAIL_SUBJECT_CACHE_NAME = '_MEMBERSHIP_WELCOME_EMAIL_SUBJECT_';
    const MEMBERSHIP_APPROVED_EMAIL_CACHE_NAE = '_MEMBERSHIP_APPROVED_EMAIL_';
    const MEMBERSHIP_APPROVED_EMAIL_SUBJECT_CACHE_NAE = '_MEMBERSHIP_APPROVED_EMAIL_SUBJECT_';
    const MEMBERSHIP_REJECTED_CACHE_NAME = '_MEMBERSHIP_REJECTED_EMAIL_';
    const MEMBERSHIP_REJECTED_SUBJECT_CACHE_NAME = '_MEMBERSHIP_REJETED_EMAIL_SUBJECT_';
    const USER_WELCOME_EMAIL_CACHE_NAME = 'USER_WELCOME_EMAIL_';
    const USER_WELCOME_EMAIL_SUBJECT_CACHE_NAME = 'USER_WELCOME_EMAIL_SUBJECT_';
    const SITE_FOOTER_PAGE_CACHE_NAME = '_FRONTEND_FOOTER_CACHE_';
    const SITE_PAGE_SETTING_CACHE_NAME = '_FRONTEND_PAGE_CACHE_';

    public function getImage()
    {
        return $this->hasMany(FileRelation::class, 'relation_id')
            ->where('relation', get_class($this));
    }
}
