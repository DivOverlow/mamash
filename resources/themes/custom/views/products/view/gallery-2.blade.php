@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@inject ('wishListHelper', 'Webkul\Customer\Helpers\Wishlist')

<?php $images = $productImageHelper->getGalleryImages($product); ?>

{!! view_render_event('bagisto.shop.products.view.gallery-2.before', ['product' => $product]) !!}

@if(count($images) > 1)

    <image-modal :showing="showImageModal2" :modal-transform="modalTransform2"  @close="showImageModal2 = false">
        <div slot="body">
        <div class="product-hero-image w-full h-screen flex items-center justify-center py-10">
            <img class="object-contain w-auto h-screen" src="{{ $images[1]['original_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>
        </div>
        </div>
    </image-modal>

    <div class="product-hero-image max-w-xl sm:ml-auto h-96 sm:h-132  flex items-center justify-center">
{{--        <img class="w-auto h-88 sm:h-96 object-scale-down" src="{{ $images[1]['large_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>--}}
        <img class="w-auto h-88 sm:h-96 object-scale-down cursor-pointer" src="{{ $images[1]['large_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"  @click="openImageModal2($event)"/>
    </div>
@endif
{!! view_render_event('bagisto.shop.products.view.gallery-2.after', ['product' => $product]) !!}

