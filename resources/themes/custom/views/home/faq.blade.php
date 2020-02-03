@inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')

{!! DbView::make($templateRepository
        ->getTemplate('home-faq'))->field('html_content')->render() !!}
