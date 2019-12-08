
<section class="slider-hooper my-3">
    <div class="main-container-wrapper text-black text-4xl sm:text-5xl text-center uppercase my-6">{{ __('shop::app.home.new-products') }}<span class="text-orange">{{ __('shop::app.home.bestsellers') }}</span></div>
   <template>
    <hooper :settings="hooperSettings" style="height: 735px">
        @foreach($sliderData as $item)
        <slide>
            <div class="w-full max-w-md bg-orange-light border border-orange">
                <div class="w-full h-48 flex justify-center content-around flex-wrap mt-3">
                    <div class="text-center text-gray-dark text-3xl uppercase px-16 py-3">{!! $item['title'] !!}</div>
                    <div class="w-2/3 text-center">{!! $item['content'] !!}</div>
                </div>
                <a href="#" class="flex flex-col items-center">
                    <div class="button-decor w-2/5 py-2 normal-case my-6">Shop Now</div>
                    <div class="w-full overflow-hidden">
                        <img class="object-cover h-88 w-full" src="{{ url()->to('/').'/storage/'.$item['path'] }}" alt="{!! $item['title']  !!}">
                    </div>
                </a>
            </div>

        </slide>
        @endforeach

        <hooper-navigation slot="hooper-addons"></hooper-navigation>
        <hooper-pagination slot="hooper-addons"></hooper-pagination>
    </hooper>
   </template>
</section>
