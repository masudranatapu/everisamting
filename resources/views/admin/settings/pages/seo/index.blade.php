@extends('admin.settings.setting-layout')
@section('title')
    {{ __('SEO') }}
@endsection
@section('website-settings')
    <section class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" style="line-height: 36px;">{{ __('seo_page_list') }}</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th> {{ __('page_name') }} </th>
                                            <th> {{ __('meta_title') }} </th>
                                            <th> {{ __('meta_description') }} </th>
                                            <th width="15%">{{ __('page_review_mage') }} </th>
                                            <th width="15%">{{ __('action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($seos->count() > 0)
                                            @foreach ($seos as $seo)
                                                <tr class="text-center">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        {{ __($seo->page_slug) }}
                                                    </td>
                                                    <td>{{ Str::limit($seo->title, 10) }}</td>
                                                    <td>
                                                        {{ Str::limit($seo->description, 15) }}
                                                    </td>
                                                    <td>
                                                        <img width="20%" src="{{ asset($seo->image) }}" alt="">
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('settings.seo.edit', $seo->id) }}"
                                                            class="btn btn-secondary mr-2">
                                                            <i class="fas fa-cog"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10" class="text-center">
                                                    <x-admin.not-found word="{{ __('SEO') }}" route="module.seo.index"
                                                        method="GET" />
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    {{-- Image upload and Preview --}}
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css">
@endsection

@section('script')
    {{-- Image upload and Preview --}}
    <script src="{{ asset('backend') }}/plugins/dropify/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Add a Picture',
                'replace': 'New picture',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        var oldTab = localStorage.getItem('Tab');
        if (oldTab) {
            $('#tablihome').removeClass('active');
            $('#home').removeClass('active');

            $('#tabli' + oldTab).addClass('active');
            $('#' + oldTab).addClass('active');
        }

        function Tab(id) {
            localStorage.setItem('Tab', id);
        }
    </script>
@endsection
