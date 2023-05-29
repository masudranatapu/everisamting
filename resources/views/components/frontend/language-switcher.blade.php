@if ($language_enable && $setting->language_changing && isset(currentLanguage()->code))
    <!--  <li class="nav-item language_switcher dropdown show">
        <a class="nav-link text-dark" data-toggle="dropdown" href="javascript:void(0)" aria-expanded="true"
            id="language_switch_button">
            <i class="flag-icon {{ currentLanguage()->icon }}"></i>
            <span class="text-uppercase">{{ currentLanguage()->code }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right show"
            style="display:none;left: inherit; right: 0px;" id="switch_dropdown">
            @foreach ($languages as $lang)
                <a class="dropdown-item {{ currentLanguage()->code == $lang->code ? 'active' : '' }}"
                    href="{{ route('changeLanguage', $lang->code) }}">
                    <i class="flag-icon {{ $lang->icon }}"></i>
                    {{ $lang->name }}
                </a>
            @endforeach
        </div>
    </li> -->

    <div class="language_switcher dropdown">
      <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="flag-icon {{ currentLanguage()->icon ?? '' }}"></i>
        <span class="text-uppercase">{{ currentLanguage()->code ?? '' }}</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
        <li class="nav-item">
            @foreach ($languages as $lang)
                <a class="dropdown-item {{ currentLanguage()->code == $lang->code ? 'active' : '' }}"
                    href="{{ route('changeLanguage', $lang->code) }}">
                    <i class="flag-icon {{ $lang->icon }}"></i>
                    {{ $lang->name }}
                </a>
            @endforeach
        </li>
      </ul>
    </div>
@endif
