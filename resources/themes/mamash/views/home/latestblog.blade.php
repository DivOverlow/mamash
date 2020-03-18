@inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')

{!! DbView::make($templateRepository
        ->getTemplate('home-latest-blog'))->field('html_content')->render() !!}
