<aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- style="background-color: {{ $setting->dark_mode ? '' : $setting->sidebar_color }}"> --}}
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ $setting->favicon_image_url }}" alt="{{ __('Logo') }}" class="elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-nav-wrapper">
            <!-- Sidebar Menu -->
            <nav class="sidebar-main-nav mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @if ($user->can('dashboard.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('admin.dashboard') ? true : false"
                                              route="admin.dashboard" icon="fas fa-tachometer-alt">
                            {{ __('dashboard') }}
                        </x-admin.sidebar-list>
                    @endif
                    <li class="nav-header">{{ __('order') }}</li>
                    @if (Module::collections()->has('Customer') && userCan('customer.view'))
                        <li class="nav-item">
                            <a href="{{ route('module.customer.index') }}"
                               class="nav-link {{ Route::is('module.customer.*') ? ' active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>{{ __('customer') }}</p>
                            </a>
                        </li>
                    @endif
                    @if (Module::collections()->has('Plan') && userCan('plan.view') && $priceplan_enable)
                        <x-sidebar-list
                            :linkActive="Route::is('module.plan.index') || Route::is('module.plan.create') ? true : false"
                            route="module.plan.index" icon="fas fa-credit-card">
                            {{ __('pricing_plan') }}
                        </x-sidebar-list>
                    @endif
                    <x-sidebar-list :linkActive="Route::is('report.index') ? true : false" route="report.index"
                                    icon="fas fa-file">
                        {{ __('seller_report') }}
                    </x-sidebar-list>

                    <li class="nav-header">{{ __('ads') }}</li>
                    @if (Module::collections()->has('Ad') && userCan('ad.view'))
                        <x-sidebar-list :linkActive="Route::is('module.ad.*') ? true : false" route="module.ad.index"
                                        icon="fas fa-store">
                            {{ __('all_listings') }}
                        </x-sidebar-list>
                    @endif
                    @if (Module::collections()->has('Category') && (userCan('category.view') ||
                    userCan('subcategory.view')))
                        <x-admin.sidebar-list
                            :linkActive="Route::is('module.category.*') || Route::is('module.subcategory.*') ? true : false"
                            route="module.category.index" icon="fas fa-th">
                            {{ __('category') }}
                        </x-admin.sidebar-list>
                    @endif
                    {{--                    @if (Module::collections()->has('CustomField') && userCan('custom-field.view'))--}}
                    {{--                        <x-admin.sidebar-list :linkActive="Route::is('module.custom.field.*') ? true : false"--}}
                    {{--                                              route="module.custom.field.index" icon="fas fa-edit">--}}
                    {{--                            {{ __('custom_field') }}--}}
                    {{--                        </x-admin.sidebar-list>--}}
                    {{--                    @endif--}}
                    @if (Module::collections()->has('Location'))
                        @if (userCan('city.view') || userCan('town.view'))
                            <x-sidebar-dropdown
                                :linkActive="Route::is('module.city.*') || Route::is('module.town.*') ? true : false"
                                :subLinkActive="Route::is('module.city.*') || Route::is('module.town.*') ? true : false"
                                icon="fas fa-location-arrow">
                                @slot('title')
                                    {{ __('location') }}
                                @endslot

                                @if (userCan('city.view'))
                                    <ul class="nav nav-treeview">
                                        <x-sidebar-list :linkActive="Route::is('module.city.*') ? true : false"
                                                        route="module.city.index" icon="fas fa-circle">
                                            {{ __('city') }}
                                        </x-sidebar-list>
                                    </ul>
                                @endif
                                @if (userCan('town.view'))
                                    <ul class="nav nav-treeview">
                                        <x-sidebar-list :linkActive="Route::is('module.town.*') ? true : false"
                                                        route="module.town.index" icon="fas fa-circle">
                                            {{ __('town') }}
                                        </x-sidebar-list>
                                    </ul>
                                @endif

                            </x-sidebar-dropdown>
                        @endif
                    @endif
                    @if (Module::collections()->has('Brand') && userCan('brand.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.brand.*') ? true : false"
                                              route="module.brand.index" icon="fab fa-renren">
                            {{ __('brand') }}
                        </x-admin.sidebar-list>
                    @endif

                    @if (userCan('model.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.model.*') ? true : false"
                                              route="module.model.index" icon="fas fa-hourglass">
                            {{ __('product_model') }}
                        </x-admin.sidebar-list>
                    @endif
                    @if (userCan('serviceType.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.serviceType.*') ? true : false"
                                              route="module.serviceType.index" icon="fas fa-handshake">
                            {{ __('service_type') }}
                        </x-admin.sidebar-list>
                    @endif
                    @if (userCan('designation.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.designation.*') ? true : false"
                                              route="module.designation.index" icon="fas fa-award">
                            {{ __('designation') }}
                        </x-admin.sidebar-list>
                    @endif

                    @if (Module::collections()->has('Map') && userCan('map.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.map.*') ? true : false"
                                              route="module.map.index" icon="fas fa-map-marker-alt">
                            {{ __('map') }}
                        </x-admin.sidebar-list>
                    @endif
                    {{-- event --}}
                    <li
                        class="nav-item has-treeview {{ Request::is('admin/event-category') || Request::is('admin/event-tags') || Request::is('admin/event-organiser') || Request::is('admin/event-venues') || Request::is('admin/event-venues/create') || Request::is('admin/event-venues/*') || Request::is('admin/events') || Request::is('admin/events/create') || Request::is('admin/events/*') ? 'menu-open' : '' }}">
                        <a href="javascript:void(0)" class="nav-link ">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>Event Manage <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('events.index') }}"
                                   class="nav-link {{ Request::is('admin/events') || Request::is('admin/events/create') || Request::is('admin/events/*')  ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p>Events</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('event-category.index') }}"
                                   class="nav-link {{ Request::is('admin/event-category') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p>Event Category</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('event-tags.index') }}"
                                   class="nav-link {{ Request::is('admin/event-tags') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p>Event Tag</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('event-venues.index') }}"
                                   class="nav-link {{ Request::is('admin/event-venues') || Request::is('admin/event-venues/create') || Request::is('admin/event-venues/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p>Event Venues</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('event-organiser.index') }}"
                                   class="nav-link {{ Request::is('admin/event-organiser') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-circle"></i>
                                    <p>Event Organiser</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('business-directory.index') }}"
                           class="nav-link {{ Request::is('admin/business-directory') || Request::is('admin/business-directory/create') || Request::is('admin/business-directory/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-business-time"></i>
                            <p>Business Directory</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('business.claim') }}"
                           class="nav-link {{ Route::is('business.claim') || Route::is('business.claim.edit') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-business-time"></i>
                            <p>Claimed Business</p>
                        </a>
                    </li>

                    <li class="nav-header">{{ __('others') }}</li>

                    @if ($user->can('admin.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('user.*') || Route::is('role.*') ? true : false"
                                              route="user.index" icon="fas fa-users">
                            {{ __('user_role_manage') }}
                        </x-admin.sidebar-list>
                    @endif
                    {{-- Newsletter Subscription --}}
                    @if (Module::collections()->has('Newsletter') && $newsletter_enable)
                        @if (userCan('newsletter.view') || userCan('newsletter.mailsend'))
                            <x-sidebar-dropdown :linkActive="Route::is('module.newsletter.*') ? true : false"
                                                :subLinkActive="Route::is('module.newsletter.*') ? true : false"
                                                icon="fas fa-envelope">
                                @slot('title')
                                    {{ __('newsletter') }}
                                @endslot

                                @if (userCan('newsletter.view'))
                                    <ul class="nav nav-treeview">
                                        <x-sidebar-list
                                            :linkActive="Route::is('module.newsletter.index') ? true : false"
                                            route="module.newsletter.index" icon="fas fa-circle">
                                            {{ __('emails') }}
                                        </x-sidebar-list>
                                    </ul>
                                @endif
                                @if (userCan('newsletter.mailsend'))
                                    <ul class="nav nav-treeview">
                                        <x-sidebar-list
                                            :linkActive="Route::is('module.newsletter.send_mail') ? true : false"
                                            route="module.newsletter.send_mail" icon="fas fa-circle">
                                            {{ __('send_mail') }}
                                        </x-sidebar-list>
                                    </ul>
                                @endif

                            </x-sidebar-dropdown>
                        @endif
                    @endif

                    {{-- Blog and Tag --}}
                    @if (Module::collections()->has('Blog'))
                        @if ($blog_enable)
                            @if (userCan('post.view') || userCan('postcategory.view'))
                                <x-sidebar-dropdown :linkActive="Route::is('module.post.*') || Route::is('module.postcategory.*')
                                    ? true
                                    : false" :subLinkActive="Route::is('module.post.*') || Route::is('module.postcategory.*')
                                    ? true
                                    : false" icon="fas fa-blog">
                                    @slot('title')
                                        {{ __('blog') }}
                                    @endslot

                                    @if (userCan('postcategory.view'))
                                        <ul class="nav nav-treeview">
                                            <x-sidebar-list
                                                :linkActive="Route::is('module.postcategory.*') ? true : false"
                                                route="module.postcategory.index" icon="fas fa-circle">
                                                {{ __('post_category') }}
                                            </x-sidebar-list>
                                        </ul>
                                    @endif
                                    @if (userCan('post.view'))
                                        <ul class="nav nav-treeview">
                                            <x-sidebar-list :linkActive="Route::is('module.post.*') ? true : false"
                                                            route="module.post.index" icon="fas fa-circle">
                                                {{ __('post') }}
                                            </x-sidebar-list>
                                        </ul>
                                    @endif
                                </x-sidebar-dropdown>
                            @endif
                        @endif
                    @endif

                    @if (Module::collections()->has('Testimonial') && userCan('testimonial.view') &&
                    $testimonial_enable)
                        <x-admin.sidebar-list :linkActive="Route::is('module.testimonial.*') ? true : false"
                                              route="module.testimonial.index" icon="fas fa-comment">
                            {{ __('testimonial') }}
                        </x-admin.sidebar-list>
                    @endif
                    @if (Module::collections()->has('Contact') && userCan('contact.view') && $contact_enable)
                        <x-admin.sidebar-list :linkActive="Route::is('module.contact.*') ? true : false"
                                              route="module.contact.index" icon="fas fa-address-book">
                            {{ __('contact') }}
                        </x-admin.sidebar-list>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('business.author.cotnact') }}"
                           class="nav-link {{ Request::is('admin/business-author-contact') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-address-card"></i>
                            <p>Author Contact</p>
                        </a>
                    </li>
                    @if (userCan('push.notification.index'))
                        <li class="nav-item">
                            <a href="{{ route('admin.push.notification.index') }}"
                               class="nav-link {{ Route::is('admin.push.notification.*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-address-card"></i>
                                <p>Push Notification</p>
                            </a>
                        </li>
                    @endif

                    @if (userCan('faq.view') && $faq_enable)
                        <x-admin.sidebar-list :linkActive="Route::is('module.faq.*') ? true : false"
                                              route="module.faq.index" icon="fas fa-question">
                            {{ __('faq') }}
                        </x-admin.sidebar-list>
                    @endif
                    @if ($settings->ads_admin_approval)
                        <form action="{{ route('module.ad.index') }}" method="GET" id="pending_ads_form">
                            <input name="filter_by" type="text" value="pending" hidden>
                            <input name="sort_by" type="text" value="latest" hidden>
                        </form>
                        <button onclick="$('#pending_ads_form').submit();" type="button"
                                class="btn btn-primary mt-4 mx-3 text-white mb-3">
                            {{ __('pending_ads') }}
                        </button>
                    @endif
                </ul>
            </nav>
            <!-- Sidebar Menu -->
            <nav class="mt-2 nav-footer" style="border-top: 1px solid gray; padding-top: 20px;">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a target="_blank" href="/" class="nav-link" style="background-color: #007bff; color: #fff;">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>{{ __('visit_website') }}</p>
                        </a>
                    </li>
                    @if ($user->can('setting.view') || $user->can('setting.update'))
                        <x-admin.sidebar-list :linkActive="request()->is('admin/settings/*') ? true : false"
                                              route="settings.general" icon="fas fa-cog">
                            {{ __('settings') }}
                        </x-admin.sidebar-list>
                    @endif
                    <li class="nav-item">
                        <a href="javascript:void(0" class="nav-link"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>{{ __('logout') }} </p>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                              class="d-none invisible">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
