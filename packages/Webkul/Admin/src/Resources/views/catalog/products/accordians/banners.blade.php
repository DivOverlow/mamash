@inject ('productFlatRepository', 'Webkul\Product\Repositories\ProductFlatRepository')

<?php
    $productBanners = $productFlatRepository->findWhere([
        'product_id' => $product->id
    ])->pluck('banner_key')->unique()->toArray();

?>

<accordian :title="'{{ __('admin::app.catalog.products.banner') }}'" :active="false">
    <div slot="body">
        <div class="control-group" :class="[errors.has('banners[]') ? 'has-error' : '']">
            <label for="banners" class="required">{{ __('admin::app.catalog.products.banner') }}</label>

            <select class="control" name="banners[]" v-validate="'required'" data-vv-as="&quot;{{ __('admin::app.catalog.products.banner') }}&quot;" multiple>
                <option value="{{ 0 }}"  {{ ($productBanners[0] == null) ? 'selected': ''}}>
                    {{ __('admin::app.catalog.products.banner-none') }}
                </option>
                @foreach (app('Webkul\Core\Repositories\BannerRepository')->all() as $banner)
                    <option value="{{ $banner->id }}" {{ in_array($banner->banner_key, $productBanners) ? 'selected' : ''}}>
                        {{ $banner->title }}
                    </option>
                @endforeach
            </select>

            <span class="control-error" v-if="errors.has('banners[]')">
                @{{ errors.first('banners[]') }}
            </span>
        </div>
    </div>
</accordian>