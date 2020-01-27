@inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')
@inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')

@component('shop::emails.layouts.master')

<div style="background-color: #282828; width: 100%">
    <div style="width: 100%;max-width: 600px;margin:auto;">
        <div style="height: 170px;background-color: #212121;padding: 0 30px;">
            <div style="height: 120px;display: flex;align-items: center;justify-content: center;">
                <a style="text-decoration: none;color: #fff;" href="{{ config('app.url') }}">
                    @include ('shop::emails.layouts.logo')
                </a>
            </div>

            <div style="display: flex;align-items: center;justify-content: center;letter-spacing: 0.025em;height: 30px;width: 100%;background-color: #212121;">
                <ul style="padding-inline-start: 0 !important;display: flex;justify-content: space-around;width: 100%;align-items: center;">
                    <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;display: flex;justify-content: center;font-size: .875rem;font-weight: 400;text-transform: uppercase;width: 23%;border-right: 1px solid #fff;">
                        <a style="text-decoration: none;color: #fff;" href="{{ route('shop.categories.index', 'products') }}">{{ __('shop::app.mail.order.menu.products') }}</a>
                    </li>
                    <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;display: flex;justify-content: center;font-size: .875rem;font-weight: 400;text-transform: uppercase;width: 23%;border-right: 1px solid #fff;">
                        <a style="text-decoration: none;color: #fff;" href="{{ route('shop.categories.index', 'collections') }}">{{ __('shop::app.mail.order.menu.collections') }}</a>
                    </li>
                    <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;display: flex;justify-content: center;font-size: .875rem;font-weight: 400;text-transform: uppercase;width: 23%;border-right: 1px solid #fff;">
                        <a style="text-decoration: none;color: #fff;" href="{{ route('shop.categories.index', 'gifts') }}">{{ __('shop::app.mail.order.menu.gifts') }}</a>
                    </li>
                    <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;display: flex;justify-content: center;font-size: .875rem;font-weight: 400;text-transform: uppercase;width: 23%;border-right: 1px solid #fff;">
                        <a style="text-decoration: none;color: #fff;" href="{{ route('shop.cms.page', 'about-us') }}">{{ __('shop::app.mail.order.menu.about-us') }}</a>
                    </li>
                    <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;display: flex;justify-content: center;font-size: .875rem;font-weight: 400;text-transform: uppercase;width: 8%"><a style="text-decoration: none;color: #fff;" href="{{ route('customer.session.index') }}">
                            <span style="width: 27px;height: 27px;display: inline-block;background-image: url({{ bagisto_asset('images/user.png') }});background-position: top center;background-repeat: no-repeat;margin-top: -2px;"></span></a></li>
                </ul>
            </div> <!-- end top-nav -->
        </div>

        <div style="background-color: #fff;padding: 30px;">
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
                                $categoryCollection = null;

                                if ($item->type == "configurable") {
                                    $images = $productImageHelper->getProductBaseImage($item->child->product);
                                    foreach ($item->child->product->categories as $category) {
                                        if ($category->display_mode == "collections_only") {
                                            $categoryCollection = $category;
                                            break;
                                        }
                                    }
                                }
                                else {
                                    $images = $productImageHelper->getProductBaseImage($item->product);
                                    foreach ($item->product->categories as $category) {
                                        if ($category->display_mode == "collections_only") {
                                            $categoryCollection = $category;
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
                                                    <a style="text-decoration: none;color: #fff;" href="{{ route('shop.categories.index', $categoryCollection->slug) }}"
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
                    <div style="width: 28px;height: 20px;display: inline-block;background-image: url({{ bagisto_asset('images/shipping.png') }});background-position: top center;background-repeat: no-repeat;"></div>
                    <span style="font-weight: bold;font-size: 1.5rem;text-transform: uppercase;padding-left: 1rem;">{{ __('shop::app.mail.order.shipping-handling') }}</span>
                </div>
                <div style="font-size: 1.125rem;letter-spacing: 0.05em;font-weight: 500;text-transform: uppercase;color: #969696;margin-bottom: 15px;">
                    {{ $order->shipping_title }}
                </div>
                <div style="display: inline-block; font-size: 1.25rem;font-weight: bold;">
                    {{ $order->shipping_address->city }}, {{ $order->shipping_address->address1 }}
                </div>
            </div>
        </div>


        {!! DbView::make($templateRepository
                ->getTemplate('email-footer-new-order'))
                ->field('html_content')
                ->render() !!}


{{--        <div class="section-footer" style="background-color: #2f2f2f;display: flex;flex-direction: column;height: 688px;padding: 0 20px;">--}}
{{--            <div style="display: flex;align-items: center;justify-content: center;width: 100%;border-bottom: solid 1px #727272;height: 160px;">--}}
{{--                <ul style="padding-inline-start: 0 !important;display: flex;justify-content: space-around;width: 90%;">--}}
{{--                    <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;"><a style="text-decoration: none;color: #fff;" href="#" target="_blank" rel="noopener noreferrer">--}}
{{--                            <svg width="40" height="40" fill="#979797" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                 viewBox="0 0 24 24">--}}
{{--                                <path--}}
{{--                                    d="M21,3H3v18h9.621v-6.961h-2.343v-2.725h2.343V9.309c0-2.324,1.421-3.591,3.495-3.591c0.699-0.002,1.397,0.034,2.092,0.105 v2.43h-1.428c-1.13,0-1.35,0.534-1.35,1.322v1.735h2.7l-0.351,2.725h-2.365V21H21V3z"></path>--}}
{{--                            </svg>--}}
{{--                        </a></li>--}}
{{--                    <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;"><a style="text-decoration: none;color: #fff;" href="#" target="_blank" rel="noopener noreferrer">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"--}}
{{--                                 fill="none" stroke="#979797" stroke-width="2" stroke-linecap="round"--}}
{{--                                 stroke-linejoin="round" class="feather feather-instagram">--}}
{{--                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>--}}
{{--                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>--}}
{{--                                <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"></line>--}}
{{--                            </svg>--}}
{{--                        </a></li>--}}
{{--                    <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;"><a style="text-decoration: none;color: #fff;" href="https://youtube.com" target="_blank" rel="noopener noreferrer">--}}
{{--                            <svg width="40" height="40" viewBox="0 0 26 20" fill="#979797"--}}
{{--                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path--}}
{{--                                    d="M25.457 3.13c-.3-1.232-1.18-2.203-2.299-2.532C21.13 0 13 0 13 0S4.87 0 2.842.598c-1.119.33-2 1.3-2.299 2.531C0 5.362 0 10.02 0 10.02s0 4.658.543 6.891c.3 1.232 1.18 2.162 2.299 2.49C4.87 20 13 20 13 20s8.13 0 10.158-.598c1.119-.33 2-1.26 2.299-2.49C26 14.677 26 10.02 26 10.02s0-4.658-.543-6.89zM10.34 14.25V5.79l6.795 4.23-6.795 4.23z"--}}
{{--                                    fill-rule="nonzero"></path>--}}
{{--                            </svg>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}

{{--            <div style="display: flex;align-content: space-around;justify-content: center;flex-wrap: wrap;width: 100%;border-bottom: solid 1px #727272;height: 330px;">--}}
{{--                <div style="display: flex;justify-content: space-around;width: 100%;font-size: .875rem;line-height: 2;color:#fff">--}}
{{--                    <div style="width: 35%;">--}}
{{--                        <span style="display: inline-block;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#dfa46d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg> Киев, ЖК "Чайки", ул. Лобановского, 12</span>--}}
{{--                    </div>--}}
{{--                    <div style="width: 35%;">--}}
{{--                        <span style="display: inline-block;"><a style="text-decoration: none;color: #fff;" href="tel:+380661312772"><span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#dfa46d" stroke="#dfa46d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></span> 066 131 27 72 </a></span>--}}
{{--                        {!!--}}
{{--                                '<a style"text-decoration: none;color: #fff;"" style="color:#fff" href="mailto:' . config('mail.from.address') . '">' . config('mail.from.address'). '</a>'--}}
{{--                        !!}--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="list-link" style="display: flex;justify-content: space-around;width: 100%;font-size: 1rem;">--}}
{{--                    <div style="width: 35%;">--}}
{{--                        <ul style="padding-inline-start: 0 !important;display: flex;flex-direction: column;line-height: 2;">--}}
{{--                            <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;color: #fff;">Информация</li>--}}
{{--                            <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;"><a style="text-decoration: none;color: #969696;" href="@php echo route('shop.cms.page', 'delivery-and-payment') @endphp">Доставка и оплата</a></li>--}}
{{--                            <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;"><a style="text-decoration: none;color: #969696;" href="@php echo route('shop.cms.page', 'faq') @endphp">Частые вопросы</a></li>--}}
{{--                            <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;"><a style="text-decoration: none;color: #969696;" href="@php echo route('shop.cms.page', 'contact-us') @endphp">Контакты</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div style="width: 35%;">--}}
{{--                        <ul style="padding-inline-start: 0 !important;display: flex;flex-direction: column;line-height: 2;">--}}
{{--                            <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;color: #fff;">О бренде</li>--}}
{{--                            <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;"><a style="text-decoration: none;color: #969696;" href="@php echo route('shop.cms.page', 'about-us') @endphp">О нас</a></li>--}}
{{--                            <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;"><a style="text-decoration: none;color: #969696;" href="@php echo route('shop.cms.page', 'leaving') @endphp">Уход с Mamash</a></li>--}}
{{--                            <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;"><a style="text-decoration: none;color: #969696;" href="@php echo route('shop.cms.page', 'gifts') @endphp">Подарки</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div style="display: flex;align-content: space-around;justify-content: center;flex-wrap: wrap;width: 100%;height: 195px;">--}}

{{--                <div style="height: 33px;display: inline-block;background-image: url({{ bagisto_asset('images/cards.png') }});background-position: top center;background-repeat: no-repeat;width: 100%"></div>--}}
{{--                <ul style="padding-inline-start: 0 !important;display: flex;">--}}
{{--                    <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;margin-right: 2rem;">--}}
{{--                        <a style="text-decoration: none;color: #fff;" href="@php echo route('shop.cms.page', 'terms-conditions') @endphp">Условия покупки</a>--}}
{{--                    </li>--}}
{{--                    <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;margin-right: 2rem;">--}}
{{--                        <a style="text-decoration: none;color: #fff;" href="@php echo route('shop.cms.page', 'terms-of-use') @endphp">Документация</a>--}}
{{--                    </li>--}}
{{--                    <li style="list-style: none !important;margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;">--}}
{{--                        <a style="text-decoration: none;color: #fff;" href="@php echo route('shop.cms.page', 'refund-policy') @endphp">Условия возврата</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}


    </div>
</div>
@endcomponent
