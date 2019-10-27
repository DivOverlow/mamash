<?php
$category = app('Webkul\Category\Repositories\CategoryRepository')->findByIdOrFail(1);
?>

<section class="hero-content">
    <div class="image-holder absolute z-0 w-full mx-auto">
        @if (!is_null($category->image))
            <img class="logo w-full object-cover object-center h-120" src="{{ $category->image_url }}"/>
        @endif
    </div>

    <div class="z-10 overflow-auto bg-black opacity-75 flex items-center w-full relative">
        <div class="text-holder w-full">
            <div class="main-container-wrapper mx-auto h-120 flex flex-col justify-center items-center">
                @if ($category->description)
                    {!! $category->description !!}
                @endif
                <div class="hero-buttons mt-6"><a href="{{ route('shop.categories.index', 'category') }}"
                        class="button-decor py-3 h-12 w-48">{{ __('shop::app.banner.shopping-btn-title') }}</a>
                </div>
        </div>
    </div>
</section>

