{!! view_render_event('bagisto.shop.products.list.gifts.before', ['product' => $product]) !!}

    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

    <?php $productBaseImage = $productImageHelper->getProductBaseImage($product); ?>

    <div class="w-full sm:w-1/2 product-information flex content-center flex-wrap h-112 sm:h-120">

        <div class="product-description font-serif text-gray-dark text-3xl sm:text-4xl text-center mx-auto px-6">
            {!! $product->short_description !!}
            <div class="mt-6"><a href="{{ url()->to('/').'/products/' . $product->url_key }}" class="button-black text-base px-6">{{ __('shop::app.banner.btn-title') }}</a></div>
        </div>

    </div>
    <div class="w-full sm:w-1/2 bg-cover" style="background-image: url('/themes/custom/assets/images/banner/bg_gift.jpg');">
        <a href="{{ route('shop.products.index', $product->url_key) }}" title="{{ $product->name }}" class="my-auto mx-auto">
            <img class="h-112 sm:h-120 w-full object-scale-down" src="{{ $productBaseImage['large_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>
        </a>
    </div>
{!! view_render_event('bagisto.shop.products.list.gifts.after', ['product' => $product]) !!}
