<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasTranslations;

    protected $table = 'abouts';

    public $translatable = [
        'title',
        'desc',
        'about_badge',
        'about_title',
        'about_description',
        'mission_badge',
        'mission_title',
        'mission_description',
        'vision_badge',
        'vision_title',
        'vision_description',
        'shapes_badge',
        'shapes_title',
        'shapes_description',
    ];

    protected $casts = [
        'shapes_items' => 'array',
    ];

    protected $fillable = [
        'banner',
        'title',
        'desc',
        'image',
        'second_image',
        'about_badge',
        'about_title',
        'about_description',
        'about_image',
        'mission_badge',
        'mission_title',
        'mission_description',
        'mission_image',
        'vision_badge',
        'vision_title',
        'vision_description',
        'vision_image',
        'shapes_badge',
        'shapes_title',
        'shapes_description',
        'shapes_items',
    ];
}
