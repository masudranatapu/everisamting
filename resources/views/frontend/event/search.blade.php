<div class="card text-white bg-secondary mb-3 mt-2" style="border:none">
    @if ($results->count() > 0)
        @foreach ($results as $result)
            <a href="{{ route('frontend.event.details',[$result->id, $result->slug]) }}" class="search_servie_image_content text-left text-white">
                <div class="card-body home_servie_serach_wrapper" style="border: 1px solid #ddd">
                    <span class="search-text-item">
                        {{ $result->title }}
                        @if($result->start_date)
                            <br>
                            <small>Event Date: {{ $result->start_date }} </small>
                        @endif
                    </span>
                </div>
            </a>
        @endforeach
    @endif
</div>
