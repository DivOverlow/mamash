@extends('shop::layouts.master')

@section('page_title')
 {{ __('shop::app.customer.reset-password.title') }}
@endsection

@section('content-wrapper')

<div class="auth-content main-container-wrapper flex justify-center">

    {!! view_render_event('bagisto.shop.customers.reset_password.before') !!}

    <form method="post" action="{{ route('customer.reset-password.store') }}" >

        {{ csrf_field() }}

        <div class="login-form w-full sm:max-w-md h-120 flex content-around flex-wrap">

            <div class="login-text w-full pt-10 uppercase text-3xl text-gray-dark text-center">{{ __('shop::app.customer.reset-password.title') }}</div>

            <input type="hidden" name="token" value="{{ $token }}">

            {!! view_render_event('bagisto.shop.customers.reset_password_form_controls.before') !!}

            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                <div class="mat-div">
                    <label for="email" class="mat-label">{{ __('shop::app.customer.reset-password.email') }}</label>
                    <input type="text" v-validate="'required|email'" class="control mat-input" id="email" name="email" value="{{ old('email') }}"/>
                </div>
                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
            </div>

            <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                <div class="mat-div">
                    <label for="password" class="mat-label">{{ __('shop::app.customer.reset-password.password') }}</label>
                    <input type="password" class="control mat-input" name="password" v-validate="'required|min:6'" ref="password">
                </div>
                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
            </div>

            <div class="control-group" :class="[errors.has('confirm_password') ? 'has-error' : '']">
                <div class="mat-div">
                    <label for="confirm_password" class="mat-label">{{ __('shop::app.customer.reset-password.confirm-password') }}</label>
                    <input type="password" class="control mat-input" name="password_confirmation"  v-validate="'required|min:6|confirmed:password'">
                </div>
                <span class="control-error" v-if="errors.has('confirm_password')">@{{ errors.first('confirm_password') }}</span>
            </div>

            {!! view_render_event('bagisto.shop.customers.reset_password_form_controls.before') !!}

            <input class="btn btn-primary px-6 py-3" type="submit" value="{{ __('shop::app.customer.reset-password.submit-btn-title') }}">

        </div>
    </form>

    {!! view_render_event('bagisto.shop.customers.reset_password.before') !!}
</div>
@endsection