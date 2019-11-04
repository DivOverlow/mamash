{!! view_render_event('bagisto.shop.products.add_to_cart.before', ['product' => $product]) !!}

<button type="submit" class="btn btn-lg btn-primary addtocart button-decor text-base py-2 h-10 w-1/3" {{ ! $product->isSaleable() ? 'disabled' : '' }}>
    {{ __('shop::app.products.add-to-cart') }}
</button>

{!! view_render_event('bagisto.shop.products.add_to_cart.after', ['product' => $product]) !!}