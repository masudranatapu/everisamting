<div class="col-lg-3 col-6">
    <h2 class="footer__title text--body-2-600">{{ __('supports') }}</h2>

    <ul class="footer-menu">
        @if ($contact_enable)
        <li class="footer-menu__item">
            <a href="{{ route('frontend.contact') }}" class="footer-menu__link text--body-3">{{ __('contact') }}</a>
        </li>
        @endif
        @if ($faq_enable)
            <li class="footer-menu__item">
                <a href="{{ route('frontend.faq') }}" class="footer-menu__link text--body-3">{{ __('faqs') }}</a>
            </li>
        @endif
        <li class="footer-menu__item">
            <a href="{{ route('frontend.terms') }}" class="footer-menu__link text--body-3">{{ __('terms_condition') }}</a>
        </li>
        <li class="footer-menu__item">
            <a href="{{ route('frontend.privacy') }}" class="footer-menu__link text--body-3">{{ __('privacy_policy') }}</a>
        </li>
        <li class="footer-menu__item">
            <a href="{{ route('frontend.sellers') }}" class="footer-menu__link text--body-3">{{ __('sellers') }}</a>
        </li>

    </ul>
</div>
