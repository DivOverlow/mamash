@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.cms.templates.title') }}
@stop

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.cms.templates.pages') }}</h1>
            </div>
            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span >
                        {{ __('admin::app.export.export') }}
                    </span>
                </div>

                <a href="{{ route('admin.template.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.cms.templates.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('cmsGrid', 'Webkul\Admin\DataGrids\CMSTemplateDataGrid')

            {!! $cmsGrid->render() !!}
        </div>
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header">{{ __('admin::app.export.download') }}</h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>
@stop

@push('scripts')
    @include('admin::export.export', ['gridName' => $cmsGrid])
@endpush

