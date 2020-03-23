@inject ('attributeRepository', 'Webkul\Attribute\Repositories\AttributeRepository')

@inject ('productFlatRepository', 'Webkul\Product\Repositories\ProductFlatRepository')

@inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')

<?php
    $filterAttributes = [];

    if (isset($category)) {
        $products = $productRepository->getAll($category->id);

        if (count($category->filterableAttributes) > 0 && count($products)) {
            $filterAttributes = $category->filterableAttributes;
        } else {
            $categoryProductAttributes = $productFlatRepository->getCategoryProductAttribute($category->id);

            if ($categoryProductAttributes) {
                foreach ($attributeRepository->getFilterAttributes() as $filterAttribute) {
                    if (in_array($filterAttribute->id, $categoryProductAttributes)) {
                        $filterAttributes[] = $filterAttribute;
                    } else  if ($filterAttribute ['code'] == 'price') {
                        $filterAttributes[] = $filterAttribute;
                    }
                }

                $filterAttributes = collect($filterAttributes);
            }
        }
    } else {
        $filterAttributes = $attributeRepository->getFilterAttributes();
    }
?>
<div class="layered-filter-wrapper z-20 absolute w-full md:max-w-sm lg:max-w-md" style="transition: left .6s cubic-bezier(.645,.045,.355,1);">

    {!! view_render_event('bagisto.shop.products.list.layered-nagigation.before') !!}

    <div class="responsive-layred-filter text-base mb-20 sm:mb-0">
        <layered-navigation></layered-navigation>
    </div>

    {!! view_render_event('bagisto.shop.products.list.layered-nagigation.after') !!}

</div>

@push('scripts')
    <script type="text/x-template" id="layered-navigation-template">
        <div>
            <div class="filter-content bg-white px-4 py-2 sm:px-10">
                <div class="filter-attributes">
                    <filter-attribute-item v-for='(attribute, index) in attributes' :attribute="attribute" :key="index" :index="index" @onFilterAdded="addFilters(attribute.code, $event)" :appliedFilterValues="appliedFilters[attribute.code]">
                    </filter-attribute-item>
                </div>
                <div class="filter-attribute-button flex justify-between items-center my-6">
                    <span class="clear-filter button-black w-full py-3 normal-case mr-1">
                        {{ __('shop::app.products.remove-filter-link-title') }}
                    </span>

                    <span class="apply-filter-link button-decor w-full py-3 normal-case ml-1" @click.stop="applyFilter()">
                        {{ __('shop::app.products.apply-filter-link-title') }}
                    </span>
                </div>

            </div>
        </div>
    </script>

    <script type="text/x-template" id="filter-attribute-item-template">
        <div class="filter-attributes-item cursor-pointer text-gray-dark uppercase" :class="[active ? 'active' : '']">
            <div class="filter-attributes-title relative" @click="active = !active">
                @{{ attribute.name ? attribute.name : attribute.admin_name }}
                    <span class="remove-filter-link hidden" v-if="appliedFilters.length" @click.stop="clearFilters()">
                        {{ __('shop::app.products.remove-filter-link-title') }}
                    </span>

                <div class="absolute top-0 bottom-0 right-0">
                    <i class="icon" :class="[active ? 'arrow-up-icon' : 'arrow-down-icon']"></i>
                </div>
            </div>

            <div class="filter-attributes-content text-base normal-case">

                <ol class="items" v-if="attribute.type != 'price'">
                    <li class="item" v-for='(option, index) in attribute.options'>

                        <span class="checkbox">
                            <input type="checkbox" :id="option.id" v-bind:value="option.id" v-model="appliedFilters" @change="addFilter($event)"/>
                            <label class="checkbox-view" :for="option.id"></label>
                            @{{ option.label ? option.label : option.admin_name }}
                        </span>

                    </li>
                </ol>

                <div class="price-range-wrapper" v-if="attribute.type == 'price'">
                    <vue-slider
                        ref="slider"
                        v-model="sliderConfig.value"
                        :process-style="sliderConfig.processStyle"
                        :tooltip-style="sliderConfig.tooltipStyle"
                        :max="sliderConfig.max"
                        :lazy="true"
                        @callback="priceRangeUpdated($event)"
                    ></vue-slider>
                </div>
            </div>
        </div>
    </script>

    <script>
        Vue.component('layered-navigation', {

            template: '#layered-navigation-template',

            data: function() {
                return {
                    attributes: @json($filterAttributes),
                    appliedFilters: {}
                }
            },

            created: function () {
                var urlParams = new URLSearchParams(window.location.search);

                //var entries = urlParams.entries();

                //for (let pair of entries) {
                    //this.appliedFilters[pair[0]] = pair[1].split(',');
                //}

                var this_this = this;

                urlParams.forEach(function (value, index) {
                    this_this.appliedFilters[index] = value.split(',');
                });
            },

            methods: {
                addFilters: function (attributeCode, filters) {
                    if (filters.length) {
                        this.appliedFilters[attributeCode] = filters;
                    } else {
                        delete this.appliedFilters[attributeCode];
                    }

                    // this.applyFilter()
                },

                applyFilter: function () {
                    var params = [];

                    for(key in this.appliedFilters) {
                        if (key != 'page') {
                            params.push(key + '=' + this.appliedFilters[key].join(','))
                        }
                    }

                    window.location.href = "?" + params.join('&');
                }
            }
        });

        Vue.component('filter-attribute-item', {

            template: '#filter-attribute-item-template',

            props: ['index', 'attribute', 'appliedFilterValues'],

            data: function() {
                return {
                    appliedFilters: [],

                    active: false,
                    sliderConfig: {
                        value: [
                            0,
                            0
                        ],
                        max: {{ core()->convertPrice($productFlatRepository->getCategoryProductMaximumPrice($category)) }},
                        processStyle: {
                            "backgroundColor": "#FF6472"
                        },
                        tooltipStyle: {
                            "backgroundColor": "#FF6472",
                            "borderColor": "#FF6472"
                        }
                    }
                }
            },

            created: function () {
                if (!this.index)
                    this.active = false;

                if (this.appliedFilterValues && this.appliedFilterValues.length) {
                    this.appliedFilters = this.appliedFilterValues;

                    if (this.attribute.type == 'price') {
                        this.sliderConfig.value = this.appliedFilterValues;
                    }

                    this.active = true;
                }
            },

            methods: {
                addFilter: function (e) {
                    this.$emit('onFilterAdded', this.appliedFilters)
                },

                priceRangeUpdated: function (value) {
                    this.appliedFilters = value;

                    this.$emit('onFilterAdded', this.appliedFilters)
                },

                clearFilters: function () {
                    if (this.attribute.type == 'price') {
                        this.sliderConfig.value = [0, 0];
                    }

                    this.appliedFilters = [];

                    this.$emit('onFilterAdded', this.appliedFilters)
                }
            }

        });

    </script>
@endpush