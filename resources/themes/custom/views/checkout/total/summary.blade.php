<div class="order-summary">
    {{--    <h3>{{ __('shop::app.checkout.total.order-summary') }}</h3>--}}
    <div class="px-8">
        <div class="item-detail w-full flex text-base sm:text-lg text-gray-dark uppercase">
            <label>
                {{ intval($cart->items_qty) }}
                {{ __('shop::app.checkout.total.sub-total') }}
                {{--            {{ __('shop::app.checkout.total.price') }}--}}
            </label>
            <label class="right ml-auto">{{ core()->currency($cart->base_sub_total) }}</label>
        </div>

        @if ($cart->selected_shipping_rate)
            <div class="item-detail w-full flex font-serif font-light text-base text-gray-cloud">
                <label>{{ __('shop::app.checkout.total.delivery-charges') }}</label>
                <label class="right ml-auto">{{ core()->currency($cart->selected_shipping_rate->base_price) }}</label>
            </div>
        @endif

        @if ($cart->base_tax_total > 0)
            <div class="item-detail w-full flex font-serif font-light text-base text-gray-cloud">
                <label>{{ __('shop::app.checkout.total.tax') }}</label>
                <label class="right ml-auto">{{ core()->currency($cart->base_tax_total) }}</label>
            </div>
        @endif


        <div
            class="item-detail w-full flex font-serif font-light text-base text-gray-cloud {{($cart->base_discount_amount && $cart->base_discount_amount > 0) ? 'visible' : 'invisible'}}"
            id="discount-detail">
            <label>
                <b>{{ __('shop::app.checkout.total.disc-amount') }}</b>
            </label>
            <label class="right ml-auto">
                <b id="discount-detail-discount-amount">
                    {{ core()->currency($cart->base_discount_amount) }}
                </b>
            </label>
        </div>


        <div class="payable-amount w-full flex text-base sm:text-lg text-gray-dark uppercase" id="grand-total-detail">
            <label>{{ __('shop::app.checkout.total.grand-total') }}</label>
            <label class="right ml-auto" id="grand-total-amount-detail">
                {{ core()->currency($cart->base_grand_total) }}
            </label>
        </div>
    </div>
    <div @if (! request()->is('checkout/cart')) v-if="parseInt(discount)" @endif>
        @if (! request()->is('checkout/cart'))
            @if (! $cart->coupon_code)
                <div class="discount mt-3 py-8 bg-white">
                    <div class="discount-group">
                        <form class="coupon-form" method="post" @submit.prevent="onSubmit">
                                <div class="w-full">
                                    <div class="control-group mat-div" :class="[errors.has('code') ? 'has-error' : '']">
                                        <input type="text" class="control mat-input" value="" v-model="coupon_code"
                                               name="code"
                                               placeholder="{{ __('shop::app.checkout.onepage.enter-coupon') }}"
                                               v-validate="'required'" style="width: 100%" @change="changeCoupon">
                                    </div>

                                    <div class="control-error mb-10" v-if="error_message != null"
                                         style="color: #FF6472">* @{{ error_message }}
                                    </div>
                                </div>
                                <div class="w-full flex justify-end">
                                <button class="button-black px-3 py-4 normal-case w-56"
                                        :disabled="couponChanged">{{ __('shop::app.checkout.onepage.apply-coupon') }}</button>
                                </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="discount-details-group py-6 px-8">
                    <div class="item-detail">
                        <label>{{ __('shop::app.checkout.total.coupon-applied') }}</label>

                        <label class="right" style="display: inline-flex; align-items: center;">
                            <b>{{ $cart->coupon_code }}</b>

                            <span class="icon cross-icon" title="{{ __('shop::app.checkout.total.remove-coupon') }}"
                                  v-on:click="removeCoupon"></span>
                        </label>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>