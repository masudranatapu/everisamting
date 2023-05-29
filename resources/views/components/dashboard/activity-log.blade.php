<div class="dashboard-card dashboard-card--recent">
    <h2 class="dashboard-card__title">{{ __('recent_activities') }}</h2>
    <ul class="dashboard-card--recent__activity">
        @forelse ($activities as $activity)
            <li class="dashboard-card--recent__activity-item {{ $activity->type === 'App\\Notifications\\AdDeleteNotification' ? 'danger':'success' }}">
                <span class="icon">
                    @if ($activity->type === 'App\\Notifications\\AdDeleteNotification')
                        <x-svg.warning-icon />
                    @elseif ($activity->type === 'App\\Notifications\\AdWishlistNotification')
                        <x-svg.list-icon width="24" height="24" />
                    @else
                    <x-svg.check-icon width="24" height="24" />
                    @endif
                </span>
                <p class="text--body-3">
                    {{ $activity->data['msg'] }}

                    @isset($activity->data['url'])
                        <a href="{{ $activity->data['url'] }}">{{ __('view_ad') }}</a>
                    @endisset
                </p>
            </li>
        @empty
            <li class="text-center mt-5 pt-5">
                <p class="text--body-3">{{ __('no_recents_activities') }}</p>
            </li>
        @endforelse
    </ul>
</div>
