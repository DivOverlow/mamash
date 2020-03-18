@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.profile.index.title') }}
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

            <div class="w-full flex flex-col sm:flex-row justify-content-between items-center">
                <div class=" flex items-end inline-block">
                    <div class="profile-icon address-info mb-2"></div>
                    <span class="account-heading text-gray-dark text-xl sm:text-2xl uppercase pl-4">{{ __('shop::app.customer.account.profile.index.title') }}</span>
                </div>

                <span class="account-action border-b border-transparent ml-auto font-serif text-gold hover:border-b hover:border-gold">
                    <a href="{{ route('customer.profile.edit') }}">{{ __('shop::app.customer.account.profile.index.edit') }}</a>
                </span>
            </div>
        </div>
        <div class="horizontal-rule"></div>

         {!! view_render_event('bagisto.shop.customers.account.profile.view.before', ['customer' => $customer]) !!}

        <div class="account-table-content">
            <table>
                <tbody>
                    <tr>
                        <td>{{ __('shop::app.customer.account.profile.fname') }}</td>
                        <td>{{ $customer->first_name }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('shop::app.customer.account.profile.lname') }}</td>
                        <td>{{ $customer->last_name }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('shop::app.customer.account.profile.gender') }}</td>
                        <td>{{ $customer->gender }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('shop::app.customer.account.profile.dob') }}</td>
                        <td>{{ $customer->date_of_birth }}</td>
                    </tr>

                    <tr>
                        <td>{{ __('shop::app.customer.account.profile.email') }}</td>
                        <td>{{ $customer->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <accordian :title="'{{ __('shop::app.customer.account.profile.index.title') }}'" :active="true">
            <div slot="body">
                <div class="page-action">
                    <button type="submit" @click="showModal('deleteProfile')" class="button-black mt-10 px-6 py-4 normal-case">
                        {{ __('shop::app.customer.account.address.index.delete') }}
                    </button>
                </div>

                <form method="POST" action="{{ route('customer.profile.destroy') }}" @submit.prevent="onSubmit">
                    @csrf
                    <modal id="deleteProfile" :is-open="modalIds.deleteProfile">
                        <h3 slot="header">{{ __('shop::app.customer.account.address.index.enter-password') }}</h3>

                        <div slot="body">
                            <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                                <div class="mat-div is-completed">
                                    <label for="password" class="required mat-label">{{ __('shop::app.customer.account.profile.password') }}</label>
                                    <input type="password" v-validate="'required|min:6|max:18'" class="control mat-input" id="password" name="password" data-vv-as="&quot;{{ __('admin::app.users.users.password') }}&quot;"/>
                                </div>
                                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                            </div>

                            <div class="page-action">
                                <button type="submit"  class="button-decor px-4 py-3 mt-10">
                                {{ __('shop::app.customer.account.address.index.delete') }}
                                </button>
                            </div>
                        </div>
                    </modal>
                </form>
            </div>
        </accordian>

         {!! view_render_event('bagisto.shop.customers.account.profile.view.after', ['customer' => $customer]) !!}
    </div>

    <div class="w-full block sm:hidden my-6">
        @include('shop::customers.account.partials.mini-gift')
    </div>

</div>

@endsection
