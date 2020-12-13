<?php

namespace Webkul\Core\Observers;

use Illuminate\Support\Facades\Storage;

class BannerObserver
{
    /**
     * Handle the Banner "deleted" event.
     *
     * @param  Banner $banner
     * @return void
     */
    public function deleted($banner)
    {
        Storage::delete($banner->path);
    }
}