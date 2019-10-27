
    @if ($product->type == "configurable")
        <div class="cart-wish-wrap text-center">
            <a href="{{ route('cart.add.configurable', $product->url_key) }}" class="btn btn-lg btn-primary addtocart button-decor">
                {{ __('shop::app.products.add-to-cart') }}
            </a>

            @include('shop::products.wishlist')
        </div>
    @else
        <div class="cart-wish-wrap text-center my-4">
            <form action="{{ route('cart.add', $product->product_id) }}" method="POST">
                @csrf
                <input type="hidden" name="product" value="{{ $product->product_id }}">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" value="false" name="is_configurable">
                <button class="btn btn-lg btn-primary addtocart button-decor text-base py-2 h-10 w-1/2" {{ $product->haveSufficientQuantity(1) ? '' : 'disabled' }}>{{ __('shop::app.products.add-to-cart') }}</button>
            </form>

            @include('shop::products.wishlist')
        </div>
    @endif