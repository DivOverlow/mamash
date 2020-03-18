{!! view_render_event('bagisto.shop.products.view.banner.before', ['banner_key' => $banner_key]) !!}

@inject ('bannerRepository', 'Webkul\Core\Repositories\BannerRepository')


{!! DbView::make($banner = $bannerRepository
        ->getBanner($banner_key))
        ->with( ['image' => $banner->path])
        ->field('html_content')->render() !!}
