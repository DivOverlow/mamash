@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.checkout.onepage.title') }}
@stop

@section('content-wrapper')
    <checkout></checkout>
@endsection

@push('scripts')
    <script type="text/x-template" id="checkout-template">
        <div id="checkout" class="checkout-process main-container-wrapper">
            <div class="title w-full h-32 flex items-end text-center">
                <span
                    class="text-xl sm:text-5xl uppercase text-gray-dark mx-auto">{{ __('shop::app.checkout.onepage.title') }}</span>
            </div>
            <div class="flex flex-col sm:flex-row justify-content-between items-start">
                <div class="col-main w-full flex flex-col">
                    <ul class="checkout-steps w-full sm:max-w-lg">
                        <li class="active" :class="[completed_step >= 0 ? 'active' : '', completed_step > 0 ? 'completed' : '']">
                            <div class=" flex items-center inline-block">
                                <div class="profile-icon address-info"></div>
                                <span
                                    class="text-gray-dark text-xl sm:text-2xl uppercase pl-4">{{ __('shop::app.checkout.onepage.information') }}</span>
                            </div>
                            <div class="step-content information" v-show="current_step == 1" id="address-section">
                                @include('shop::checkout.onepage.customer-info')
                           </div>
                        </li>
{{--                        <li :class="[current_step >= 0 || completed_step > 0 ? 'completed' : '']" @click="navigateToStep(2)">--}}
                        <li :class="[completed_step >= 0 ? 'active' : '', completed_step > 0 ? 'completed' : '']">
                            <div class="flex items-center inline-block">
                                <div class="decorator shipping"></div>
                                <span
                                    class="text-gray-dark text-xl sm:text-2xl uppercase pl-4">{{ __('shop::app.checkout.onepage.shipping') }}</span>
                            </div>
                            <div class="step-content shipping" v-show="current_step == 0" id="shipping-section">
{{--                                <shipping-section v-if="current_step == 0" @onShippingMethodSelected="shippingMethodSelected($event)"></shipping-section>--}}
                                <shipping-section v-if="current_step == 0" @onShippingMethodSelected="shippingMethodSelected($event)"></shipping-section>
                            </div>
                        </li>

                    </ul>


{{--                    <div class="step-content payment" v-show="current_step == 3" id="payment-section">--}}
{{--                        <payment-section v-if="current_step == 3"--}}
{{--                                         @onPaymentMethodSelected="paymentMethodSelected($event)"></payment-section>--}}

