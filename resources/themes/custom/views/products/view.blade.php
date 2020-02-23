@extends('shop::layouts.master')

@section('page_title')
    {{ trim($product->meta_title) != "" ? $product->meta_title : $product->name }}
@stop

@section('seo')
    <meta name="description"
          content="{{ trim($product->meta_description) != "" ? $product->meta_description : str_limit(strip_tags($product->description), 120, '') }}"/>
    <meta name="keywords" content="{{ $product->meta_keywords }}"/>
@stop

@section('content-wrapper')
    @inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
    @inject ('categoryRepository', 'Webkul\Category\Repositories\CategoryRepository')

    <?php
    $path = parse_url(\Illuminate\Support\Facades\Request::path(), PHP_URL_PATH);
    $path_slug = explode("/", $path);
    $category_slug = $path_slug[sizeof($path_slug) - 2];


    $categories = [];
    $parent_id = NULL;
    $category = app('Webkul\Category\Repositories\CategoryRepository')->findBySlugOrFail($category_slug);
    $parent_id = $category->parent_id;

    $categories = [];
    $parent_id = $category->parent_id;
    $current_id = $category->id;
    while ($parent_id != NULL) {
        $result = app('Webkul\Category\Repositories\CategoryRepository')->findOrFail($parent_id);
        if (isset($result->parent_id)) {
            if ($result->parent_id != NULL && $result->parent_id > 1) {
                $categories[] = $result;
                $parent_id = $result->parent_id;
                $current_id = $result->id;
            } else {
                break;
            }
        } else {
            break;
        }
    }
    $categories = array_reverse($categories);

    $categoryCollection = null;
    $product_categories = $productRepository->find($product->id);

    if($product_categories) {
        foreach ($product_categories->categories()->get() as $category) {
            if ($category->display_mode == "collections_only") {
                $categoryCollection = $category;
                break;
            }
        }
    }
    ?>

    {!! view_render_event('bagisto.shop.products.view.before', ['product' => $product]) !!}

    <section class="product-detail">

        <div class="layouter">
            <product-view>
                <div class="form-container">
                    @csrf()
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                    <div class="w-full bg-cover h-full sm:h-132"
                         style="background-image: url('/themes/custom/assets/images/banner/bg_card.jpg');">

                        <div class="main-container-wrapper flex flex-col sm:flex-row my-4">
                            <div class="w-full sm:w-1/2">
                                <div class="block text-base">
                                    {{ Breadcrumbs::render('categories', $categories,  $category) }}
                                </div>
                                @include ('shop::products.view.gallery')
                            </div>
                            <div class="w-full sm:w-1/2">
                                <div class="details w-full font-serif flex flex-col justify-center content-between h-132 flex-wrap">
                                    <div class="product-heading font-serif text-gray-dark text-center my-3">
                                        @if ($categoryCollection)
                                            <div class="text-lg font-medium hover:text-gray-silver">
                                                <a href="{{ route('shop.categories.index', $categoryCollection->slug) }}"
                                                   title="{{ $categoryCollection->name }}">
                                                    {{ $categoryCollection->name }} </a>
                                            </div>
                                        @endif

                                        <p class="font-medium uppercase text-xl sm:text-3xl leading-tight">{{ $product->name }}</p>
                                        <p class="text-gray-silver text-lg">
                                            {{ number_format($product->weight) }}{{ __('shop::app.products.weight-unit') }}
                                        </p>
                                    </div>

                                    {!! view_render_event('bagisto.shop.products.view.short_description.before', ['product' => $product]) !!}
                                    <div class="description px-0 sm:px-6 text-center text-gray-dark my-3 overflow-hidden" style="max-height: 8rem;">
                                        {!! str_limit($product->short_description, 160)  !!}
                                        <a class="right-0 bottom-0 text-gold font-serif underline hover:no-underline lowercase" href="#product-description">{{ __('shop::app.products.show-more') }}</a>
                                    </div>
                                    {!! view_render_event('bagisto.shop.products.view.short_description.after', ['product' => $product]) !!}

                                    <div class="w-full text-center font-medium my-3">
                                        @include ('shop::products.review', ['product' => $product])

                                        @include ('shop::products.price', ['product' => $product])

                                        {{--                                        @include ('shop::products.view.stock', ['product' => $product])--}}
                                        @include ('shop::products.view.product-add')

                                    </div>

                                    {!! view_render_event('bagisto.shop.products.view.quantity.before', ['product' => $product]) !!}

                                    @if ($product->getTypeInstance()->showQuantityBox())
                                        <quantity-changer></quantity-changer>
                                    @else
                                        <input type="hidden" name="quantity" value="1">
                                    @endif
                                    {!! view_render_event('bagisto.shop.products.view.quantity.after', ['product' => $product]) !!}


                                    @include ('shop::products.view.configurable-options')
                                    @include ('shop::products.view.grouped-products')
                                    @include ('shop::products.view.bundle-options')

                                    {{--                                    @include ('shop::products.view.downloadable')--}}



                                    {!! view_render_event('bagisto.shop.products.view.description.before', ['product' => $product]) !!}

                                    <div class="w-full flex justify-center my-6">
                                        @include ('shop::products.view.attributes-shipping')
                                    </div>

                                    {{--                                    @include ('shop::products.view.reviews')--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full flex flex-col sm:flex-row">
                        <div class="w-full sm:w-1/2">
{{--                            @include ('shop::products.view.gallery-2')--}}
                        </div>
                        <div class="w-full h-140 sm:h-132 sm:w-1/2 relative bg-gray-dark-grey flex content-start sm:content-center flex-wrap h-140 sm:h-132">
                            <img  class="content-container h-10 sm:h-12 w-auto absolute inset-x-0 top-0 mx-auto sm:ml-12 my-8"
                                src="/themes/custom/assets/images/logo.png"/>
                            <div
                                class="text-white leading-none sm:ml-12 flex flex-row sm:flex-col block mx-auto mt-20 sm:mt-0">
                                <div class="sm:mb-10">
                                    <p class="font-medium italic text-7xl">15%</p><span
                                        class="font-serif text-2xl sm:text-4xl">Витамина С</span>
                                </div>
                                <div class="ml-8 sm:ml-0">
                                    <p class="font-medium italic text-7xl">15%</p><span
                                        class="font-serif text-2xl sm:text-4xl">Арбутина</span>
                                </div>
                            </div>
                            <div class="absolute object-contain inset-x-0 bottom-0"><img
                                    src="/themes/custom/assets/images/banner/happy-girl.png" alt="banner image"
                                    class="max-w-sm mx-auto sm:ml-auto sm:mr-10 h-88 sm:h-112">
                            </div>
                        </div>
                    </div>


                </div>
            </product-view>
        </div>
        @include('shop::home.jean-niel')

        <div class="w-full flex justify-center mb-6">
            @include ('shop::products.view.attributes-description')
        </div>

        @include("shop::home.research")

        @if($product->banner_key != null)
            @include("shop::products.view.banner", ['banner_key' => $product->banner_key])
        @endif

        @include ('shop::products.view.related-products')

        @include ('shop::products.view.up-sells')


        {!! view_render_event('bagisto.shop.products.view.after', ['product' => $product]) !!}
        @endsection

        @push('scripts')

            <script type="text/x-template" id="product-view-template">
                <form method="POST" id="product-form" action="{{ route('cart.add', $product->product_id) }}"
                      @click="onSubmit($event)">

                    <input type="hidden" name="is_buy_now" v-model="is_buy_now">

                    <slot></slot>

                </form>
            </script>

            <script type="text/x-template" id="quantity-changer-template">
                <div class="quantity control-group hidden" :class="[errors.has(controlName) ? 'has-error' : '']">
                    <label class="required">{{ __('shop::app.products.quantity') }}</label>

                    <button type="button outline-none" class="decrease" @click="decreaseQty()">-</button>

                    <input :name="controlName" class="control" :value="qty" :v-validate="validations"
                           data-vv-as="&quot;{{ __('shop::app.products.quantity') }}&quot;" readonly>

                    <button type="button" class="increase outline-none" @click="increaseQty()">+</button>

                    <span class="control-error" v-if="errors.has(controlName)">@{{ errors.first(controlName) }}</span>
                </div>
            </script>

            <script>

                Vue.component('product-view', {

                    template: '#product-view-template',

                    inject: ['$validator'],

                    data: function () {
                        return {
                            is_buy_now: 0,
                        }
                    },

                    methods: {
                        onSubmit: function (e) {
                            if (e.target.getAttribute('type') != 'submit')
                                return;

                            e.preventDefault();

                            var this_this = this;

                            this.$validator.validateAll().then(function (result) {
                                if (result) {
                                    this_this.is_buy_now = e.target.classList.contains('buynow') ? 1 : 0;

                                    setTimeout(function () {
                                        document.getElementById('product-form').submit();
                                    }, 0);
                                }
                            });
                        }
                    }
                });

                Vue.component('quantity-changer', {
                    template: '#quantity-changer-template',

                    inject: ['$validator'],

                    props: {
                        controlName: {
                            type: String,
                            default: 'quantity'
                        },

                        quantity: {
                            type: [Number, String],
                            default: 1
                        },

                        minQuantity: {
                            type: [Number, String],
                            default: 1
                        },

                        validations: {
                            type: String,
                            default: 'required|numeric|min_value:1'
                        }
                    },

                    data: function () {
                        return {
                            qty: this.quantity
                        }
                    },

                    watch: {
                        quantity: function (val) {
                            this.qty = val;

                            this.$emit('onQtyUpdated', this.qty)
                        }
                    },

                    methods: {
                        decreaseQty: function () {
                            if (this.qty > this.minQuantity)
                                this.qty = parseInt(this.qty) - 1;

                            this.$emit('onQtyUpdated', this.qty)
                        },

                        increaseQty: function () {
                            this.qty = parseInt(this.qty) + 1;

                            this.$emit('onQtyUpdated', this.qty)
                        }
                    }
                });

                $(document).ready(function () {
                    // var addTOButton = document.getElementsByClassName('add-to-buttons')[0];
                    document.getElementById('loader').style.display = "none";
                    // addTOButton.style.display = "flex";
                });

                window.onload = function () {
                    var thumbList = document.getElementsByClassName('thumb-list')[0];
                    var thumbFrame = document.getElementsByClassName('thumb-frame');
                    var productHeroImage = document.getElementsByClassName('product-hero-image')[0];

                    if (thumbList && productHeroImage) {

                        for (let i = 0; i < thumbFrame.length; i++) {
                            thumbFrame[i].style.height = (productHeroImage.offsetHeight / 4) + "px";
                            thumbFrame[i].style.width = (productHeroImage.offsetHeight / 4) + "px";
                        }

                        if (screen.width > 720) {
                            thumbList.style.width = (productHeroImage.offsetHeight / 4) + "px";
                            thumbList.style.minWidth = (productHeroImage.offsetHeight / 4) + "px";
                            thumbList.style.height = productHeroImage.offsetHeight + "px";
                        }
                    }

                    window.onresize = function () {
                        if (thumbList && productHeroImage) {

                            for (let i = 0; i < thumbFrame.length; i++) {
                                thumbFrame[i].style.height = (productHeroImage.offsetHeight / 4) + "px";
                                thumbFrame[i].style.width = (productHeroImage.offsetHeight / 4) + "px";
                            }

                            if (screen.width > 720) {
                                thumbList.style.width = (productHeroImage.offsetHeight / 4) + "px";
                                thumbList.style.minWidth = (productHeroImage.offsetHeight / 4) + "px";
                                thumbList.style.height = productHeroImage.offsetHeight + "px";
                            }
                        }
                    }
                };
            </script>
    @endpush