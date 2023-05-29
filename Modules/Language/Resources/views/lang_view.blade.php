@extends('admin.settings.setting-layout')

@section('title')
    {{ __('translate_language') }}
@endsection

@section('website-settings')
    {{-- <div id="loadinng">
    <div class="loading"></div>
</div> --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">
                            {{ $language->name }} - {{ __('translate_language') }}
                        </h3>
                        <a href="{{ route('language.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('translation.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="lang_id" value="{{ $language->id }}">
                            <div class="row">
                                <table class="table table-striped table-bordered mt-0 pt-0" id="tranlation-table"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="48%">English Text</th>
                                            <th width="48%">
                                                <span class="d-flex justify-content-between">
                                                    <span>Translation Text</span>
                                                    <span onclick="AutoTransAll('{{ $language->id }}')" id="translate_all"
                                                        class="btn bg-info btn-sm">
                                                        Translate All
                                                    </span>
                                                </span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($translations as $key => $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="key">{{ ucwords(str_replace('_', ' ', $key)) }}
                                                </td>
                                                <td>
                                                    <span class="d-flex">
                                                        <input type="text" class="form-control value" style="width:100%"
                                                            name="{{ $key }}" value="{{ $value }}">
                                                        <button type="button"
                                                            onclick="AutoTrans('{{ $key }}', '{{ $value }}', '{{ $language->code }}')"
                                                            class="btn btn-sm ml-1 bg-info">
                                                            Translate
                                                        </button>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="d-flex mx-auto">
                                    <button type="submit" class="lang-btn btn btn-success"><i
                                            class="fas fa-sync"></i>&nbsp; {{ __('update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .lang-btn {
            position: fixed;
            left: 50%;
            bottom: 50px;
            width: 200px;
            padding: 15px;
            text-align: center;
            transform: translateX(-50%, 0);
        }

        /* For Laoding */
        #loadinng {
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 1;
            background-color: #fff;
            z-index: 99;
        }

        #loadinng-image {
            z-index: 1;
        }

        .loading {
            height: 0;
            width: 0;
            padding: 15px;
            border: 6px solid #ccc;
            border-right-color: #888;
            border-radius: 22px;
            -webkit-animation: rotate 1s infinite linear;
            /* left, top and position just for the demo! */
            position: absolute;
            left: 50%;
            top: 50%;
        }

        @-webkit-keyframes rotate {
            100% {
                -webkit-transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section('script')
    <script>
        function AutoTrans(key, value, lang) {
            $.ajax({
                url: "{{ route('translation.update.auto') }}",
                type: "POST",
                data: {
                    lang: lang,
                    text: value,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result);
                    $('input[name=' + key + ']').val(result);
                }
            });
        }
        //  for all
        function AutoTransAll(lang) {
            $('#translate_all').text('Translating...');
            $('.lang-btn').prop('disabled', true);

            $.ajax({
                url: "{{ route('translation.update.auto.all') }}",
                type: "POST",
                data: {
                    lang: lang,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $.each(result.data, function(key, value) {
                        $('input[name=' + key + ']').val(value);
                    });

                    setTimeout(() => {
                        $('#translate_all').text('Translate All');
                        $('.lang-btn').prop('disabled', false);
                    }, 1000);
                },
                error: function(error) {
                    $('#translate_all').text('Translate All');
                    $('.lang-btn').prop('disabled', false);
                }
            });

        }
    </script>
@endsection
