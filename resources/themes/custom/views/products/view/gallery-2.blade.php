@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

<?php $images = $productImageHelper->getGalleryImages($product); ?>

{!! view_render_event('bagisto.shop.products.view.gallery-2.before', ['product' => $product]) !!}
@if(count($images) > 1)
    <div class="product-hero-image max-w-sm sm:max-w-full">
        <img class="w-full mx-auto h-auto sm:h-132 object-scale-down" src="{{ $images[1]['large_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>
    </div>
@endif
{!! view_render_event('bagisto.shop.products.view.gallery-2.after', ['product' => $product]) !!}

