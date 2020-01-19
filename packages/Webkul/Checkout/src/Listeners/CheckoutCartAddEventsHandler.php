<?php

namespace Webkul\Checkout\Listeners;

class CheckoutCartAddEventsHandler {

    /**
     * Handle Checkout Cart add events.
     */
    public function onCartAdd($event)
    {
        session()->put('showCardModal', true);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen('checkout.cart.add.after', 'Webkul\Checkout\Listeners\CheckoutCartAddEventsHandler@onCartAdd');
    }
}