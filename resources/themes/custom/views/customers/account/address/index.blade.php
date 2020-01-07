@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.customer.account.address.index.page-title') }}
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

            <div class="w-full flex justify-content-between items-center">
                <div class=" flex items-end inline-block">
                    <div class="address-icon align-middle h-auto w-6 mb-1"></div>
                    <span class="account-heading text-gray-dark text-lg sm:text-xl uppercase pl-4">{{ __('shop::app.layouts.address') }}</span>
                </div>
                @if (! $addresses->isEmpty())
                <span class="account-action border-b border-transparent ml-auto font-serif text-gold hover:border-b hover:border-gold">
                        <a href="{{ route('customer.address.create') }}">{{ __('shop::app.customer.account.address.index.add') }}</a>
                </span>
                @else
                    <span></span>
                @endif
            </div>
        </div>
        <div class="horizontal-rule"></div>


        {!! view_render_event('bagisto.shop.customers.account.address.list.before', ['addresses' => $addresses]) !!}

        <div class="account-table-content">
            @if ($addresses->isEmpty())
                <div>{{ __('shop::app.customer.account.address.index.empty') }}</div>
                <br/>
                <span class="button-decor w-1/2 py-3 normal-case">
                    <a href="{{ route('customer.address.create') }}">{{ __('shop::app.customer.account.address.index.add') }}</a></span>
            @else
                <div class="address-holder">
                    @foreach ($addresses as $address)
                        <div class="address-card">
                            <div class="details">
                                <span class="bold">{{ auth()->guard('customer')->user()->name }}</span>
                                <ul class="address-card-list">
                                    <li class="mt-5">
                                        {{ $address->name }}
                                    </li>

                                    <li class="mt-5">
                                        {{ $address->address1 }},
                                    </li>

                                    <li class="mt-5">
                                        {{ $address->city }}
                                    </li>

                                    <li class="mt-5">
                                        {{ $address->state }}
                                    </li>

                                    <li class="mt-5">
                                        {{ core()->country_name($address->country) }} {{ $address->postcode }}
                                    </li>

                                    <li class="mt-10">
                                        {{ __('shop::app.customer.account.address.index.contact') }} : {{ $address->phone }}
                                    </li>
                                </ul>

                                <div class="control-links mt-20">
                                    <span>
                                        <a href="{{ route('customer.address.edit', $address->id) }}">
                                            {{ __('shop::app.customer.account.address.index.edit') }}
                                        </a>
                                    </span>

                                    <span>
                                        <a href="{{ route('address.delete', $address->id) }}" onclick="deleteAddress('{{ __('shop::app.customer.account.address.index.confirm-delete') }}')">
                                            {{ __('shop::app.customer.account.address.index.delete') }}
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {!! view_render_event('bagisto.shop.customers.account.address.list.after', ['addresses' => $addresses]) !!}
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function deleteAddress(message) {
            if (!confirm(message))
            event.preventDefault();
        }
    </script>
@endpush
