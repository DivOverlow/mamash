@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
@inject ('categoryRepository', 'Webkul\Category\Repositories\CategoryRepository')
@inject ('giftRepository', 'Webkul\Discount\Repositories\GiftRuleRepository')

<?php $cart = cart()->getCart();?>

@if ($cart)
    <?php $items = $cart->items;
        if(count($items) > 0 && !session()->has('gift_product_id')) {
            $gift_products = app('Webkul\Discount\Repositories\GiftRuleRepository')->getGiftsProduct();
            $gifts = [];
            foreach ($gift_products as $gift_product) {
                if( $cart->base_sub_total < $gift_product->action_amount) {
                    break;
                }

                if(isset($gift_product->related_products()->first()->product_id)) {
                    $gifts[] = $gift_product->related_products()->first()->product_id;
                }
            }
            if (count($gifts) > 0) {
                session()->put('gift_product_id', end($gifts));
            }
        }
    ?>

    <div class="dropdown-toggle flex relative w-12 inline-block" @click="showCardModal = true">
        <a class="cart-link z-10 w-full" href="{{ route('shop.checkout.cart.index') }}" title="{{ __('shop::app.header.cart') }}">
            <span class="cart-icon"></span>
        </a>

        <span class="name top-0 right-0 inline-block absolute -mt-1 mr-2">
{{--            {{ __('shop::app.header.cart') }}--}}
            <span
                class="count align-top bg-chocolate text-xs text-white rounded-full h-6 w-6 flex items-center justify-center">{{ intval($cart->items_qty) }}</span>
        </span>

        {{--        <i class="icon arrow-down-icon"></i>--}}
    </div>

    <?php
        $showCardModal = false;
        if (session()->has('showCardModal')) {
            $showCardModal = true;
            session()->forget('showCardModal');
        }
    ?>
    <card-modal :showing="showCardModal"     @close="showCardModal = false">
        <div slot="header" class="dropdown-header bg-gray-snow h-20 flex content-center flex-wrap"> <p class="heading w-full font-medium text-center text-gray-dark text-xl uppercase">
                {{ __('shop::app.checkout.cart.title') }}
            </p>
        </div>
        <div slot="body">
            <div class="cart-content my-3">
                @foreach ($items as $item)
                    <div class="item w-full flex flex-row items-center px-3 py-2 inline-block">
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

            <div class="cart-footer absolute inset-x-0 bottom-0">
                <div class="w-full my-3">
                    <?php $gift_products = $giftRepository->getGiftsProduct(); ?>

                    @if (count($gift_products))
                        @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
                        <div class="gift-content my-3 pr-3">
                            @if (session()->has('gift_product_id'))
                                @foreach($gift_products as $gift_product)

                                    @if(isset($gift_product->related_products()->first()->product_id))
                                        <?php
                                        $product = $productRepository->find($gift_product->related_products()->first()->product_id);
                                        $productBaseImage = $productImageHelper->getProductBaseImage($product);
                                        ?>

                                        @if (session()->get('gift_product_id') == $product->product_id)
                                            <div class="w-full flex flex-row items-center justify-between text-left py-2 border-t-2 border-orange-500 rounded-b shadow-md">
                                                <div class="item-image h-28 w-1/3 flex items-center justify-center">
                                                    <a href="{{ url()->to('/').'/products/'.$product->url_key }}"><img  class="object-scale-down h-24 w-auto"
                                                                                                                        src="{{ $productBaseImage['small_image_url'] }}"/></a>
                                                </div>
                                                <div class="item-title flex flex-col items-start justify-around h-28">
                                                    <div class="w-4/5 ml-auto tracking-widest text-gold">{{ __('shop::app.checkout.gift.title') }}</div>
                                                    <div class="text-base text-gray-dark uppercase hover:text-gray-cloud">
                                                        <a href="{{ url()->to('/').'/products/'.$product->url_key }}">
                                                            {{ $product->name }} </a>
                                                    </div>
                                                    <div class="font-serif font-medium text-base text-gray-cloud">
                                                        {{  __('shop::app.checkout.gift.free') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @else
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
                                    @endif
                                @endforeach
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
                <div class="bg-gray-snow w-full font-medium text-gray-dark h-12 flex content-center flex-wrap">
                    <div class="w-2/3 text-center uppercase">
                        {{ __('shop::app.checkout.cart.cart-subtotal') }}:
                    </div>
                    <div class="w-1/3 text-center">
                        {!! view_render_event('bagisto.shop.checkout.cart-mini.subtotal.before', ['cart' => $cart]) !!}

                        {{ core()->currency($cart->base_sub_total) }}

                        {!! view_render_event('bagisto.shop.checkout.cart-mini.subtotal.after', ['cart' => $cart]) !!}
                    </div>
                </div>
                <div class="w-full flex flex-row items-center text-sm sm:text-base">
                        <span class="button-black w-full py-3 normal-case">
{{--                            <a href="{{ route('shop.checkout.cart.index') }}">{{ __('shop::app.checkout.cart.continue-shopping') }}</a>--}}
                            <a href="{{ route('shop.checkout.cart.index') }}">{{ __('shop::app.minicart.view-cart') }}</a>
                        </span>
                    <span class="button-decor w-full py-3 normal-case">
{{--                            <a href="{{ route('shop.checkout.cart.index') }}">{{ __('shop::app.minicart.view-cart') }}</a>--}}
                            <a  href="{{ route('shop.checkout.onepage.index') }}">{{ __('shop::app.minicart.checkout') }}</a>
                        </span>
                </div>
            </div>

        </div>
    </card-modal>
@else

    <div class="dropdown-toggle ml-6">
        <div style="display: inline-block; cursor: pointer;">
            <span class="cart-icon"></span>
            {{--            <span class="name">{{ __('shop::app.minicart.cart') }}<span class="count"> ({{ __('shop::app.minicart.zero') }}) </span></span>--}}
        </div>
    </div>
@endif