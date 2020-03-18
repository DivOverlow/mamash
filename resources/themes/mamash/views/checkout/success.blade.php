@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.checkout.success.title') }}
@stop

@section('content-wrapper')

    <div class="main-container-wrapper w-full flex justify-center h-88">
        <div class="order-success-content flex content-around justify-center flex-wrap" style="min-height: 300px;">
                <div class="w-full text-xl font-semibold text-gray-dark">{{ __('shop::app.checkout.success.thanks') }}</div>

            <div class="w-full text-lg text-gray-dark">{{ __('shop::app.checkout.success.order-id-info', ['order_id' => $order->increment_id]) }}</div>

            <div class="w-full text-lg text-gray-dark">{{ __('shop::app.checkout.success.info') }}</div>

            {{ view_render_event('bagisto.shop.checkout.continue-shopping.before', ['order' => $order]) }}

            <div class="misc-controls">
                <a style="display: inline-block" href="{{ route('shop.home.index') }}" class="btn btn-primary px-6 py-3">
                    {{ __('shop::app.checkout.cart.continue-shopping') }}
                </a>
            </div>

            {{ view_render_event('bagisto.shop.checkout.continue-shopping.after', ['order' => $order]) }}

        </div>
    </div>
@endsection
