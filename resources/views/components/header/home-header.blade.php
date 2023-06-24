<header class="header header--two" id="sticky-menu">
    <div class="navigation-bar__top">
        <div class="container">
            <div class="navigation-bar">
                <div class="d-flex align-items-center">
                    <button class="toggle-icon  ">
                        <span class="toggle-icon__bar"></span>
                        <span class="toggle-icon__bar"></span>
                        <span class="toggle-icon__bar"></span>
                    </button>
                    <!-- Brand Logo -->
                    <a href="{{ route('frontend.index') }}" class="navigation-bar__logo d-none d-xl-block">
                        <img src="{{ $settings->logo_image_url }}" alt="brand-logo" class="logo-dark">
                    </a>
                </div>
                <!-- Search Field -->
                <form class="d-none d-xl-block" action="{{ route('frontend.adlist.search') }}" method="GET">
                    <div class="navigation-bar__search-field">
                        <input type="text" placeholder="{{ __('ads_title_keyword') }}..." name="keyword" />
                        <button type="submit" class="navigation-bar__search-icon">
                            <x-svg.search-icon />
                        </button>
                    </div>
                </form>


                <div class="d-flex align-items-center">
                    <a href="{{ route('frontend.index') }}" class="navigation-bar__logo d-block d-xl-none">
                        <img src="{{ $settings->logo_image_url }}" alt="brand-logo" class="logo-dark">
                    </a>
                </div>

                <!-- Action Buttons -->
                <div class="navigation-bar__buttons">
                    @if (auth('user')->check())
                        <a href="{{ route('frontend.dashboard') }}" class="user position-relative">
                            <div class="user__img-wrapper">
                                <img src="{{ auth('user')->user()->image_url }}"
                                    style="width: 40px; height: 40px; border-radius: 50%" alt="User Image">
                            </div>
                        </a>
                        <a href="{{ route('frontend.post') }}" class="btn">
                            <span class="icon--left">
                                <x-svg.image-select-icon />
                            </span>
                            {{ __('post_ads') }}
                        </a>
                    @else
                        <a href="{{ route('users.login') }}" class="btn btn--bg">{{ __('sign_in') }}</a>
                        <a href="{{ route('users.login') }}" class="btn">
                            <span class="icon--left">
                                <x-svg.image-select-icon />
                            </span>
                            {{ __('post_ads') }}
                        </a>
                    @endif
                </div>
                <!-- Responsive Navigation Menu  -->
                <x-frontend.responsive-menu />
            </div>
        </div>
    </div>
    <div class="navigation-bar__bottom-wrap">
        <div class="container navigation-bar__bottom justify-content-between">
            <div class="d-flex align-items-center">
                <!-- category menu -->
                <ul class="category-menu">
                    <li class="category-menu__item">
                        <a href="#" class="category-menu__link">
                            {{ __('all_categories') }}
                            <span class="icon">
                                <x-svg.category-arrow-icon />
                            </span>
                        </a>
                        <ul class="category-menu__dropdown">
                            <div class="overflow_scroll">
                                @foreach ($categories as $category)
                                    @php
                                        $totalcateads = DB::table('ads')
                                            ->where('category_id', $category->id)
                                            ->get();
                                    @endphp
                                    {{-- Filter Form-2 --}}
                                    <form method="GET" action="{{ route('frontend.adlist.search') }}"
                                        id="adFilterForm2" class="d-none">
                                        <input type="hidden" name="category" value="" id="adFilterInput2">
                                    </form>

                                    <li class="category-menu__dropdown__item">
                                        <a href="{{ route('frontend.adlist.search', $category->slug) }}"
                                            class="category-menu__dropdown__link">
                                            <i class="category-icon {{ $category->icon }}" style="color: #f27319"></i>
                                            {{ __(str_replace(' ', '_', strtolower($category->name))) }} (
                                            {{ $totalcateads->count() }} )
                                            @if ($category->subcategories->count() > 0)
                                                <span class="drop-icon">
                                                    <x-svg.category-right-icon />
                                                </span>
                                            @endif
                                        </a>
                                        @if ($category->subcategories->count() > 0)
                                            <ul class="category-menu__subdropdown">
                                                <div class="overflow_scroll">
                                                    @foreach ($category->subcategories as $subcategory)
                                                        @php
                                                            $totalsubcateads = DB::table('ads')
                                                                ->where('subcategory_id', $subcategory->id)
                                                                ->get();
                                                        @endphp
                                                        {{-- Filter Form-3 --}}
                                                        <form method="GET"
                                                            action="{{ route('frontend.adlist.search') }}"
                                                            id="adFilterForm3" class="d-none">
                                                            <input type="hidden" name="subcategory[]" value=""
                                                                id="adFilterInput3">
                                                        </form>

                                                        <li class="category-menu__subdropdown__item">
                                                            <a href="{{ route('frontend.adlist.search', [$category->slug, 'subcategory[]' => $subcategory->slug]) }}"
                                                                class="category-menu__subdropdown__link">
                                                                {{ __(str_replace(' ', '_', strtolower($subcategory->name))) }}
                                                                ( {{ $totalsubcateads->count() }} )
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </div>
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </div>
                        </ul>
                    </li>
                </ul>
                <!-- Category Item -->
                <ul class="categories">
                    <li class="categories__item">
                        <a href="{{ route('frontend.business.directories') }}" class="categories__link"
                            style="font-weight: bold; color: black;">
                            {{ __('directories') }}
                        </a>
                    </li>
                    <li class="categories__item">
                        <a href="{{ route('frontend.event') }}" class="categories__link"
                            style="font-weight: bold; color: black;">
                            {{ __('events') }}
                        </a>
                    </li>
                    @foreach ($top_categories as $category)
                        <li class="categories__item">
                            <a href="{{ route('frontend.adlist.search', $category->slug) }}"
                                class="categories__link {{ request()->routeIs('frontend.index') ? 'active' : '' }} ">
                                {{ __(str_replace(' ', '_', strtolower($category->name))) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <x-frontend.language-switcher />

        </div>
    </div>
</header>
