
{!! view_render_event('bagisto.admin.content.create_form_accordian.content.link.before') !!}

<div class="control-group" :class="[errors.has('page_link') ? 'has-error' : '']">
    <label for="page_link" class="required">
        {{ __('admin::app.contents.content.category-slug') }}
    </label>

    @php
       $pageTarget = isset($locale) ? (old($locale)['page_link'] ?? (isset($content) ? $content->translate($locale)['page_link'] : '')) : '';
    @endphp

    <input
        type="text"
        id="page_link"
        class="control"
        name="{{$locale}}[page_link]"
        v-validate="'required|max:150'"
        value="{{ $pageTarget }}"
        data-vv-as="&quot;{{ __('admin::app.contents.content.page-link') }}&quot;" />

    <span class="control-error" v-if="errors.has('page_link')">
        @{{ errors.first('page_link') }}
    </span>
</div>

<div class="control-group">
    <label for="link_target">
        {{ __('admin::app.contents.content.link-target') }}
    </label>

    @php
       $linkTarget = isset($locale) ? (old($locale)['link_target'] ?? (isset($content) ? $content->translate($locale)['link_target'] : '')) : '';
    @endphp

    <select class="control" id="link_target" name="{{$locale}}[link_target]" value="">
        <option value="0">
            {{ __('admin::app.contents.self') }}
        </option>
        <option value="1" @if ($linkTarget == 1) selected="selected" @endif>
            {{ __('admin::app.contents.new-tab') }}
        </option>
    </select>
</div>

{!! view_render_event('bagisto.admin.content.create_form_accordian.content.link.after') !!}