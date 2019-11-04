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
        @if ($category->display_mode == 'products_collection')
        <div class="hero-image bg-cover bg-center shadow-lg h-96 sm:h-120 relative" style="background-image: url('/public/themes/custom/assets/images/banner/bg-linear.jpg');">
            <div class="main-container-wrapper max-w-sm sm:max-w-xl px-30 sm:px-0 mx-auto overflow-hidden absolute inset-x-0 top-0 mt-8">
                @if (!is_null($category->image))
                    <img class="w-full" src="{{ $category->image_url }}" alt="{!! $category->name !!}">
                @endif
            </div>
        </div>
            <div class="max-w-sm sm:max-w-2xl mx-auto my-10 sm:my-16">
                @if ($category->description)
                    {!! $category->description !!}
                @endif
            <div class="mt-12 text-center"><a



        href="{{ route('shop.categories.index', ['categories'=>'category','line_filter'=>'16']) }}"
                        class="button-black text-base">{{ __('shop::app.banner.collections-btn-title') }}</a>
                </div>
            </div>
        @else
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
    @if ($category->display_mode == 'products_collection')
        <div class="main">
            {!! view_render_event('bagisto.shop.products.index.before', ['category' => $category]) !!}

            <div class="main-container-wrapper category-container">
                <?php $products = $productRepository->getAll($category->id); ?>
                @if ($products->count())

                <div class="product-list">
                    @foreach ($products as $productFlat)
                        <div class="product-card bg-white flex flex-col {{($loop->index & 1) ? 'sm:flex-row' : 'sm:flex-row-reverse' }} justify-between items-center my-10 mx-0 sm:-mx-10">
                            @include ('shop::products.list.collections', ['product' => $productFlat])
                        </div>
                    @endforeach
                </div>

                @endif
            </div>

            {!! view_render_event('bagisto.shop.products.index.after', ['category' => $category]) !!}

            <section class="banner-container">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <div class="inline flex items-end w-full sm:w-3/5 h-56 sm:h-120 bg-no-repeat my-4" style="background-image: url('/public/themes/custom/assets/images/banner/bg-panel_md.jpg');">
                        <img class="max-w-sm sm:max-w-3xl mx-auto sm:ml-40 px-3" src="/public/themes/custom/assets/images/banner/element_1.png" alt="banner">
                    </div>
                    <div class="inline w-full sm:w-2/5  h-56 sm:h-120 bg-no-repeat ml-0 sm:ml-8 my-4" style="background-image: url('/public/themes/custom/assets/images/banner/bg-panel_sm.jpg');">
                        <img class="max-w-sm mx-auto sm:ml-32 h-56 sm:h-112 object-contain -mt-6 sm:-mt-8" src="/public/themes/custom/assets/images/banner/element_2.png" alt="banner">
                    </div>
                </div>
                <div class="main-container-wrapper">
                    <div class="max-w-sm w-full sm:max-w-3xl mx-auto flex my-10">
                        <div class="lg:h-auto lg:w-48 flex-none overflow-hidden mr-4">
                            <img class="h-56 sm:h-112 object-cover" src="/public/themes/custom/assets/images/banner/chevron.jpg" alt="chevron">
                        </div>
                        <div class="bg-white flex flex-col justify-between leading-normal -mt-2 sm:-mt-4">
                            <h2 class="font-serif font-bold text-rosy-brown text-2xl sm:text-5xl text-shadow flex items-center uppercase mb-4">
                                незамедлительный <br/>видимый результат
                            </h2>
                            <div class="font-serif font-semibold text-black text-base">
                                <ul>
                                    <li>Цвет лица: более сияющий, яркий и ровный</li>
                                    <li>Кожа: свежая и подтянутая</li>
                                    <li>Поверхность кожи: более гладкая, подтянутая, отдохнувшый вид</li>
                                    <li>Морщины минимизируются и сглаживаются</li>
                                    <li>Контур лица более четкий и подтянутый</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto w-full max-w-3xl hidden sm:block my-10">
                        <p class="font-semibold text-2xl uppercase">быстрая программа ухода для придания коже сияния</p>
                        <p class="font-bold text-3xl uppercase tracking-wider">попробовав однажды, вы полюбите ее!</p>
                    </div>
                </div>
                <div class="w-full overflow-hidden">
                    <img class="h-20 sm:h-32 object-cover" src="/public/themes/custom/assets/images/banner/bar.jpg" alt="footer bar">
                </div>
            </section>

        </div>
    @elseif ($category->display_mode == 'products_gift')
        <div class="main">
            {!! view_render_event('bagisto.shop.products.index.before', ['category' => $category]) !!}

            <div class="main-container-wrapper category-container">
                <?php $products = $productRepository->getAll($category->id); ?>

                @if ($products->count())
                    <div class="product-list my-10">
                        @foreach ($products as $productFlat)
                            <div class="product-card bg-white flex flex-col {{($loop->index & 1) ? 'sm:flex-row' : 'sm:flex-row-reverse' }} justify-between items-center my-4 sm:my-0">
                                @include ('shop::products.list.gifts', ['product' => $productFlat])
                            </div>
                        @endforeach
                    </div>

                @endif
            </div>

            {!! view_render_event('bagisto.shop.products.index.after', ['category' => $category]) !!}

        </div>
    @else
    <div class="main">
        {!! view_render_event('bagisto.shop.products.index.before', ['category' => $category]) !!}

        <div class="category-container container flex flex-col sm:flex-row z-10 -mt-12 relative">
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
                            <ul class="list-group uppercase text-gray-cloud sm:text-white">
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
                        class="inline-block text-gray-light uppercase relative px-10 mb-4 -ml-6 sm:ml-0">{{ __('shop::app.products.layered-nav-title') }}
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
                    <section class="banner-container">
                        <div class="bg-white py-4">
                            @foreach($categories as $value)
                                <div class="container flex flex-col justify-between items-center">
                                    <div class="left-banner w-full">
                                        @if (!is_null($value->image))
                                            <img src="{{ $value->image_url }}" alt="{!! $value->name !!}"/>
                                        @endif
                                    </div>
                                    <div class="right-banner w-full">
                                        <div
                                            class="banner-content text-3xl w-full flex flex-col justify-center items-center h-96 mx-auto">
                                            @if ($value->description)
                                                {!! $value->description !!}
                                            @endif

                                            <div class="mt-6"><a
                                                    href="{{ route('shop.categories.index', $value->slug) }}"
                                                    class="button-black text-base">{{ __('shop::app.banner.btn-title') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section><!-- end section banner container -->
                @endif


            </div>
            <div class="category-block w-full sm:w-2/3"
                 @if ($category->display_mode == 'description_only') style="width: 100%" @endif>

                @if (in_array($category->display_mode, [null, 'products_only', 'products_and_description']))

                    @if ($products->count())

                        @include ('shop::products.list.toolbar')

                        @inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

                        @if ($toolbarHelper->getCurrentMode() == 'grid')
                            <div class="product-grid-3 flex flex-wrap">
                                @foreach ($products as $productFlat)
                                    <div class="w-full sm:w-1/2 pl-0 sm:pl-6 pb-0 sm:pb-6">
                                        @include ('shop::products.list.card', ['product' => $productFlat])
                                    </div>
                                @endforeach
                                {!! view_render_event('bagisto.shop.products.index.pagination.before', ['category' => $category]) !!}

                                <div class="bottom-toolbar w-full sm:w-1/2 text-center">
                                    {{ $products->appends(request()->input())->links() }}
                                </div>

                                {!! view_render_event('bagisto.shop.products.index.pagination.after', ['category' => $category]) !!}

                            </div>
                        @else
                            <div class="product-list">
                                @foreach ($products as $productFlat)

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
@endpush