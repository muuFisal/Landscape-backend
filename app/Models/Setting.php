<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    protected $table = 'settings';

    public $translatable = [
        'site_name',
        'site_desc',
        'site_title',
        'site_address',
        'meta_key',
        'meta_desc',
    ];

    protected $fillable = [
        'site_name',
        'site_desc',
        'site_title',
        'site_phone',
        'site_address',
        'site_email',
        'email_support',
        'facebook',
        'x_url',
        'youtube',
        'instagram',
        'tiktok',
        'linkedin',
        'whatsapp',
        'meta_key',
        'meta_desc',
        'logo',
        'light_logo',
        'dark_logo',
        'favicon',
        'site_copyright',
        'promotion_url',
    ];
}
