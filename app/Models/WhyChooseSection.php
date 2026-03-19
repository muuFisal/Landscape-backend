<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WhyChooseSection extends Model
{
    use HasTranslations;

    protected $table = 'why_choose_sections';

    public $translatable = ['title', 'description'];

    protected $fillable = ['title', 'description', 'image', 'status'];

    public function items()
    {
        return $this->hasMany(WhyChooseSectionItem::class, 'why_choose_section_id');
    }
}
