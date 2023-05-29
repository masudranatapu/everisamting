@php
$user = auth()->user();
@endphp
<li class="nav-item dropdown">
    <a class="nav-link d-flex justify-content-center align-items-center" data-toggle="dropdown" href="#"
        aria-expanded="false">
        <i class="fas fa-plus"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
        <span class="dropdown-item dropdown-header">{{ __('quick_actions') }}</span>
        <div class="dropdown-divider"></div>
        <div class="row row-paddingless" style="padding-left: 15px; padding-right: 15px;">
            @if (userCan('admin.create'))
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="{{ route('user.create') }}" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-users"></i>
                        <span class="w-100 d-block text-muted">{{ __('add_user') }}</span>
                    </a>
                </div>
            @endif
            @if (userCan('role.create'))
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="{{ route('role.create') }}" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-lock"></i>
                        <span class="w-100 d-block text-muted">{{ __('add_role') }}</span>
                    </a>
                </div>
            @endif

            @if (userCan('setting.view') || userCan('setting.update'))
                <div class="col-6 p-0 border-bottom border-right">
                    <a href="{{ route('settings.general') }}" class="d-block text-center py-3 bg-hover-light"> <i
                            class="fas fa-cog"></i>
                        <span class="w-100 d-block text-muted">{{ __('settings') }}</span>
                    </a>
                </div>
            @endif
        </div>
        <div class="dropdown-divider"></div>
    </div>
</li>
@if ($language_enable)
    <li class="nav-item dropdown">
        <a class="nav-link d-flex justify-content-center align-items-center" data-toggle="dropdown" href="#"
            aria-expanded="false">
            <i class="fas fa-language" style="font-size: 22px"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="left: inherit; right: 0px;">
            @foreach ($languages as $lang)
                <a class="dropdown-item {{ session('set_lang') === $lang->code ? 'active' : '' }}"
                    href="{{ route('changeLanguage', $lang->code) }}">
                    <i class="flag-icon {{ $lang->icon }}"></i> {{ $lang->name }}
                </a>
            @endforeach
        </div>
    </li>
@endif
<li class="nav-item">
    <a class="nav-link d-flex justify-content-center align-items-center" data-widget="fullscreen" href="#"
        role="button">
        <i class="fas fa-expand-arrows-alt"></i>
    </a>
</li>
@if ($appearance_enable)
    <li class="nav-item">
        <form action="{{ route('settings.mode.update') }}" method="post" id="mode_form">
            @csrf
            @method('PUT')
            @if ($setting->dark_mode)
                <input type="hidden" name="dark_mode" value="0">
            @else
                <input type="hidden" name="dark_mode" value="1">
            @endif
        </form>
        <a onclick="$('#mode_form').submit()" class="nav-link d-flex justify-content-center align-items-center"
            href="#" role="button">
            @if ($setting->dark_mode)
                <i class="fas fa-sun"></i>
            @else
                <i class="fas fa-moon"></i>
            @endif
        </a>
    </li>
@endif
<li class="nav-item dropdown user-menu">
    <a href="{{ route('profile') }}" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        @if ($user->image_url)
            <img src="{{ asset($user->image) }}" class="user-image img-circle elevation-2">
        @else
            <img src="{{ asset('image/default-user.png') }}" class="user-image img-circle elevation-2">
        @endif
        <span class="d-none d-md-inline">{{ $user->name }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right rounded border-0" style="left: inherit; right: 0px;">
        <!-- User image -->
        <li class="user-header bg-primary rounded-top">
            <img src="{{ asset($user->image) }}" class="user-image img-circle elevation-2"
                alt="{{ __('user_image') }}">
            <p>
                {{ $user->name }} -
                @foreach ($user->getRoleNames() as $role)
                    (<span>{{ ucwords($role) }}</span>)
                @endforeach
                <small>{{ __('member_since') }} {{ $user->created_at->format('M d, Y') }}</small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer border-bottom d-flex">
            <a href="{{ route('profile') }}" class="btn btn-default">{{ __('profile') }}</a>
            <a href="javascript:void(0)"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                class="btn btn-default ml-auto">{{ __('sign_out') }}</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none invisible">
                @csrf
            </form>
        </li>
    </ul>
</li>
