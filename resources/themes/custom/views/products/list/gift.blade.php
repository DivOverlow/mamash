{!! view_render_event('bagisto.shop.products.list.gifts.before', ['product' => $product, 'evaluation' => $evaluation]) !!}
    @inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')
    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

    <?php $productBaseImage = $productImageHelper->getProductBaseImage($product); ?>


{!! DbView::make($templateRepository
        ->getTemplate('gift-product-category'))
        ->field('html_content')
        ->with( ['product_url_key' => $product->url_key,'product_name' => $product->name, 'evaluation'=> number_format($evaluation, 2), 'large_image_url' => $productBaseImage['large_image_url']])
        ->render() !!}


{!! view_render_event('bagisto.shop.products.list.gifts.after', ['product' => $product, 'evaluation' => $evaluation]) !!}
