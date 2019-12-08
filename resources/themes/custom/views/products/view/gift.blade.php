@inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')

{!! DbView::make($templateRepository
        ->getTemplate('banner-product-gift'))->field('html_content')->render() !!}
