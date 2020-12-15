
{{--@inject ('templateRepository', 'Webkul\CMS\Repositories\TemplateRepository')--}}

{{--<div class="footer">--}}
{{--    <div class="footer-content">--}}
{{--        {!! DbView::make($templateRepository->getTemplate('footer'))->field('html_content')->render() !!}--}}
{{--    </div>--}}
{{--</div>--}}


<div class="footer">
    <div class="footer-content container flex content-center w-full bg-white" style="min-height: 181px">
        <div class="footer-list-container w-full">
            <div class="list-container flex">
{{--                {!! DbView::make(core()->getCurrentChannel())->field('footer_content')->render() !!}--}}
                    <div class="flex justify-between">
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-700 uppercase mb-2">Косметолог</span>
                            <span class="my-0"><a href="#" class="text-blue-700 text-md hover:text-blue-500">+38 (067) 203 11 27</a></span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-700 uppercase mt-4 md:mt-0 mb-2">Служба підтримки</span>
                            <span class="my-0"><a href="#" class="text-blue-700 text-md hover:text-blue-500">+38 (067) 203 11 27</a></span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-700 uppercase mt-4 md:mt-0 mb-2">Емайл</span>
                            <span class="my-0"><a href="#" class="text-brownish-pink text-md hover:text-blue-500">info@mamash.com.ua</a></span>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        @if(core()->getConfigData('customer.settings.newsletter.subscription'))
                            <span class="list-heading">{{ __('shop::app.footer.subscribe-newsletter') }}</span>
                            <div class="form-container">
                                <form action="{{ route('shop.subscribe') }}">
                                    <div class="control-group" :class="[errors.has('subscriber_email') ? 'has-error' : '']">
                                        <input type="email" class="control subscribe-field" name="subscriber_email" placeholder="Email Address" required><br/>

                                        <button class="btn btn-md btn-primary">{{ __('shop::app.subscription.subscribe') }}</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>
