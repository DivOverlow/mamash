{!! view_render_event('bagisto.shop.products.list.gifts.before', ['product' => $product, 'evaluation' => $evaluation, 'class' => $class]) !!}
    @inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')
    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

    <?php $productBaseImage = $productImageHelper->getProductBaseImage($product);
        $evaluation = core()->convertPrice($evaluation) . ' ' . core()->currencySymbol(core()->getBaseCurrencyCode());
    ?>


{!! DbView::make($templateRepository
        ->getTemplate('gift-product-category'))
        ->field('html_content')
        ->with( ['product_url_key' => $product->url_key,'product_name' => $product->name, 'evaluation'=> $evaluation, 'medium_image_url' => $productBaseImage['medium_image_url'], 'class' => $class])
        ->render() !!}


{!! view_render_event('bagisto.shop.products.list.gifts.after', ['product' => $product, 'evaluation' => $evaluation, 'class' => $class]) !!}
