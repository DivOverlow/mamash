<?php
$category = app('Webkul\Category\Repositories\CategoryRepository')->findOrFail(1);
?>

<section class="hero-content">
    <div class="image-holder w-full relative overflow-hidden">
        @if (!is_null($category->image))
            <img class="object-none sm:object-cover h-132 w-full" src="{{ $category->image_url }}"/>
        @endif

            <div class="overflow-auto flex items-center w-full absolute h-132 inset-0 bg-dark">
                <div class="text-holder w-full">
                    <div class="main-container-wrapper flex flex-col justify-content-center items-center">
                        @if ($category->description)
                            {!! $category->description !!}
                        @endif
                        <div class="hero-buttons mt-6"><a href="{{ route('shop.categories.index', 'category') }}"
                                                          class="button-decor py-3 h-12 w-48">{{ __('shop::app.banner.shopping-btn-title') }}</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</section>

