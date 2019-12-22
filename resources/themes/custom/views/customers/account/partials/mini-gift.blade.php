
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

?>

<div class="w-full sm:w-1/2 my-6">
    @include ('shop::products.list.gift', ['product' => $product, 'evaluation' => $evaluation, 'class' => 'mini' ])
</div>
