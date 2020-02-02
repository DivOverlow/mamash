<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Contracts\BannerTranslation as BannerTranslationContract;

class BannerTranslation  extends Model implements BannerTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['title','html_content','content', 'locale_id'];

}
