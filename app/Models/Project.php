<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasTranslations;

    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'short_description',
        'year',
        'location',
        'area',
        'challenge_title',
        'challenge_description',
        'solution_title',
        'solution_description',
        'facts',
        'sort_order',
        'status'
    ];

    public $translatable = [
        'title',
        'short_description',
        'location',
        'area',
        'challenge_title',
        'challenge_description',
        'solution_title',
        'solution_description'
    ];

    protected $casts = [
        'facts' => 'array',
        'status' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order', 'asc');
    }

    public function coverImage()
    {
        return $this->images()->where('status', true)->first();
    }
}
