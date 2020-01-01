@extends('shop::layouts.master')
@section('page_title')
    {{ __('shop::app.customer.signup-form.page-title') }}
@endsection
@section('content-wrapper')

<div class="auth-content w-full bg-cover relative" style="background-image: url('/themes/custom/assets/images/banner/bg_card.jpg'); min-height: 34rem;">

    <img src="/themes/custom/assets/images/banner/blooper.png" alt="blooper image" class="h-24 w-auto absolute right-0 bottom-0 mb-20 invisible sm:visible">

    <div class="main-container-wrapper flex flex-col justify-content-between sm:flex-row">
        <div class="w-full sm:w-1/2 py-4">

        {!! view_render_event('bagisto.shop.customers.signup.before') !!}

        <form method="post" action="{{ route('customer.register.create') }}" @submit.prevent="onSubmit">

            {{ csrf_field() }}

            <div class="login-form flex flex-col content-between flex-wrap max-w-lg">
                <div class="login-text text-gold text-2xl uppercase mt-6">{{ __('shop::app.customer.signup-form.title') }}</div>

                {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}

                <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                    <div class="mat-div">
                        <label for="first_name" class="required mat-label">{{ __('shop::app.customer.signup-form.firstname') }}</label>
                        <input type="text" class="control mat-input" name="first_name" v-validate="'required'" value="{{ old('first_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.firstname') }}&quot;">
                    </div>
                    <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                </div>

                <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                    <div class="mat-div">
                        <label for="last_name" class="required mat-label">{{ __('shop::app.customer.signup-form.lastname') }}</label>
                        <input type="text" class="control mat-input" name="last_name" v-validate="'required'" value="{{ old('last_name') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.lastname') }}&quot;">
                    </div>
                    <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
                </div>

                <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                    <div class="mat-div">
                        <label for="email" class="required mat-label">{{ __('shop::app.customer.signup-form.email') }}</label>
                        <input type="email" class="control mat-input" name="email" v-validate="'required|email'" value="{{ old('email') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.email') }}&quot;">
                    </div>
                    <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                </div>

                <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                    <div class="mat-div">
                        <label for="password" class="required mat-label">{{ __('shop::app.customer.signup-form.password') }}</label>
                        <input type="password" class="control mat-input" name="password" v-validate="'required|min:6'" ref="password" value="{{ old('password') }}" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.password') }}&quot;">
                    </div>
                    <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                </div>

                <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                    <div class="mat-div">
                        <label for="password_confirmation" class="required mat-label">{{ __('shop::app.customer.signup-form.confirm_pass') }}</label>
                        <input type="password" class="control mat-input" name="password_confirmation"  v-validate="'required|min:6|confirmed:password'" data-vv-as="&quot;{{ __('shop::app.customer.signup-form.confirm_pass') }}&quot;">
                    </div>
                    <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                </div>

                {!! view_render_event('bagisto.shop.customers.signup_form_controls.after') !!}


                <button class="button-black w-full sm:w-1/2 py-3 text-xl capitalize mt-3" type="submit">
                    {{ __('shop::app.customer.signup-form.button_title') }}
                </button>

            </div>
        </form>
        {!! view_render_event('bagisto.shop.customers.signup.after') !!}
        </div>

        <div class="w-full sm:w-1/2 flex content-between flex-wrap py-4">
            <div class="w-full text-gold text-2xl uppercase mt-6">{{ __('shop::app.customer.signup-text.account_exists') }}</div>
            <div class="sign-up button-decor w-full sm:w-1/3 py-3 text-xl capitalize">
                <a href="{{ route('customer.session.index') }}">{{ __('shop::app.customer.signup-text.title') }}</a>
            </div>
        </div>

</div>
@endsection
