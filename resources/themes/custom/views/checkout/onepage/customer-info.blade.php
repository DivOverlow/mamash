<form data-vv-scope="address-form">

    <div class="form-container" v-if="!this.new_billing_address">
        <div class="form-header mb-10 w-full flex justify-end items-center">
            <span class="checkout-step-heading font-serif font-medium uppercase mr-6">{{ __('shop::app.checkout.onepage.billing-address') }}</span>

            <a class="btn btn-primary py-3 px-6" @click = newBillingAddress()>
                {{ __('shop::app.checkout.onepage.new-address') }}
            </a>
        </div>
        <div class="address-holder">
            <div class="address-card" v-for='(addresses, index) in this.allAddress'>
                <div class="checkout-address-content" style="display: flex; flex-direction: row; justify-content: space-between; width: 100%;">
                    <label class="radio-container" style="float: right; width: 10%;">
                        <input type="radio" v-validate="'required'" id="billing[address_id]" name="billing[address_id]" :value="addresses.id" v-model="address.billing.address_id" data-vv-as="&quot;{{ __('shop::app.checkout.onepage.billing-address') }}&quot;">
                        <span class="checkmark"></span>
                    </label>

                    <ul class="address-card-list font-serif text-gray-dark" style="float: right; width: 85%;">
                        <li class="mb-3">
                            <b>@{{ allAddress.first_name }} @{{ allAddress.last_name }},</b>
                        </li>

                        <li class="mb-2">
                            @{{ addresses.city }},
                        </li>

                        <li class="mb-2">
                            @{{ addresses.address1 }},
                        </li>

{{--                        <li class="mb-5">--}}
{{--                            @{{ addresses.state }},--}}
{{--                        </li>--}}

