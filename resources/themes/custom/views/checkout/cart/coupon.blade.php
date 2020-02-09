@if ($cart)
    <script type="text/x-template" id="coupon-component-template">
        <div class="coupon-container my-6">
            <div class="discount-control">
                <form class="coupon-form" method="post" @submit.prevent="applyCoupon">

                    <div class="control-group flex" :class="[error_message ? 'has-error' : '']">
                        <div class="mat-div w-full">
                            <label for="code" class="normal-case mat-label">{{ __('shop::app.checkout.onepage.enter-coupon-code') }}</label>
                            <input type="text" class="control mat-input" v-model="coupon_code" name="code">
                        </div>
                        <button class="border-b border-transparent hover:border-b hover:border-gold w-1/3 normal-case text-gold pt-8 px-3" :disabled="disable_button">{{ __('shop::app.checkout.onepage.apply-coupon') }}</button>

                        <div class="control-error">@{{ error_message }}</div>
                    </div>


                </form>
            </div>

            <div class="applied-coupon-details" v-if="applied_coupon">
                <label>{{ __('shop::app.checkout.total.coupon-applied') }}</label>

                <label class="right" style="display: inline-flex; align-items: center;">
                    <b>@{{ applied_coupon }}</b>

                    <span class="icon cross-icon" title="{{ __('shop::app.checkout.total.remove-coupon') }}" v-on:click="removeCoupon"></span>
                </label>
            </div>
        </div>
    </script>

    <script>
        Vue.component('coupon-component', {
            template: '#coupon-component-template',

            inject: ['$validator'],

            data: function() {
                return {
                    coupon_code: '',

                    applied_coupon: "{{ $cart->coupon_code }}",

                    error_message: '',

                    route_name: "{{ request()->route()->getName() }}",

                    disable_button: false
                }
            },

            methods: {
                applyCoupon: function() {
                    var self = this;

                    if (! self.coupon_code.length)
                        return;

                    self.error_message = null;

                    self.disable_button = true;

                    axios.post('{{ route('shop.checkout.cart.coupon.apply') }}', {code: self.coupon_code})
                        .then(function(response) {
                            if (response.data.success) {
                                self.$emit('onApplyCoupon');

                                self.applied_coupon = self.coupon_code;

                                self.coupon_code = '';

                                window.flashMessages = [{'type': 'alert-success', 'message': response.data.message}];

                                self.$root.addFlashMessages();

                                self.redirectIfCartPage();
                            } else {
                                self.error_message = response.data.message;
                            }

                            self.disable_button = false;
                        })
                        .catch(function(error) {
                            self.error_message = error.response.data.message;

                            self.disable_button = false;
                        });
                },

                removeCoupon: function () {
                    var self = this;

                    axios.delete('{{ route('shop.checkout.coupon.remove.coupon') }}')
                        .then(function(response) {
                            self.$emit('onRemoveCoupon')

                            self.applied_coupon = '';

                            window.flashMessages = [{'type': 'alert-success', 'message': response.data.message}];

                            self.$root.addFlashMessages();

                            self.redirectIfCartPage();
                        })
                        .catch(function(error) {
                            window.flashMessages = [{'type': 'alert-error', 'message': error.response.data.message}];

                            self.$root.addFlashMessages();
                        });
                },

                redirectIfCartPage: function() {
                    if (this.route_name != 'shop.checkout.cart.index')
                        return;

                    setTimeout(function() {
                        window.location.reload();
                    }, 700);
                }
            }
        });
    </script>
@endif