<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends AdminModel
{
    use HasFactory;

    const STATUS = [
        'active'    => 'Active',
        'draft'     => 'draft',
        'pending'   => 'Pending',
        'rejected'  => 'Rejected',
    ];


    const IMAGE_TYPES = [
        'featured_image'    => 'Featured Image',
        'gallery_image'     => 'Gallery Image',
        'seo'               => 'SEO',
        'cover_image'       => 'Book Cover Image',
    ];

    const BOOK_UPLOAD_STAGE = [
        'step_zero' => 'upload',
        'step_one'  => 'book_validate',
        'step_two'  => 'book_meta',
        'step_three'    => 'book_category',
        'step_four'  => 'book_default_project',
        'step_five' => 'confirmation',
        'step_six'  => 'complete'
    ];

    const DB_DISPLAY_STAGE = [
        'step_zero'     => 'step_one',
        'step_one'      => 'step_two',
        'step_two'      => 'step_three',
        'step_three'    => 'step_four',
        'step_four'     => 'step_five',
        'step_five'     => 'step_six',
        'step_six'      => 'step_six'
    ];
    protected $casts  = [
        'categories'    => 'array',
    ];

    protected $fillable = [
        'user_id',
        'book_title',
        'slug',
        'intro_text',
        'short_description',
        'full_description',
        'status',
        'default_project',
        'categories',
        'canva_link',
        'book',
        'image',
    ];

    public function getAuthor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getSelectedProject()
    {
        return $this->belongsTo(Project::class, 'default_project');
    }

    public function getCategories(): mixed
    {
        $result = [];
        $categories = Category::whereIn('id', $this->categories)->get();

        if ($categories) {
            $result = $categories;
        }

        return $result;
    }

    public function pdf()
    {
        return $this->hasOne(Image::class, 'id', 'book')->latest();
    }
}
