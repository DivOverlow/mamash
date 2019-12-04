
@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')

<?php
    $products = $productRepository->getAll(4)->random(1);
?>

@if (count($products))
    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
    @inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')
    @inject ('productViewHelper', 'Webkul\Product\Helpers\View')

    <?php $evaluation = 0; ?>
    @foreach ($products as $product)
        <?php  $productBaseImage = $productImageHelper->getProductBaseImage($product); ?>
        @if ($customAttributeValues = $productViewHelper->getAdditionalData($product, 0))
            @foreach ($customAttributeValues as $attribute)
                <?php
                    if($attribute['code'] == 'gift_rules') {
                           $evaluation = $attribute['value'];
                    }
                ?>
            @endforeach
        @endif


            {!! DbView::make($templateRepository
                    ->getTemplate('banner-gift'))
                    ->field('html_content')
                    ->with( ['product_url_key' => $product->url_key,'product_name' => $product->name, 'evaluation'=> $evaluation, 'large_image_url' => $productBaseImage['large_image_url']])
                    ->render() !!}

    @endforeach
@endif
