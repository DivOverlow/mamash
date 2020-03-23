<div class="form-container max-w-md mb-10">
    <div class="form-header mb-10 flex justify-center inline-block">
        <span class="checkout-step-heading font-serif font-medium text-lg text-gray-dark uppercase">{{ __('shop::app.checkout.onepage.summary') }}</span>
    </div>

    <div class="address-summary w-full flex flex-col sm:flex-row justify-between justify-center px-6">
        @if ($billingAddress = $cart->billing_address)
            <div class="billing-address">
{{--                <div class="card-title mb-10 font-serif font-medium text-gray-dark">--}}
{{--                    <b>{{ __('shop::app.checkout.onepage.billing-address') }}</b>--}}
{{--                </div>--}}

                <div class="card-content font-serif font-medium text-gray-silver">
                    <ul>
                        <li class="mb-6">
                            {{ $billingAddress->name }}
                        </li>
{{--                        <li class="mb-6">--}}
{{--                            {{ $billingAddress->address1 }},<br/> {{ $billingAddress->state }}--}}
{{--                        </li>--}}
{{--                        <li class="mb-6">--}}
{{--                            {{ core()->country_name($billingAddress->country) }} {{ $billingAddress->postcode }}--}}
{{--                        </li>--}}

                        <span class="horizontal-rule my-3"></span>

                        <li class="mb-6">
                            {{ __('shop::app.checkout.onepage.contact') }} : {{ $billingAddress->phone }}
                        </li>
                    </ul>
                </div>
            </div>
        @endif

{{--        @if ($cart->haveStockableItems() && $shippingAddress = $cart->shipping_address)--}}
{{--            <div class="shipping-address">--}}
{{--                <div class="card-title mb-20">--}}
{{--                    <b>{{ __('shop::app.checkout.onepage.shipping-address') }}</b>--}}
{{--                </div>--}}

{{--                <div class="card-content">--}}
{{--                    <ul>--}}
{{--                        <li class="mb-10">--}}
{{--                            {{ $shippingAddress->name }}--}}
{{--                        </li>--}}
{{--                        <li class="mb-10">--}}
{{--                            {{ $shippingAddress->address1 }},<br/> {{ $shippingAddress->state }}--}}
{{--                        </li>--}}
{{--                        <li class="mb-10">--}}
{{--                            {{ core()->country_name($shippingAddress->country) }} {{ $shippingAddress->postcode }}--}}
{{--                        </li>--}}

{{--                        <span class="horizontal-rule mb-15 mt-15"></span>--}}

{{--                        <li class="mb-10">--}}
{{--                            {{ __('shop::app.checkout.onepage.contact') }} : {{ $shippingAddress->phone }}--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
    </div>
{{--    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')--}}

{{--    <div class="cart-item-list mt-20">--}}
{{--        @foreach ($cart->items as $item)--}}
{{--            @php--}}
{{--                $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);--}}
{{--            @endphp--}}

{{--            <div class="item mb-5" style="margin-bottom: 5px;">--}}
{{--                <div class="item-image">--}}
{{--                    <img src="{{ $productBaseImage['medium_image_url'] }}" />--}}
{{--                </div>--}}

{{--                <div class="item-details">--}}

{{--                    {!! view_render_event('bagisto.shop.checkout.name.before', ['item' => $item]) !!}--}}

{{--                    <div class="item-title">--}}
{{--                        {{ $item->product->name }}--}}
{{--                    </div>--}}

{{--                    {!! view_render_event('bagisto.shop.checkout.name.after', ['item' => $item]) !!}--}}
{{--                    {!! view_render_event('bagisto.shop.checkout.price.before', ['item' => $item]) !!}--}}

{{--                    <div class="row">--}}
{{--                        <span class="title">--}}
{{--                            {{ __('shop::app.checkout.onepage.price') }}--}}
{{--                        </span>--}}
{{--                        <span class="value">--}}
{{--                            {{ core()->currency($item->base_price) }}--}}
{{--                        </span>--}}
{{--                    </div>--}}

{{--                    {!! view_render_event('bagisto.shop.checkout.price.after', ['item' => $item]) !!}--}}
{{--                    {!! view_render_event('bagisto.shop.checkout.quantity.before', ['item' => $item]) !!}--}}

{{--                    <div class="row">--}}
{{--                        <span class="title">--}}
{{--                            {{ __('shop::app.checkout.onepage.quantity') }}--}}
{{--                        </span>--}}
{{--                        <span class="value">--}}
{{--                            {{ $item->quantity }}--}}
{{--                        </span>--}}
{{--                    </div>--}}

{{--                    {!! view_render_event('bagisto.shop.checkout.quantity.after', ['item' => $item]) !!}--}}

{{--                    {!! view_render_event('bagisto.shop.checkout.options.before', ['item' => $item]) !!}--}}

{{--                    @if (isset($item->additional['attributes']))--}}
{{--                        <div class="item-options">--}}
{{--                            --}}
{{--                            @foreach ($item->additional['attributes'] as $attribute)--}}
{{--                                <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>--}}
{{--                            @endforeach--}}

{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {!! view_render_event('bagisto.shop.checkout.options.after', ['item' => $item]) !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}

    <div class="order-description my-3 px-6">
        <div class="pull-left w-full flex justify-between justify-center font-serif font-medium text-gray-silver">
            @if ($cart->haveStockableItems())
                <div class="shipping">
                    <div class="decorator">
                        <i class="icon shipping-icon"></i>
                    </div>

                    <div class="text">
                        {{ core()->currency($cart->selected_shipping_rate->base_price) }}

                        <div class="info">
                            {{ $cart->selected_shipping_rate->method_title }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="payment flex items-center">
                <div class="decorator">
                    <i class="icon payment-icon"></i>
                </div>

                <div class="text ml-2">
                    {{ core()->getConfigData('sales.paymentmethods.' . $cart->payment->method . '.title') }}
                </div>
            </div>

        </div>

{{--        <div class="pull-right">--}}
{{--            <slot name="summary-section"></slot>--}}
{{--        </div>--}}
    </div>
</div>