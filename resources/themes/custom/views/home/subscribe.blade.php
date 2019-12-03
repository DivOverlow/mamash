@if(core()->getConfigData('customer.settings.newsletter.subscription'))
    @inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')
    {!! DbView::make($templateRepository->getTemplate('subscribe'))->field('html_content')->render() !!}
@endif
