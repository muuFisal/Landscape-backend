<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use HasTranslations;

    public $table = 'banners';

    public $translatable = [
        'title',
        'primary_label',
        'secondary_label',
    ];

    protected $fillable = [
        'banner',
        'title',
        'primary_label',
        'secondary_label',
        'sub_labels',
        'sort_order',
        'status'
    ];

    protected $casts = [
        'sub_labels' => 'array',
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];
}
