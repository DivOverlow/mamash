@extends('shop::layouts.master')

@section('page_title')
    {{ $category->meta_title ?? $category->name }}
@stop



@section('seo')
    <meta name="description" content="{{ $category->meta_description }}"/>
    <meta name="keywords" content="{{ $category->meta_keywords }}"/>
@stop


@section('content-wrapper')
    @inject ('productRepository', 'Webkul\Product\Repositories\ProductRepository')
    <section class="hero-content">
        @if ($category->display_mode != 'collections_only')
            <div class="hero-image absolute z-0 w-full mx-auto">
                <div class="container">
                    @if (!is_null($category->image))
                        <img class="logo w-full object-cover object-center h-120" src="{{ $category->image_url }}" alt="{!! $category->name !!}"/>
                    @endif
                </div>
            </div>
            <div class="z-10 overflow-auto bg-black opacity-75 flex items-center h-120 w-full relative">
                <div class="main-container-wrapper">
                    <div class="container-inner -mt-24">
                        <h2 class="text-white text-4xl sm:text-6xl text-center uppercase">{!! $category->name !!}</h2>
                        @if (in_array($category->display_mode, [null, 'description_only', 'products_and_description']))
                            @if ($category->description)
                                <div class="category-description font-serif text-white text-center text-xl sm:text-2xl">
                                    {!! $category->description !!}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </section>
    @if ($category->display_mode == 'collections_only')
        @inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')
        <?php $products = $productRepository->getAll($category->id);
            $more_one =  ($products->count() > 1);
            if (!is_null($category->image)) {
                $category_image_url = $category->image_url;
            }
            else {
                $category_image_url = null;
            }
        ?>
        {!! DbView::make($templateRepository->getTemplate($category->slug))
                ->field('html_content')
                ->with(['category_name' => $category->name, 'category_description' => $category->description,
                            'category_image_url'=> $category->image_url, 'more_one' => $more_one, 'category_image_url' => $category_image_url ])
                ->render() !!}

    @elseif ($category->display_mode == 'gifting_only')
        <div class="main">
            {!! view_render_event('bagisto.shop.products.index.before', ['category' => $category]) !!}

            <div class="main-container-wrapper category-container">
                    @inject ('giftRepository', 'Webkul\Discount\Repositories\GiftRuleRepository')
                    <?php
                        $gift_products = $giftRepository->getGiftsProduct();
                    ?>
                    @foreach($gift_products as $gift_product)
                        @if (isset($gift_product->related_products()->first()->product_id))
                            <?php
                                $action_amount = $gift_product->action_amount;
                                $product = $productRepository->find($gift_product->related_products()->first()->product_id);
                            ?>
                            @if ($product)
                                <div class="product-card bg-white flex flex-col {{($loop->index & 1) ? 'sm:flex-row' : 'sm:flex-row-reverse' }} justify-between items-center my-4 sm:my-0">
                                    @include ('shop::products.list.gift', ['product' => $product, 'evaluation' => $action_amount, 'class' => 'medium'])
                                </div>
                            @endif
                        @endif
                    @endforeach
            </div>
        </div>

            {!! view_render_event('bagisto.shop.products.index.after', ['category' => $category]) !!}

        </div>
    @else
    <div class="main">
        {!! view_render_event('bagisto.shop.products.index.before', ['category' => $category]) !!}

        <div class="category-container text-xs container flex flex-col sm:flex-row z-10 -mt-12 relative">
            <div class="category-block w-full"
                 @if ($category->display_mode == 'description_only') style="width: 100%" @endif>

                @if (in_array($category->display_mode, [null, 'products_only', 'products_and_description']))

                    @inject ('giftRepository', 'Webkul\Discount\Repositories\GiftRuleRepository')
                    <?php
                        $gift_products = $giftRepository->getGiftsProduct();
                        $gift_index = 0;

                        $products = $productRepository->getAll($category->id);
                    ?>

                @if ($products->count())

                        @include ('shop::products.list.toolbar')

                        @inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

                        @if ($toolbarHelper->getCurrentMode() == 'grid')
                            <div class="product-grid-3 flex flex-wrap">
                                @foreach ($products as $productFlat)
                                    @if ($loop->index == 0)

                                        <div class="w-full max-w-md sm:w-1/3 bg-gray-dark text-xs mb-6">
                                                        <div class="hidden p-10 sm:block">
                                                            <?php
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
                                                            ?>

                                                            {{ Breadcrumbs::render('categories', $categories,  $category) }}
                                                        </div>
                                                        <?php
                                                        $categories = [];

                                                        foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree($parent_id) as $value) {
                                                            if ($value->slug) {
                                                                $categories[] = $value;
                                                            }
                                                        }
                                                        ?>

                                                        <div class="w-1/2 bg-black text-white text-sm uppercase p-3 sm:hidden">{{$category->name}}</div>
                                                        <div class="main-container-wrapper sm:container bg-gray-snow sm:bg-gray-dark py-3 sm:py-0">
                                                            @if (count($categories))
                                                                <div class="list-container px-0 sm:px-6 mb-6">
                                                                    <ul class="list-group text-sm uppercase text-gray-cloud sm:text-white">
                                                                        @foreach ($categories as $key => $value)
                                                                            <li class="py-1">
                                                                                <a href="{{ route('shop.categories.index', $value->slug) }}"
                                                                                   class="list-item {{ ($current_id == $value->id) ? 'text-gray-dark sm:text-white border-b border-gray-smoke sm:border-b sm:border-white' :''}}">{{ $value->name }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <?php $products = $productRepository->getAll($category->id); ?>
                                                        @if ($products->count())
                                                            <div
                                                                class="inline-block text-gray-light text-base uppercase relative px-10 mb-4 -ml-6 sm:ml-0">{{ __('shop::app.products.layered-nav-title') }}
                                                                <div class="icon filter-icon-on absolute cursor-pointer top-0 bottom-0 right-0 py-4"
                                                                     id="filter"></div>
                                                            </div>
                                                        @endif
                                                        @if (in_array($category->display_mode, [null, 'products_only', 'products_and_description']))
                                                            @include ('shop::products.list.layered-navigation')
                                                        @endif

                                                    </div>

                                    @endif

                                    @if (!($loop->index & 1) && ($gift_index < count($gift_products)) && ($loop->index != 0))
                                            @if (isset($gift_products[$gift_index]->related_products()->first()->product_id))
                                                <?php
                                                    $product = $productRepository->find($gift_products[$gift_index]->related_products()->first()->product_id);
                                                    $action_amount = $gift_products[$gift_index]->action_amount;
                                                    $gift_index++;
                                                ?>
                                                    <div class="w-full max-w-md sm:w-1/3 my-3 sm:my-0">
                                                      @include ('shop::products.list.gift', ['product' => $product, 'evaluation' => $action_amount, 'class' => 'medium' ])

                                                    @if (($gift_index < count($gift_products)) && (count($products) - $loop->index) < 3)
                                                            @for( $gift_index; $gift_index < count($gift_products); $gift_index++)
                                                                @if (isset($gift_products[$gift_index]->related_products()->first()->product_id))
                                                                    <?php
                                                                    $product = $productRepository->find($gift_products[$gift_index]->related_products()->first()->product_id);
                                                                    $action_amount = $gift_products[$gift_index]->action_amount;
                                                                    $gift_index++;
                                                                    ?>
                                                                    <div class="w-full my-6">
                                                                        @include ('shop::products.list.gift', ['product' => $product, 'evaluation' => $action_amount, 'class' => 'medium'])
                                                                    </div>
                                                                @endif
                                                            @endfor
                                                    @endif
                                                    </div>
                                            @endif
                                    @endif

                                    <div class="w-full sm:w-1/3 pl-0 sm:pl-6 pb-0 sm:pb-6">
                                        @include ('shop::products.list.card', ['product' => $productFlat])
                                    </div>

                                @endforeach

                                {!! view_render_event('bagisto.shop.products.index.pagination.before', ['category' => $category]) !!}

                                <div class="bottom-toolbar w-full flex justify-center">

                                    <div class="my-6">
                                        <button type="button" class="button-black text-sm px-6 load-more inline-flex items-center relative">
                                            {{ __('shop::app.products.show-more') }}
                                            <span class="cp-spinner cp-round -mt-1" id="loader">
                                            </span>
                                        </button>
                                    </div>
{{--                                    {{ $products->appends(request()->input())->links() }}--}}

                                </div>

                                {!! view_render_event('bagisto.shop.products.index.pagination.after', ['category' => $category]) !!}

                            </div>
                        @else
                            <div class="product-list">
                                @foreach ($products as $productFlat)
                                    <div class="w-full sm:w-1/3 bg-gray-dark text-xs">
                                                        <div class="hidden p-10 sm:block">
                                                            <?php
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
                                                            ?>

                                                            {{ Breadcrumbs::render('categories', $categories,  $category) }}
                                                        </div>
                                                        <?php
                                                        $categories = [];

                                                        foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree($parent_id) as $value) {
                                                            if ($value->slug) {
                                                                $categories[] = $value;
                                                            }
                                                        }
                                                        ?>

                                                        <div class="w-1/2 bg-black text-white text-sm uppercase p-3 sm:hidden">{{$category->name}}</div>
                                                        <div class="main-container-wrapper sm:container bg-gray-snow sm:bg-gray-dark py-3 sm:py-0">
                                                            @if (count($categories))
                                                                <div class="list-container px-0 sm:px-6 mb-6">
                                                                    <ul class="list-group text-sm uppercase text-gray-cloud sm:text-white">
                                                                        @foreach ($categories as $key => $value)
                                                                            <li class="py-1">
                                                                                <a href="{{ route('shop.categories.index', $value->slug) }}"
                                                                                   class="list-item {{ ($current_id == $value->id) ? 'text-gray-dark sm:text-white border-b border-gray-smoke sm:border-b sm:border-white' :''}}">{{ $value->name }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <?php $products = $productRepository->getAll($category->id); ?>
                                                        @if ($products->count())
                                                            <div
                                                                class="inline-block text-gray-light text-base uppercase relative px-10 mb-4 -ml-6 sm:ml-0">{{ __('shop::app.products.layered-nav-title') }}
                                                                <div class="icon filter-icon-on absolute cursor-pointer top-0 bottom-0 right-0 py-4"
                                                                     id="filter"></div>
                                                            </div>
                                                        @endif
                                                        @if (in_array($category->display_mode, [null, 'products_only', 'products_and_description']))
                                                            @include ('shop::products.list.layered-navigation')
                                                        @endif


                                                        <?php
                                                        $categories = [];

                                                        foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(6) as $value) {
                                                            if ($value->slug) {
                                                                $categories[] = $value;
                                                            }
                                                        }
                                                        if (count($categories) > 3) {
                                                            $rand_keys = array_rand($categories, count($categories) - 3);
                                                            foreach ($rand_keys as $key) {
                                                                unset($categories[$key]);
                                                            }
                                                        }

                                                        ?>

                                                        @if (count($categories))
                                                        @endif


                                                    </div>
                                        @include ('shop::products.list.card', ['product' => $productFlat])
                                @endforeach
                            </div>
                        @endif

                    @else

                        <div class="product-list empty">
                            <h2>{{ __('shop::app.products.whoops') }}</h2>

                            <p>
                                {{ __('shop::app.products.empty') }}
                            </p>
                        </div>

                    @endif
                @endif
            </div>
        </div>
        {!! view_render_event('bagisto.shop.products.index.after', ['category' => $category]) !!}
    </div>
    @endif
