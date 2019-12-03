@extends('shop::layouts.master')

@section('page_title')
    {{ $page->page_title }}
@endsection

@section('head')
    @isset($page->meta_title)
        <meta name="title" content="{{ $page->meta_title }}" />
    @endisset

    @isset($page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}" />
    @endisset

    @isset($page->meta_keywords)
        <meta name="keywords" content="{{ $page->meta_keywords }}" />
    @endisset

{{--    <link href="{{ asset('themes/default/assets/css/shop.css') }}" rel="stylesheet" />--}}
@endsection

@section('content-wrapper')
    {!! DbView::make($page)->field('html_content')->render() !!}

{{--    <section class="hero-content">--}}
{{--        <div class="relative w-full h-132 overflow-hidden"><img class="object-cover hidden sm:block h-auto w-full" src="../../../themes/custom/assets/images/banner/about-hero.jpg" /> <img class="object-cover block sm:hidden h-132 w-full" src="../../../themes/custom/assets/images/banner/about-hero-sm.jpg" />--}}
{{--            <div class="overflow-auto bg-black sm:bg-transparent opacity-75 sm:opacity-100 flex items-center w-full absolute inset-0">--}}
{{--                <div class="text-holder w-full">--}}
{{--                    <div class="main-container-wrapper h-132 flex flex-col justify-center items-center">--}}
{{--                        <div class="w-full sm:w-2/3 text-center text-white sm:text-left mr-auto">--}}
{{--                            <div class="text-3xl sm:text-5xl uppercase">Цепляющий заголовок</div>--}}
{{--                            <p class="font-serif text-xl">Не упусти свой шанс. Заказывай прямо сейчас!</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--    <section class="sub-header">--}}
{{--        <div class="w-full flex flex-col items-center font-serif text-gray-dark">--}}
{{--            <div class="max-w-2xl w-full my-6 text-center">--}}
{{--                <div class="font-sans text-3xl sm:text-5xl uppercase">В чeм наша сила</div>--}}
{{--                <p class="font-serif text-xl">Они везде, они везде. Они имеют тенденцию не замечать. Ритуалы раскрывают эти моменты и напоминают вам испытать их с радостью. Ритуалы позволяют расслабиться. Ритуалы раскрывают эти моменты и напоминают вам испытать их с радостью. Ритуалы позволяют расслабиться.</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--    <section class="banners">--}}
{{--        <div class="main-container-wrapper">--}}
{{--            <div class="flex flex-col-reverse sm:flex-row justify-between items-center my-8 mx-0 sm:-mx-12">--}}
{{--                <div class="left-banner h-112 sm:h-132 w-full px-0 sm:px-6 flex items-center"><img class="h-auto w-full object-cover" src="../../../themes/custom/assets/images/banner/about-01.jpg" /></div>--}}
{{--                <div class="right-banner w-full h-112 sm:h-132 px-0 sm:px-6 flex justify-center items-center">--}}
{{--                    <div class="max-w-xl text-center">--}}
{{--                        <div class="font-sans text-3xl sm:text-5xl uppercase">О нас</div>--}}
{{--                        <p class="font-serif text-xl">Они везде, они везде. Они имеют тенденцию не замечать. Ритуалы раскрывают эти моменты и напоминают вам испытать их с радостью. Ритуалы позволяют расслабиться. Ритуалы раскрывают эти моменты и напоминают вам испытать их с радостью. Ритуалы позволяют расслабиться.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="flex flex-col sm:flex-row justify-between items-center my-8 mx-0 sm:-mx-12">--}}
{{--                <div class="left-banner h-112 sm:h-132 w-full px-0 sm:px-6 flex justify-center items-center">--}}
{{--                    <div class="max-w-xl text-center">--}}
{{--                        <div class="font-sans text-3xl sm:text-5xl uppercase">Подписные ароматезаторы</div>--}}
{{--                        <p class="font-serif text-xl">Они везде, они везде. Они имеют тенденцию не замечать. Ритуалы раскрывают эти моменты и напоминают вам испытать их с радостью. Ритуалы позволяют расслабиться. Ритуалы раскрывают эти моменты и напоминают вам испытать их с радостью. Ритуалы позволяют расслабиться.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="right-banner w-full h-112 sm:h-132 px-0 sm:px-6 flex items-center"><img class="h-auto w-full object-cover" src="../../../themes/custom/assets/images/banner/about-02.jpg" /></div>--}}
{{--            </div>--}}
{{--            <div class="flex flex-col-reverse sm:flex-row justify-between items-center my-8 mx-0 sm:-mx-12">--}}
{{--                <div class="left-banner h-112 sm:h-132 w-full px-0 sm:px-6 flex items-center"><img class="h-auto w-full object-cover" src="../../../themes/custom/assets/images/banner/about-03.jpg" /></div>--}}
{{--                <div class="right-banner w-full h-112 sm:h-132 px-0 sm:px-6 flex justify-center items-center">--}}
{{--                    <div class="max-w-xl text-center">--}}
{{--                        <div class="font-sans text-3xl sm:text-5xl uppercase">Совершенные подарки</div>--}}
{{--                        <p class="font-serif text-xl">Они везде, они везде. Они имеют тенденцию не замечать. Ритуалы раскрывают эти моменты и напоминают вам испытать их с радостью. Ритуалы позволяют расслабиться. Ритуалы раскрывают эти моменты и напоминают вам испытать их с радостью. Ритуалы позволяют расслабиться.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--    <section class="hero-footer">--}}
{{--        <div class="relative w-full w-full overflow-hidden"><img class="object-cover hidden sm:block h-132 w-auto mx-auto" src="../../../themes/custom/assets/images/banner/about-footer.jpg" /> <img class="object-cover block sm:hidden h-132 w-full" src="../../../themes/custom/assets/images/banner/about-footer-sm.jpg" />--}}
{{--            <div class="overflow-auto flex items-center w-full absolute inset-0" style="background-color: rgba(0,0,0,0.7);">--}}
{{--                <div class="main-container-wrapper">--}}
{{--                    <div class="text-holder w-full h-132 flex flex-col justify-center items-center absolute inset-0">--}}
{{--                        <div class="w-full text-center text-white">--}}
{{--                            <div class="text-3xl sm:text-5xl uppercase">Цепляющий заголовок</div>--}}
{{--                            <p class="font-serif text-xl">Не упусти свой шанс. Заказывай прямо сейчас!</p>--}}
{{--                            <div class="mt-6"><a href="#" class="normal-case button-black text-base px-16">Читать</a></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}



@endsection

@push('scripts')
{{--    <script src="{{ asset('themes/default/assets/js/shop.js') }}" type="text/javascript"></script>--}}
@endpush
