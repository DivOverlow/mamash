@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.sales.orders.view-title', ['order_id' => $order->increment_id]) }}
@stop

@section('content-wrapper')
    @inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
    @inject ('giftRepository', 'Webkul\Discount\Repositories\GiftRuleRepository')

    <?php
        $product_id = 0;
    ?>
    <div class="content full-page">
        <form method="POST" action="{{ route('admin.sales.orders.update', $order->increment_id) }}">
            <div class="page-header">

                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.sales.orders.view-title', ['order_id' => $order->increment_id]) }} - {{ trans('admin::app.sales.orders.products-ordered') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.sales.orders.save-btn-changes') }}
                    </button>

                </div>
            </div>

            <div class="page-content">
                <div class="sale-container">

                    <accordian :title="'{{ __('admin::app.sales.orders.order-and-account') }}'" :active="true">
                        <div slot="body">

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span>{{ __('admin::app.sales.orders.order-info') }}</span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.order-date') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->created_at }}
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.order-status') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->status_label }}
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.channel') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->channel_name }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span>{{ __('admin::app.sales.orders.account-info') }}</span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.customer-name') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->customer_full_name }}
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.email') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->customer_email }}
                                        </span>
                                    </div>

                                    @if (! is_null($order->customer))
                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.customers.customers.customer_group') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->customer->group['name'] }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </accordian>

                    <accordian :title="'{{ __('admin::app.sales.orders.address') }}'" :active="false">
                        <div slot="body">

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span>{{ __('admin::app.sales.orders.billing-address') }}</span>
                                </div>

                                <div class="section-content">

                                    @include ('admin::sales.address', ['address' => $order->billing_address])

                                </div>
                            </div>

                            @if ($order->shipping_address)
                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span>{{ __('admin::app.sales.orders.shipping-address') }}</span>
                                    </div>

                                    <div class="section-content">

                                        @include ('admin::sales.address', ['address' => $order->shipping_address])

                                    </div>
                                </div>
                            @endif

                        </div>
                    </accordian>

                    <accordian :title="'{{ __('admin::app.sales.orders.payment-and-shipping') }}'" :active="false">
                        <div slot="body">

                            <div class="sale-section">
                                <div class="secton-title">
                                    <span>{{ __('admin::app.sales.orders.payment-info') }}</span>
                                </div>

                                <div class="section-content">
                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.payment-method') }}
                                        </span>

                                        <span class="value">
                                            {{ core()->getConfigData('sales.paymentmethods.' . $order->payment->method . '.title') }}
                                        </span>
                                    </div>

                                    <div class="row">
                                        <span class="title">
                                            {{ __('admin::app.sales.orders.currency') }}
                                        </span>

                                        <span class="value">
                                            {{ $order->order_currency_code }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @if ($order->shipping_address)
                                <div class="sale-section">
                                    <div class="secton-title">
                                        <span>{{ __('admin::app.sales.orders.shipping-info') }}</span>
                                    </div>

                                    <div class="section-content">
                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.shipping-method') }}
                                            </span>

                                            <span class="value">
                                                {{ $order->shipping_title }}
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="title">
                                                {{ __('admin::app.sales.orders.shipping-price') }}
                                            </span>

                                            <span class="value">
                                                {{ core()->formatBasePrice($order->base_shipping_amount) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('admin::app.sales.orders.products-ordered') }}'" :active="true">
                        <div slot="body">

                            <div class="table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>{{ __('admin::app.sales.orders.SKU') }}</th>
                                            <th>{{ __('admin::app.sales.orders.product-name') }}</th>
                                            <th>{{ __('admin::app.sales.orders.price') }}</th>
                                            <th>{{ __('admin::app.sales.orders.item-status') }}</th>
                                            <th>{{ __('admin::app.sales.orders.subtotal') }}</th>
                                            <th>{{ __('admin::app.sales.orders.tax-percent') }}</th>
                                            <th>{{ __('admin::app.sales.orders.tax-amount') }}</th>
                                            @if ($order->base_discount_amount > 0)
                                                <th>{{ __('admin::app.sales.orders.discount-amount') }}</th>
                                            @endif
                                            <th>{{ __('admin::app.sales.orders.grand-total') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($order->items as $item)
                                            @if ($item->base_price > 0)
                                                <tr>
                                                <td>
                                                    {{ $item->getTypeInstance()->getOrderedItem($item)->sku }}
                                                </td>

                                                <td>
                                                    {{ $item->name }}

                                                    @if (isset($item->additional['attributes']))
                                                        <div class="item-options">

                                                            @foreach ($item->additional['attributes'] as $attribute)
                                                                <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                                            @endforeach

                                                        </div>
                                                    @endif
                                                </td>

                                                <td>{{ core()->formatBasePrice($item->base_price) }}</td>

                                                <td>
                                                    <span class="qty-row">
                                                        {{ $item->qty_ordered ? __('admin::app.sales.orders.item-ordered', ['qty_ordered' => $item->qty_ordered]) : '' }}
                                                    </span>

                                                    <span class="qty-row">
                                                        {{ $item->qty_invoiced ? __('admin::app.sales.orders.item-invoice', ['qty_invoiced' => $item->qty_invoiced]) : '' }}
                                                    </span>

                                                    <span class="qty-row">
                                                        {{ $item->qty_shipped ? __('admin::app.sales.orders.item-shipped', ['qty_shipped' => $item->qty_shipped]) : '' }}
                                                    </span>

                                                    <span class="qty-row">
                                                        {{ $item->qty_refunded ? __('admin::app.sales.orders.item-refunded', ['qty_refunded' => $item->qty_refunded]) : '' }}
                                                    </span>

                                                    <span class="qty-row">
                                                        {{ $item->qty_canceled ? __('admin::app.sales.orders.item-canceled', ['qty_canceled' => $item->qty_canceled]) : '' }}
                                                    </span>
                                                </td>

                                                <td>{{ core()->formatBasePrice($item->base_total) }}</td>

                                                <td>{{ $item->tax_percent }}%</td>

                                                <td>{{ core()->formatBasePrice($item->base_tax_amount) }}</td>

                                                @if ($order->base_discount_amount > 0)
                                                    <td>{{ core()->formatBasePrice($item->base_discount_amount) }}</td>
                                                @endif

                                                <td>{{ core()->formatBasePrice($item->base_total + $item->base_tax_amount - $item->base_discount_amount) }}</td>
                                            </tr>
                                            @else
                                                <?php $product_id = $item->product_id ?>
                                            @endif
                                        @endforeach
                                </table>
                            </div>
                            <table class="sale-summary">
                                <tr>
                                    <td>{{ __('admin::app.sales.orders.subtotal') }}</td>
                                    <td>-</td>
                                    <td>{{ core()->formatBasePrice($order->base_sub_total) }}</td>
                                </tr>

                                @if ($order->haveStockableItems())
                                    <tr>
                                        <td>{{ __('admin::app.sales.orders.shipping-handling') }}</td>
                                        <td>-</td>
                                        <td>{{ core()->formatBasePrice($order->base_shipping_amount) }}</td>
                                    </tr>
                                @endif

                                @if ($order->base_discount_amount > 0)
                                    <tr>
                                        <td>{{ __('admin::app.sales.orders.discount') }}</td>
                                        <td>-</td>
                                        <td>{{ core()->formatBasePrice($order->base_discount_amount) }}</td>
                                    </tr>
                                @endif

                                <tr class="border">
                                    <td>{{ __('admin::app.sales.orders.tax') }}</td>
                                    <td>-</td>
                                    <td>{{ core()->formatBasePrice($order->base_tax_amount) }}</td>
                                </tr>

                                <tr class="bold">
                                    <td>{{ __('admin::app.sales.orders.grand-total') }}</td>
                                    <td>-</td>
                                    <td>{{ core()->formatBasePrice($order->base_grand_total) }}</td>
                                </tr>

                                <tr class="bold">
                                    <td>{{ __('admin::app.sales.orders.total-paid') }}</td>
                                    <td>-</td>
                                    <td>{{ core()->formatBasePrice($order->base_grand_total_invoiced) }}</td>
                                </tr>

                                <tr class="bold">
                                    <td>{{ __('admin::app.sales.orders.total-refunded') }}</td>
                                    <td>-</td>
                                    <td>{{ core()->formatBasePrice($order->base_grand_total_refunded) }}</td>
                                </tr>

                                <tr class="bold">
                                    <td>{{ __('admin::app.sales.orders.total-due') }}</td>
                                    <td>-</td>
                                    <td>{{ core()->formatBasePrice($order->base_total_due) }}</td>
                                </tr>
                            </table>
                        <?php $gift_products = $giftRepository->getGiftsProduct(); ?>
                        @if (count($gift_products) > 0)

                            @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

                            <table class="sale-summary">
                                <tr class="bold">
                                    <td colspan="3">{{ __('admin::app.sales.orders.products-gifts') }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="radio"><input type="radio" id="0" name="product_id" value="0"> <label for="0" class="radio-view"
                                               @if ($product_id == 0) checked = "checked" @endif
                                            ></label></span>
                                    </td>
                                    <td colspan="2"><span class="{{ ($product_id == 0) ? 'bold' : '' }}"></span>{{ __('admin::app.sales.orders.not-gift') }}</td>
                                </tr>

                                @foreach($gift_products as $gift_product)
                                    @if(isset($gift_product->related_products()->first()->product_id))
                                        <?php $product = $productRepository->find($gift_product->related_products()->first()->product_id); ?>
                                        @if($product)
                                            @php
                                                $productBaseImage = $productImageHelper->getProductBaseImage($product);
                                            @endphp
                                            @if($product_id == $product->id)
                                            <tr class="border">
                                            @else
                                            <tr>
                                            @endif
                                                <td>
                                                    <span class="radio"><input type="radio" id="$product->id" name="product_id" value="$product->id"
                                                       @if ($product_id == $product->id) checked = "checked" @endif
                                                        > <label for="$product->id" class="radio-view"></label></span>
                                                </td>
                                                <td style="text-align: left;padding: 8px">
                                                    <a href="{{ url()->to('/').'/products/'.$product->url_key }}"><img
                                                                                    src="{{ $productBaseImage['small_image_url'] }}" style="width: 100%;height: 4rem;object-fit: contain"/></a>
                                                <td>
                                                    <a href="{{ url()->to('/').'/products/'.$product->url_key }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
{{--                                @if ($order->haveStockableItems())--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ __('admin::app.sales.orders.shipping-handling') }}</td>--}}
{{--                                        <td>-</td>--}}
{{--                                        <td>{{ core()->formatBasePrice($order->base_shipping_amount) }}</td>--}}
{{--                                    </tr>--}}
{{--                                @endif--}}

{{--                                @if ($order->base_discount_amount > 0)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ __('admin::app.sales.orders.discount') }}</td>--}}
{{--                                        <td>-</td>--}}
{{--                                        <td>{{ core()->formatBasePrice($order->base_discount_amount) }}</td>--}}
{{--                                    </tr>--}}
{{--                                @endif--}}

