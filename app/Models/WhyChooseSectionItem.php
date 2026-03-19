<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class WhyChooseSectionItem extends Model
{
    use HasTranslations;

    protected $table = 'why_choose_section_items';

    public $translatable = ['title', 'description'];

    protected $fillable = ['why_choose_section_id', 'title', 'description', 'sort_order', 'status'];

    public function section()
    {
        return $this->belongsTo(WhyChooseSection::class, 'why_choose_section_id');
    }
}
