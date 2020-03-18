<?php
    $relatedProducts = $product->related_products()->get();
?>

@if ($relatedProducts->count())
    <div class="attached-products-wrapper mb-6">

        <div class="title text-black text-4xl sm:text-5xl text-center uppercase my-10">
            {{ __('shop::app.products.related-product-title') }}
            <span class="border-bottom text-orange-orange">{{ __('shop::app.products.related-product-bottom') }}</span>
        </div>

        <div class="product-grid-4">
            <template>
                <hooper :settings="hooperSettings" style="height: 735px">
                    @foreach ($relatedProducts as $related_product)
                        <slide>
                            @include ('shop::products.list.card', ['product' => $related_product])
                        </slide>
                    @endforeach

                    <hooper-navigation slot="hooper-addons"></hooper-navigation>
                    <hooper-pagination slot="hooper-addons"></hooper-pagination>
                </hooper>
            </template>
        </div>

    </div>
@endif