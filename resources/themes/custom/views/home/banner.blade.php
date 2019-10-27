<?php
$categories = [];
$category = [];

foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(6) as $category){
    if ($category->slug) {
        $categories[] = $category;
    }
}
if (count($categories)) {
    $rand_key = array_rand($categories, 1);
    $category = $categories[$rand_key];
}

?>

@if (count($categories))
    <section class="banner-container">
        <div class="my-16  bg-no-repeat bg-right-top bg-white"
             style="background-image: url('/themes/custom/assets/images/banner/blooper.png');">
            <div class="main-container-wrapper flex flex-col-reverse sm:flex-row justify-between items-center">
                <div class="left-banner w-full">
                    @if (!is_null($category->image))
                        <img  src="{{ $category->image_url }}" alt="{!! $category->name !!}"/>
                    @endif
                </div>
                <div class="right-banner w-full px-8">
                    <div class="banner-content text-3xl sm:text-4xl w-full flex flex-col justify-center items-center h-112 mx-auto px-6">
                        @if ($category->description)
                            {!! $category->description !!}
                        @endif

                        <div class="mt-6"><a href="{{ route('shop.categories.index', $category->slug) }}" class="button-black text-base">{{ __('shop::app.banner.btn-title') }}</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- end section banner container -->

@endif

