<form action="{{ route('frontend.myad.expire', $ad) }}" method="post" class="edit-dropdown__link">
    @csrf
    @method('PUT')
    <button onclick="return confirm('{{ __('are_you_sure_you_want_to_expire_this_item') }}?');" type="submit"
        class="d-flex align-items-center">
        <span class="icon">
            <x-svg.cross-icon />
        </span>
        <h5 class="text--body-4">{{ __('mark_as_sold') }}</h5>
    </button>
</form>
