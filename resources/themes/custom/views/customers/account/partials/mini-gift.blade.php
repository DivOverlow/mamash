@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
<?php
$products = $productRepository->getAll(4)->random(1);
?>
@if (count($products))
    @foreach ($products as $product)
        <div class="w-full sm:w-1/2 flex flex-col-reverse justify-content-between items-center my-8">
            @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

            <?php $productBaseImage = $productImageHelper->getProductBaseImage($product); ?>

            <div class="w-full product-information flex content-center flex-wrap h-64">

                <div class="product-description font-serif text-gray-dark text-lg text-center mx-auto">
                    {!! $product->short_description !!}
                    <div class="mt-6"><a href="{{ url()->to('/').'/products/' . $product->url_key }}" class="button-black text-sm px-6">{{ __('shop::app.banner.btn-title') }}</a></div>
                </div>

            </div>
            <div class="w-full bg-cover" style="background-image: url('/themes/custom/assets/images/banner/bg_gift.jpg');">
                <a href="{{ route('shop.products.index', $product->url_key) }}" title="{{ $product->name }}" class="my-auto mx-auto">
                    <img class="h-64 w-full object-scale-down" src="{{ $productBaseImage['large_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>
                </a>
            </div>
        </div>
    @endforeach
@endif