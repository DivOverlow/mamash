<ul class="logo-container flex justify-center sm:justify-start my-4 sm:my-0">
    <li>
        <a href="{{ route('shop.home.index') }}">
            @if ($logo = core()->getCurrentChannel()->logo_url)
                <img class="logo h-10 w-auto lg:h-auto" src="{{ $logo }}" />
            @else
                <img class="logo h-10 w-auto lg:h-auto" src="{{ bagisto_asset('images/logo.svg') }}" />
            @endif
        </a>
    </li>
</ul>
