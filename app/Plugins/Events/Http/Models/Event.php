<?php

namespace App\Plugins\Events\Http\Models;

use App\Models\AdminModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends AdminModel
{
    use HasFactory;

    protected $fillable = [
        'event_title',
        'event_slug',
        'intro_description',
        'short_description',
        'full_description',
        'active',
        'paid_event',
        'event_start_date',
        'event_end_date',
        'event_start_time',
        'event_end_time',
        'event_contact_person',
        'event_contact_number',
        'event_contact_email',
        'event_location',
        'event_location_iframe'
    ];

    const IMAGE_TYPES = [
        'featured_image'    => 'Featured Image',
        'banner_image'  => 'Banner Image',
        'welcome_image' => 'Welcome Image'
    ];

    public static function getSlug(string $slug, Model $model = null): string
    {
        $className =  get_called_class();
        $slug = \Illuminate\Support\Str::slug($slug);

        $query = $className::where('event_slug', $slug);

        if ($model) {
            $query->where('id', '!=', $model->getKey());
        }

        if ($query->exists()) {
            $slug .= '-'.\Illuminate\Support\Str::slug(\Illuminate\Support\Str::random(6));
        }

        return $slug;
    }
}
