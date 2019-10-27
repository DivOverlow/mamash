{!! view_render_event('bagisto.shop.products.list.collections.before', ['product' => $product]) !!}

    @inject ('productViewHelper', 'Webkul\Product\Helpers\View')

    <div class="product-information flex content-center flex-wrap h-112 sm:h-120 sm:px-10">

        <h2 class="product-name font-serif font-bold text-gray-dark uppercase text-xl sm:text-2xl text-center mb-6 mx-auto">
            {{ $product->name }}
        </h2>
        <div class="product-description font-serif text-gray-dark text-lg sm:text-xl text-center mx-auto">
            {!! $product->short_description !!}
            <div class="mt-8 px-4"><a href="{{route('shop.categories.index', 'category')}}" class="button-black text-base"><span class="px-6">{{ __('shop::app.button.buy') }}</span></a></div>
        </div>

    </div>
    <div class="product-image flex-shrink-0 px-0 sm:px-10">
        @if ($customAttributeValues = $productViewHelper->getAdditionalData($product))
            @foreach ($customAttributeValues as $attribute)
                @if ($attribute['type'] == 'image' && $attribute['value'])
                    <img class="max-w-full sm:h-120 sm:w-auto" src="{{ Storage::url($attribute['value']) }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>
                @else
                    {{ $attribute['value'] }}
                @endif
            @endforeach
        @else
            <img class="max-w-full sm:h-120 sm:w-auto" src="{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}"/>
        @endif
    </div>
{!! view_render_event('bagisto.shop.products.list.collections.after', ['product' => $product]) !!}