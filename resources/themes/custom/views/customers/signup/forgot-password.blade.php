@extends('shop::layouts.master')

@section('page_title')
 {{ __('shop::app.customer.forgot-password.page_title') }}
@stop

@push('css')
    <style>
        .button-group {
            margin-bottom: 25px;
        }
        .primary-back-icon {
            vertical-align: middle;
        }
    </style>
@endpush

@section('content-wrapper')

<div class="main-container-wrapper auth-content flex justify-center">

    {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}

    <form method="post" action="{{ route('customer.forgot-password.store') }}" @submit.prevent="onSubmit">

        {{ csrf_field() }}

        <div class="login-form w-full sm:max-w-md h-120 flex content-around flex-wrap">

            <div class="login-text w-full pt-10 uppercase text-3xl text-gray-dark text-center">{{ __('shop::app.customer.forgot-password.title') }}</div>

            {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}

            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                <div class="mat-div">
                    <label for="email" class="mat-label">{{ __('shop::app.customer.forgot-password.email') }}</label>
                    <input type="email" class="control mat-input" name="email" v-validate="'required|email'">
                </div>
                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
            </div>

            {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}

            <div class="button-group w-full text-center">
                <button type="submit" class="btn btn-lg btn-primary px-6 py-3">
                    {{ __('shop::app.customer.forgot-password.submit') }}
                </button>
            </div>

            <div class="control-group w-full text-center">
                <a href="{{ route('customer.session.index') }}" class="underline hover:no-underline text-gray-silver">
                    <i class="icon primary-back-icon"></i>
                    {{ __('shop::app.customer.reset-password.back-link-title') }}
                </a>
            </div>

        </div>
    </form>

    {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}

</div>
@endsection