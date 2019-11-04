
@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
<?php
    $products = $productRepository->getAll(4)->random(1);
?>

@if (count($products))
    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

    @foreach ($products as $product)
    <?php $productBaseImage = $productImageHelper->getProductBaseImage($product); ?>
    <section class="banner-container">
        <div class="my-16 bg-no-repeat bg-right-top bg-white"
             style="background-image: url('/themes/custom/assets/images/banner/blooper.png');">
            <div class="main-container-wrapper flex flex-col-reverse sm:flex-row justify-between items-center">
                <div class="left-banner w-full bg-cover" style="background-image: url('/themes/custom/assets/images/banner/bg_gift.jpg');">
                    <a href="{{ route('shop.products.index', $product->url_key) }}" title="{{ $product->name }}" class="my-auto mx-auto">
                        <img class="h-112 w-full object-scale-down" src="{{ $productBaseImage['large_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>
                    </a>
                </div>
                <div class="right-banner w-full h-112 px-0 sm:px-6">
                    <div class="banner-content text-3xl sm:text-4xl w-full flex flex-col justify-center items-center h-112 mx-auto px-6">
                        {!! $product->short_description !!}
                        <div class="mt-6"><a href="{{ url()->to('/').'/products/' . $product->url_key }}" class="button-black text-base">{{ __('shop::app.banner.btn-title') }}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- end section banner container -->
    @endforeach
@endif

