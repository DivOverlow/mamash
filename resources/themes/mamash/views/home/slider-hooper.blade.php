
<section class="slider-hooper my-3">
    <div class="main-container-wrapper text-black text-4xl sm:text-5xl text-center uppercase my-6">{{ __('shop::app.home.new-products') }}<span class="text-orange">{{ __('shop::app.home.bestsellers') }}</span></div>
   <template>
    <hooper :settings="hooperSettings" style="height: 735px">
        @foreach($sliderData as $item)
        <slide>

            <div class="w-full max-w-md bg-orange-light border border-orange">
                <div class="w-full h-48 flex justify-center content-around flex-wrap mt-3 overflow-hidden">
                    <div class="text-center text-gray-dark text-3xl uppercase px-16 py-3 leading-tight">{!! $item['title']  !!}</div>
                    <div class="w-full text-center font-serif px-6">{!! $item['content']  !!}</div>
                </div>
                <div class="w-full flex justify-center"><a class="button-decor w-2/5 py-2 normal-case my-6" href="{{ url()->to('/').'/products/' . $item['slug'] }}">{{ __('shop::app.home.shop-now') }}</a></div>

                <div class="w-full">
                    <img class="object-cover h-88 w-full" src="{{ url()->to('/').'/storage/'.$item['path'] }}" alt="{!! $item['title']  !!}">
                </div>
            </div>

        </slide>
        @endforeach

        <hooper-navigation slot="hooper-addons"></hooper-navigation>
        <hooper-pagination slot="hooper-addons"></hooper-pagination>
    </hooper>
   </template>
</section>
