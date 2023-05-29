@extends('layouts.frontend.layout_one')

@section('title')
    {{ $blog->title }}
@endsection

@section('meta')
    <meta name="title" content="{{ $blog->title }}">
    <meta name="description" content="{{ $blog->short_description }}">

    <meta property="og:image" content="{{ $blog->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:url" content="{{ route('frontend.single.blog', $blog->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $blog->short_description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:creator content="{{ $blog->author->name }}" />
    <meta name=twitter:url content="{{ route('frontend.single.blog', $blog->slug) }}" />
    <meta name=twitter:title content="{{ $blog->title }}" />
    <meta name=twitter:description content="{{ $blog->short_description }}" />
    <meta name=twitter:image content="{{ $blog->image_url }}" />
@endsection

@section('content')
    <!-- breedcrumb section start  -->

    <x-frontend.breedcrumb-component :background="$cms->blog_background">
        {{ $blog->title }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.blog') }}" class="breedcrumb__page-link text--body-3">{{ __('blog') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3"> {{ $blog->title }} </a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- single Blog Section start  -->
    <section class="section single-blog">
        <div class="container">
            <div class="single-blog__lg-img-wrapper">
                <img src="{{ $blog->image_url }}" alt="blog-img" class="img-fluid">
            </div>
            <div class="row single-blog__content">
                <div class="col-lg-8">
                    <div class="single-blog__blog-content">
                        <ul class="single-blog__info">
                            <li class="single-blog__info-item">
                                <span class="icon">
                                    <i class="{{ $blog->category->icon }}" style="color: #00AAFF"></i>
                                </span>
                                <p class="text--body-3">{{ $blog->category->name }}</p>
                            </li>
                            <li class="single-blog__info-item">
                                <span class="icon">
                                    <x-svg.user-icon width="24" height="24" />
                                </span>
                                <p class="text--body-3">{{ $blog->author->name }}</p>
                            </li>
                            <li class="single-blog__info-item">
                                <span class="icon">
                                    <x-svg.message-icon />
                                </span>
                                <p class="text--body-3" id="comment_count"> {{ $blog->comments_count }}
                                    {{ __('comments') }}</p>
                            </li>
                        </ul>
                        <h2 class="text--heading-2 single-blog__title">
                            {{ $blog->title }}
                        </h2>
                        <div class="single-blog__author-info">
                            <div class="author-img">
                                <div class="img">
                                    <img src="{{ asset($blog->author->image) }}" alt="author-img">
                                </div>
                                <h2 class="name text--body-3-600">{{ $blog->author->name }}</h2>
                            </div>
                            <ul class="author-social">
                                <li class="author-social__item">
                                    <a href="{{ socialMediaShareLinks(url()->current(), 'whatsapp') }}"
                                        class="social-link social-link--wa  author-social__link">
                                        <x-svg.whatsapp-icon />
                                    </a>
                                </li>
                                <li class="author-social__item">
                                    <a href="{{ socialMediaShareLinks(url()->current(), 'facebook') }}"
                                        class="social-link social-link--fb  author-social__link">
                                        <x-svg.facebook-icon fill="#fff" />
                                    </a>
                                </li>
                                <li class="author-social__item">
                                    <a href="{{ socialMediaShareLinks(url()->current(), 'twitter') }}"
                                        class="social-link social-link--tw  author-social__link">
                                        <x-svg.twitter-icon fill="#fff" />
                                    </a>
                                </li>
                                <li class="author-social__item">
                                    <a href="{{ socialMediaShareLinks(url()->current(), 'linkedin') }}"
                                        class="social-link social-link--in  author-social__link">
                                        <x-svg.linkedin-icon />
                                    </a>
                                </li>
                                <li class="author-social__item">
                                    <a href="{{ socialMediaShareLinks(url()->current(), 'gmail') }}"
                                        class="social-link social-link--p  author-social__link">
                                        <x-svg.envelope-icon stroke="#fff" />
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <p class="single-blog__content-text text--body-3">
                            {!! $blog->description !!}
                        </p>

                    </div>

                    <!-- comment part  -->
                    @livewire('blog.comment', ['post_id' => $blog->id])

                </div>
                <div class="col-lg-4">
                    <div class="blog__sidebar ">

                        <span class="toggle-icon">
                            <x-svg.toggle-icon />
                        </span>
                        <form action="{{ route('frontend.blog') }}" method="GET" id="searchForm">
                            <input id="categoryWiseSorting" name="category" type="hidden" value="">
                        </form>
                        <div class="blog__sidebar-wrapper">
                            <!-- Category -->
                            <div class="blog__sidebar-category blog__sidebar-item">
                                <h2 class="text--body-2-600 item-title">{{ __('top_category') }}</h2>
                                <div class="category">
                                    @forelse ($categories as $category)
                                        <div class="category-item">
                                            <a href="{{ route('frontend.blog', ['category' => $category->slug]) }}">
                                                <img style="width: 168px;" src="{{ $category->image_url }}"
                                                    alt="category-img">
                                                <h2 class="text--body-3">{{ $category->name }}</h2>
                                            </a>
                                        </div>
                                    @empty
                                        <x-no-data-found />
                                    @endforelse
                                </div>
                            </div>

                            <!-- Recent Post -->
                            <div class="blog__sidebar-post blog__sidebar-item">
                                <h2 class="text--body-2-600 item-title">{{ __('recent_post') }}</h2>
                                <div class="post">
                                    @foreach ($recentPost as $post)
                                        <div class="post-item">
                                            <a href="{{ route('frontend.single.blog', $post->slug) }}"
                                                class="post-img">
                                                <img src="{{ $post->image }}" alt="post-img">
                                            </a>
                                            <div class="post-info">
                                                <a href="{{ route('frontend.single.blog', $post->slug) }}"
                                                    class="text--body-3"> {{ $post->title }} </a>
                                                <div class="post-review">
                                                    <span class="date">
                                                        {{ $post->created_at->format('M d, Y') }} </span>
                                                    <span class="dot"></span>
                                                    <span class="comments"> {{ $post->comments_count }}
                                                        {{ __('comments') }} </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('adlisting_style')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/venobox.min.css" />
@endsection

@section('frontend_script')
    @livewireScripts
    <script src="{{ asset('frontend') }}/js/plugins/venobox.min.js"></script>
    <script>
        function countComments(postId) {
            setTimeout(function() {
                $.ajax({
                    type: 'GET',
                    url: '/blog/comments/count/' + postId,
                    success: function(data) {
                        $("#comment_count").html(data + ' Comments');
                    }
                });
            }, 2000);
        }

        function sorting(categorySlug) {
            $('#categoryWiseSorting').val(categorySlug)
            $('#searchForm').submit()
        }
    </script>
@endsection
