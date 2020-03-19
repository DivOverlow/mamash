@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.contents.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.contents.title') }}</h1>
            </div>
            <div class="page-action">
                <a href="{{ route('admin.content.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.contents.btn-add-content') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('header_contents', 'Webkul\Admin\DataGrids\ContentDataGrid')
            {!! $header_contents->render() !!}
        </div>
    </div>
@stop