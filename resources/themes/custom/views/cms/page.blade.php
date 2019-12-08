@extends('shop::layouts.master')

@section('page_title')
    {{ $page->page_title }}
@endsection

@section('head')
    @isset($page->meta_title)
        <meta name="title" content="{{ $page->meta_title }}" />
    @endisset

    @isset($page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}" />
    @endisset

    @isset($page->meta_keywords)
        <meta name="keywords" content="{{ $page->meta_keywords }}" />
    @endisset

{{--    <link href="{{ asset('themes/default/assets/css/shop.css') }}" rel="stylesheet" />--}}
@endsection

@section('content-wrapper')
    {!! DbView::make($page)->field('html_content')->render() !!}

{{--<div class="w-full bg-cover" style="background-image: url('/themes/custom/assets/images/banner/bg_card.jpg');">--}}
{{--    <div class="account-content main-container-wrapper flex flex-col sm:flex-row">--}}
{{--        <div class="w-full sm:w-1/2">--}}
{{--            <div class="flex items-end inline-block h-20">--}}
{{--                <span class="text-gray-dark text-xl sm:text-2xl uppercase pl-4">Часто задавемые вопросы</span>--}}
{{--            </div>--}}

{{--            <div class="sidebar">--}}
{{--                <div class="menu-block font-serif uppercase mt-6 sm:mt-12">--}}
{{--                    <div class="menu-block-content">--}}
{{--                        <ul class="menubar">--}}
{{--                            <li class="menu-item py-3 block active">--}}
{{--                                <i class="active align-middle h-auto w-6"></i><a href="@php echo route('shop.cms.page', 'faq') @endphp" class="ml-4">Доставка</a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item py-3 block">--}}
{{--                                <i class="align-middle h-auto w-6"></i><a href="@php echo route('shop.cms.page', 'faq-payment') @endphp" class="ml-4">Оплата</a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item py-3 block">--}}
{{--                                <i class="align-middle h-auto w-6"></i><a href="@php echo route('shop.cms.page', 'faq-refund') @endphp" class="ml-4">Возврат</a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item py-3 block">--}}
{{--                                <i class="align-middle h-auto w-6"></i><a href="@php echo route('shop.cms.page', 'faq') @endphp" class="ml-4">Как получить--}}
{{--                                    товар</a>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item py-3 block">--}}
{{--                                <i class="align-middle h-auto w-6"></i><a href="@php echo route('shop.cms.page', 'faq') @endphp" class="ml-4">Как получить--}}
{{--                                    тесткры</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}

{{--        <div class="account-layout w-full sm:w-1/2">--}}

{{--            <div class="account-head flex items-end h-10 sm:h-40">--}}

{{--                <div class="w-full flex justify-content-between items-center">--}}
{{--                    <div class=" flex items-end inline-block">--}}
{{--                        <span class="account-heading text-yellow text-xl sm:text-2xl uppercase pl-4">Доставка</span>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}

{{--            <accordian :title="'Вопрос'" :active="true">--}}
{{--                <div slot="body" class="font-serif text-gray px-3">--}}
{{--                   - Ответ--}}
{{--                </div>--}}
{{--            </accordian>--}}

{{--            <accordian :title="'Вопрос'" :active="false">--}}
{{--                <div slot="body" class="font-serif text-gray px-3">--}}
{{--                   - Ответ--}}
{{--                </div>--}}
{{--            </accordian>--}}

{{--            <accordian :title="'Вопрос'" :active="false">--}}
{{--                <div slot="body" class="font-serif text-gray px-3">--}}
{{--                    - Ответ--}}
{{--                </div>--}}
{{--            </accordian>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


@endsection

@push('scripts')
{{--    <script src="{{ asset('themes/default/assets/js/shop.js') }}" type="text/javascript"></script>--}}
@endpush

