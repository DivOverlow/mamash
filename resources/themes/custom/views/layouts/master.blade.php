<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <title>@yield('page_title')</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-language" content="{{ app()->getLocale() }}">

{{--    <link rel="stylesheet" href="{{ bagisto_asset('css/shop.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}">--}}
    <link rel="stylesheet" href="{{ bagisto_asset('css/main.css') }}">

    @if ($favicon = core()->getCurrentChannel()->favicon_url)
        <link rel="icon" sizes="16x16" href="{{ $favicon }}" />
    @else
        <link rel="icon" sizes="16x16" href="{{ bagisto_asset('images/favicon.ico') }}" />
    @endif

    @yield('head')

    @section('seo')
        @if (! request()->is('/'))
            <meta name="description" content="{{ core()->getCurrentChannel()->description }}"/>
        @endif
    @show

    @stack('css')

    {!! view_render_event('bagisto.shop.layout.head') !!}

</head>


<body @if (core()->getCurrentLocale()->direction == 'rtl') class="rtl" @endif style="scroll-behavior: smooth;">

    {!! view_render_event('bagisto.shop.layout.body.before') !!}

    <div id="app">
        <flash-wrapper ref='flashes'></flash-wrapper>

        <div class="mx-auto pt-0 w-full font-sans">

            {!! view_render_event('bagisto.shop.layout.header.before') !!}

            @include('shop::layouts.header.index')

            {!! view_render_event('bagisto.shop.layout.header.after') !!}

            @yield('slider')

            <div class="content-container">

                {!! view_render_event('bagisto.shop.layout.content.before') !!}

                @yield('content-wrapper')

                {!! view_render_event('bagisto.shop.layout.content.after') !!}

            </div>

        </div>

        {!! view_render_event('bagisto.shop.layout.footer.before') !!}

        @include('shop::layouts.footer.footer')

        {!! view_render_event('bagisto.shop.layout.footer.after') !!}

        @if (core()->getConfigData('general.content.footer.footer_toggle'))

            <div class="footer absolute mt-0 sm:-mt-10 pt-0 sm:pt-1 px-10">
                <p>
                    @if (core()->getConfigData('general.content.footer.footer_content'))
                        {{ core()->getConfigData('general.content.footer.footer_content') }}
                    @else
                        {{ trans('admin::app.footer.copy-right') }}
                    @endif
                </p>
            </div>
        @endif
    </div>

    <script type="text/javascript">
        window.flashMessages = [];

        @if ($success = session('success'))
            window.flashMessages = [{'type': 'alert-success', 'message': "{{ $success }}" }];
        @elseif ($warning = session('warning'))
            window.flashMessages = [{'type': 'alert-warning', 'message': "{{ $warning }}" }];
        @elseif ($error = session('error'))
            window.flashMessages = [{'type': 'alert-error', 'message': "{{ $error }}" }
            ];
        @elseif ($info = session('info'))
            window.flashMessages = [{'type': 'alert-info', 'message': "{{ $info }}" }
            ];
        @endif

        window.serverErrors = [];
        @if(isset($errors))
            @if (count($errors))
                window.serverErrors = @json($errors->getMessages());
            @endif
        @endif
    </script>

    <script type="text/javascript" src="{{ bagisto_asset('js/shop.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".mat-input").focus(function () {
                $(this).parent().addClass("is-active is-completed");
            });

            $(".mat-input").focusout(function () {
                if ($(this).val() === "")
                    $(this).parent().removeClass("is-completed");
                $(this).parent().removeClass("is-active");
            })
        });
    </script>

    @stack('scripts')

    {!! view_render_event('bagisto.shop.layout.body.after') !!}

    <div class="modal-overlay"></div>


{{--    <script>--}}
{{--        (function(w,d,u){--}}
{{--            var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);--}}
{{--            var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);--}}
{{--        })(window,document,'https://cdn.bitrix24.ua/b12349765/crm/site_button/loader_2_80wt05.js%27);--}}
{{--    </script>--}}

</body>

</html>