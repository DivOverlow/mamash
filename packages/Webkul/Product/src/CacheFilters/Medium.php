<?php

namespace Webkul\Product\CacheFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Medium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $width = null;
        $height = 360;
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        return $image->resizeCanvas($width, $height, 'center', false, '#fff');
    }
}