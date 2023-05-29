<li class="nav-item dashboard-post__item" role="presentation">
    <div class="nav-link dashboard-post__link
        @if (session('step1'))
            active
        @elseif (session('step1_success'))
            success
        @endif
    ">
        <!-- <span class="icon icon--default">
            <x-svg.step-one-icon />
        </span>
        <span class="icon icon--success">
            <x-svg.check-icon width="24" height="24" stroke="white" />
        </span> -->
        <div class="step-info">
            <h2 class="text--body-3-600">{{ __('steps01') }}</h2>
            <p class="text--body-4">{{ __('basic_info') }}</p>
        </div>
    </div>
</li>
