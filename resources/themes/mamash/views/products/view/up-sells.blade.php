{!! view_render_event('bagisto.shop.products.view.up-sells.after', ['product' => $product]) !!}

<?php
    $productUpSells = $product->up_sells()->get();
?>

@if ($productUpSells->count())
    <div class="attached-products-wrapper main-container-wrapper">

        <div class="title text-lg sm:text-2xl text-gray-dark text-center uppercase my-6">
            {{ __('shop::app.products.up-sell-title') }}
            <span class="border-bottom"></span>
        </div>

        <div class="lg:max-w-md w-full lg:w-1/3 pl-0 sm:pl-6 pb-0 sm:pb-6">

            @foreach ($productUpSells as $up_sell_product)

                @include ('shop::products.list.card', ['product' => $up_sell_product])

            @endforeach

        </div>

    </div>
@endif

{!! view_render_event('bagisto.shop.products.view.up-sells.after', ['product' => $product]) !!}