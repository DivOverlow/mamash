
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
                        <div class="mt-2 text-brownish-pink hover:text-gray-500"><a href="@php echo route('shop.cms.page', 'about-us') @endphp">Політика конфіденційності</a></div>
                        <p>Copyright 2017 Mamash Organic All Rights Reserved</p>
                    </div>
            </div>
        </div>
    </div>
</div>
