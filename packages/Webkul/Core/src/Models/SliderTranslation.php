<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Contracts\SliderTranslation as SliderTranslationContract;

class SliderTranslation extends Model implements SliderTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['title', 'slug', 'content', 'locale_id'];
}