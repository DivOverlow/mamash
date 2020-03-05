@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.cms.templates.add-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.template.store') }}" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.cms.templates.pages') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.cms.templates.create-btn-title') }}
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

                                <input type="text" class="control" name="template_title" v-validate="'required'" value="{{ old('template_title') }}" data-vv-as="&quot;{{ __('admin::app.cms.templates.template-title') }}&quot;">

                                <span class="control-error" v-if="errors.has('template_title')">@{{ errors.first('template_title') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('template_key') ? 'has-error' : '']">
                                <label for="template-key" class="required">{{ __('admin::app.cms.templates.template-key') }}</label>

                                <input type="text" class="control" name="template_key" v-validate="'required'" value="{{ old('template-key') }}" data-vv-as="&quot;{{ __('admin::app.cms.templates.template-key') }}&quot;" v-slugify>

                                <span class="control-error" v-if="errors.has('template_key')">@{{ errors.first('template_key') }}</span>
                            </div>

                            @inject('channels', 'Webkul\Core\Repositories\ChannelRepository')
                            @inject('locales', 'Webkul\Core\Repositories\LocaleRepository')

                            <div class="control-group" :class="[errors.has('channels[]') ? 'has-error' : '']">
                                <label for="template-key" class="required">{{ __('admin::app.cms.templates.channel') }}</label>

                                <select type="text" class="control" name="channels[]" v-validate="'required'" value="{{ old('channel[]') }}" data-vv-as="&quot;{{ __('admin::app.cms.templates.channel') }}&quot;" multiple="multiple">
                                    @foreach($channels->all() as $channel)
                                        <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                    @endforeach
                                </select>

                                <span class="control-error" v-if="errors.has('channels[]')">@{{ errors.first('channels[]') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('locales[]') ? 'has-error' : '']">
                                <label for="template-key" class="required">{{ __('admin::app.cms.templates.locale') }}</label>

                                <select type="text" class="control" name="locales[]" v-validate="'required'" value="{{ old('locale[]') }}" data-vv-as="&quot;{{ __('admin::app.cms.templates.locale') }}&quot;" multiple="multiple">
                                    @foreach($locales->all() as $locale)
                                        <option value="{{ $locale->id }}">{{ $locale->name }}</option>
                                    @endforeach
                                </select>

                                <span class="control-error" v-if="errors.has('locales[]')">@{{ errors.first('locales[]') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('html_content') ? 'has-error' : '']">
                                <label for="html_content" class="required">{{ __('admin::app.cms.templates.content') }}</label>

                                <textarea type="text" class="control" id="content" name="html_content" v-validate="'required'" value="{{ old('html_content') }}" data-vv-as="&quot;{{ __('admin::app.cms.templates.content') }}&quot;"></textarea>

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

    {{-- <modal id="showHelpers" :is-open="modalIds.showHelpers">
        <h3 slot="header">{{ __('admin::app.cms.templates.helper-classes') }}</h3>

        <div slot="body">
            @include('ui::partials.helper-classes')
        </div>
    </modal> --}}
@stop

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea#content',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
                image_advtab: true,
                valid_elements : '*[*]'
            });
        });
    </script>
@endpush