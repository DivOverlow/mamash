<?php

namespace Webkul\Liqpay\Providers;

use Illuminate\Support\ServiceProvider;

class LiqpayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../Http/routes.php';

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'liqpay');
    }

}
