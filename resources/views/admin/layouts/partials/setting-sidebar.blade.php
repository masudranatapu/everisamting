<aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ $setting->favicon_image_url }}" alt="{{ __('Logo') }}" class="elevation-3">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-nav-wrapper">
            <!-- Sidebar Menu -->
            <nav class="sidebar-main-nav mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @if ($user->can('dashboard.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('admin.dashboard') ? true : false" route="admin.dashboard" icon="fas fa-tachometer-alt">
                            {{ __('dashboard') }}
                        </x-admin.sidebar-list>
                    @endif

                    {{-- Website Setting --}}
                    <li class="nav-header">{{ __('website_setting') }}</li>
                    <x-admin.sidebar-list :linkActive="Route::is('settings.system') ? true : false" route="settings.system" icon="fas fa-hashtag">
                        {{ __('preferences') }}
                    </x-admin.sidebar-list>
                    <x-admin.sidebar-list :linkActive="Route::is('settings.social.login') ? true : false" route="settings.social.login" icon="fab fa-facebook">
                        {{ __('social_login') }}
                    </x-admin.sidebar-list>
                  <!--   <x-admin.sidebar-list :linkActive="Route::is('settings.cookies') ? true : false" route="settings.cookies" icon="fas fa-cookie-bite">
                        {{ __('cookies_alert') }}
                    </x-admin.sidebar-list> -->
                    <x-admin.sidebar-list :linkActive="Route::is('settings.seo.*') ? true : false" route="settings.seo.index" icon="fas fa-award">
                        {{ __('seo') }} {{ __('settings') }}
                    </x-admin.sidebar-list>
                   <!--  <x-admin.sidebar-list :linkActive="Route::is('settings.custom') ? true : false" route="settings.custom" icon="fas fa-tools">
                        {{ __('custom_css_and_JS') }}
                    </x-admin.sidebar-list> -->
                    <x-admin.sidebar-list :linkActive="Route::is('settings.cms') ? true : false" route="settings.cms" icon="fas fa-paragraph">
                        {{ __('cms') }}
                    </x-admin.sidebar-list>

                    {{-- System Setting --}}
                    <li class="nav-header">{{ __('system_setting') }}</li>
                    <x-admin.sidebar-list :linkActive="Route::is('settings.general') ? true : false" route="settings.general" icon="fas fa-cog">
                        {{ __('general') }}
                    </x-admin.sidebar-list>
                    @if ($language_enable)
                        @if (Auth::user()->can('setting.view') || Auth::user()->can('setting.update'))
                            <x-admin.sidebar-list :linkActive="Route::is('language.*') ? true : false" route="language.index" icon="fas fa-globe-asia">
                                {{ __('language') }}
                            </x-admin.sidebar-list>
                        @endif
                    @endif
                    <!-- <x-admin.sidebar-list :linkActive="Route::is('settings.theme') ? true : false" route="settings.theme" icon="fas fa-swatchbook">
                        {{ __('theme') }}
                    </x-admin.sidebar-list> -->
                    <x-admin.sidebar-list :linkActive="Route::is('settings.email') ? true : false" route="settings.email" icon="fas fa-envelope">
                        {{ __('SMTP') }}
                    </x-admin.sidebar-list>
                    <x-admin.sidebar-list :linkActive="Route::is('module.currency.*') ? true : false" route="module.currency.index" icon="fas fa-dollar-sign">
                        {{ __('currency') }}
                    </x-admin.sidebar-list>
                   <!--  <x-admin.sidebar-list :linkActive="Route::is('settings.database.backup.*') ? true : false" route="settings.database.backup.index"
                        icon="fas fa-database">
                        {{ __('backup') }}
                    </x-admin.sidebar-list> -->
                    <x-admin.sidebar-list :linkActive="Route::is('settings.payment') ? true : false" route="settings.payment" icon="fas fa-credit-card">
                        {{ __('payment_gateway') }}
                    </x-admin.sidebar-list>
                    <!-- <x-admin.sidebar-list :linkActive="Route::is('settings.module') ? true : false" route="settings.module" icon="fas fa-cog">
                        {{ __('module') }}
                    </x-admin.sidebar-list> -->

                    {{-- Mobile App Setting --}}
                    @if (Module::collections()->has('MobileApp'))
                        <li class="nav-header">{{ __('mobile_app_settings') }}</li>
                        <x-admin.sidebar-list :linkActive="Route::is('mobile-config.*') ? true : false" route="mobile-config.index" icon="fas fa-mobile">
                            {{ __('mobile_app_config') }}
                        </x-admin.sidebar-list>
                    @endif
                </ul>
            </nav>
            <!-- Sidebar Menu -->
            @if ($user->can('dashboard.view'))
                <nav class="mt-2 nav-footer" style="border-top: 1px solid gray; padding-top: 20px;">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link"
                                style="background-color: #007bff; color: #fff;">
                                <i class="nav-icon fas fa-chevron-left"></i>
                                <p>{{ __('go_back') }}</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
