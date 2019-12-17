@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.promotion.edit-gift-rule') }}
@stop

@section('content')
    <div class="content">
        <gift-rule></gift-rule>
    </div>


    @push('scripts')
        <script type="text/x-template" id="gift-rule-form-template">
            <div>
                <form method="POST" action="{{ route('admin.gift-rule.update', $gift_rule[0]->id) }}" @submit.prevent="onSubmit">
                    @csrf

                    <div class="page-header">
                        <div class="page-title">
                            <h1>
                                <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                                {{ __('admin::app.promotion.edit-gift-rule') }}
                            </h1>
                        </div>

                        <div class="page-action">
                            <button type="submit" class="btn btn-lg btn-primary">
                                {{ __('admin::app.promotion.edit-btn-title') }}
                            </button>
                        </div>
                    </div>

                    <div class="page-content">
                        <div class="form-container">
                            @csrf()

                            <accordian :active="true" title="{{ __('admin::app.promotion.information') }}">
                                <div slot="body">
                                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                        <label for="name" class="required">{{ __('admin::app.promotion.general-info.name') }}</label>

                                        <input type="text" class="control" name="name" v-model="name" v-validate="'required'" value="{{ old('name') }}" data-vv-as="&quot;{{ __('admin::app.promotion.general-info.name') }}&quot;">

                                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('customer_groups[]') ? 'has-error' : '']">
                                        <label for="customer_groups" class="required">{{ __('admin::app.promotion.general-info.cust-groups') }}</label>

                                        <select type="text" class="control" name="customer_groups[]" v-model="customer_groups" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.promotion.general-info.cust-groups') }}&quot;" multiple="multiple">
                                            <option disabled="disabled">Select Customer Groups</option>
                                            @foreach(app('Webkul\Customer\Repositories\CustomerGroupRepository')->all() as $channel)
                                                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                            @endforeach
                                        </select>

                                        <span class="control-error" v-if="errors.has('customer_groups[]')">@{{ errors.first('customer_groups[]') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('channels[]') ? 'has-error' : '']">
                                        <label for="channels" class="required">{{ __('admin::app.promotion.general-info.channels') }}</label>

                                        <select type="text" class="control" name="channels[]" v-model="channels" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.promotion.general-info.channels') }}&quot;" multiple="multiple">
                                            <option disabled="disabled">Select Channels</option>
                                            @foreach(app('Webkul\Core\Repositories\ChannelRepository')->all() as $channel)
                                                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                            @endforeach
                                        </select>

                                        <span class="control-error" v-if="errors.has('channels[]')">@{{ errors.first('status') }}</span>
                                    </div>

                                    <div class="control-group" :class="[errors.has('status') ? 'has-error' : '']">
                                        <label for="status" class="required">{{ __('admin::app.promotion.general-info.status') }}</label>

                                        <select type="text" class="control" name="status" v-model="status" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.promotion.general-info.status') }}&quot;">
                                            <option disabled="disabled">{{ __('admin::app.promotion.select-attribute', ['attribute' => 'Option']) }}</option>
                                            <option value="1">{{ __('admin::app.promotion.yes') }}</option>
                                            <option value="0">{{ __('admin::app.promotion.no') }}</option>
                                        </select>

                                        <span class="control-error" v-if="errors.has('status')">@{{ errors.first('status') }}</span>
                                    </div>
                                </div>
                            </accordian>

                            <accordian :active="false" title="{{ __('admin::app.promotion.actions') }}">
                                <div slot="body">
                                    <div class="control-group" :class="[errors.has('action_amount') ? 'has-error' : '']">

                                        <label for="action_amount" class="required">{{ __('admin::app.promotion.general-info.amount') }}</label>

                                        <span class="currency-code">({{ core()->currencySymbol(core()->getBaseCurrencyCode()) }})</span>

                                        <input type="text" v-validate="'required'" v-model="action_amount" class="control" name="action_amount" value="{{ old('action_amount') }}" data-vv-as="&quot;{{  __('admin::app.promotion.general-info.amount') }}&quot;"/>

                                        <span class="control-error"  v-if="errors.has('action_amount')">
                                                @{{ errors.first('action_amount') }}
                                            </span>
                                    </div>
                                </div>
                            </accordian>

                            @include('admin::promotions.gift-rule.accordians.product-links')

                        </div>
                    </div>
                </form>
            </div>
        </script>

        <script>
            Vue.component('gift-rule', {
                template: '#gift-rule-form-template',

                inject: ['$validator'],

                data () {
                    return {
                        name: '{{ $gift_rule[0]->name }}',
                        channels: '{{ $gift_rule[1] }}',
                        customer_groups: '{{ $gift_rule[2] }}',
                        status: '{{ $gift_rule[0]->status }}',
                        action_amount: '{{ $gift_rule[0]->action_amount }}'
                    }
                },

                mounted () {
                    gift_rule = @json($gift_rule[0]);
                    channels = @json($gift_rule[0]->channels);

                    this.channels = [];
                    for (i in channels) {
                        this.channels.push(channels[i].channel_id);

                    }
                    customer_groups = @json($gift_rule[0]->customer_groups);

                    this.customer_groups = [];
                    for (i in customer_groups) {
                        this.customer_groups.push(customer_groups[i].customer_group_id);
                    }

                    this.action_amount = '{{ $gift_rule[0]->action_amount }}';
                },

                methods: {
                    created() {
                    },

                    onSubmit: function (e) {

                        this.$validator.validateAll().then(result => {
                            if (result) {
                                e.target.submit();
                            }
                        });
                    },

                    addFlashMessages() {
                        const flashes = this.$refs.flashes;

                        flashMessages.forEach(function(flash) {
                            flashes.addFlash(flash);
                        }, this);
                    }
                }
            });
        </script>
    @endpush
@stop