@stop

@push('scripts')
    <script>
        $(document).ready(function () {

            $('.responsive-layred-filter').css('display', 'none');
            $('.clear-filter').click(function () {
                $('.remove-filter-link').trigger('click');
                $('.apply-filter-link').trigger('click');
            })
            $(".sort-icon, .filter-icon-on, .filter-icon-menu").on('click', function (e) {
                var currentElement = $(e.currentTarget);
                if (currentElement.hasClass('sort-icon')) {
                    currentElement.removeClass('sort-icon');
                    // currentElement.addClass('filter-icon-off');
                    // currentElement.addClass('icon-menu-close-adj');
                    currentElement.next().removeClass();
                    // currentElement.next().addClass('icon filter-icon-on');
                    // $('.responsive-layred-filter').css('display', 'none');
                    $('.pager').css('display', 'flex');
                    $('.pager').css('justify-content', 'space-between');
                } else if (currentElement.hasClass('filter-icon-on')) {
                    currentElement.removeClass('filter-icon-on');
                    // $('.responsive-layred-filter').css('display', 'none');
                    // currentElement.addClass('icon-menu-close-adj');
                    currentElement.addClass('filter-icon-off');
                    // currentElement.prev().removeClass();
                    // currentElement.prev().addClass('icon sort-icon');
                    $('.pager').css('display', 'none');
                    $('.responsive-layred-filter').css('display', 'block');
                    $('.responsive-layred-filter').css('margin-top', '10px');
                } else if (currentElement.hasClass('filter-icon-off')) {
                    currentElement.removeClass('filter-icon-off');
                    $('.responsive-layred-filter').css('display', 'none');
                    // currentElement.addClass('icon-menu-close-adj');
                    currentElement.addClass('filter-icon-on');
                    // currentElement.prev().removeClass();
                    // currentElement.prev().addClass('icon sort-icon');
                    // $('.pager').css('display', 'none');
                    // $('.responsive-layred-filter').css('display', 'block');
                    // $('.responsive-layred-filter').css('margin-top', '10px');
                } else {
                    // currentElement.removeClass('icon-menu-close-adj');
                    currentElement.removeClass('filter-icon-off');
                    currentElement.addClass('filter-icon-on');
                    $('.responsive-layred-filter').css('display', 'none');
                    $('.pager').css('display', 'none');
                    if ($(this).index() == 0) {
                        currentElement.addClass('sort-icon');
                    } else {
                        currentElement.addClass('filter-icon-on');
                    }
                }
            });
        });
    </script>
    <script>
        $(function () {
            $('.load-more').on('click', function () {
               const btn = $(this);
               const loader = btn.find('span');

               btn.attr('disabled', true);
               loader.addClass('inline-block');
               // GET request for remote image
                axios({
                    method: 'get',
                    url: '{{ route('shop.categories.index') }}',
                    responseType: 'stream'
                })
                    .then(function (response) {
                        setTimeout(function () {
                            loader.removeClass('inline-block');
                            btn.attr('disabled', false);
                        }, 1000);

                        console.log(response.data);
                        // response.data.pipe(fs.createWriteStream('ada_lovelace.jpg'))
                    });
            });
        });
    </script>
@endpush