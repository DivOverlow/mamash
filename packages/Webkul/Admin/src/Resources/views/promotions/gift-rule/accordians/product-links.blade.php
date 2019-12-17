{!! view_render_event('bagisto.admin.promotions.gift-rule.edit_form_accordian.product_links.before', ['gift_rule' => $gift_rule[0]]) !!}

<accordian :title="'{{ __('admin::app.promotion.product-link') }}'" :active="false">
    <div slot="body">

        <linked-products></linked-products>

    </div>
</accordian>

{!! view_render_event('bagisto.admin.promotions.gift-rule.edit_form_accordian.product_links.before', ['gift_rule' => $gift_rule[0]]) !!}

@push('scripts')

<script type="text/x-template" id="linked-products-template">
    <div>

        <div class="control-group">
            <label for="related_products">
                {{ __('admin::app.catalog.products.related-products') }}
            </label>

            <input type="text" class="control" autocomplete="off" v-model="search_term" placeholder="{{ __('admin::app.catalog.products.product-search-hint') }}" v-on:keyup="search">

            <div class="linked-product-search-result">
                <ul>
                    <li v-for='(product, index) in products' v-if='products.length' @click="addProduct(product)">
                        @{{ product.name }}
                    </li>

                    <li v-if='! products.length && search_term.length && ! is_searching'>
                        {{ __('admin::app.catalog.products.no-result-found') }}
                    </li>

                    <li v-if="is_searching && search_term.length">
                        {{ __('admin::app.catalog.products.searching') }}
                    </li>
                </ul>
            </div>

            <input type="hidden" name="related_products[]" v-for='(product, index) in addedProducts' v-if="addedProducts.length" :value="product.id"/>

            <span class="filter-tag" style="text-transform: capitalize; margin-top: 10px; margin-right: 0px; justify-content: flex-start" v-if="addedProducts.length">
                <span class="wrapper" style="margin-left: 0px; margin-right: 10px;" v-for='(product, index) in addedProducts'>
                    @{{ product.name }}
                <span class="icon cross-icon" @click="removeProduct(product)"></span>
                </span>
            </span>
        </div>

    </div>
</script>

<script>

    Vue.component('linked-products', {

        template: '#linked-products-template',

        data: function() {
            return {
                products: [],

                search_term: '',

                addedProducts: [],

                is_searching: false,

                productId: {{ $gift_rule[0]->id }},

                linkedProducts: 'related_products',

                relatedProducts: @json($gift_rule[0]->related_products()->get()),
            }
        },

        created: function () {
            if (this.relatedProducts.length >= 1) {
                for (var index in this.relatedProducts) {
                    console.log(this.relatedProducts[index]);
                    this.addedProducts.push(this.relatedProducts[index]);
                }
            }
        },

        methods: {
            addProduct: function (product) {
                this.addedProducts.push(product);
                this.search_term = '';
                this.products = []
            },

            removeProduct: function (product) {
                for (var index in this.addedProducts) {
                    if (this.addedProducts[index].id == product.id ) {
                        this.addedProducts.splice(index, 1);
                    }
                }
            },

            search: function () {
                this_this = this;

                this.is_searching = true;

                if (this.search_term.length >= 1) {
                    this.$http.get ("{{ route('admin.catalog.products.productlinksearch') }}", {params: {query: this.search_term}})
                        .then (function(response) {

                            for (var index in response.data) {
                                if (response.data[index].id == this_this.productId) {
                                    response.data.splice(index, 1);
                                }
                            }

                            if (this_this.addedProducts.length) {
                                for (var product in this_this.addedProducts) {
                                    for (var productId in response.data) {
                                        if (response.data[productId].id == this_this.addedProducts[product].id) {
                                            response.data.splice(productId, 1);
                                        }
                                    }
                                }
                            }

                            this_this.products = response.data;

                            this_this.is_searching = false;
                        })

                        .catch (function (error) {
                            this_this.is_searching = false;
                        })
                } else {
                    this_this.products = [];
                    this_this.is_searching = false;
                }
            }
        }
    });

</script>

@endpush