@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.checkout.cart.title') }}
@stop

@section('content-wrapper')
    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
    @inject ('categoryRepository', 'Webkul\Category\Repositories\CategoryRepository')
    @inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
    @inject ('giftRepository', 'Webkul\Discount\Repositories\GiftRuleRepository')

    <section class="cart">
        <div class="cart-product bg-ghost-white w-full">
            <div class="main-container-wrapper">
                @if ($cart)
                    <div class="title w-full h-32 flex items-end text-center">
                        <span class="text-xl sm:text-5xl uppercase text-gray-dark mx-auto">{{ __('shop::app.checkout.cart.title') }}</span>
                    </div>
                    <div class="w-full invisible sm:visible font-serif text-xs tracking-widest text-gray-dark uppercase flex flex-row justify-between items-center mt-12">
                        <div class="w-1/2">
                            {{ __('shop::app.checkout.cart.name') }}
                        </div>
                        <div class="w-1/2">
                            <div class="w-1/2 ml-auto flex justify-between items-center">
                                <span>{{ __('shop::app.products.quantity') }}</span>
                                <span>{{ __('shop::app.checkout.total.price') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="cart-content">
                        <div class="left-side">
                            <form action="{{ route('shop.checkout.cart.update') }}" method="POST"
                                  @submit.prevent="onSubmit">

                                <div class="cart-item-list">
                                    @csrf
                                    @foreach ($cart->items as $key => $item)
                                        @php
                                            $productBaseImage = $item->product->getTypeInstance()->getBaseImage($item);
                                        @endphp

                                        <div class="item w-full flex flex-col sm:flex-row justify-between items-center py-5">
                                            <div class="w-full sm:w-1/2 flex justify-between items-center inline-block">
                                                <div class="item-image w-1/5">
                                                    <a href="{{ url()->to('/').'/products/'.$item->product->url_key }}"><img
                                                            src="{{ $productBaseImage['small_image_url'] }}"/></a>
                                                </div>

                                                <div class="item-details w-4/5 flex content-between flex-wrap px-2" style="min-height: 6rem;">

                                                    {!! view_render_event('bagisto.shop.checkout.cart.item.name.before', ['item' => $item]) !!}

                                                    <div class="item-title w-full">
                                                        @php
                                                              $categoryCollection = null;
                                                            foreach ($item->product->categories as $category) {
                                                                if ($category->display_mode == "collections_only") {
                                                                    $categoryCollection = $category;
                                                                    break;
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

                                                        <span class="text-base sm:text-lg text-gray-dark uppercase hover:text-gray-cloud">
                                                            <a href="{{ url()->to('/').'/products/'.$item->product->url_key }}">
                                                            {{ $item->product->name }} </a>
                                                        </span>
                                                    </div>

                                                    {!! view_render_event('bagisto.shop.checkout.cart.item.name.after', ['item' => $item]) !!}

                                                    {!! view_render_event('bagisto.shop.checkout.cart.item.options.before', ['item' => $item]) !!}

                                                    @if (isset($item->additional['attributes']))
                                                        <div class="item-options">

                                                            @foreach ($item->additional['attributes'] as $attribute)
                                                                <b>{{ $attribute['attribute_name'] }}
                                                                    : </b>{{ $attribute['option_label'] }}</br>
                                                            @endforeach

                                                        </div>
                                                    @endif

                                                    {!! view_render_event('bagisto.shop.checkout.cart.item.options.after', ['item' => $item]) !!}

                                                    <span class="remove font-serif text-base text-gray-cloud cursor-pointer underline hover:no-underline hover:text-gray-dark static">
                                                        <a href="{{ route('shop.checkout.cart.remove', $item->id) }}"
                                                       onclick="removeLink('{{ __('shop::app.checkout.cart.cart-remove-action') }}')">{{ __('shop::app.checkout.cart.remove-link') }}</a>
                                                    </span>

                                                    @auth('customer')
{{--                                                        <span class="towishlist">--}}
{{--                                                            @if ($item->parent_id != 'null' ||$item->parent_id != null)--}}
{{--                                                                <a href="{{ route('shop.movetowishlist', $item->id) }}"--}}
{{--                                                                   onclick="removeLink('{{ __('shop::app.checkout.cart.cart-remove-action') }}')">{{ __('shop::app.checkout.cart.move-to-wishlist') }}</a>--}}
{{--                                                            @else--}}
{{--                                                                <a href="{{ route('shop.movetowishlist', $item->child->id) }}"--}}
{{--                                                                   onclick="removeLink('{{ __('shop::app.checkout.cart.cart-remove-action') }}')">{{ __('shop::app.checkout.cart.move-to-wishlist') }}</a>--}}
{{--                                                            @endif--}}
{{--                                                     </span>--}}
                                                    @endauth
                                                </div>
                                            </div>
                                            <div class="w-full sm:w-1/2">
                                                <div class="w-2/3 sm:w-1/2 ml-0 sm:ml-auto flex justify-between items-center">

                                                    {!! view_render_event('bagisto.shop.checkout.cart.item.quantity.before', ['item' => $item]) !!}

                                                    <div class="misc">

                                                        <div class="control-group" :class="[errors.has('qty[{{$item->id}}]') ? 'has-error' : '']">
                                                            <div class="wrap font-serif text-gray-dark flex justify-center items-center inline-block">
{{--                                                                <label for="qty[{{$item->id}}]">{{ __('shop::app.checkout.cart.quantity.quantity') }}</label>--}}

                                                                <input class="control quantity-change font-semibold w-12" value="-" onclick="updateCartQunatity('remove', {{$key}})" readonly>

                                                                <input type="text" class="control quantity-change control border border-gray-cloud font-semibold text-xl rounded-full h-12 w-12 flex items-center justify-center text-center" id="cart-quantity{{ $key
                                                    }}" v-validate="'required|numeric|min_value:1'" name="qty[{{$item->id}}]" value="{{ $item->quantity }}" data-vv-as="&quot;{{ __('shop::app.checkout.cart.quantity.quantity') }}&quot;" readonly>

                                                                <input class="font-semibold text-xl px-4 w-12 control quantity-change" value="+" onclick="updateCartQunatity('add', {{$key}})" readonly>
                                                            </div>

                                                            <span class="control-error" v-if="errors.has('qty[{{$item->id}}]')">@{{ errors.first('qty[{!!$item->id!!}]') }}</span>
                                                        </div>

                                                    </div>

                                                    {!! view_render_event('bagisto.shop.checkout.cart.item.quantity.after', ['item' => $item]) !!}


                                                    {!! view_render_event('bagisto.shop.checkout.cart.item.price.before', ['item' => $item]) !!}

                                                    <div class="price">
                                                        {{ core()->currency($item->base_price) }}
                                                    </div>

                                                    {!! view_render_event('bagisto.shop.checkout.cart.item.price.after', ['item' => $item]) !!}


                                                </div>
                                                @if (! cart()->isItemHaveQuantity($item))
                                                    <div class="error-message mt-15">
                                                        * {{ __('shop::app.checkout.cart.quantity-error') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>



                                <?php $gift_products = $giftRepository->getGiftsProduct(); ?>
                                @if (count($gift_products))
                                    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

                                <div class="gift-item-list bg-old-lace my-6">
                                    <div class="font-serif text-xs tracking-widest text-gray-dark uppercase">{{ __('shop::app.checkout.gift.title') }}</div>
                                    @if (!session()->has('gift_product_id'))
                                        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4">
                                            <p>{{__('shop::app.checkout.gift.gift-not-available')}}</p>
                                        </div>
                                    @endif

                                    @foreach($gift_products as $gift_product)
                                        @if(isset($gift_product->related_products()->first()->product_id))
                                            <?php $product = $productRepository->find($gift_product->related_products()->first()->product_id); ?>
                                            @if($product)
                                                    @php
                                                        $productBaseImage = $productImageHelper->getProductBaseImage($product);
                                                    @endphp
                                            <div class="item w-full flex flex-row justify-between">
                                                <div class="w-full sm:w-5/6 flex flex-col sm:flex-row justify-between items-center text-center sm:text-left py-5">
                                                    <div class="item-image w-full sm:w-1/5 h-56 flex items-center justify-center">
                                                        <a href="{{ url()->to('/').'/products/'.$product->url_key }}"><img  class="object-scale-down h-48 w-auto"
                                                                src="{{ $productBaseImage['medium_image_url'] }}"/></a>
                                                    </div>
                                                    <div class="item-title w-full sm:w-2/5 flex flex-col justify-start">
                                                        <div class="text-base sm:text-lg text-gray-dark uppercase hover:text-gray-cloud">
                                                            <a href="{{ url()->to('/').'/products/'.$product->url_key }}">
                                                            {{ $product->name }} </a>
                                                        </div>
                                                        <div class="font-serif font-medium text-base text-gray-cloud my-3">
                                                            {{ ($cart->base_sub_total < $gift_product->action_amount) ? __('shop::app.checkout.gift.premium') : __('shop::app.checkout.gift.free') }}
                                                        </div>
                                                    </div>
                                                    <div class="item-title w-full sm:w-2/5 flex flex-col justify-end">
                                                        <div class="w-full sm:w-2/3 sm:ml-auto font-normal font-medium text-lg text-gray-cloud">
                                                            @if ($cart->base_sub_total < $gift_product->action_amount)
                                                              {{  __('shop::app.checkout.gift.premium-message', ['premium_counter' => core()->convertPrice($gift_product->action_amount - $cart->base_sub_total) . core()->currencySymbol(core()->getBaseCurrencyCode())]) }}
                                                            @elseif (session()->get('gift_product_id') == $product->id )
                                                                <span class="text-gold text-xl"> {{ __('shop::app.checkout.gift.title') }} </span>
                                                            @else
                                                                {{ __('shop::app.checkout.gift.free-message') }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-auto sm:w-1/6 flex sm:justify-center items-start sm:items-center">
                                                    <span class="radio"><input type="radio" id="{{$product->id}}" @if($cart->base_sub_total < $gift_product->action_amount) disabled @elseif(session()->get('gift_product_id') == $product->id) checked @endif name="product_gift_id" value="{{ $product->id }}"> <label for="{{ $product->id }}" class="radio-view"></label></span>
                                                </div>
                                            </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                @endif


                                <div class="bg-white flex flex-col sm:flex-row justify-between items-center">
                                    <div class="w-full sm:w-1/2">
                                        @include ('shop::products.view.cross-sells')
                                    </div>
                                    <div class="w-full sm: w-1/2">
                                        <div class="right-side w-full sm:max-w-md ml-0 sm:ml-auto">
                                            {!! view_render_event('bagisto.shop.checkout.cart.summary.after', ['cart' => $cart]) !!}

                                            @include('shop::checkout.total.summary', ['cart' => $cart])

                                            <coupon-component></coupon-component>

                                            {!! view_render_event('bagisto.shop.checkout.cart.summary.after', ['cart' => $cart]) !!}

                                            {!! view_render_event('bagisto.shop.checkout.cart.controls.after', ['cart' => $cart]) !!}

                                            <div class="misc-controls my-3">
                                                <a href="{{ route('shop.home.index') }}"
                                                   class="link font-serif font-medium text-base text-gold border-b border-transparent hover:border-b hover:border-gold">{{ __('shop::app.checkout.cart.continue-shopping') }}</a>

                                                <div class="flex flex-row justify-between items-center mt-8 normal-case text-sm sm:text-base">
                                                    <button type="submit" class="button-black w-full py-3">
                                                        {{ __('shop::app.checkout.cart.update-cart') }}
                                                    </button>

                                                    @if (! cart()->hasError())
                                                        <a href="{{ route('shop.checkout.onepage.index') }}"
                                                           class="button-decor w-full py-3 normal-case">
                                                            {{ __('shop::app.checkout.cart.proceed-to-checkout') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                            {!! view_render_event('bagisto.shop.checkout.cart.controls.after', ['cart' => $cart]) !!}


                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>


                @else


                    <div class="title w-full h-32 flex items-end text-center">
                        <span class="text-xl sm:text-5xl uppercase text-gray-dark mx-auto">{{ __('shop::app.checkout.cart.title') }}</span>
                    </div>

                    <div class="cart-content text-base sm:text-lg text-gray-dark uppercase">
                        <p>
                            {{ __('shop::app.checkout.cart.empty') }}
                        </p>

                        <p class="w-full text-center inline-block my-3">
                            <a style="display: inline-block;" href="{{ route('shop.home.index') }}"
                               class="link font-serif font-medium text-base text-gold hover:underline">{{ __('shop::app.checkout.cart.continue-shopping') }}</a>
                        </p>
                    </div>

                @endif
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    @include('shop::checkout.cart.coupon')

    <script>
        $(document).ready(function () {
            if (document.querySelector('input[name="product_gift_id"]')) {
                document.querySelectorAll('input[name="product_gift_id"]').forEach((elem) => {
                    elem.addEventListener("change", function(event) {
                        let id = event.target.value;
                        axios.post('{{ route('shop.checkout.cart.gift.change') }}', {
                            product_gift_id: id
                        })
                            .then(function (response) {
                                window.location.href = '{{ route('shop.checkout.cart.index') }}'
                                // console.log(response);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                    });
                });
            }

        });


        function removeLink(message) {
            if (!confirm(message))
                event.preventDefault();
        }

        function updateCartQunatity(operation, index) {
            var quantity = document.getElementById('cart-quantity' + index).value;

            if (operation == 'add') {
                quantity = parseInt(quantity) + 1;
            } else if (operation == 'remove') {
                if (quantity > 1) {
                    quantity = parseInt(quantity) - 1;
                } else {
                    alert('{{ __('shop::app.products.less-quantity') }}');
                }
            }
            document.getElementById('cart-quantity' + index).value = quantity;
            event.preventDefault();
        }

    </script>



@endpush