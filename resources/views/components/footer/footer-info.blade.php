<div class="col-xl-3 col-lg-4 col-md-6">
    <div class="footer__brand-logo">
        @if ($logotype === 'dark')
            <img style=" height: 77px;width: 182px;" src="{{ $settings->white_logo_url }}" alt="logo-brand" />
        @else
            <img style="height: 77px;width: 182px;" src="{{ $settings->logo_image_url }}" alt="logo-brand" />
        @endif
    </div>
    <div class="footer__loc-info">
        @if($cms->contact_address)
            <p class="text--body-3">
                {{ $cms->contact_address }}
            </p>
        @endif
        @if($cms->contact_number)
            <p class="text--body-3 phone">
                <a style="color: #767e94" href="tel:{{ $cms->contact_number }}"> {{ __('phone') }}: {{ $cms->contact_number }} </a>
            </p>
        @endif
        @if($cms->contact_email)
            <p class="text--body-3 email text-lowercase">
                <a style="color: #767e94" href="mailto:{{ $cms->contact_email }}"> {{ __('mail') }}: {{ $cms->contact_email }} </a>
            </p>
        @endif
    </div>
    <x-footer.footer-social />
</div>
