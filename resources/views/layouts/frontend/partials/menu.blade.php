<ul class="menu">
    <li class="menu__item">
        <a href="{{ route('frontend.index') }}" class="menu__link {{ Route::is('frontend.index') ? 'active' : '' }}">{{ __('home') }}</a>
    </li>
    <li class="menu__item">
        <a href="{{ route('frontend.adlist') }}" class="menu__link {{ Route::is('frontend.adlist') ? 'active' : '' }}">{{ __('ads') }}</a>
    </li>
    @if ($blog_enable)
        <li class="menu__item">
            <a href="{{ route('frontend.blog') }}" class="menu__link {{ Route::is('frontend.blog') ? 'active' : '' }}">{{ __('blog') }}</a>
        </li>
    @endif
    @if ($priceplan_enable)
        <li class="menu__item">
            <a href="{{ route('frontend.priceplan') }}" class="menu__link {{ Route::is('frontend.priceplan') ? 'active' : '' }}">{{ __('pricing') }}</a>
        </li>
    @endif
</ul>
