<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class GalleryPage extends Model
{
    use HasTranslations;

    protected $table = 'gallery_pages';

    public $translatable = ['title', 'description'];

    protected $fillable = ['title', 'description', 'image'];
}
