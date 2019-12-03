@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
@inject ('categoryRepository', 'Webkul\Category\Repositories\CategoryRepository')


<?php $cart = cart()->getCart(); ?>

@if ($cart)
    <?php $items = $cart->items; ?>

    <div class="dropdown-toggle flex relative w-12 inline-block">
        <a class="cart-link z-10 w-full" href="{{ route('shop.checkout.cart.index') }}" title="{{ __('shop::app.header.cart') }}">
            <span class="cart-icon"></span>
        </a>

        <span class="name top-0 right-0 inline-block absolute -mt-1 mr-2">
{{--            {{ __('shop::app.header.cart') }}--}}
            <span
                class="count align-top bg-chocolate text-xs text-white rounded-full h-6 w-6 flex items-center justify-center"> {{ $cart->items->count() }}</span>
        </span>

{{--        <i class="icon arrow-down-icon"></i>--}}
    </div>

    <div class="dropdown-list z-50 absolute right-0 max-w-md w-full" style="display: none;">
        <div class="dropdown-container bg-white">
            <div class="dropdown-cart">
                <div class="dropdown-header bg-gray-snow h-24 flex content-center flex-wrap">
                    <p class="heading w-full font-medium text-center text-gray-dark text-xl uppercase">
                        {{ __('shop::app.checkout.cart.title') }}
                    </p>
                    <span class="absolute top-0 bottom-0 left-0 px-4 py-3"> <i class="icon remove-icon"></i></span>
                </div>

                <div class="dropdown-content my-3">
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

                <div class="dropdown-footer">
                    <div class="bg-gray-snow font-medium text-gray-dark h-16 flex content-center flex-wrap">
                        <div class="w-2/3 text-center uppercase">
                            {{ __('shop::app.checkout.cart.cart-subtotal') }}:
                        </div>
                        <div class="w-1/3 text-center">
                            {!! view_render_event('bagisto.shop.checkout.cart-mini.subtotal.before', ['cart' => $cart]) !!}

                           {{ core()->currency($cart->base_sub_total) }}

                            {!! view_render_event('bagisto.shop.checkout.cart-mini.subtotal.after', ['cart' => $cart]) !!}
                        </div>
                    </div>
                    <div class="flex flex-row justify-content-between items-center">
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
        </div>
    </div>

@else

    <div class="dropdown-toggle ml-6">
        <div style="display: inline-block; cursor: pointer;">
            <span class="cart-icon"></span>
            {{--            <span class="name">{{ __('shop::app.minicart.cart') }}<span class="count"> ({{ __('shop::app.minicart.zero') }}) </span></span>--}}
        </div>
    </div>
@endif