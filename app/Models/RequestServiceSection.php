<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class RequestServiceSection extends Model
{
    use HasTranslations;

    protected $table = 'request_service_sections';

    public $translatable = ['small_label', 'title', 'description', 'button_text'];

    protected $fillable = ['small_label', 'title', 'description', 'button_text', 'image', 'status'];
}
