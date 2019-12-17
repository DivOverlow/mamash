
@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
@inject ('giftRepository', 'Webkul\Discount\Repositories\GiftRuleRepository')

<?php
    $gift_products = $giftRepository->getGiftsProduct();
    $product = null;
    $product_id = null;
    $evaluation = 0;

    $cart = cart()->getCart();
    if ($cart) {
        $last_gift = null;
        foreach ($gift_products as $gift_product)
        {
            $last_gift = $gift_product;
            if($gift_product->action_amount > $cart->base_sub_total) {
                $evaluation = $gift_product->action_amount - $cart->base_sub_total;
                $product_id = $gift_product->related_products()->first()->product_id;
                break;
            }
        }

        if (!$product_id && $last_gift) {
            $product_id = $last_gift->related_products()->first()->product_id;
        }
    } else {
        foreach ($gift_products as $gift_product) {
            $evaluation = $gift_product->action_amount;
            $product_id = $gift_product->related_products()->first()->product_id;
            break;
        }
    }

    if ($product_id) {
        $product = $productRepository->find($product_id);
    }

    $evaluation = number_format($evaluation, 2);
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
