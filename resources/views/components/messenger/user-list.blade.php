<a href="{{ route('frontend.message', $user->username) }}"
    class="user user--profile {{ request()->route('username') == $user->username ? 'active' : '' }}">
    <div class="user-info">
        <div class="img">
            <img src="{{ asset($user->image) }}" alt="user-photo">
        </div>
        <div class="name">
            <h2 class="text--body-4-600">
                {{ $user->name }}

                <span id="unread_count{{ $user->id }}" amount="{{ $unread }}"
                    class="text-danger h6 {{ $unread ? '' : 'd-none' }}">
                    ({{ $unread }})
                </span>
            </h2>
        </div>
    </div>
</a>
