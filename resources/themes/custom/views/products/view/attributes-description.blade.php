@inject ('productViewHelper', 'Webkul\Product\Helpers\View')

{!! view_render_event('bagisto.shop.products.view.attributes-shipping.before', ['product' => $product]) !!}

<?php
    $customAttributeValues = $productViewHelper->getAdditionalData($product);
?>
<section id="product-description" class="product-description">
    <div class="w-full max-w-sm sm:max-w-4xl text-center mx-auto">
        <tabs>
            <tab name="{{ __('shop::app.products.description') }}" :selected="true">
                {!! $product->description !!}
            </tab>
            @foreach ($customAttributeValues as $attribute)
                @if ($attribute['code'] == 'ingredients')
                    <tab name="{{ $attribute['label'] }}">
                        {{ $attribute['value'] }}
                    </tab>
                @endif
                @if ($attribute['code'] == 'how_use')
                    <tab name="{{ $attribute['label'] }}">
                        {{ $attribute['value'] }}
                    </tab>
                @endif
            @endforeach
        </tabs>
    </div>
</section>

{!! view_render_event('bagisto.shop.products.view.attributes-description.after', ['product' => $product]) !!}