
@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
@inject ('giftRepository', 'Webkul\Discount\Repositories\GiftRuleRepository')

<?php
    $gift_products = $giftRepository->getGiftsProduct();
    $product = null;
    $product_id = null;
    $evaluation = 0;
    foreach ($gift_products as $gift_product) {
        $evaluation = $gift_product->action_amount;
        if (isset($gift_product->related_products()->first()->product_id)) {
            $product_id = $gift_product->related_products()->first()->product_id;
            break;
        }
    }

    if ($product_id) {
        $product = $productRepository->find($product_id);
    }

    $evaluation = core()->convertPrice($evaluation) . ' ' . core()->currencySymbol(core()->getBaseCurrencyCode());
?>

@if ($product)
    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
    @inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')

    <?php  $productBaseImage = $productImageHelper->getProductBaseImage($product); ?>

        {!! DbView::make($templateRepository
                ->getTemplate('banner-gift'))
                ->field('html_content')
                ->with( ['product_url_key' => $product->url_key,'product_name' => $product->name, 'evaluation'=> $evaluation, 'large_image_url' => $productBaseImage['large_image_url']])
                ->render() !!}

@endif
