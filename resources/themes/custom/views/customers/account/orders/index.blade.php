@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.order.index.page-title') }}
@endsection

@section('content-wrapper')

    <div class="account-content main-container-wrapper flex content-start flex-wrap">
        <div class="w-full sm:w-1/2">
            <div class="flex items-end inline-block h-20">
                <div class="user-icon active mb-1"></div>
                <span class="text-gold text-xl sm:text-2xl uppercase pl-4">{{ $customer->first_name .' ' .  $customer->last_name  }}</span>
            </div>

            @include('shop::customers.account.partials.sidemenu')

        </div>



        <div class="account-layout w-full sm:w-1/2">

            <div class="account-head flex items-end h-20">

                <div class="w-full flex justify-start items-center">
                    <div class="flex items-end inline-block">
                        <div class="history-icon align-middle h-auto w-6 mb-2"></div>
                        <span class="account-heading text-gray-dark text-xl sm:text-2xl uppercase pl-4">{{ __('shop::app.customer.account.order.index.title') }}</span>
                    </div>
                </div>
            </div>
            <div class="horizontal-rule"></div>
            {!! view_render_event('bagisto.shop.customers.account.orders.list.before') !!}

            <div class="account-items-list">
                <div class="account-table-content">

                    @inject('order','Webkul\Shop\DataGrids\OrderDataGrid')
                    {!! $order->render() !!}

                </div>
            </div>

            {!! view_render_event('bagisto.shop.customers.account.orders.list.after') !!}

        </div>

        <div class="w-full block sm:hidden my-6">
            @include('shop::customers.account.partials.mini-gift')
        </div>
    </div>

@endsection