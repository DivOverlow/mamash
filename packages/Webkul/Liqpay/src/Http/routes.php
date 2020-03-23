<?php

    Route::prefix('liqpay')->group(function () {

        Route::get('/redirect', 'Webkul\Liqpay\Http\Controllers\LiqpayController@redirect')->name('liqpay.redirect');

        Route::post('/result', 'Webkul\Liqpay\Http\Controllers\LiqpayController@result')->name('liqpay.result');

        //server to server
        Route::post('/server', 'Webkul\Liqpay\Http\Controllers\LiqpayController@server')->name('liqpay.server');
    });