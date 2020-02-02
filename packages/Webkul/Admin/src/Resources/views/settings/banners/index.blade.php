@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.banners.title') }}
@stop

@section('content')


    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.settings.banners.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.banners.store') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.settings.banners.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('sliders','Webkul\Admin\DataGrids\BannerDataGrid')
            {!! $sliders->render() !!}
        </div>
    </div>
@stop