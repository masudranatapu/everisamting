@extends('frontend.postad.index')

@section('title', __('Select Category'))

@section('post-ad-content')

    <div class="adpost_form mb-4">
        <div class="heading mb-4">
            <h3>Select a Category</h3>
        </div>
        <div class="post_category text-center">
            <div class="row g-3">
                @if(isset($categories) && $categories->count() > 0)
                    @foreach($categories as $category)
                        <div class="col-sm-6 col-md-3">
                            <div class="category_name">
                                <a href="{{ route('frontend.post.create', $category->slug) }}">
                                    <i class="{{ $category->icon }}"></i>
                                    {{ $category->name }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

@section('frontend_style')
    <style>
        .category_name{
            height: 100%;
        }
    </style>
@endsection

@push('component_script')

@endpush
