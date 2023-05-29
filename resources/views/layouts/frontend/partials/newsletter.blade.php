<section class="subscribe bgcolor--g">
    <div class="container">
        <div class="subscribe__content">
            <div class="subscribe__left">
                <h2 class="subscribe__title text--heading-2">{{ __('subscribe_to_our_newsletter') }}</h2>
                <p class="text--body-3 subscribe__description">
                    {{ $cms->newsletter_content }}
                </p>
            </div>
            <div class="subscribe__right">
                <form action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <div class="subscribe__input-group @error('email') is-invalid border-danger @enderror">
                        <span class="icon">
                            <x-svg.envelope-icon />
                        </span>
                        <input type="email" placeholder="{{ __('email_address') }}" name="email" id="email" />
                        <button class="btn" type="submit">{{ __('subscribe') }}</button>
                    </div>
                    <span class="error" style="color:red"></span>
                </form>
            </div>
        </div>
    </div>
</section>
@push('newslater_script')
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
    <script>
        $(document).on('submit', '#mailForm', function(event){

            event.preventDefault();
            let email = $("#email").val();

            axios.post('{{ route('newsletter.subscribe') }}', {
                email: email
            })
            .then(res => {
                $('#mailForm')[0].reset();
                $(".error").text('');
                toastr.success(res.data);
            })
            .catch(err => {
                $(".error").text(err.response.data.errors.email[0]);
            })
        });
    </script>
@endpush