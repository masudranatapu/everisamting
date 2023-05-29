<div class="user-info">
    <div class="img">
        <img src="{{ $user->image_url }}" alt="user-img">
    </div>
    <div class="info">
        <h2 class="text--body-3-600">{{ $user->name}}</h2>
        <p class="status text--body-4">
            @if (Cache::has('isOnline' . $user->id))
                <span class="icon"></span> {{ __('online') }}
            @else
                <span class="offline"></span> {{ __('offline') }}
            @endif
        </p>
    </div>
</div>
