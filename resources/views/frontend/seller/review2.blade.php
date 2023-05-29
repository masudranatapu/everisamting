<div class="">
    <form action="{{ route('frontend.seller.review') }}" method="post">
        @csrf
        <div id="rateYo">
        </div>
        @error('stars')
        <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
        <input type="hidden" name="stars" id="rating">
        <input type="hidden" name="seller_id" value="{{ $user->id }}">
        <div class="mt-3 input-field--textarea">
            <textarea name="comment" id="description" class="@error('comment') border-danger @enderror"></textarea>
            @error('comment')
            <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn">
            <span class="ml-2">{{ __('publish_review') }}</span>
        </button>
    </form>
</div>
@push('component_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<style>
    .mb-24 {
        margin-bottom: 24px;
    }
</style>
@endpush

@push('component_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
    $(document).ready(function() {
            $("#rateYo").rateYo({
                starWidth: '30px',
                fullStar: true,
                mormalFill: 'yellow',
                ratedFill: 'orange',
                onSet: function(rating, rateYoInstance) {
                    $('#rating').val(rating);
                }
            });
        });
</script>
<script>
    setTimeout(() => {
            $('.jq-ry-normal-group').addClass('d-flex');
            $('.jq-ry-normal-group').addClass('gap-1');
        }, 1000);
</script>
@endpush