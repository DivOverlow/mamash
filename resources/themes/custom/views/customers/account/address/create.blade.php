@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.address.create.page-title') }}
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
            <div class="account-head mb-15">
                <span class="back-icon"><a href="{{ route('customer.account.index') }}"><i class="icon icon-menu-back"></i></a></span>
                <span class="account-heading w-full flex items-end h-20 text-gray-dark text-xl sm:text-2xl uppercase pl-4">{{ __('shop::app.customer.account.address.create.title') }}</span>
                <span></span>
            </div>
            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 mt-6 p-4" role="alert">
                <p class="font-serif">{{ __('shop::app.checkout.onepage.address-message') }}</p>
            </div>

            {!! view_render_event('bagisto.shop.customers.account.address.create.before') !!}

            <form method="post" action="{{ route('customer.address.create') }}" @submit.prevent="onSubmit">

                <div class="account-table-content">
                    @csrf

                    {!! view_render_event('bagisto.shop.customers.account.address.create_form_controls.before') !!}

                    <div class="control-group" :class="[errors.has('city') ? 'has-error' : '']">
                        <div class="mat-div">
                            <label for="city" class="required mat-label">{{ __('shop::app.customer.account.address.create.city') }}</label>
                            <input type="text" class="control mat-input text-gray-dark" name="city" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.city') }}&quot;">
                        </div>
                        <span class="control-error" v-if="errors.has('city')">@{{ errors.first('city') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('address1[]') ? 'has-error' : '']">
                        <div class="mat-div">
                        <label for="address_0" class="required mat-label">{{ __('shop::app.customer.account.address.create.street-address') }}</label>
                        <input type="text" class="control mat-input text-gray-dark" name="address1[]" id="address_0" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.street-address') }}&quot;">
                        </div>
                        <span class="control-error" v-if="errors.has('address1[]')">@{{ errors.first('address1[]') }}</span>
                    </div>

                    @if (core()->getConfigData('customer.settings.address.street_lines') && core()->getConfigData('customer.settings.address.street_lines') > 1)
                        <div class="control-group">
                            @for ($i = 1; $i < core()->getConfigData('customer.settings.address.street_lines'); $i++)
                                <input type="text" class="control mat-input text-gray-dark" name="address1[{{ $i }}]" id="address_{{ $i }}">
                            @endfor
                        </div>
                    @endif

{{--                    @include ('shop::customers.account.address.country-state', ['countryCode' => old('country'), 'stateCode' => old('state')])--}}

{{--                    <div class="control-group" :class="[errors.has('postcode') ? 'has-error' : '']">--}}
{{--                        <div class="mat-div">--}}
{{--                        <label for="postcode" class="required mat-label">{{ __('shop::app.customer.account.address.create.postcode') }}</label>--}}
{{--                        <input type="text" class="control mat-input text-gray-dark" name="postcode" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.postcode') }}&quot;">--}}
{{--                        </div>--}}
{{--                        <span class="control-error" v-if="errors.has('postcode')">@{{ errors.first('postcode') }}</span>--}}
{{--                    </div>--}}

                    <div class="control-group" :class="[errors.has('phone') ? 'has-error' : '']">
                        <div class="mat-div">
                        <label for="phone" class="required mat-label">{{ __('shop::app.customer.account.address.create.phone') }}</label>
                        <input type="text" class="control mat-input text-gray-dark" name="phone" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.address.create.phone') }}&quot;">
                        </div>
                        <span class="control-error" v-if="errors.has('phone')">@{{ errors.first('phone') }}</span>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.address.create_form_controls.after') !!}

                    <div class="button-group mt-10">
                        <input class="btn btn-primary py-3 px-6" type="submit" value="{{ __('shop::app.customer.account.address.create.submit') }}">
                        {{-- <button class="btn btn-primary btn-lg" type="submit">
                            {{ __('shop::app.customer.account.address.edit.submit') }}
                        </button> --}}
                    </div>

                </div>

            </form>

            {!! view_render_event('bagisto.shop.customers.account.address.create.after') !!}

        </div>

    </div>

@endsection