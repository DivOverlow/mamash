<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Contracts\ContentTranslation as ContentTranslationContract;

class ContentTranslation extends Model implements ContentTranslationContract
{

    protected $table = 'header_contents_translations';

    public $timestamps = false;

    protected $fillable = ['title', 'custom_title', 'custom_heading', 'page_link', 'link_target', 'catalog_type', 'products', 'description'];

    public function content()
    {
        return $this->belongsTo(ContentProxy::modelClass());
    }
}