@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.banners.edit-title') }}
@stop

@section('content')
    <div class="content">
        <?php $locale = request()->get('locale') ?: app()->getLocale(); ?>
        <form method="POST" action="" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.settings.banners.edit-title') }}
                    </h1>

                    <div class="control-group">
                        <select class="control" id="locale-switcher" onChange="window.location.href = this.value">
                            @foreach (core()->getAllLocales() as $localeModel)

                                <option value="{{ route('admin.banners.update', $banner->id) . '?locale=' . $localeModel->code }}" {{ ($localeModel->code) == $locale ? 'selected' : '' }}>
                                    {{ $localeModel->name }}
                                </option>

                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.settings.banners.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">

                    @csrf()

                    {!! view_render_event('bagisto.admin.settings.banner.edit.before') !!}

                    <div class="control-group" :class="[errors.has('{{$locale}}[title]') ? 'has-error' : '']">
                        <label for="title" class="required">{{ __('admin::app.settings.banners.name') }}</label>
                        <input type="text" class="control" id="title" name="{{$locale}}[title]" value="{{ old($locale)['title'] ?: $banner->translate($locale)['title'] }}" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.settings.banners.name') }}&quot;">
                        <span class="control-error" v-if="errors.has('{{$locale}}[title]')">@{{ errors.first('{!!$locale!!}[title]') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('banner_key') ? 'has-error' : '']">
                        <label for="banner-key" class="required">{{ __('admin::app.settings.banners.banner-key') }}</label>

                        <input type="text" class="control" name="banner_key" v-validate="'required'" value="{{ $banner->banner_key ?? old('banner_key') }}" data-vv-as="&quot;{{ __('admin::app.settings.banners.banner-key') }}&quot;" disabled>

                        <span class="control-error" v-if="errors.has('banner_key')">@{{ errors.first('banner_key') }}</span>
                    </div>


                <?php $channels = core()->getAllChannels() ?>
                    <div class="control-group" :class="[errors.has('channel_id') ? 'has-error' : '']">
                        <label for="channel_id">{{ __('admin::app.settings.banners.channels') }}</label>
                        <select class="control" id="channel_id" name="channel_id" data-vv-as="&quot;{{ __('admin::app.settings.banners.channels') }}&quot;" value="" v-validate="'required'">
                            @foreach ($channels as $channel)
                                <option value="{{ $channel->id }}" @if ($channel->id == $banner->channel_id) selected @endif>
                                    {{ __($channel->name) }}
                                </option>
                            @endforeach
                        </select>
                        <span class="control-error" v-if="errors.has('channel_id')">@{{ errors.first('channel_id') }}</span>
                    </div>

                    <div class="control-group {!! $errors->has('image.*') ? 'has-error' : '' !!}">
                        <label class="required">{{ __('admin::app.catalog.categories.image') }}</label>

                        <image-wrapper :button-label="'{{ __('admin::app.settings.banners.image') }}'" input-name="image" :multiple="false" :images='"{{ url('storage/'.$banner->path) }}"' ></image-wrapper>

                        <span class="control-error" v-if="{!! $errors->has('image.*') !!}">
                            @foreach ($errors->get('image.*') as $key => $message)
                                @php echo str_replace($key, 'Image', $message[0]); @endphp
                            @endforeach
                        </span>
                    </div>

                    <div class="control-group" :class="[errors.has('{{$locale}}[html_content]') ? 'has-error' : '']">
                        <label for="html_content" class="required">{{ __('admin::app.settings.banners.content') }}</label>

                        <textarea id="tiny" class="control" id="html_content" name="{{$locale}}[html_content]" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.settings.banners.content') }}&quot;">{{ $banner->translate($locale)['html_content'] ?? old($locale)['html_content'] }}</textarea>
                        <span class="control-error" v-if="errors.has('{{$locale}}[html_content]')">@{{ errors.first('{!!$locale!!}[html_content]') }}</span>

                        <div class="mt-10 mb-10">
                            <a target="_blank" href="{{ route('ui.helper.classes') }}" class="btn btn-sm btn-primary">
                                {{ __('admin::app.cms.pages.helper-classes') }}
                            </a>
                        </div>

                        <span class="control-error" v-if="errors.has('html_content')">@{{ errors.first('html_content') }}</span>
                    </div>

                    {!! view_render_event('bagisto.admin.settings.banner.edit.after', ['banner' => $banner]) !!}
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea#tiny',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
                image_advtab: true,
                valid_elements : '*[*]'
                // templates: [
                //     { title: 'Test template 1', content: 'Test 1' },
                //     { title: 'Test template 2', content: 'Test 2' }
                // ],
            });
        });
    </script>
@endpush
