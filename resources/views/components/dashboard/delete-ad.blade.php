<form action="{{ route('frontend.delete.myad',$ad->id) }}" method="post" class="edit-dropdown__link">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');" class="d-flex align-items-center">
        <span class="icon">
            <x-svg.delete-icon />
        </span>
        <h5 class="text--body-4">{{ __('delete_ad') }}</h5>
    </button>
</form>