{{--                        <li class="mb-15">--}}
{{--                            @{{ addresses.country }}.--}}
{{--                        </li>--}}

                        <li>
                            <b>{{ __('shop::app.customer.account.address.index.contact') }}</b> : @{{ addresses.phone }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="control-group" :class="[errors.has('address-form.billing[address_id]') ? 'has-error' : '']">
                <span class="control-error" v-if="errors.has('address-form.billing[address_id]')">
                    @{{ errors.first('address-form.billing[address_id]') }}
                </span>
            </div>
        </div>

{{--            <div class="control-group mt-5">--}}
{{--                <span class="checkbox">--}}
{{--                    <input type="checkbox" id="billing[use_for_shipping]" name="billing[use_for_shipping]" v-model="address.billing.use_for_shipping"/>--}}
{{--                        <label class="checkbox-view" for="billing[use_for_shipping]"></label>--}}
{{--                        {{ __('shop::app.checkout.onepage.use_for_shipping') }}--}}
{{--                </span>--}}
{{--            </div>--}}
    </div>

    <div class="form-container" v-if="this.new_billing_address">

        <div class="form-header w-full flex justify-end items-center">
            <div class="font-serif font-medium uppercase mr-6">{{ __('shop::app.checkout.onepage.billing-address') }}</div>
            @guest('customer')
                <a class="btn btn-primary py-3 px-6 -mt-8" href="{{ route('customer.session.index') }}">
                    {{ __('shop::app.checkout.onepage.sign-in') }}
                </a>
            @endguest

            @auth('customer')
                @if(count(auth('customer')->user()->addresses))
                    <a class="btn btn-primary py-3 px-6" @click = backToSavedBillingAddress()>
                        {{ __('shop::app.checkout.onepage.back') }}
                    </a>
                @endif
            @endauth


        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[first_name]') ? 'has-error' : '']">
            <div class="mat-div" :class="address.billing.first_name ? 'is-completed' : ''">
                <label for="billing[first_name]" class="required mat-label">
                    {{ __('shop::app.checkout.onepage.first-name') }}
                </label>
                <input type="text" v-validate="'required'" class="control mat-input" id="billing[first_name]"
                       name="billing[first_name]" v-model="address.billing.first_name"
                       data-vv-as="&quot;{{ __('shop::app.checkout.onepage.first-name') }}&quot;"/>
            </div>
            <span class="control-error" v-if="errors.has('address-form.billing[first_name]')">
                @{{ errors.first('address-form.billing[first_name]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[last_name]') ? 'has-error' : '']">
            <div class="mat-div" :class="address.billing.last_name ? 'is-completed' : ''">
                <label for="billing[last_name]" class="required mat-label">
                    {{ __('shop::app.checkout.onepage.last-name') }}
                </label>

                <input type="text" v-validate="'required'" class="control mat-input" id="billing[last_name]"
                       name="billing[last_name]" v-model="address.billing.last_name"
                       data-vv-as="&quot;{{ __('shop::app.checkout.onepage.last-name') }}&quot;"/>
            </div>

            <span class="control-error" v-if="errors.has('address-form.billing[last_name]')">
                @{{ errors.first('address-form.billing[last_name]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[phone]') ? 'has-error' : '']">
            <div class="mat-div" :class="address.billing.phone ? 'is-completed' : ''">

                <label for="billing[phone]" class="required mat-label">
                    {{ __('shop::app.checkout.onepage.phone') }}
                </label>

                <input type="text" v-validate="'required'" class="control mat-input" id="billing[phone]" name="billing[phone]"
                       v-model="address.billing.phone"
                       data-vv-as="&quot;{{ __('shop::app.checkout.onepage.phone') }}&quot;"/>
            </div>

            <span class="control-error" v-if="errors.has('address-form.billing[phone]')">
                @{{ errors.first('address-form.billing[phone]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[email]') ? 'has-error' : '']">
            <div class="mat-div" :class="address.billing.email ? 'is-completed' : ''">
                <label for="billing[email]" class="mat-label">
                    {{ __('shop::app.checkout.onepage.email') }}
                </label>
{{--                    <input type="text" v-validate="'required|email'" class="control mat-input" id="billing[email]" name="billing[email]" placeholder=" " v-model="address.billing.email" data-vv-as="&quot;{{ __('shop::app.checkout.onepage.email') }}&quot;"/>--}}
                <input type="text" v-validate="'email'" class="control mat-input" id="billing[email]" name="billing[email]" placeholder=" " v-model="address.billing.email" data-vv-as="&quot;{{ __('shop::app.checkout.onepage.email') }}&quot;"/>
            </div>
            <span class="control-error" v-if="errors.has('address-form.billing[email]')">
                @{{ errors.first('address-form.billing[email]') }}
            </span>
        </div>
        @guest('customer')
            <div class="form-control" v-if="address.billing.use_for_shipping && this.new_shipping_address">
            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 mt-6 p-4" role="alert">
                <p class="font-serif">{{ __('shop::app.checkout.onepage.address-message') }}</p>
            </div>

            <div class="control-group" :class="[errors.has('address-form.billing[city]') ? 'has-error' : '']">
                <div class="mat-div" :class="address.billing.city ? 'is-completed' : ''">
                    <label for="billing[city]" class="mat-label required">
                        {{ __('shop::app.checkout.onepage.city') }}
                    </label>

                    <input type="text" class="control mat-input required" id="billing[city]" name="billing[city]"
                           v-model="address.billing.city"
                           data-vv-as="&quot;{{ __('shop::app.checkout.onepage.city') }}&quot;"/>
                </div>

                <span class="control-error" v-if="errors.has('address-form.billing[city]')">
                    @{{ errors.first('address-form.billing[city]') }}
                </span>
            </div>

            <div class="control-group" :class="[errors.has('address-form.billing[address1][]') ? 'has-error' : '']">
                <div class="mat-div">
                    <label for="billing_address_0" class="required mat-label">
                        {{ __('shop::app.checkout.onepage.address1') }}
                    </label>

                    <input type="text" v-validate="'required'" class="control mat-input" id="billing_address_0"
                           name="billing[address1][]" v-model="address.billing.address1[0]"
                           data-vv-as="&quot;{{ __('shop::app.checkout.onepage.address1') }}&quot;"/>
                </div>

                <span class="control-error" v-if="errors.has('address-form.billing[address1][]')">
                    @{{ errors.first('address-form.billing[address1][]') }}
                </span>
            </div>
            @if (core()->getConfigData('customer.settings.address.street_lines') && core()->getConfigData('customer.settings.address.street_lines') > 1)
                <div class="control-group" style="margin-top: -25px;">
                    <div class="mat-div">
                    @for ($i = 1; $i < core()->getConfigData('customer.settings.address.street_lines'); $i++)
                        <input type="text" class="control mat-input" name="billing[address1][{{ $i }}]" id="billing_address_{{ $i }}" v-model="address.billing.address1[{{$i}}]">
                    @endfor
                    </div>
                </div>
            @endif
        </div>
        @endguest
        @auth('customer')
            <div class="form-control" v-if="address.billing.use_for_shipping && !this.new_shipping_address">
            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 mt-6 p-4" role="alert">
                <p class="font-serif">{{ __('shop::app.checkout.onepage.address-message') }}</p>
            </div>

            <div class="control-group" :class="[errors.has('address-form.billing[city]') ? 'has-error' : '']">
                <div class="mat-div" :class="address.billing.city ? 'is-completed' : ''">
                    <label for="billing[city]" class="mat-label required">
                        {{ __('shop::app.checkout.onepage.city') }}
                    </label>

                    <input type="text" class="control mat-input required" id="billing[city]" name="billing[city]"
                           v-model="address.billing.city"
                           data-vv-as="&quot;{{ __('shop::app.checkout.onepage.city') }}&quot;"/>
                </div>

                <span class="control-error" v-if="errors.has('address-form.billing[city]')">
                    @{{ errors.first('address-form.billing[city]') }}
                </span>
            </div>

            <div class="control-group" :class="[errors.has('address-form.billing[address1][]') ? 'has-error' : '']">
                <div class="mat-div">
                    <label for="billing_address_0" class="required mat-label">
                        {{ __('shop::app.checkout.onepage.address1') }}
                    </label>

                    <input type="text" v-validate="'required'" class="control mat-input" id="billing_address_0"
                           name="billing[address1][]" v-model="address.billing.address1[0]"
                           data-vv-as="&quot;{{ __('shop::app.checkout.onepage.address1') }}&quot;"/>
                </div>

                <span class="control-error" v-if="errors.has('address-form.billing[address1][]')">
                    @{{ errors.first('address-form.billing[address1][]') }}
                </span>
            </div>
            @if (core()->getConfigData('customer.settings.address.street_lines') && core()->getConfigData('customer.settings.address.street_lines') > 1)
                <div class="control-group" style="margin-top: -25px;">
                    <div class="mat-div">
                        @for ($i = 1; $i < core()->getConfigData('customer.settings.address.street_lines'); $i++)
                            <input type="text" class="control mat-input" name="billing[address1][{{ $i }}]" id="billing_address_{{ $i }}" v-model="address.billing.address1[{{$i}}]">
                        @endfor
                    </div>
                </div>
            @endif
        </div>
        @endauth

            <div class="control-group mt-6">
                <span class="checkbox">
                    <input type="checkbox" id="billing[use_for_shipping]" name="billing[use_for_shipping]" v-model="address.billing.use_for_shipping"/>
                    <label class="checkbox-view text-gray-dark" for="billing[use_for_shipping]"></label>
                    {{ __('shop::app.checkout.onepage.use_for_shipping') }}
                </span>
            </div>

{{--        @auth('customer')--}}
{{--            @if(count(auth('customer')->user()->addresses))--}}
{{--                <a class="btn btn-primary py-3 px-6" @click = backToSavedBillingAddress()>--}}
{{--                    {{ __('shop::app.checkout.onepage.back') }}--}}
{{--                </a>--}}
{{--            @endif--}}
{{--        @endauth--}}



    @auth('customer')

            <div class="control-group" v-if="address.billing.use_for_shipping && this.new_shipping_address">
                <span class="checkbox">
                    <input type="checkbox" id="billing[save_as_address]" name="billing[save_as_address]" v-model="address.billing.save_as_address"/>
                    <label class="checkbox-view text-gray-dark" for="billing[save_as_address]"></label>
                    {{ __('shop::app.checkout.onepage.save_as_address') }}
                </span>
            </div>
    @endauth

    </div>

        <div class="form-container" v-if="!address.billing.use_for_shipping && !this.new_shipping_address">
            <div class="form-header mb-10 w-full flex justify-end items-center">
                <span class="checkout-step-heading font-serif font-medium uppercase mr-6">{{ __('shop::app.checkout.onepage.shipping-address') }}</span>

                <a class="btn btn-lg btn-primary py-3 px-6" @click=newShippingAddress()>
                    {{ __('shop::app.checkout.onepage.new-address') }}
                </a>
            </div>

            <div class="address-holder">
                <div class="address-card" v-for='(addresses, index) in this.allAddress'>
                    <div class="checkout-address-content" style="display: flex; flex-direction: row; justify-content: space-between; width: 100%;">
                        <label class="radio-container" style="float: right; width: 10%;">
                            <input v-validate="'required'" type="radio" id="shipping[address_id]" name="shipping[address_id]" v-model="address.shipping.address_id" :value="addresses.id"
                            data-vv-as="&quot;{{ __('shop::app.checkout.onepage.shipping-address') }}&quot;">
                            <span class="checkmark"></span>
                        </label>

                        <ul class="address-card-list" style="float: right; width: 85%;">
                            <li class="mb-5">
                                <b>@{{ allAddress.first_name }} @{{ allAddress.last_name }},</b>
                            </li>

                            <li class="mb-2">
                                @{{ addresses.city }},
                            </li>

                            <li class="mb-2">
                                @{{ addresses.address1 }},
                            </li>

{{--                            <li class="mb-5">--}}
{{--                                @{{ addresses.state }},--}}
{{--                            </li>--}}

{{--                            <li class="mb-15">--}}
{{--                                @{{ addresses.country }}.--}}
{{--                            </li>--}}

                            <li>
                                <b>{{ __('shop::app.customer.account.address.index.contact') }}</b> : @{{ addresses.phone }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="control-group" :class="[errors.has('address-form.shipping[address_id]') ? 'has-error' : '']">
                    <span class="control-error" v-if="errors.has('address-form.shipping[address_id]')">
                        @{{ errors.first('address-form.shipping[address_id]') }}
                    </span>
                </div>

            </div>
        </div>

        <div class="form-container" v-if="!address.billing.use_for_shipping && this.new_shipping_address">

            <div class="form-header w-full flex justify-end items-center">
                <div class="font-serif font-medium uppercase mr-3">{{ __('shop::app.checkout.onepage.shipping-address') }}</div>
                @auth('customer')
                    @if(count(auth('customer')->user()->addresses))
                        <a class="btn btn-primary py-3 px-6 -mt-8" @click = backToSavedShippingAddress()>
                            {{ __('shop::app.checkout.onepage.back') }}
                        </a>
                    @endif
                @endauth
            </div>

            <div class="control-group" :class="[errors.has('address-form.shipping[first_name]') ? 'has-error' : '']">
                <div class="mat-div" :class="address.shipping.first_name ? 'is-completed' : ''">
                    <label for="shipping[first_name]" class="required mat-label">
                        {{ __('shop::app.checkout.onepage.first-name') }}
                    </label>

                    <input type="text" v-validate="'required'" class="control mat-input" id="shipping[first_name]" name="shipping[first_name]" v-model="address.shipping.first_name" data-vv-as="&quot;{{ __('shop::app.checkout.onepage.first-name') }}&quot;"/>
                </div>
                <span class="control-error" v-if="errors.has('address-form.shipping[first_name]')">
                    @{{ errors.first('address-form.shipping[first_name]') }}
                </span>
            </div>

            <div class="control-group" :class="[errors.has('address-form.shipping[last_name]') ? 'has-error' : '']">
                <div class="mat-div" :class="address.shipping.last_name ? 'is-completed' : ''">
                    <label for="shipping[last_name]" class="required mat-label">
                        {{ __('shop::app.checkout.onepage.last-name') }}
                    </label>

                    <input type="text" v-validate="'required'" class="control mat-input" id="shipping[last_name]" name="shipping[last_name]" v-model="address.shipping.last_name" data-vv-as="&quot;{{ __('shop::app.checkout.onepage.last-name') }}&quot;"/>
                </div>
                <span class="control-error" v-if="errors.has('address-form.shipping[last_name]')">
                    @{{ errors.first('address-form.shipping[last_name]') }}
                </span>
            </div>

            <div class="control-group" :class="[errors.has('address-form.shipping[phone]') ? 'has-error' : '']">
                <div class="mat-div" :class="address.shipping.phone ? 'is-completed' : ''">
                    <label for="shipping[phone]" class="required mat-label">
                        {{ __('shop::app.checkout.onepage.phone') }}
                    </label>

                    <input type="text" v-validate="'required'" class="control mat-input" id="shipping[phone]" name="shipping[phone]" v-model="address.shipping.phone" data-vv-as="&quot;{{ __('shop::app.checkout.onepage.phone') }}&quot;"/>
                </div>
                <span class="control-error" v-if="errors.has('address-form.shipping[phone]')">
                    @{{ errors.first('address-form.shipping[phone]') }}
                </span>
            </div>

            <div class="control-group" :class="[errors.has('address-form.shipping[email]') ? 'has-error' : '']">
                <div class="mat-div" :class="address.shipping.email ? 'is-completed' : ''">
                    <label for="shipping[email]" class="mat-label">
                        {{ __('shop::app.checkout.onepage.email') }}
                    </label>

                    <input type="text" v-validate="'email'" class="control" id="shipping[email]" name="shipping[email]" v-model="address.shipping.email" data-vv-as="&quot;{{ __('shop::app.checkout.onepage.email') }}&quot;"/>
                </div>
                <span class="control-error" v-if="errors.has('address-form.shipping[email]')">
                    @{{ errors.first('address-form.shipping[email]') }}
                </span>
            </div>

            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 mt-6 p-4" role="alert">
                <p class="font-serif">{{ __('shop::app.checkout.onepage.address-message') }}</p>
            </div>

            <div class="control-group" :class="[errors.has('address-form.shipping[city]') ? 'has-error' : '']">
                <div class="mat-div" :class="address.shipping.city ? 'is-completed' : ''">
                    <label for="shipping[city]" class="required mat-label">
                        {{ __('shop::app.checkout.onepage.city') }}
                    </label>

                    <input type="text" v-validate="'required'" class="control mat-input" id="shipping[city]" name="shipping[city]" v-model="address.shipping.city" data-vv-as="&quot;{{ __('shop::app.checkout.onepage.city') }}&quot;"/>
                </div>
                <span class="control-error" v-if="errors.has('address-form.shipping[city]')">
                    @{{ errors.first('address-form.shipping[city]') }}
                </span>
            </div>

            <div class="control-group" :class="[errors.has('address-form.shipping[address1][]') ? 'has-error' : '']">
                <div class="mat-div" :class="address.shipping.address1[0] ? 'is-completed' : ''">
                    <label for="shipping_address_0" class="required mat-label">
                        {{ __('shop::app.checkout.onepage.address1') }}
                    </label>

                    <input type="text" v-validate="'required'" class="control mat-input" id="shipping_address_0" name="shipping[address1][]" v-model="address.shipping.address1[0]" data-vv-as="&quot;{{ __('shop::app.checkout.onepage.address1') }}&quot;"/>
                </div>
                <span class="control-error" v-if="errors.has('address-form.shipping[address1][]')">
                    @{{ errors.first('address-form.shipping[address1][]') }}
                </span>
            </div>

            @if (core()->getConfigData('customer.settings.address.street_lines') && core()->getConfigData('customer.settings.address.street_lines') > 1)
                <div class="control-group" style="margin-top: -25px;">
                    <div class="mat-div is-completed">
                    @for ($i = 1; $i < core()->getConfigData('customer.settings.address.street_lines'); $i++)
                        <input type="text" class="control mat-input" name="shipping[address1][{{ $i }}]" id="shipping_address_{{ $i }}" v-model="address.shipping.address1[{{$i}}]">
                    @endfor
                </div>
            @endif


            @auth('customer')
                <div class="control-group">
                    <span class="checkbox">
                        <input type="checkbox" id="shipping[save_as_address]" name="shipping[save_as_address]" v-model="address.shipping.save_as_address"/>
                            <label class="checkbox-view text-gray-dark" for="shipping[save_as_address]"></label>
                        {{ __('shop::app.checkout.onepage.save_as_address') }}
                    </span>
                </div>
            @endauth

        </div>

</form>

@push('scripts')
    <script>

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function() {
            $("#password").hide();
            $('#login-and-forgot-btn').hide();
            $("[name='billing[email]']").on('blur', function() {
                //get the given emai
                var email = $("[name='billing[email]']").val();

                $.ajax({
                    /* the route pointing to the post function */
                    url: '{{ route('customer.checkout.exist') }}',
                    type: 'POST',

                    /* send the csrf-token and the input to the controller with data */
                    data: {'_token': CSRF_TOKEN,
                            'email': email },
                    dataType: 'JSON',

                    /* remind that 'data' is the response of the OnePageController */
                    success: function (data) {
                        if (data == true) {
                            $("#password").show();
                            $('#login-and-forgot-btn').show();
                        } else {
                            $("#password").hide();
                            $('#login-and-forgot-btn').hide();
                            }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.btn-login').click(function(e) {
                var email = $("[name='billing[email]']").val();
                var password = $("[name='password']").val();
                event.preventDefault();
                $.ajax({

                    /* the route pointing to the post function */
                    url: '{{ route('customer.checkout.login') }}',
                    type: 'POST',

                    /* send the csrf-token and the input to the controller with data */
                    data: {'_token': CSRF_TOKEN,
                            'email': email,
                            'password': password
                        },
                    dataType: 'JSON',

                    /* remind that 'data' is the response of the OnePageController */
                    success: function (response) {

                        if (response.success) {
                            window.location.href = "{{ route('shop.checkout.onepage.index') }}";
                        } else {
                            var appendData =  '<div class="alert alert-error"><span class="icon white-cross-sm-icon"></span><p>'+response.error+'</p></div>';
                            $('.alert-wrapper').html('');
                            $('.alert-wrapper').append(appendData);

                            setTimeout(function () {
                                $('.alert-error').hide();
                            }, 5000);
                            Success = false;
                        }
                    },
                });
            });
        });
    </script>

@endpush
