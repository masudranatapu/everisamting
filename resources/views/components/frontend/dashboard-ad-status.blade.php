<div class="tag-status tag-status--active">
    <span class="icon">
        @if ($ad->status === 'active')
            <x-svg.check-icon width="18" height="18" />
        @elseif($ad->status === 'sold')
            <x-svg.cross-icon stroke="#dc3545" />
        @elseif($ad->status === 'declined')
            <x-svg.cross-icon stroke="#dc3545" />
        @else
            <x-svg.pending-icon />
        @endif
    </span>
    <h6 class="text--body-3">
        @if ($ad->status === 'sold')
            <span class="text-danger">{{ $ad->status }}</span>
        @elseif($ad->status === 'pending')
            <span class="text-warning">{{ $ad->status }}</span>
        @elseif($ad->status === 'declined')
            <span class="text-danger">{{ $ad->status }}</span>
        @else
            <span>{{ $ad->status }}</span>
        @endif
    </h6>
</div>
