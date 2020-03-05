@extends('admin::layouts.content')

@section('template_title')
    {{ __('admin::app.cms.templates.edit-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" id="page-form" action="{{ route('admin.template.edit', $template->id) }}" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.cms.templates.pages') }}
                    </h1>
                </div>

                <div class="page-action">
{{--                    <button id="preview" class="btn btn-lg btn-primary">--}}
{{--                        {{ __('admin::app.cms.templates.preview') }}--}}
{{--                    </button>--}}

                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.cms.templates.edit-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    @csrf()
                    <accordian :title="'{{ __('admin::app.cms.templates.general') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('template_title') ? 'has-error' : '']">
                                <label for="template_title" class="required">{{ __('admin::app.cms.templates.template-title') }}</label>

                                <input type="text" class="control" name="template_title" v-validate="'required'" value="{{ $template->template_title ?? old('template_title') }}" data-vv-as="&quot;{{ __('admin::app.cms.templates.page-title') }}&quot;">

                                <span class="control-error" v-if="errors.has('template_title')">@{{ errors.first('template_title') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('template_key') ? 'has-error' : '']">
                                <label for="template-key" class="required">{{ __('admin::app.cms.templates.template-key') }}</label>

                                <input type="text" class="control" name="template_key" v-validate="'required'" value="{{ $template->template_key ?? old('template_key') }}" data-vv-as="&quot;{{ __('admin::app.cms.templates.template-key') }}&quot;" disabled>

                                <span class="control-error" v-if="errors.has('template_key')">@{{ errors.first('template_key') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('html_content') ? 'has-error' : '']">
                                <label for="html_content" class="required">{{ __('admin::app.cms.templates.content') }}</label>

                                <textarea type="text" class="control" id="content" name="html_content" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.cms.templates.content') }}&quot;">{{ $template->html_content ?? old('html_content') }}</textarea>

                                <div class="mt-10 mb-10">
                                    <a target="_blank" href="https://tailwindcss.com/" class="btn btn-sm btn-primary">
                                        {{ __('admin::app.cms.pages.helper-classes') }}
                                    </a>
                                </div>

                                <span class="control-error" v-if="errors.has('html_content')">@{{ errors.first('html_content') }}</span>
                            </div>
                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
@stop

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#channel-switcher, #locale-switcher').on('change', function (e) {
                $('#channel-switcher').val()
                var query = '?channel=' + $('#channel-switcher').val() + '&locale=' + $('#locale-switcher').val();

                window.location.href = "{{ route('admin.cms.edit', $template->id)  }}" + query;
            });

            tinymce.init({
                selector: 'textarea#content',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code',
                image_advtab: true,
                valid_elements : '*[*]'
            });
        });
    </script>
@endpush