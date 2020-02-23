@extends('shop::layouts.master')

@section('page_title')
    {{ __('shop::app.search.page-title') }}
@endsection

@section('content-wrapper')
    <div class="main-container-wrapper">
    @if (! $results)
        <div class="text-gray-dark text-lg" style="min-height: 9vh;">
            {{  __('shop::app.search.no-results') }}
        </div>
    @endif

    @if ($results)
        <div class="main mb-30" style="min-height: 27vh;">
            @if ($results->isEmpty())
                <div class="search-result-status">
                    <h2>{{ __('shop::app.products.whoops') }}</h2>
                    <span>{{ __('shop::app.search.no-results') }}</span>
                </div>
            @else
                @if ($results->total() == 1)
                    <div class="search-result-status mb-20 text-gray-dark text-lg">
                        <span><b>{{ $results->total() }} </b>{{ __('shop::app.search.found-result') }}</span>
                    </div>
                @else
                    <div class="search-result-status mb-20 text-gray-dark text-lg">
                        <span><b>{{ $results->total() }} </b>{{ __('shop::app.search.found-results') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mb-20 -mx-3">
                    @foreach ($results as $productFlat)
                        <div class="p-3">
                            @include('shop::products.list.card', ['product' => $productFlat->product])
                        </div>

                    @endforeach
                </div>

                @include('ui::datagrid.pagination')
            @endif
        </div>
    @endif
    </div>
@endsection