@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.subscribe.index.title') }}
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

        <div class="w-full sm:w-1/2">
            <div class="flex flex-row sm:flex-col content-between font-sans h-80 sm:h-88 flex-wrap">
                    <div class="w-full text-gray-dark">
                        <div class="flex items-end h-20 text-3xl sm:text-4xl">Будь в курсе&nbsp;<span class="text-gold">событий</span></div>
                        <div class="w-full font-serif my-3 text-sm sm:text-base">нажимая на кнопку &ldquo;подписаться на новости&rdquo; вы даете согласие на действия входящие в <a href="#" class="text-gold font-serif underline">политику конфиденциальности</a></div>
                    </div>

                    <div class="form-container">
                        <form action="@php echo route('shop.subscribe') @endphp">
                            <div class="w-full flex content-between flex-wrap h-28 sm:h-40">
                                <div class="control-group" :class="[errors.has('subscriber_email') ? 'has-error' : '']">
                                        <div class="mat-div is-completed">
                                            <label for="subscriber_email" class="required mat-label">{{ __('shop::app.customer.account.profile.email') }}</label>
                                            <input type="email" class="control mat-input" name="subscriber_email" value="{{ old('subscriber_email') ?? $customer->email }}" v-validate="'required'" data-vv-as="&quot;{{ __('shop::app.customer.account.profile.email') }}&quot;">
                                        </div>
                                        <span class="control-error" v-if="errors.has('subscriber_email')">@{{ errors.first('subscriber_email') }}</span>
                                    </div>
                                    <button> <span class="font-serif tracking-wider uppercase text-gold flex items-center inline-block align-baseline h-4 mb-3"> подписаться на новости <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline-block feather feather-mail ml-2 mb-1"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> </span> </button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
        <div class="w-full block sm:hidden my-6">
            @include('shop::customers.account.partials.mini-gift')
        </div>

    </div>
@endsection
