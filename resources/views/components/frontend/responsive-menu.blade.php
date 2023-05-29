@php
    $mobilecategory = DB::table('categories')->where('status', 1)->get();
@endphp
<div class="menu--sm mobile-menu">
    <!-- Head -->
    <div class="mobile-menu__header">
        <!-- brand -->
        <div class="mobile-menu__brand">
            <a href="{{ route('frontend.index') }}">
                <img src="{{ $settings->logo_image_url }}" alt="brand-logo">
            </a>
            <div class="close">
                <span>
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 5.08325L15.6066 15.6899" stroke="#191F33" stroke-width="1.9375"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.99999 15.9167L15.6066 5.31015" stroke="#191F33" stroke-width="1.9375"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </div>
        </div>
        @php
            $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));

             // Check if the "tablet" word exists in User-Agent
            $isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet"));

            $isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows"));
            $isMac = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "Mac"));

        @endphp
        @if($isMob||$isTab)

        <div class="mobile-menu__search">
            <form action="{{ route('frontend.adlist.search') }}" method="GET">
                <div class="input-field">
                    <input type="text" placeholder="{{ __('ads_title_keyword') }}..." name="keyword">
                    <button class="icon icon-search">
                        <x-svg.search-icon/>
                    </button>
                </div>
            </form>
        </div>
        @endif
        <div class="mobile-menu__body">
            <ul>
                <li class="menu--sm__item">
                    <a href="{{ route('frontend.index') }}" class="menu--sm__link">{{ __('home') }}</a>
                </li>
                <li class="menu--sm__item">
                    <a href="{{ route('frontend.event') }}" class="menu--sm__link">{{ __('events') }}</a>
                </li>
                <li class="menu--sm__item">
                    <a href="{{ route('frontend.adlist') }}" class="menu--sm__link">{{ __('ads') }}</a>
                </li>
                <li class="menu--sm__item">
                    <a href="{{ route('frontend.business.directories') }}"
                       class="menu--sm__link">{{ __('directories') }}</a>
                </li>
                <li class="menu--sm__item">
                    @if (isset($categories) && count($categories))
                        <div class="accordion sidebar_category" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">{{ __('all_categories') }}</button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                     aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($categories as $category)
                                                @php
                                                    $mobiletotalcateads = DB::table('ads')->where('category_id', $category->id)->get();
                                                @endphp
                                                <li class="menu--sm-dropdown__item">
                                                    <a href="{{ route('frontend.adlist.search', $category->slug) }}"
                                                       class="menu--sm-dropdown__link">
                                                        {{ __(str_replace(' ', '_', strtolower($category->name))) }}
                                                        ( {{ $mobiletotalcateads->count() }} )
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </li>
                @if ($blog_enable)
                    <li class="menu--sm__item">
                        <a href="{{ route('frontend.blog') }}" class="menu--sm__link">{{ __('blog') }}</a>
                    </li>
                @endif
                <li class="menu--sm__item">
                    <a href="{{ route('frontend.sellers') }}" class="menu--sm__link">{{ __('sellers') }}</a>
                </li>
                @if ($priceplan_enable)
                    <li class="menu--sm__item">
                        <a href="{{ route('frontend.priceplan') }}" class="menu--sm__link">{{ __('pricing') }}</a>
                    </li>
                @endif
            </ul>
            <div class="ps-3">
                <x-frontend.language-switcher/>
            </div>
        </div>
    </div>
    <!-- footer  -->
    <div class="mobile-menu__footer ">
        @if (auth('user')->check())
            <div class="mobile-menu__footer ">
                <div class="mobile-menu-user-wrap">
                    <div class="mobile-menu-user-left">
                        <div class="mobile-menu-user">
                            <img src="{{ auth('user')->user()->image_url }}" alt="">
                        </div>
                        <div class="mobile-menu-user-data">
                            <h5>{{ auth('user')->user()->name }}</h5>
                            <p>{{ auth('user')->user()->username }}</p>
                        </div>
                    </div>
                    <div class="mobile-menu-user-right">
                        <a class="sign-out" href="#"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <img src="{{ asset('frontend') }}/images/svg/SignOut.svg" alt="">
                        </a>
                        <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="d-flex align-items-center">
                <a href="{{ route('users.login') }}" class="btn mr-3 login_required">
                    <span class="icon--left">
                        <x-svg.image-select-icon/>
                    </span>
                    {{ __('post_ads') }}
                </a>
                <a href="{{ route('users.login') }}" class="btn btn--bg ">{{ __('sign_in') }}</a>
            </div>
        @endif
    </div>
</div>
