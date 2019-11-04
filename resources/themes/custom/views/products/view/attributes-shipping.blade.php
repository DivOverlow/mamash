@inject ('productViewHelper', 'Webkul\Product\Helpers\View')

{!! view_render_event('bagisto.shop.products.view.attributes-shipping.before', ['product' => $product]) !!}

@if ($customAttributeValues = $productViewHelper->getAdditionalData($product))
    <ul>
    @foreach ($customAttributeValues as $attribute)
            @if ($attribute['code'] == 'shipping_info')
                @foreach( explode(",", $attribute['value']) as $value )
                    <li class="checkmark block">{{ $value }}</li>
                @endforeach
            @endif
    @endforeach
    </ul>
@endif

{!! view_render_event('bagisto.shop.products.view.attributes-shipping.after', ['product' => $product]) !!}