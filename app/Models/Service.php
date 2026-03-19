<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'image',
        'slug',
        'sort_order',
        'has_projects',
        'show_in_projects_filter',
        'status'
    ];

    public $translatable = ['title', 'description'];

    protected $casts = [
        'has_projects' => 'boolean',
        'show_in_projects_filter' => 'boolean',
        'status' => 'boolean',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
