<?php

namespace Webkul\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\CMS\Contracts\Template as TemplateContract;

class Template extends Model implements TemplateContract
{
    protected $table = 'cms_templates';

    protected $fillable = ['content', 'html_content', 'template_key', 'template_title', 'channel_id', 'locale_id'];
}