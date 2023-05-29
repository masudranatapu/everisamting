<ul class="social-icon">
    <!-- Twitter -->
    @if ($settings->twitter)
    <li class="social-icon__item">
        <a href="{{ $settings->twitter }}" class="social-icon__link">
            <x-svg.twitter-icon fill="currentColor" />
        </a>
    </li>
    @endif
    <!-- facebook -->
    @if ($settings->facebook)
    <li class="social-icon__item">
        <a href="{{ $settings->facebook }}" class="social-icon__link">
            <x-svg.facebook-icon fill="currentColor"/>
        </a>
    </li>
    @endif


    <!-- Instagram -->
    @if ($settings->instagram)
    <li class="social-icon__item">
        <a href="{{ $settings->instagram }}" class="social-icon__link">
            <x-svg.instagram-icon />
        </a>
    </li>
    @endif

    <!-- Youtube -->
    @if ($settings->youtube)
    <li class="social-icon__item">
        <a href="{{ $settings->youtube }}" class="social-icon__link">
           <x-svg.youtube-icon />
        </a>
    </li>
    @endif

    <!-- Linkedin -->
    @if ($settings->linkdin)
    <li class="social-icon__item">
        <a href="{{ $settings->linkdin }}" class="social-icon__link">
            <x-svg.linkedin-footer-icon />
        </a>
    </li>
    @endif

    <!-- whats app -->
    @if ($settings->whatsapp)
    <li class="social-icon__item">
        <a href="{{ $settings->whatsapp }}" class="social-icon__link">
            <x-svg.whatsapp-footer-icon />
        </a>
    </li>
    @endif
</ul>
