@inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')

{!! DbView::make($templateRepository
        ->getTemplate('home-research'))->field('html_content')->render() !!}
