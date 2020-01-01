@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.profile.edit-profile.page-title') }}
@endsection

@section('content-wrapper')
    <div class="account-content main-container-wrapper flex flex-col sm:flex-row">
        <div class="w-full sm:w-1/2">
            <div class="flex items-end inline-block h-20">
                <div class="user-icon active mb-1"></div>
                <span class="text-gold text-xl sm:text-2xl uppercase pl-4">{{ $customer->first_name .' ' .  $customer->last_name  }}</span>
            </div>

            @include('shop::customers.account.partials.sidemenu')
            @include('shop::customers.account.partials.mini-gift')

        </div>

        <div class="account-layout w-full sm:w-1/2 flex flex-col">
            <div class="account-head w-full flex items-end h-20">
{{--                <span class="back-icon"><a href="{{ route('customer.account.index') }}"><i class="icon icon-menu-back"></i></a></span>--}}
                <div class=" flex items-end inline-block">
                    <div class="profile-icon address-info mb-2"></div>
                    <span class="account-heading text-gray-dark text-xl sm:text-2xl uppercase pl-4">{{ __('shop::app.customer.account.profile.edit-profile.title') }}</span>
                </div>
            </div>

            <div class="w-full max-w-lg mt-6">
              {!! view_render_event('bagisto.shop.customers.account.profile.edit.before', ['customer' => $customer]) !!}

                <form method="post" action="{{ route('customer.profile.edit') }}" @submit.prevent="onSubmit">

                <div class="edit-form flex flex-col">
                        @csrf

                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.before', ['customer' => $customer]) !!}
                       <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                            <div class="mat-div is-completed">
                                <label for="first_name" class="required mat-label">{{ __('shop::app.customer.account.profile.fname') }}</label>

                                <input type="text" class="control mat-input" name="first_name" value="{{ old('first_name') ?? $customer->first_name }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.fname') }}&quot;">
                            </div>
                            <span class="control-error" v-if="errors.has('first_name')">@{{ errors.first('first_name') }}</span>
                        </div>
                        <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                            <div class="mat-div is-completed">
                                <label for="last_name" class="required mat-label">{{ __('shop::app.customer.account.profile.lname') }}</label>

                                <input type="text" class="control mat-input" name="last_name" value="{{ old('last_name') ?? $customer->last_name }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.lname') }}&quot;">
                            </div>
                            <span class="control-error" v-if="errors.has('last_name')">@{{ errors.first('last_name') }}</span>
                        </div>
                        <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                            <div class="mat-div is-completed">
                                <label for="email" class="required mat-label">{{ __('shop::app.customer.account.profile.email') }}</label>
                                <input type="email" class="control mat-input" name="email" value="{{ old('email') ?? $customer->email }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.email') }}&quot;">
                            </div>
                            <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                        </div>
                        <div class="control-group" :class="[errors.has('gender') ? 'has-error' : '']">
                            <div class="mat-div is-completed">
                                <label for="email" class="required mat-label">{{ __('shop::app.customer.account.profile.gender') }}</label>

                                <select name="gender" class="control mat-input" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.gender') }}&quot;">
                                    <option value=""  @if ($customer->gender == "") selected @endif></option>
                                    <option value="Other"  @if ($customer->gender == "Other") selected @endif>Other</option>
                                    <option value="Male"  @if ($customer->gender == "Male") selected @endif>Male</option>
                                    <option value="Female" @if ($customer->gender == "Female") selected @endif>Female</option>
                                </select>
                            </div>
                            <span class="control-error" v-if="errors.has('gender')">@{{ errors.first('gender') }}</span>
                        </div>
                        <div class="control-group"  :class="[errors.has('date_of_birth') ? 'has-error' : '']">
                            <div class="mat-div is-completed">
                                <label for="date_of_birth" class="text-gray-silver uppercase">{{ __('shop::app.customer.account.profile.dob') }}</label>
                                <input type="date" class="control mat-input" name="date_of_birth" value="{{ old('date_of_birth') ?? $customer->date_of_birth }}" v-validate="" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.dob') }}&quot;">
                            </div>
                            <span class="control-error" v-if="errors.has('date_of_birth')">@{{ errors.first('date_of_birth') }}</span>
                            <span>{{ __('shop::app.customer.account.profile.sub-dob') }}</span>
                        </div>


                        <div class="control-group mt-20" :class="[errors.has('oldpassword') ? 'has-error' : '']">
                            <div class="mat-div">
                                <label for="password" class="mat-label">{{ __('shop::app.customer.account.profile.opassword') }}</label>
                                <input type="password" class="control mat-input" name="oldpassword" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.opassword') }}&quot;" v-validate="'min:6'">
                            </div>
                            <span class="control-error" v-if="errors.has('oldpassword')">@{{ errors.first('oldpassword') }}</span>
                        </div>
                        <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                            <div class="mat-div">

                                <label for="password" class="mat-label">{{ __('shop::app.customer.account.profile.password') }}</label>

                                <input type="password" id="password" class="control mat-input" name="password" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.password') }}&quot;" v-validate="'min:6'">
                            </div>
                            <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                        </div>
                        <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                            <div class="mat-div">
                                <label for="password" class="mat-label">{{ __('shop::app.customer.account.profile.cpassword') }}</label>

                                <input type="password" id="password_confirmation" class="control mat-input" name="password_confirmation" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.cpassword') }}&quot;" v-validate="'min:6|confirmed:password'">
                            </div>
                            <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.after', ['customer' => $customer]) !!}

                        <div class="button-group mt-12">
                            <input class="button-decor w-full sm:w-1/2 py-3 text-xl capitalize" type="submit" value="{{ __('shop::app.customer.account.profile.submit') }}">
                        </div>
                    </div>
                </div>
                </form>

                {!! view_render_event('bagisto.shop.customers.account.profile.edit.after', ['customer' => $customer]) !!}
            </div>
        </div>

    </div>
@endsection
