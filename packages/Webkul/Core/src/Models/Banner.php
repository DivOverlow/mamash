<?php

namespace Webkul\Core\Models;

use Illuminate\Support\Facades\Storage;
use Webkul\Core\Contracts\Banner as BannerContract;
use Webkul\Core\Eloquent\TranslatableModel;

class Banner extends TranslatableModel implements BannerContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $translatedAttributes = ['title', 'html_content', 'content'];

    protected $table = 'banners';

    protected $fillable = [
        'banner_key', 'path', 'channel_id'
    ];

    protected $with = ['translations'];
    /**
     * Get image url for the category image.
     */
    public function image_url()
    {
        if (! $this->path)
            return;

        return Storage::url($this->path);
    }

    /**
     * Get image url for the category image.
     */
    public function getImageUrlAttribute()
    {
        return $this->image_url();
    }
}
