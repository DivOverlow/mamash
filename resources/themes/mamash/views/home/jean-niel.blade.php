@inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')

{!! DbView::make($templateRepository
        ->getTemplate('jean-niel'))->field('html_content')->render() !!}
