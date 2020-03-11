<?php

namespace Webkul\Shipping\Carriers;

use Config;
use Webkul\Checkout\Models\CartShippingRate;
use Webkul\Sales\Models\Order;
use Webkul\Shipping\Facades\Shipping;
use Webkul\Checkout\Facades\Cart;

/**
 * Class Rate.
 *
 */
class FlatRate extends AbstractShipping
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'flatrate';

    /**
     * Returns rate for flatrate
     *
     * @return array
     */
    public function calculate()
    {
        if (! $this->isAvailable()) {
            return false;
        }

        $cart = Cart::getCart();

        $object = new CartShippingRate;

        $object->carrier = 'flatrate';
        $object->carrier_title = $this->getConfigData('title');
        $object->method = 'flatrate_flatrate';
        $object->method_title = $this->getConfigData('title');
        $object->method_description = $this->getConfigData('description');
        $object->price = 0;
        $object->base_price = 0;

        if ($this->getConfigData('type') == 'per_unit') {
            foreach ($cart->items as $item) {
                if ($item->product->getTypeInstance()->isStockable()) {
                    $object->price += core()->convertPrice($this->getConfigData('default_rate')) * $item->quantity;
                    $object->base_price += $this->getConfigData('default_rate') * $item->quantity;
                }
            }
        } else {
            $object->price = core()->convertPrice($this->getConfigData('default_rate'));
            $object->base_price = $this->getConfigData('default_rate');
        }

        return $object;
    }

    /**
     * Returns rate for flatrate
     *
     * @return array
     */
    public function calculateOrder($orderId)
    {
        if (! $this->isAvailable()) {
            return false;
        }

        $order = app('Webkul\Sales\Repositories\OrderRepository')->getOrder($orderId);

        $object = new CartShippingRate;

        $object->carrier = 'flatrate';
        $object->carrier_title = $this->getConfigData('title');
        $object->method = 'flatrate_flatrate';
        $object->method_title = $this->getConfigData('title');
        $object->method_description = $this->getConfigData('description');
        $object->price = 0;
        $object->base_price = 0;

        if ($this->getConfigData('type') == 'per_unit') {
            foreach ($order->items as $item) {

                if ($item->getTypeInstance()->isStockable() && $item->price > 0) {
                    $object->price += core()->convertPrice($this->getConfigData('default_rate')) * $item->qty_ordered;
                    $object->base_price += $this->getConfigData('default_rate') * $item->qty_ordered;
                }
            }
        } else {
            $object->price = core()->convertPrice($this->getConfigData('default_rate'));
            $object->base_price = $this->getConfigData('default_rate');
        }

        return $object;
    }
}