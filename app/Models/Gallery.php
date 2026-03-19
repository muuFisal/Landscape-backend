<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gallery extends Model
{
    use HasTranslations;

    protected $table = 'galleries';

    public $translatable = ['title'];

    protected $fillable = ['title', 'image', 'sort_order', 'status'];
}
