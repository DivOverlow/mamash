@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')

@component('shop::emails.layouts.master')

@section('extra-css')
    <style>
        ul, li {
            list-style: none !important;
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
        }
        a {
            text-decoration: none;
        }
        .container {
            background-color: #fff;
            padding: 30px;
        }
        .section-footer {
            background-color: #2f2f2f;
            display: flex;
            height: 688px;
            padding: 0 20px;
        }
        .top-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            letter-spacing: 0.025em;
            height: 50px;
            width: 100%;
            background-color: #212121;
        }

        .top-nav ul {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        .top-nav ul li {
            display: flex;
            font-size: .875rem;
            font-weight: 400;
            text-transform: uppercase;
        }

        .top-nav ul li::after {
            content: ' |';
            color: #fff;
            margin-left: 22px;
        }

        .top-nav ul li:last-child::after {
            margin-left: 0;
            content: '';
        }

        .top-nav a {
            color: #fff;
        }

        .top-nav a:hover {
            color: #dfa46d;
        }

        .user-icon {
            width: 27px;
            height: 27px;
            display: inline-block;
            background-image: url(../themes/custom/assets/images/user.png);
            background-position: top center;
            background-repeat: no-repeat;
        }

        .user-icon:hover,
        .user-icon:focus,
        .user-icon.active,
        {
            background-position-y: -31px;
        }

        /*@media only screen and (max-width: 768px) {*/
        @media only screen and (max-width : 480px) {
            .container {
                padding: 30px 0;
            }

            .top-nav {
                flex-direction: column;
            }

            .top-nav ul li {
                font-size: .75rem;
            }

            .top-nav ul li::after {
                content: ' |';
                color: #fff;
                margin: 0 2px;
            }
        }
    </style>
@endsection

<div style="background-color: #282828; width: 100%">
    <div style="width: 100%;max-width: 600px;margin:auto;">
        <div style="height: 170px;background-color: #212121;padding: 0 30px;">
            <div style="height: 120px;display: flex;align-items: center;justify-content: center;">
                <a href="{{ config('app.url') }}">
                    @include ('shop::emails.layouts.logo')
                </a>
            </div>

            <div class="top-nav">
                <ul>
                    <li>
                        <a href="{{ route('shop.categories.index', 'products') }}">{{ __('shop::app.mail.order.menu.products') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('shop.categories.index', 'collections') }}">{{ __('shop::app.mail.order.menu.collections') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('shop.categories.index', 'gifts') }}">{{ __('shop::app.mail.order.menu.gifts') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('shop.cms.page', 'about-us') }}">{{ __('shop::app.mail.order.menu.about-us') }}</a>
                    </li>
                    <li><a href="{{ route('customer.session.index') }}"><span class="user-icon mr-1"></span></a></li>
                </ul>
            </div> <!-- end top-nav -->
        </div>

        <div class="container">
            <div style="background-color: #fff; color: #242424;">
                <div
                    style="text-transform: uppercase;display: flex;justify-content: center;align-items: center;height: 120px;font-weight: bold;font-size: 1.875rem;line-height: 30px;margin-bottom: 30px;background-color: #e8e8e8;">
                    {{ __('shop::app.mail.order.new-heading') }}
                </div>

                <div class="section-content">
                    <div class="table mb-20">
                        <table style="overflow-x: auto; border-collapse: collapse;
                border-spacing: 0;width: 100%">
                            <tbody>
                            @foreach ($order->items as $item)
                                <?php
                                if ($item->type == "configurable")
                                    $images = $productImageHelper->getProductBaseImage($item->child->product);
                                else
                                    $images = $productImageHelper->getProductBaseImage($item->product);

                                $categoryCollection = null;
                                $categoriesForProduct = $productRepository->find($item->product->id);
                                if ($categoriesForProduct) {
                                    foreach ($categoriesForProduct->categories()->get() as $categoryProduct) {
                                        if ($categoryProduct->display_mode == "products_collection") {
                                            $categoryCollection = $categoryRepository->findOrFail($categoryProduct->id);
                                            break;
                                        }
                                    }
                                }
                                ?>

                                <tr>
                                    @if ($item->price > 0)
                                        <td style="text-align: left;padding: 8px"><img
                                                src="{{ $images['small_image_url'] }}"/></td>
                                        <td data-value="{{ __('shop::app.customer.account.order.view.product-name') }}"
                                            style="display: flex;flex-direction: column;text-align: left;">
                                            @if ($categoryCollection)
                                                <div style="padding: 8px;color: #969696;font-weight: 400;">
                                                    <a href="{{ route('shop.categories.index', $categoryCollection->slug) }}"
                                                       title="{{ $categoryCollection->name }}">
                                                        {{ $categoryCollection->name }} </a>
                                                </div>
                                            @endif

                                            <span
                                                style="font-size: 1rem;font-weight: bold;text-transform: uppercase;padding: 8px;">{{ $item->name }}</span>

                                            @if (isset($item->additional['attributes']))
                                                <div class="item-options">

                                                    @foreach ($item->additional['attributes'] as $attribute)
                                                        <b>{{ $attribute['attribute_name'] }}
                                                            : </b>{{ $attribute['option_label'] }}</br>
                                                    @endforeach

                                                </div>
                                            @endif
                                            <div
                                                style="display: inline-block;text-align: left;padding: 8px;color: #969696;font-weight: 400;">
                                                {{ __('shop::app.customer.account.order.view.qty') }}
                                                : {{ $item->qty_ordered }}
                                            </div>
                                        </td>

                                        <td data-value="{{ __('shop::app.customer.account.order.view.price') }}"
                                            style="font-size: 1rem;font-weight: bold;text-align: right;padding: 8px">{{ core()->formatPrice($item->price, $order->order_currency_code) }}
                                        </td>

                                    @else
                                        <td></td>
                                        <td colspan="2" style="display:flex;text-align: left;padding: 8px"><img
                                                src="{{ $images['small_image_url'] }}"/>
                                            <div
                                                style="display:flex;flex-direction: column;height: 100px;justify-content: center;align-content: center;flex-wrap: wrap;text-align: left;padding: 8px;">
                                                {{ $item->name }}
                                                <span
                                                    style="color: #969696;font-weight: 500 !important;">{{ __('shop::app.customer.account.order.view.gift') }}</span>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="font-weight: 500;display: flex;align-content: space-around;flex-wrap: wrap;height: 120px;padding: 0 60px;margin: 30px 0;background-color: #e8e8e8;">
                    <div style="display: block; width:100%">
                        <span  style="text-align: left;padding: 4px;color: #969696;">{{ __('shop::app.mail.order.shipping-handling') }}&nbsp;{{ $order->shipping_title }}</span>
                        <span style="float: right;font-weight: bold;">
                                    {{ core()->formatPrice($order->shipping_amount, $order->order_currency_code) }}
                        </span>
                    </div>
                    @if ($order->tax_amount > 0)
                        <div style="display: block; width:100%">
                            <span style="text-align: left;padding: 4px;color: #969696;">{{ __('shop::app.mail.order.tax') }}</span>
                            <span style="float: right;font-weight: bold;">
                                 {{ core()->formatPrice($order->tax_amount, $order->order_currency_code) }}
                            </span>
                        </div>
                    @endif
                    @if ($order->discount_amount > 0)
                        <div style="display: block; width:100%">
                            <span style="text-align: left;padding: 4px;color: #969696;">{{ __('shop::app.mail.order.discount') }}</span>
                            <span style="float: right;font-weight: bold;">
                                {{ core()->formatPrice($order->discount_amount, $order->order_currency_code) }}
                            </span>
                        </div>
                    @endif

                    <div style="font-weight: bold; text-transform: uppercase; width: 100%;">
                        <span  style="text-align: left;padding: 4px;">{{ __('shop::app.mail.order.grand-total') }}</span>
                        <span style="float: right;">
                        {{ core()->formatPrice($order->grand_total, $order->order_currency_code) }}
                        </span>
                    </div>

                </div>

                <div style="display: flex;align-items: center;display:inline-block; margin-bottom: 40px">
                    <div class="decorator shipping" style="width: 2rem;"></div>
                    <span style="font-weight: bold;font-size: 1.5rem;text-transform: uppercase;padding-left: 1rem;">{{ __('shop::app.mail.order.shipping-handling') }}</span>
                </div>
                <div style="font-size: 1.125rem;letter-spacing: 0.05em;font-weight: 500;text-transform: uppercase;color: #969696;margin-bottom: 15px;">
                    {{ $order->shipping_title }}
                </div>
                <div style="display: inline-block; font-size: 1.25rem;font-weight: bold;">
                    {{ $order->shipping_address->city }}, {{ $order->shipping_address->address1 }}
                </div>




{{--                <div style="margin-top: 65px;font-size: 16px;color: #5E5E5E;line-height: 24px;display: inline-block">--}}
{{--                    <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">--}}
{{--                        {{ __('shop::app.mail.order.final-summary') }}--}}
{{--                    </p>--}}

{{--                    <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">--}}
{{--                        {!!--}}
{{--                            __('shop::app.mail.order.help', [--}}
{{--                                'support_email' => '<a style="color:#0041FF" href="mailto:' . config('mail.from.address') . '">' . config('mail.from.address'). '</a>'--}}
{{--                                ])--}}
{{--                        !!}--}}
{{--                    </p>--}}

{{--                    <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">--}}
{{--                        {{ __('shop::app.mail.order.thanks') }}--}}
{{--                    </p>--}}
{{--                </div>--}}
            </div>
        </div>

        <div class="section-footer">
            <div style="display: flex;align-items: center;width: 100%;border-bottom: solid 1px #727272;height: 160px;">
                <ul style="display: flex;justify-content: space-around;width: 90%;">
                    <li><a href="#" target="_blank" rel="noopener noreferrer">
                            <svg width="40" height="40" fill="#979797" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 24 24">
                                <path
                                    d="M21,3H3v18h9.621v-6.961h-2.343v-2.725h2.343V9.309c0-2.324,1.421-3.591,3.495-3.591c0.699-0.002,1.397,0.034,2.092,0.105 v2.43h-1.428c-1.13,0-1.35,0.534-1.35,1.322v1.735h2.7l-0.351,2.725h-2.365V21H21V3z"></path>
                            </svg>
                        </a></li>
                    <li><a href="#" target="_blank" rel="noopener noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                                 fill="none" stroke="#979797" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-instagram">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"></line>
                            </svg>
                        </a></li>
                    <li><a href="https://youtube.com" target="_blank" rel="noopener noreferrer">
                            <svg width="40" height="40" viewBox="0 0 26 20" fill="#979797"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M25.457 3.13c-.3-1.232-1.18-2.203-2.299-2.532C21.13 0 13 0 13 0S4.87 0 2.842.598c-1.119.33-2 1.3-2.299 2.531C0 5.362 0 10.02 0 10.02s0 4.658.543 6.891c.3 1.232 1.18 2.162 2.299 2.49C4.87 20 13 20 13 20s8.13 0 10.158-.598c1.119-.33 2-1.26 2.299-2.49C26 14.677 26 10.02 26 10.02s0-4.658-.543-6.89zM10.34 14.25V5.79l6.795 4.23-6.795 4.23z"
                                    fill-rule="nonzero"></path>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

{{--            <div style="display: flex;align-items: center;width: 100%;border-bottom: solid 1px #727272;padding: 20px 0;">--}}
{{--            </div>--}}
        </div>


    </div>
</div>
@endcomponent
