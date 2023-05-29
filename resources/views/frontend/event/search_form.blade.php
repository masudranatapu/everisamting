<form class="search_event mb-4" action="{{ route('frontend.event') }}" method="get">
    <div class="row">
        <div class="col-lg-7 col-md-12 mb-2 mb-lg-0">
            <div class="row g-0">
                <div class="col-lg-6 col-md-6 mb-2 mb-lg-0">
                    <div id="search_div">
                        <div class="input-group">
                            <input type="text" name="search" id="event_search" class="form-control event_search"
                                   placeholder="{{ __('looking_for') }}">
                            <span class="input-group-text loading" style="display: none">
                               <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </span>
                        </div>
                        <div id="search-results" class="search-results"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-2 mb-lg-0">
                    <div class="input-group">
                        <input class="form-control datepicker" value="{{ request()->date ?? __('select_date') }}" type="text" name="date" />
                        <button type="submit" class="btn btn-primary">{{ __('Find_Events') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <a href="{{ route('frontend.event.create') }}" class="btn bg-info">{{ __('Create_Event') }}</a>
        </div>
    </div>
</form>

@push('c_css')
    <style>
        #search_div {
            position: relative;
        }

        #search-results {
            position: absolute;
            z-index: 9999;
            width: 100%;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            white-space: nowrap;
            background-color: #fff;
            border: none;
            border-top: 1px solid #86b7fe;
            border-bottom: 1px solid #86b7fe;
    </style>
@endpush


@push('c_js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.event_search').on('input', function() {
                var search = $(this).val();
                console.log(search);
                // if (search.length >= 3) {
                $.ajax({
                    url: "{{ route('frontend.getEvent') }}",
                    method: 'GET',
                    data: {search:search},
                    beforeSend: function () {
                        $('.loading').show();
                        $('#event_search').css('border-right', 'none');
                    },
                    success: function(response) {
                        // console.log(response)
                        // var results = '';
                        // $.each(response, function(index, product) {
                        //     results += '<li>'+product.title+'</li>';
                        // });
                        $('.search-results').html(response);
                    },
                    complete: function () {
                        $('.loading').hide();
                        $('#event_search').css('border-right', '1px solid #86b7fe');
                    },
                });
                // }
            });

            $('body').on('click', function() {
                $('.search-results').html('');
                $('#event_search').css('border-right', '1px solid #F3F6F9');
            });
        });
    </script>
@endpush
