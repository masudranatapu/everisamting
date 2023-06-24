@extends('admin.layouts.app')

@section('title')
{{ __('Edit Business Directory') }}
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('backend/plugins/summernote/summernote.min.css')}}">
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('business-directory.update', $businessdirectories->id) }}"
                        enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Edit Business Directory</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('business-directory.index') }}" type="button"
                                            class="btn btn-success">
                                            <i class="fas fa-backward mr-2"></i>
                                            Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') border-danger @enderror"
                                            value="{{$businessdirectories->title}}" placeholder="Title"
                                            placeholder="Title">
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6 col-md-6">
                                        <label for="">Category <span class="text-danger">*</span></label>
                                        <select name="category_id[]" multiple="multiple" class="form-control select2 mycategory"
                                            id="categoryid" required>
                                            <option class="d-none">Select One</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if(isset($businessdirectories->category_id) && in_array($category->id , $businessdirectories->category_id)) selected @endif>{{ __(str_replace(' ', '_',
                                                strtolower($category->name))) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') border-danger @enderror"
                                            name="email" value="{{ $businessdirectories->email }}"
                                            placeholder="Email Address">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Phone number <span class="text-danger">*</span> <sub>Head
                                                office</sub></label>
                                        <input type="tel"
                                            class="form-control @error('phone') border-danger @enderror" name="phone"
                                            value="{{ $businessdirectories->phone }}" placeholder="Phone number one">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Phone number <sub> Corporate office</sub></label>
                                        <input type="tel" class="form-control " name="phone_2"
                                            value="{{ $businessdirectories->phone_2 }}" placeholder="Phone number tow">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="">Image </label>
                                        <input type="file" name="thumbnail"
                                            class="form-control my-form-control @error('thumbnail') border-danger @enderror">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" @if($businessdirectories->status == 'active')
                                                selected @endif>Active</option>
                                            <option value="pending" @if($businessdirectories->status == 'pending')
                                                selected @endif>Pending</option>
                                            <option value="declined" @if($businessdirectories->status == 'declined')
                                                selected @endif>Declined</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="">Business Profile Link</label>
                                        <input type="text" class="form-control" name="business_profile_link"
                                            value="{{ $businessdirectories->business_profile_link }}"
                                            placeholder="Business profile link">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                                        <label for="">{{ __('business_location') }} <span
                                                class="text-danger">*</span></label>
                                        <input name="address"
                                            class="form-control @error('address') border-danger @enderror"
                                            value="{{ $businessdirectories->address }}"
                                            placeholder="{{ __('business_location') }}" />

                                        @error('address')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message
                                                }}</strong></span>
                                        @enderror

                                        <div class="mt-3">
                                            <label for="description">{{ __('description') }}</label>
                                            <textarea class="form-control" name="description" id="description"
                                                placeholder="description"
                                                style="height: 200px">{{ $businessdirectories->description }}</textarea>

                                            @error('description')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message
                                                    }}</strong></span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label for="">Map </label>

                                        <div>
                                            <input id="searchInput" class="mapClass form-control" name="map" type="text"
                                                placeholder="{{ __('enter_a_location') }}">
                                            <div class="map mymap" id="google-map"></div>
                                        </div>
                                        @error('map')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message
                                                }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-success" type="submit">Update Business Directory</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="old_lat" value="{{ $businessdirectories->lat }}">
                        <input type="hidden" class="old_long" value="{{ $businessdirectories->lang }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
{{-- select --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .my-form-control {
        padding: 3px 9px !important;
    }

    .select2-container--default .select2-selection--multiple {
        min-height: 38px;
    }

    .note-btn-group .note-btn {
        padding: 0.5rem 0.5rem !important;
        font-size: 15px !important;
    }

    .mb-3 .btn {
        line-height: 15px !important;
    }

    .select2-container .select2-selection--single {
        min-height: 38px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 27px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        margin-top: 4px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: rgb(0, 0, 0) !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: rgb(255, 0, 0) !important;
    }

    .form-style-input-file {
        height: calc(2.7rem + 2px) !important;
    }

    .mapClass {
        position: absolute;
        left: 188px;
        top: 10px !important;
        height: 41px !important;
        border: none;
        border-radius: 4px !important;
        width: 350px;
    }

    .map {
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 289px;
        margin: 0px;
    }
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 25px !important;
    }
</style>
@endsection

@section('script')

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('backend/plugins/summernote/summernote.min.js')}}"></script>
<script>
    $(document).ready(function() {
            $('.select2').select2({
                placeholder: "{{ __('select_one') }}",
                allowClear: true
            });
        });

</script>

<script>
    $(document).ready(function() {
            $('#categoryid').on('change', function(){
                var category_id = $(this).val();
                // alert(category_id);
                if(category_id) {
                    $.ajax({
                        url: "{{  url('/admin/business-directory/category/subcategory') }}/"+category_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            console.log(data);
                            $('#subcategoryid').empty();
                            $('#subcategoryid').html(data);

                            // $.each(data, function(key, value){
                            //     $('#subcategoryid').append('<option value="'+ value.id +'">' + value.name + '</option>');
                            // });

                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });

    $('#description').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['insert', ['link', 'picture', 'video']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
        height:160,
        callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            }
        },
    });
    function uploadImage(image) {
        const data = new FormData();
        data.append("image", image);
        $.ajax({
            method:"POST",
            url: "{{route('text-editor.image')}}",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(url) {
                console.log(url)

                var image = $('<img>').attr('src', url).attr('data-src', url).attr('class', 'img-fluid img-responsive');
                $('#description').summernote("insertNode", image[0]);
            },
            error: function(data) {

                console.log(data);
            }
        });
    }

</script>
<x-set-googlemap />
@endsection
