@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.promotion.gift-rule') }}
@stop

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.promotion.gift-rule') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.gift-rule.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.promotion.add-gift-rule') }}
                </a>

{{--                <a href="{{ route('admin.gift-rule.apply') }}" class="btn btn-lg btn-primary">--}}
{{--                    {{ __('admin::app.promotion.apply') }}--}}
{{--                </a>--}}

{{--                <a href="{{ route('admin.gift-rule.declut') }}" class="btn btn-lg btn-primary">--}}
{{--                    {{ __('admin::app.promotion.declut') }}--}}
{{--                </a>--}}
            </div>
        </div>

        <div class="page-content">
            @inject('catalogRuleGrid','Webkul\Admin\DataGrids\GiftRuleDataGrid')
            {!! $catalogRuleGrid->render() !!}
        </div>
    </div>
@endsection