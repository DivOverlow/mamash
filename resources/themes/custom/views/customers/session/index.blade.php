@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.login-form.page-title') }}
@endsection

@section('content-wrapper')
    @inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')

    <div class="auth-content w-full bg-cover h-full relative"
         style="background-image: url('/themes/custom/assets/images/banner/bg_card.jpg');  min-height: 34rem;">
        <img src="/themes/custom/assets/images/banner/blooper.png" alt="blooper image" class="h-24 w-auto absolute right-0 mt-20 invisible sm:visible">
        <div class="main-container-wrapper flex flex-col justify-content-between sm:flex-row">
            <div class="w-full sm:w-1/2 py-4 pr-4">
                {!! view_render_event('bagisto.shop.customers.login.before') !!}

                <form method="POST" action="{{ route('customer.session.create') }}" @submit.prevent="onSubmit">
                    {{ csrf_field() }}
                    <div class="login-form flex flex-col content-between flex-wrap max-w-lg">
                        <div class="py-12">
                            <div class="login-text text-gold text-2xl uppercase mb-2">{{ __('shop::app.customer.login-form.title') }}</div>
                            <p class="font-serif text-gray-dark text-base">{{ __('shop::app.customer.login-form.sub-title') }}</p>
                        </div>
                        {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}

                        <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                            <div class="mat-div">
                                <label for="email" class="required mat-label">{{ __('shop::app.customer.login-form.email') }}</label>
                                <input type="text" class="control mat-input" name="email" v-validate="'required|email'"
                                       value="{{ old('email') }}"
                                       data-vv-as="&quot;{{ __('shop::app.customer.login-form.email') }}&quot;">
                            </div>
                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                        </div>

                        <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                            <div class="mat-div">
                                <label for="password"
                                       class="required mat-label">{{ __('shop::app.customer.login-form.password') }}</label>
                                <input type="password" v-validate="'required|min:6'" class="control mat-input" id="password"
                                       name="password"
                                       data-vv-as="&quot;{{ __('admin::app.users.sessions.password') }}&quot;"
                                       value=""/>
                            </div>
                                <span class="control-error"
                                      v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}

                        <div class="forgot-password-link font-serif text-gray-cloud text-right py-4">
                            <a class="underline" href="{{ route('customer.forgot-password.create') }}">{{ __('shop::app.customer.login-form.forgot_pass') }}</a>

                            <div class="mt-10">
                                @if (Cookie::has('enable-resend'))
                                    @if (Cookie::get('enable-resend') == true)
                                        <a href="{{ route('customer.resend.verification-email', Cookie::get('email-for-resend')) }}">{{ __('shop::app.customer.login-form.resend-verification') }}</a>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <input class="button-black w-full sm:w-1/2 py-3 text-xl capitalize" type="submit"
                               value="{{ __('shop::app.customer.login-form.button_title') }}">
                    </div>
                </form>

                {!! view_render_event('bagisto.shop.customers.login.after') !!}
            </div>

            {!! DbView::make($templateRepository
                    ->getTemplate('login-right-block'))
                    ->field('html_content')
                    ->render() !!}

        </div>
    </div>

@stop