{{--                        <div class="button-group">--}}
{{--                            <button type="button" class="btn btn-lg btn-primary" @click="validateForm('payment-form')"--}}
{{--                                    :disabled="disable_button" id="checkout-payment-continue-button">--}}
{{--                                {{ __('shop::app.checkout.onepage.continue') }}--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="step-content review" v-show="current_step == 4" id="summary-section">--}}
{{--                        <review-section v-if="current_step == 4" :key="reviewComponentKey">--}}

                    <div class="button-group">
                        <button type="button" class="button-decor w-1/2 py-4 normal-case" @click="placeOrder()"
                                :disabled="disable_button" id="checkout-place-order-button">
                            {{ __('shop::app.checkout.onepage.place-order') }}
                        </button>
                    </div>

                </div>

            <div class="col-right w-full bg-old-lace sm:bg-white sm:max-w-md ml-auto mt-2" v-show="current_step != 4">


                @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
                @inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
                @inject ('categoryRepository', 'Webkul\Category\Repositories\CategoryRepository')


                <?php $cart = cart()->getCart(); ?>

                @if ($cart)
                    <?php $items = $cart->items; ?>


                    <div class="w-full">
                        <div class="sm:bg-gray-snow h-24 flex content-center flex-wrap">
                            <p class="cart-heading w-full font-medium text-center text-gray-dark text-xl uppercase">
                                {{ __('shop::app.checkout.onepage.cart-title') }}
                            </p>
                        </div>

                            <div class="cart-content my-3">
                                @foreach ($items as $item)
                                    <div class="item w-full flex flex-row justify-content-between items-center px-3 py-1 inline-block">
                                        <div class="item-image w-1/5">
                                            <?php
                                            if ($item->type == "configurable")
                                                $images = $productImageHelper->getProductBaseImage($item->child->product);
                                            else
                                                $images = $productImageHelper->getProductBaseImage($item->product);
                                            ?>
                                            <img src="{{ $images['small_image_url'] }}"/>
                                        </div>

                                        <div class="item-details w-3/5 flex content-between flex-wrap px-2 inline-block" style="min-height: 4rem;">
                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.name.before', ['item' => $item]) !!}

                                            <div class="item-title w-full">
                                                @php
                                                    $categoryCollection = null;
                                                    $categoriesForProduct = $productRepository->find($item->product_id);
                                                    if ($categoriesForProduct) {
                                                        foreach ($categoriesForProduct->categories()->get() as $categoryProduct) {
                                                            if ($categoryProduct->display_mode == "products_collection") {
                                                                $categoryCollection = $categoryRepository->findOrFail($categoryProduct->id);
                                                                break;
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                @if ($categoryCollection)
                                                    <p>
                                                        <a href="{{ route('shop.categories.index', $categoryCollection->slug) }}"
                                                           class="font-serif font-medium text-base text-gray-cloud cursor-pointer hover:text-gray-dark"
                                                           title="{{ $categoryCollection->name }}">
                                                            {{ $categoryCollection->name }} </a>
                                                    </p>
                                                @endif
                                                <span class="text-base text-gray-dark uppercase hover:text-gray-cloud">
                                        <a href="{{ url()->to('/').'/products/'.$item->product->url_key }}">
                                        {{ $item->product->name }} </a>
                                    </span>
                                            </div>

                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.name.after', ['item' => $item]) !!}


                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.options.before', ['item' => $item]) !!}

                                            @if ($item->type == "configurable")
                                                <div class="item-options">
                                                    {{ trim(Cart::getProductAttributeOptionDetails($item->child->product)['html']) }}
                                                </div>
                                            @endif

                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.options.after', ['item' => $item]) !!}

                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.quantity.before', ['item' => $item]) !!}

                                            <div
                                                class="item-qty font-serif text-base text-sm text-gray-cloud block">{{ __('shop::app.checkout.cart.quantity.short') }} {{ $item->quantity }}</div>

                                            {!! view_render_event('bagisto.shop.checkout.cart-mini.item.quantity.after', ['item' => $item]) !!}
                                        </div>
                                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.price.before', ['item' => $item]) !!}

                                        <div class="item-price w-1/5 font-medium">{{ core()->currency($item->base_total) }}</div>

                                        {!! view_render_event('bagisto.shop.checkout.cart-mini.item.price.after', ['item' => $item]) !!}
                                    </div>

                                @endforeach
                            </div>

                        <div class="w-full my-3">
                            @inject ('giftRepository', 'Webkul\Discount\Repositories\GiftRuleRepository')
                            <?php $gift_products = $giftRepository->getGiftsProduct(); ?>
                            @if (count($gift_products))
                                @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

                                <div class="gift-content my-3">
                                        @if (session()->has('gift_product_id'))
                                        <?php $product = $productRepository->find(session()->get('gift_product_id')); ?>
                                        @if($product)
                                            @php
                                                $productBaseImage = $productImageHelper->getProductBaseImage($product);
                                            @endphp
                                            <div class="w-full flex flex-col sm:flex-row justify-between items-center text-center sm:text-left py-2">
                                                <div class="item-image h-56 sm:h-28 w-full sm:w-1/3 sm:ml-auto flex items-center justify-center">
                                                    <a href="{{ url()->to('/').'/products/'.$product->url_key }}"><img  class="object-scale-down h-48 sm:h-24 w-auto"
                                                                                                                        src="{{ $productBaseImage['medium_image_url'] }}"/></a>
                                                </div>
                                                <div class="item-title flex flex-col justify-start">
                                                    <div class="text-base text-gray-dark uppercase hover:text-gray-cloud">
                                                        <a href="{{ url()->to('/').'/products/'.$product->url_key }}">
                                                            {{ $product->name }} </a>
                                                    </div>
                                                    <div class="font-serif font-medium text-base text-gray-cloud">
                                                        {{  __('shop::app.checkout.gift.free') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                                            <p>{{__('shop::app.checkout.gift.gift-not-available')}}</p>
                                        </div>
                                        @foreach($gift_products as $gift_product)
                                            @if(isset($gift_product->related_products()->first()->product_id))
                                                <?php $product = $productRepository->find($gift_product->related_products()->first()->product_id); ?>
                                                @if($product)
                                                    @php
                                                        $productBaseImage = $productImageHelper->getProductBaseImage($product);
                                                    @endphp
                                                    <div class="w-full flex flex-row justify-between items-center text-left py-2">
                                                        <div class="item-image h-28 w-1/2 flex items-center justify-center">
                                                            <a href="{{ url()->to('/').'/products/'.$product->url_key }}"><img  class="object-scale-down h-24 w-auto"
                                                                                                                                src="{{ $productBaseImage['small_image_url'] }}"/></a>
                                                        </div>
                                                        <div class="item-title flex flex-col justify-start">
                                                            <div class="text-base text-gray-dark uppercase hover:text-gray-cloud">
                                                                <a href="{{ url()->to('/').'/products/'.$product->url_key }}">
                                                                    {{ $product->name }} </a>
                                                            </div>
                                                            <div class="font-serif font-medium text-base text-gray-cloud">
                                                                {{ ($cart->base_sub_total < $gift_product->action_amount) ? __('shop::app.checkout.gift.premium') : __('shop::app.checkout.gift.free') }}
                                                            </div>
                                                            <div class="font-normal font-medium text-base text-gray-cloud leading-tight">
                                                                {{ ($cart->base_sub_total < $gift_product->action_amount) ? sprintf(__('shop::app.checkout.gift.premium-message'), core()->convertPrice($gift_product->action_amount - $cart->base_sub_total) . core()->currencySymbol(core()->getBaseCurrencyCode()) ) : __('shop::app.checkout.gift.free-message') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @break
                                            @endif
                                        @endforeach

                                    @endif

                                </div>
                            @endif
                        </div>

                            {{--                            <div class="dropdown-footer">--}}
{{--                                <div class="bg-gray-snow font-medium text-gray-dark h-16 flex content-center flex-wrap">--}}
{{--                                    <div class="w-2/3 text-center uppercase">--}}
{{--                                        {{ __('shop::app.checkout.cart.cart-subtotal') }}:--}}
{{--                                    </div>--}}
{{--                                    <div class="w-1/3 text-center">--}}
{{--                                        {!! view_render_event('bagisto.shop.checkout.cart-mini.subtotal.before', ['cart' => $cart]) !!}--}}
{{--    --}}
{{--                                        {{ core()->currency($cart->base_sub_total) }}--}}
{{--    --}}
{{--                                        {!! view_render_event('bagisto.shop.checkout.cart-mini.subtotal.after', ['cart' => $cart]) !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="flex flex-row justify-content-between items-center">--}}
{{--                    <span class="button-black w-full py-3 normal-case">--}}
{{--    --}}{{--                            <a href="{{ route('shop.checkout.cart.index') }}">{{ __('shop::app.checkout.cart.continue-shopping') }}</a>--}}
{{--                        <a href="{{ route('shop.checkout.cart.index') }}">{{ __('shop::app.minicart.view-cart') }}</a>--}}
{{--                    </span>--}}
{{--                                    <span class="button-decor w-full py-3 normal-case">--}}
{{--    --}}{{--                            <a href="{{ route('shop.checkout.cart.index') }}">{{ __('shop::app.minicart.view-cart') }}</a>--}}
{{--                        <a  href="{{ route('shop.checkout.onepage.index') }}">{{ __('shop::app.minicart.checkout') }}</a>--}}
{{--                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                    </div>

                @endif


                <div class="step-content review" v-show="current_step >= 0" id="summary-section">
                    <review-section v-if="current_step >= 0" :key="reviewComponentKey">
                        <div slot="summary-section">
                            <summary-section
                                discount="1"
                                :key="summeryComponentKey"
                                @onApplyCoupon="getOrderSummary"
                                @onRemoveCoupon="getOrderSummary"
                            ></summary-section>
                        </div>
                    </review-section>
                </div>
                <div class="sm:bg-gray-snow px-8">
                   <summary-section :key="summeryComponentKey"></summary-section>
                </div>
            </div>
        </div>
        </div>
    </script>

    <script>
        var shippingHtml = '';
        var paymentHtml = '';
        var reviewHtml = '';
        var summaryHtml = '';
        var customerAddress = '';
        var shippingMethods = '';
        var paymentMethods = '';

        @auth('customer')
            @if(auth('customer')->user()->addresses)
            customerAddress = @json(auth('customer')->user()->addresses);
        customerAddress.email = "{{ auth('customer')->user()->email }}";
        customerAddress.first_name = "{{ auth('customer')->user()->first_name }}";
        customerAddress.last_name = "{{ auth('customer')->user()->last_name }}";
        @endif
        @endauth

        Vue.component('checkout', {
            template: '#checkout-template',
            inject: ['$validator'],

            data: function () {
                return {
                    step_numbers: {
                        'information': 1,
                        'shipping': 1,
                        'payment': 3,
                        'review': 4
                    },

                    current_step: 1,

                    completed_step: 1,

                    address: {
                        billing: {
                            address1: [''],

                            use_for_shipping: true,
                        },

                        shipping: {
                            address1: ['']
                        },
                    },

                    selected_shipping_method: '',

                    selected_payment_method: '',

                    disable_button: false,

                    new_shipping_address: false,

                    new_billing_address: false,

                    allAddress: {},

                    countryStates: @json(core()->groupedStatesByCountries()),

                    country: @json(core()->countries()),

                    summeryComponentKey: 0,

                    reviewComponentKey: 0
                }
            },

            created: function () {
                this.getOrderSummary();

                if (!customerAddress) {
                    this.new_shipping_address = true;
                    this.new_billing_address = true;
                } else {
                    this.address.billing.first_name = this.address.shipping.first_name = customerAddress.first_name;
                    this.address.billing.last_name = this.address.shipping.last_name = customerAddress.last_name;
                    this.address.billing.email = this.address.shipping.email = customerAddress.email;

                    if (customerAddress.length < 1) {
                        this.new_shipping_address = true;
                        this.new_billing_address = true;
                    } else {
                        this.allAddress = customerAddress;

                        for (var country in this.country) {
                            for (var code in this.allAddress) {
                                if (this.allAddress[code].country) {
                                    if (this.allAddress[code].country == this.country[country].code) {
                                        this.allAddress[code]['country'] = this.country[country].name;
                                    }
                                }
                            }
                        }
                    }
                }
            },

            methods: {
                navigateToStep: function (step) {
                    if (step <= this.completed_step) {
                        this.current_step = step
                        this.completed_step = step - 1;
                    }
                },

                haveStates: function (addressType) {
                    if (this.countryStates[this.address[addressType].country] && this.countryStates[this.address[addressType].country].length)
                        return true;

                    return false;
                },

                validateForm: function (scope) {
                    var this_this = this;

                    this.$validator.validateAll(scope).then(function (result) {

                       if (result) {
                            if (scope == 'address-form') {
                                this_this.saveAddress();
                            } else if (scope == 'shipping-form') {
                                this_this.saveShipping();
                            } else if (scope == 'payment-form') {
                                this_this.savePayment();
                            }
                        }
                    });
                },

                getOrderSummary() {
                    var this_this = this;

                    this.$http.get("{{ route('shop.checkout.summary') }}")
                        .then(function (response) {
                            summaryHtml = Vue.compile(response.data.html)

                            this_this.summeryComponentKey++;
                            this_this.reviewComponentKey++;
                        })
                        .catch(function (error) {
                        })
                },

                saveAddress: function () {
                    var this_this = this;

                    this.disable_button = true;

                    this.$http.post("{{ route('shop.checkout.save-address') }}", this.address)
                        .then(function (response) {
                            this_this.disable_button = false;

                            if (this_this.step_numbers[response.data.jump_to_section] == 2)
                                shippingHtml = Vue.compile(response.data.html)
                            else
                                paymentHtml = Vue.compile(response.data.html)

                            this_this.completed_step = this_this.step_numbers[response.data.jump_to_section] + 1;
                            this_this.current_step = this_this.step_numbers[response.data.jump_to_section];
                            this_this.getOrderSummary();
                        })
                        .catch(function (error) {
                            this_this.disable_button = false;
                            this_this.handleErrorResponse(error.response, 'address-form')
                        })
                },

                saveShipping: function () {
                    var this_this = this;

                    this.disable_button = true;

                    this.$http.post("{{ route('shop.checkout.save-shipping') }}", {'shipping_method': this.selected_shipping_method})
                        .then(function (response) {
                            this_this.disable_button = false;

                            paymentHtml = Vue.compile(response.data.html)
                            this_this.completed_step = this_this.step_numbers[response.data.jump_to_section] + 1;
                            this_this.current_step = this_this.step_numbers[response.data.jump_to_section];

                            this_this.getOrderSummary();
                        })
                        .catch(function (error) {
                            this_this.disable_button = false;

                            this_this.handleErrorResponse(error.response, 'shipping-form')
                        })
                },

                savePayment: function () {
                    var this_this = this;

                    this.disable_button = true;

                    this.$http.post("{{ route('shop.checkout.save-payment') }}", {'payment': this.selected_payment_method})
                        .then(function (response) {
                            this_this.disable_button = false;

                            reviewHtml = Vue.compile(response.data.html)
                            this_this.completed_step = this_this.step_numbers[response.data.jump_to_section] + 1;
                            this_this.current_step = this_this.step_numbers[response.data.jump_to_section];

                            this_this.getOrderSummary();
                        })
                        .catch(function (error) {
                            this_this.disable_button = false;

                            this_this.handleErrorResponse(error.response, 'payment-form')
                        });
                },

                placeOrder: function () {
                    var this_this = this;

                    this.disable_button = true;

                    this.$http.post("{{ route('shop.checkout.save-order') }}", {'_token': "{{ csrf_token() }}"})
                        .then(function (response) {
                            if (response.data.success) {
                                if (response.data.redirect_url) {
                                    window.location.href = response.data.redirect_url;
                                } else {
                                    window.location.href = "{{ route('shop.checkout.success') }}";
                                }
                            }
                        })
                        .catch(function (error) {
                            this_this.disable_button = true;

                            window.flashMessages = [{
                                'type': 'alert-error',
                                'message': "{{ __('shop::app.common.error') }}"
                            }];

                            this_this.$root.addFlashMessages()
                        })
                },

                handleErrorResponse: function (response, scope) {
                    if (response.status == 422) {
                        serverErrors = response.data.errors;
                        this.$root.addServerErrors(scope)
                    } else if (response.status == 403) {
                        if (response.data.redirect_url) {
                            window.location.href = response.data.redirect_url;
                        }
                    }
                },

                shippingMethodSelected: function (shippingMethod) {
                    this.selected_shipping_method = shippingMethod;
                },

                paymentMethodSelected: function (paymentMethod) {
                    this.selected_payment_method = paymentMethod;
                },

                newBillingAddress: function () {
                    this.new_billing_address = true;
                },

                newShippingAddress: function () {
                    this.new_shipping_address = true;
                },

                backToSavedBillingAddress: function () {
                    this.new_billing_address = false;
                },

                backToSavedShippingAddress: function () {
                    this.new_shipping_address = false;
                },
            }
        })

        var shippingTemplateRenderFns = [];

        Vue.component('shipping-section', {
            inject: ['$validator'],

            data: function () {
                return {
                    templateRender: null,

                    selected_shipping_method: '',

                    first_iteration: true,
                }
            },

            staticRenderFns: shippingTemplateRenderFns,

            mounted: function () {
                for (method in shippingMethods) {
                    if (this.first_iteration) {
                        for (rate in shippingMethods[method]['rates']) {
                            this.selected_shipping_method = shippingMethods[method]['rates'][rate]['method'];
                            this.first_iteration = false;
                            this.methodSelected();
                        }
                    }
                }

                this.templateRender = shippingHtml.render;
                for (var i in shippingHtml.staticRenderFns) {
                    shippingTemplateRenderFns.push(shippingHtml.staticRenderFns[i]);
                }

                eventBus.$emit('after-checkout-shipping-section-added');
            },

            render: function (h) {
                return h('div', [
                    (this.templateRender ?
                        this.templateRender() :
                        '')
                ]);
            },

            methods: {
                methodSelected: function () {
                    this.$emit('onShippingMethodSelected', this.selected_shipping_method)

                    eventBus.$emit('after-shipping-method-selected');
                }
            }
        })

        var paymentTemplateRenderFns = [];

        Vue.component('payment-section', {
            inject: ['$validator'],

            data: function () {
                return {
                    templateRender: null,

                    payment: {
                        method: ""
                    },

                    first_iteration: true,
                }
            },

            staticRenderFns: paymentTemplateRenderFns,

            mounted: function () {
                for (method in paymentMethods) {
                    if (this.first_iteration) {
                        this.payment.method = paymentMethods[method]['method'];
                        this.first_iteration = false;
                        this.methodSelected();
                    }
                }

                this.templateRender = paymentHtml.render;
                for (var i in paymentHtml.staticRenderFns) {
                    paymentTemplateRenderFns.push(paymentHtml.staticRenderFns[i]);
                }

                eventBus.$emit('after-checkout-payment-section-added');
            },

            render: function (h) {
                return h('div', [
                    (this.templateRender ?
                        this.templateRender() :
                        '')
                ]);
            },

            methods: {
                methodSelected: function () {
                    this.$emit('onPaymentMethodSelected', this.payment)

                    eventBus.$emit('after-payment-method-selected');
                }
            }
        })

        var reviewTemplateRenderFns = [];

        Vue.component('review-section', {
            data: function () {
                return {
                    templateRender: null,

                    error_message: ''
                }
            },

            staticRenderFns: reviewTemplateRenderFns,

            render: function (h) {
                return h('div', [
                    (this.templateRender ?
                        this.templateRender() :
                        '')
                ]);
            },

            mounted: function () {
                this.templateRender = reviewHtml.render;

                for (var i in reviewHtml.staticRenderFns) {
                    // reviewTemplateRenderFns.push(reviewHtml.staticRenderFns[i]);
                    reviewTemplateRenderFns[i] = reviewHtml.staticRenderFns[i];
                }

                this.$forceUpdate();
            }
        });


        var summaryTemplateRenderFns = [];

        Vue.component('summary-section', {
            inject: ['$validator'],

            props: {
                discount: {
                    type: [String, Number],

                    default: 0,
                }
            },

            data: function () {
                return {
                    templateRender: null,

                    coupon_code: null,

                    error_message: null,

                    couponChanged: false,

                    changeCount: 0
                }
            },

            staticRenderFns: summaryTemplateRenderFns,

            mounted: function () {
                this.templateRender = summaryHtml.render;

                for (var i in summaryHtml.staticRenderFns) {
                    // summaryTemplateRenderFns.push(summaryHtml.staticRenderFns[i]);
                    summaryTemplateRenderFns[i] = summaryHtml.staticRenderFns[i];
                }

                this.$forceUpdate();
            },

            render: function (h) {
                return h('div', [
                    (this.templateRender ?
                        this.templateRender() :
                        '')
                ]);
            },

            methods: {
                onSubmit: function () {
                    var this_this = this;

                    axios.post('{{ route('shop.checkout.check.coupons') }}', {code: this_this.coupon_code})
                        .then(function (response) {
                            this_this.$emit('onApplyCoupon');

                            this_this.couponChanged = true;
                        })
                        .catch(function (error) {
                            this_this.couponChanged = true;

                            this_this.error_message = error.response.data.message;
                        });
                },

                changeCoupon: function () {
                    if (this.couponChanged == true && this.changeCount == 0) {
                        this.changeCount++;

                        this.error_message = null;

                        this.couponChanged = false;
                    } else {
                        this.changeCount = 0;
                    }
                },

                removeCoupon: function () {
                    var this_this = this;

                    axios.post('{{ route('shop.checkout.remove.coupon') }}')
                        .then(function (response) {
                            this_this.$emit('onRemoveCoupon')
                        })
                        .catch(function (error) {
                            window.flashMessages = [{'type': 'alert-error', 'message': error.response.data.message}];

                            this_this.$root.addFlashMessages();
                        });
                }
            }
        })
    </script>

@endpush