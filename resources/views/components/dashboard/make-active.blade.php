<form action="{{ route('frontend.myad.active', $ad) }}" method="post" class="edit-dropdown__link">
    @csrf
    @method('PUT')
    <button type="submit" href="javascript:void(0)" class="d-flex align-items-center">
        <span class="icon">
            <x-svg.check-mark-icon />
        </span>
        <h5 class="text--body-4">{{ __('make_it_active') }}</h5>
    </button>
</form>
