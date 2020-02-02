{{--@inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')--}}

{{--{!! DbView::make($templateRepository--}}
{{--        ->getTemplate('banner-product-gift'))->field('html_content')->render() !!}--}}

{!! view_render_event('bagisto.shop.products.view.banner.before', ['banner_key' => $banner_key]) !!}

@inject ('bannerRepository', 'Webkul\Core\Repositories\BannerRepository')

{!! DbView::make($bannerRepository
        ->getBanner($banner_key))->field('html_content')->render() !!}
