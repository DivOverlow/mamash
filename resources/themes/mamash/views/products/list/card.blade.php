{!! view_render_event('bagisto.shop.products.list.card.before', ['product' => $product]) !!}

<div class="product-card max-w-md bg-orange-light border border-orange px-4 py-3 relative">

    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
    @inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')

    <?php $productBaseImage = $productImageHelper->getProductBaseImage($product);
    $categoryCollection = null;
    $product_categories = $productRepository->find($product->id);

    if($product_categories) {
        foreach ($product_categories->categories as $category) {
            if ($category->display_mode == "collections_only") {
                    $categoryCollection = $category;
                break;
            }
        }
    }

    ?>




@if ($product->new)
        <div class="sticker new">
            {{ __('shop::app.products.new') }}
        </div>
    @endif

    <div class="product-information">
        <div class="text-base text-center text-gray-dark my-1 hover:text-gray-silver">
        @if ($categoryCollection)
                <a href="{{ route('shop.categories.index', $categoryCollection->slug) }}" title="{{ $categoryCollection->name }}">
                    {{ $categoryCollection->name }} </a>
            @endif
        </div>

        <div class="product-name cursor-pointer text-gray-dark uppercase text-xl text-center mb-2 leading-tight">
            <a href="{{ url()->to('/').'/products/' . $product->url_key }}" title="{{ $product->name }}">
                <span>
                    {{ $product->name }}
                </span>
            </a>
        </div>

        @include ('shop::products.price', ['product' => $product])

        @include('shop::products.add-buttons', ['product' => $product])
    </div>

    <div class="product-image flex justify-center items-center px-10">
        <a href="{{ route('shop.products.index', $product->url_key) }}" title="{{ $product->name }}" class="my-auto mx-auto">
            <img class="w-full object-scale-down" src="{{ $productBaseImage['medium_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>
        </a>
    </div>


</div>

{!! view_render_event('bagisto.shop.products.list.card.after', ['product' => $product]) !!}