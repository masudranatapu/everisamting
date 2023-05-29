<div class="dashboard__navigation">
    @php
        $user = auth('user')->user();
        $user_plan = DB::table('user_plans')->where('user_id', $user->id)->first();
    @endphp
    <div class="dashboard__navigation-top">
        <div class="dashboard__user-proifle">
            <div class="dashboard__user-img">
                <img src="{{ $user->image_url }}" alt="user-photo" />
            </div>
            <div class="dashboard__user-info">
                <h2 class="name text--body-2-600">{{ $user->name }}</h2>
                <p class="designation">{{ $user->username }}</p>
            </div>
        </div>
    </div>
    <div class="dashboard__navigation-bottom">
        <ul class="dashboard__nav">
            <li class="dashboard__nav-item">
                <a href="{{ route('frontend.dashboard') }}"
                    class="dashboard__nav-link {{ request()->routeIs('frontend.dashboard') ? 'active' : '' }}">
                    <span class="icon">
                        <x-svg.overview-icon />
                    </span>
                    {{ __('overview') }}
                </a>
            </li>
            @if($user->is_social_login == 2 || $user->is_social_login == 0)
                <li class="dashboard__nav-item">
                    <a href="{{ route('frontend.seller.profile', $user->username) }}"
                        class="dashboard__nav-link {{ request()->routeIs('frontend.seller-dashboard') ? 'active' : '' }}">
                        <span class="icon">
                            <x-svg.user-icon width="24" height="24" stroke="currentColor" />
                        </span>
                        {{ __('public_profile') }}
                    </a>
                </li>

                @if ($user_plan->ad_limit == 0 || (isset($user_plan->expired_date) && $user_plan->expired_date < now()->format('Y-m-d')))
                    <li class="dashboard__nav-item">
                        <a href="{{ route('frontend.dashboard') }}"
                            class="dashboard__nav-link">
                            <span class="icon">
                                <x-svg.image-select-icon />
                            </span>
                            {{ __('post_ads') }}
                        </a>
                    </li>
                @else
                    <li class="dashboard__nav-item">
                        <a href="{{ route('frontend.post') }}"
                            class="dashboard__nav-link {{ request()->routeIs('frontend.post') ? 'active' : '' }}">
                            <span class="icon">
                                <x-svg.image-select-icon />
                            </span>
                            {{ __('post_ads') }}
                        </a>
                    </li>
                @endif
                <li class="dashboard__nav-item">
                    <a href="{{ route('frontend.adds') }}"
                        class="dashboard__nav-link {{ request()->routeIs('frontend.adds') ? 'active' : '' }}">
                        <span class="icon">
                            <x-svg.list-icon width="24" height="24" stroke="currentColor" />
                        </span>
                        {{ __('my_ads') }}
                    </a>
                </li>
                <li class="dashboard__nav-item">
                    <a href="{{ route('frontend.favourites') }}"
                        class="dashboard__nav-link {{ request()->routeIs('frontend.favourites') ? 'active' : '' }}">
                        <span class="icon">
                            <x-svg.heart-icon fill="none" stroke="currentColor" />
                        </span>
                        {{ __('favorite_ads') }}
                    </a>
                </li>
                <li class="dashboard__nav-item">
                    @php
                        $unread_messages = App\Models\Messenger::where('to_id', auth('user')->id())
                            ->where('body', '!=', '.')
                            ->where('read', 0)
                            ->count();
                    @endphp
                    <a href="{{ route('frontend.message') }}"
                        class="dashboard__nav-link {{ request()->routeIs('frontend.message') ? 'active' : '' }}">
                        <span class="icon">
                            <x-svg.message-icon width="24" height="24" stroke="currentColor" />
                        </span>
                        {{ __('message') }}

                        <span id="unread_count_custom2" class="text-danger {{ $unread_messages ? '' : 'd-none' }}"
                            amount="{{ $unread_messages }}">
                            ({{ $unread_messages }})
                        </span>
                    </a>
                </li>
                <li class="dashboard__nav-item">
                    <a href="{{ route('frontend.myevent') }}"
                        class="dashboard__nav-link {{ request()->routeIs('frontend.myevent') ? 'active' : '' }}">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#b3b3b3" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </span>
                        {{ __('my_events') }}
                    </a>
                </li>
                <li class="dashboard__nav-item">
                    <a href="{{ route('frontend.user-business-directory.index') }}"
                        class="dashboard__nav-link {{ Request::is('dashboard/user-business-directory') || Request::is('dashboard/user-business-directory/create') || Request::is('dashboard/user-business-directory/*') ? 'active' : '' }}">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#b3b3b3" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel">
                                <path d="M6 2L3 6v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V6l-3-4H6zM3.8 6h16.4M16 10a4 4 0 1 1-8 0"/>
                            </svg>
                        </span>
                        {{ __('business_directory') }}
                    </a>
                </li>
                <li class="dashboard__nav-item">
                    <a href="{{ route('frontend.plans-billing') }}"
                        class="dashboard__nav-link  {{ request()->routeIs('frontend.plans-billing') ? 'active' : '' }}">
                        <span class="icon">
                            <x-svg.invoice-icon width="24" height="24" stroke="currentColor" />
                        </span>
                        {{ __('plans_billing') }}
                    </a>
                </li>
            @endif
            <li class="dashboard__nav-item">
                <a href="{{ route('frontend.account-setting') }}"
                    class="dashboard__nav-link {{ request()->routeIs('frontend.account-setting') ? 'active' : '' }}">
                    <span class="icon">
                        <x-svg.setting-icon />
                    </span>
                    {{ __('account_settings') }}
                </a>
            </li>
            <li class="dashboard__nav-item">
                <a href="#" class="dashboard__nav-link"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span class="icon">
                        <x-svg.logout-icon />
                    </span>
                    {{ __('sign_out') }}
                </a>

                <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <span class="dashboard__navigation-toggle-btn">
        <x-svg.toggle-icon />
    </span>
</div>
