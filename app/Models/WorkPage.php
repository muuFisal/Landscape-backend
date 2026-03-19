<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WorkPage extends Model
{
    use HasTranslations;

    protected $fillable = ['title', 'description', 'eyebrow', 'image'];

    public $translatable = ['title', 'description', 'eyebrow'];
}
