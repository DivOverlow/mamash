@inject ('toolbarHelper', 'Webkul\Product\Helpers\Toolbar')

{!! view_render_event('bagisto.shop.products.list.toolbar.before') !!}

<div class="top-toolbar flex justify-end items-center bg-transparent -mt-6">
    <div class="page-info">
        <span class="sort-filter">
            <i class="icon sort-icon" id="sort" ></i>
{{--            <i class="icon filter-icon" id="filter">--}}
{{--                {{ __('shop::app.products.layered-nav-title') }}--}}
{{--            </i>--}}
        </span>
    </div>

    <div class="pager flex flex-row">

        <div class="sorter text-yellow ml-12">

            <select onchange="window.location.href = this.value" class="bg-transparent uppercase">

                @foreach ($toolbarHelper->getAvailableOrders() as $key => $order)

                    <option value="{{ $toolbarHelper->getOrderUrl($key) }}" {{ $toolbarHelper->isOrderCurrent($key) ? 'selected' : '' }} class="text-sm sm:text-base text-gray-dark">
                        {{ __('shop::app.products.' . $order) }}
                    </option>

                @endforeach

            </select>
        </div>

{{--        <div class="limiter">--}}
{{--            <label>{{ __('shop::app.products.show') }}</label>--}}

{{--            <select onchange="window.location.href = this.value">--}}

{{--                @foreach ($toolbarHelper->getAvailableLimits() as $limit)--}}

{{--                    <option value="{{ $toolbarHelper->getLimitUrl($limit) }}" {{ $toolbarHelper->isLimitCurrent($limit) ? 'selected' : '' }}>--}}
{{--                        {{ $limit }}--}}
{{--                    </option>--}}

{{--                @endforeach--}}

{{--            </select>--}}
{{--        </div>--}}

    </div>

</div>

{!! view_render_event('bagisto.shop.products.list.toolbar.after') !!}

