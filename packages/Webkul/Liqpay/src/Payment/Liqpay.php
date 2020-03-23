<?php

namespace Webkul\Liqpay\Payment;

use Illuminate\Support\Facades\Config;
use Webkul\Payment\Payment\Payment;
use LiqPay as LiqPaySDK;

/**
 * Liqpay payment method class
 *
 */
class Liqpay extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'liqpay';

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return route('liqpay.redirect');
    }
}