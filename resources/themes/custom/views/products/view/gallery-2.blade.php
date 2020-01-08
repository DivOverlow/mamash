@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

<?php $images = $productImageHelper->getGalleryImages($product); ?>

{!! view_render_event('bagisto.shop.products.view.gallery-2.before', ['product' => $product]) !!}

@if(count($images) > 1)
    <div class="product-hero-image max-w-xl sm:ml-auto h-88 sm:h-96  flex items-center justify-center">
        <img class="w-full h-88 sm:h-96 object-scale-down" src="{{ $images[1]['large_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>
    </div>
@endif
{!! view_render_event('bagisto.shop.products.view.gallery-2.after', ['product' => $product]) !!}

