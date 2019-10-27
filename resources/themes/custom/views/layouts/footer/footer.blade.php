<div class="footer">
    <div class="footer-content">
        <div class="footer-container full-width bg-gray-dark font-sans">
            @if(core()->getConfigData('customer.settings.newsletter.subscription'))
                <div class="main-container-wrapper h-75 sm:h-48">
                    <div class="full-width flex flex-col sm:flex-row justify-between items-center h-48 sm:h-24">
                        <div>
                            <p class="text-white text-4xl text-center">{{ __('shop::app.footer.subscribe-newsletter') }}<span
                                    class="text-yellow">{{ __('shop::app.footer.subscribe-newsletter-span') }}</span>
                            </p>
                        </div>
                        <div class="form-container full-width ml-0 sm:ml-2 pt-0 sm:pt-10 mb-2">
                            <form action="{{ route('shop.subscribe') }}">
                                <div class="control-group flex-col sm:flex-row justify-between items-center"
                                     :class="[errors.has('subscriber_email') ? 'has-error' : '']">
                                    <input type="email"
                                           class="control subscribe-field bg-transparent font-light font-serif text-xs tracking-wider uppercase text-white h-8 w-full sm:w-48 border-b border-yellow-unclean focus:border-yellow"
                                           name="subscriber_email"
                                           placeholder="email" required>
                                    <button>
                                        <span class="font-serif text-xs tracking-wider uppercase text-yellow inline-block align-baseline ml-6 mt-2 h-4">
                                            {{ __('shop::app.subscription.subscribe') }}
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline-block feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <p class="text-center sm:text-left sm:w-1/2 text-gray-light font-serif pb-4"> {{ __('shop::app.footer.subscribe-newsletter-sub') }}
                        <a href="#"
                           class="text-yellow font-serif underline">{{ __('shop::app.footer.subscribe-newsletter-sub-span') }}</a>
                    </p>
                </div>
            @endif
        </div>
        {!! DbView::make(core()->getCurrentChannel())->field('footer_content')->render() !!}
    </div>
</div>