{{--                                <tr class="border">--}}
{{--                                    <td>{{ __('admin::app.sales.orders.tax') }}</td>--}}
{{--                                    <td>-</td>--}}
{{--                                    <td>{{ core()->formatBasePrice($order->base_tax_amount) }}</td>--}}
{{--                                </tr>--}}

{{--                                <tr class="bold">--}}
{{--                                    <td>{{ __('admin::app.sales.orders.grand-total') }}</td>--}}
{{--                                    <td>-</td>--}}
{{--                                    <td>{{ core()->formatBasePrice($order->base_grand_total) }}</td>--}}
{{--                                </tr>--}}

{{--                                <tr class="bold">--}}
{{--                                    <td>{{ __('admin::app.sales.orders.total-paid') }}</td>--}}
{{--                                    <td>-</td>--}}
{{--                                    <td>{{ core()->formatBasePrice($order->base_grand_total_invoiced) }}</td>--}}
{{--                                </tr>--}}

{{--                                <tr class="bold">--}}
{{--                                    <td>{{ __('admin::app.sales.orders.total-refunded') }}</td>--}}
{{--                                    <td>-</td>--}}
{{--                                    <td>{{ core()->formatBasePrice($order->base_grand_total_refunded) }}</td>--}}
{{--                                </tr>--}}

{{--                                <tr class="bold">--}}
{{--                                    <td>{{ __('admin::app.sales.orders.total-due') }}</td>--}}
{{--                                    <td>-</td>--}}
{{--                                    <td>{{ core()->formatBasePrice($order->base_total_due) }}</td>--}}
{{--                                </tr>--}}
                            </table>
                        @endif

                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
@stop