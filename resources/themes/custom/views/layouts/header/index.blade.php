<div class="header" id="header">
    <div class="header-top bg-gray-grey">
{{--        <span class="menu-box hidden" ><span class="icon icon-menu" id="hammenu"></span></span>--}}
        <div class="main-container-wrapper flex justify-between sm:justify-end py-3">
            <span class="menu-box visible sm:invisible"><span class="icon icon-menu" id="hammenu"></span></span>
            <div class="left-content mx-8 mt-1 leading-none relative">
            <a href="{{ route('shop.cms.page', 'faq') }}" class="invisible sm:visible inline-block align-top text-white text-sm hover:text-gold cursor-pointer">{{ __('shop::app.header.help') }}</a>
        </div>

        <?php
            $query = parse_url(\Illuminate\Support\Facades\Request::path(), PHP_URL_QUERY);
            $searchTerm = explode("?", $query);

            foreach($searchTerm as $term){
                if (strpos($term, 'term') !== false) {
                    $serachQuery = $term;
                }
            }
        ?>

        <div class="right-content flex">
{{--            <div class="mt-1 {{ count(core()->getCurrentChannel()->locales) == 1 ? 'hidden' : '' }}">--}}
            <div class="ml-8 mt-1">
                <ul class="flex uppercase text-sm leading-none relative">
                    @foreach (core()->getCurrentChannel()->locales as $locale)
                        <li class="px-1 {{($loop->index > 0) ? 'border-l-2 border-solid border-gray-light' : 'border-0'}}">
                            @if( $locale->code == app()->getLocale())
                                <span class="inline-block align-top text-gold">{{$locale->code}}</span>
                            @else
                                @if(isset($serachQuery))
                                    <a href="?{{ $serachQuery }}?locale={{ $locale->code }}" class="inline-block align-top text-white hover:underline">{{$locale->code}}</a>
                                @else
                                    <a href="?locale={{ $locale->code }}" class="inline-block align-top text-white hover:underline">{{$locale->code}}</a>
                                @endif
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <ul class="right-content-menu">

                {!! view_render_event('bagisto.shop.layout.header.currency-item.before') !!}

                @if (core()->getCurrentChannel()->currencies->count() > 1)
                    <li class="currency-switcher">
                        <span class="dropdown-toggle">
                            {{ core()->getCurrentCurrencyCode() }}

                            <i class="icon arrow-down-icon"></i>
                        </span>

                        <ul class="dropdown-list currency">
                            @foreach (core()->getCurrentChannel()->currencies as $currency)
                                <li>
                                    @if(isset($serachQuery))
                                        <a href="?{{ $serachQuery }}?currency={{ $currency->code }}">{{ $currency->code }}</a>
                                    @else
                                        <a href="?currency={{ $currency->code }}">{{ $currency->code }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                {!! view_render_event('bagisto.shop.layout.header.currency-item.after') !!}

            </ul>
        </div>
    </div>
    </div>

    <div class="bg-gray-dark">
        <div class="main-container-wrapper flex items-center flex-col sm:flex-row h-24">
            <div class="header-bottom w-full flex-grow lg:flex lg:items-center lg:w-full" id="header-bottom" style="display: none;">
                @include('shop::layouts.header.nav-menu.navmenu')
            </div>
            <div class="w-auto absolute inset-0 sm:relative h-16">
                <ul class="logo-container h-full w-32 sm:w-56 sm:mx-2">
                    <li>
                        <a href="{{ route('shop.home.index') }}">
                            @if ($logo = core()->getCurrentChannel()->logo_url)
                                <img class="logo mt-2 ml-24 sm:ml-0" src="{{ $logo }}" />
                            @else
                                <img class="logo mt-2 ml-24 sm:ml-0" src="{{ bagisto_asset('images/logo.svg') }}" />
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
            <div class="w-full w-5/12 flex justify-end items-center header-cart-line">
                <div class="w-full right-content flex justify-between items-center">
                    <div class="search-container mr-10 items-center w-full flex justify-end relative">
                        <form role="search" action="{{ route('shop.search.index') }}" method="GET" >
                            <input type="search" name="term" class="search-field bg-transparent font-serif font-light text-white text-sm h-8 w-20 border-b border-gray-light relative focus:w-48 focus:border-gold"
                                   placeholder="{{ __('shop::app.header.search-text') }}" required>
                                    <div class="search-icon-wrapper flex items-center absolute right-0 inset-y-0">
                                        <button class="pl-2 -mr-5 pb-1">
                                            <svg class="fill-current text-white hover:text-gold inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
                                        </button>
                                </div>
                        </form>
                    </div>

                    <div class="mx-1 px-10"><span class="border-gray-light border-l py-4 opacity-50"></span></div>

{{--                <span class="search-box hidden sm:visible"><span class="icon icon-search" id="search"></span></span>--}}

                    <ul class="w-1/2 right-content-menu flex justify-between items-center">

                        {!! view_render_event('bagisto.shop.layout.header.account-item.before') !!}

                        <li>
{{--                        @guest--}}
{{--                            <a href="{{ route('customer.session.index') }}"><div class="cursor-pointer user-icon mr-1"></div></a>--}}
{{--                        @else--}}
{{--                            <div>--}}
{{--                                <label style="color: #9e9e9e; font-weight: 700; text-transform: uppercase; font-size: 15px;">--}}
{{--                                    {{ auth()->guard('customer')->user()->first_name }}--}}
{{--                                </label>--}}
{{--                                <a href="{{ route('customer.profile.index') }}" title="{{ __('shop::app.header.profile') }}"><div class="cursor-pointer user-icon active"></div></a>--}}
{{--                            </div>--}}
{{--                        @endguest--}}
                        @auth('customer')
                            <div class="relative w-12">
                                <label class="ml-auto -mt-3 bg-chocolate rounded-full h-8 w-8 flex items-center justify-center text-white text-xl">
                                    {{ substr(auth()->guard('customer')->user()->first_name, 0, 2) }}
                                </label>
                                <a href="{{ route('customer.profile.index') }}" title="{{ __('shop::app.header.profile') }}" class="z-0 absolute inset-0 mt-2">
                                    <span class="user-icon active"></span></a>
                            </div>
                            @else
                                <a href="{{ route('customer.session.index') }}"><span class="user-icon mr-1"></span></a>
                        @endauth

                        </li>

                        {!! view_render_event('bagisto.shop.layout.header.account-item.after') !!}


                        {!! view_render_event('bagisto.shop.layout.header.cart-item.before') !!}

                        <li class="cart-dropdown-container static">

                            @include('shop::checkout.cart.mini-cart')

                        </li>

                        {!! view_render_event('bagisto.shop.layout.header.cart-item.after') !!}

                    </ul>
                </div>
{{--                    <span class="menu-box hidden sm:visible" ><span class="icon icon-menu" id="hammenu"></span></span>--}}

            </div>
        </div>
    </div>

</div>




@push('scripts')
    <script>

        $(document).ready(function() {

            $('body').delegate('#search, .icon-menu-close, .icon.icon-menu', 'click', function(e) {
                toggleDropdown(e);
            });

            let vh = window.innerHeight * 0.01;
            document.documentElement.style.setProperty('--vh', `${vh}px`);
            window.addEventListener('resize', () => {
                let vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', `${vh}px`);
            });


            function toggleDropdown(e) {
                var currentElement = $(e.currentTarget);
                $("#header-bottom").find("div.show-subnav").removeClass("show-subnav");
                if (currentElement.hasClass('icon-search')) {
                    currentElement.removeClass('icon-search');
                    currentElement.addClass('icon-menu-close');
                    $('#hammenu').removeClass('icon-menu-close');
                    $('#hammenu').addClass('icon-menu');
                    $("#search-responsive").css("display", "block");
                    $("#header-bottom").css("display", "none");
                } else if (currentElement.hasClass('icon-menu')) {
                    currentElement.removeClass('icon-menu');
                    currentElement.addClass('icon-menu-close');
                    $('#search').removeClass('icon-menu-close');
                    $('#search').addClass('icon-search');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "block");
                } else {
                    currentElement.removeClass('icon-menu-close');
                    $("#search-responsive").css("display", "none");
                    $("#header-bottom").css("display", "none");
                    if (currentElement.attr("id") == 'search') {
                        currentElement.addClass('icon-search');
                    } else {
                        currentElement.addClass('icon-menu');
                    }
                }
            }
        });
        $(document).ready(function(){


                $('#header-bottom li:has(.nav-level)').append ('<div class="arrow-menu">+</div>')


            $('.arrow-menu').click(function(e){
                e.preventDefault();
                var parent = $(this).parent();
                parent.siblings().find("div.show-subnav").removeClass("show-subnav");
                parent.find('.nav-level:first').toggleClass('show-subnav');
                $(this).find(".show-subnav").removeClass("show-subnav");
            });

        });
    </script>
@endpush
