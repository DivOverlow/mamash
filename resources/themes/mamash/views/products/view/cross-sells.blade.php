@foreach ($cart->items as $item)
    <?php
        $product = $item->product;

        if ($product->cross_sells()->count()) {
            $products[] = $product;
            $products = array_unique($products);
        }
    ?>
@endforeach

@if (isset($products))

    <div class="attached-products-wrapper mt-10">

        <div class="title text-lg sm:text-2xl text-gray-dark text-center uppercase mb-3">
            {{ __('shop::app.products.cross-sell-title') }}
             <span class="border-bottom"></span>
        </div>

        <div class="product-grid-4">
            @foreach($products as $product)

                @foreach ($product->cross_sells()->paginate(2) as $cross_sell_product)

                    @include ('shop::products.list.card', ['product' => $cross_sell_product])

                @endforeach

            @endforeach

        </div>

    </div>

@endif