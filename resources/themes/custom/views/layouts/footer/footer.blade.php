
@inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')

<div class="footer">
    <div class="footer-content">
        {!! DbView::make($templateRepository->getTemplate('footer'))->field('html_content')->render() !!}
    </div>
</div>
