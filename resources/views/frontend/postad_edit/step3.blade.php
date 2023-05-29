@extends('frontend.postad.index')

@section('title')
    {{ __('edit_ad') }} ({{ __('steps03') }}) - {{ $ad->title }}
@endsection

@section('post-ad-content')
 <!-- Steop 03 -->
 <div class="tab-pane fade show active" id="pills-advance" role="tabpanel" aria-labelledby="pills-advance-tab">
    <div class="dashboard-post__step02 step-information">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('frontend.post.step3.update',$ad->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-field--textarea">
                <x-forms.label name="ad_description" for="description" />
                <textarea name="description" placeholder="{{ __('your_thought') }}..." id="description" class="@error('description') border-danger @enderror">{{ $ad->description }}</textarea>
            </div>
            <div class="input-field--textarea">
                <x-forms.label name="feature" for="feature" />
                <div id="multiple_feature_part">
                    <div class="row">
                        <div class="col-lg-10">
                             <div class="input-field">
                                 <input name="features[]" type="text" placeholder="{{ __('feature') }}" id="adname" class="@error('title') border-danger @enderror"/>
                             </div>
                        </div>
                        <div class="col-lg-2 mt-10">
                         <a role="button" onclick="add_features_field()"
                         class="btn bg-primary btn-sm text-light"><i class="fas fa-plus"></i></a>
                        </div>
                     </div>
                    @foreach ($ad->features as $feature)
                        <div class="row">
                            <div class="col-lg-10">
                                    <div class="input-field">
                                        <input value="{{ $feature->name }}" name="features[]" type="text" placeholder="{{ __('feature') }}" id="adname" class="@error('title') border-danger @enderror"/>
                                    </div>
                            </div>
                            <div class="col-lg-2 mt-10">
                                <button onclick="remove_single_field()" id="remove_item" class="btn btn-sm bg-danger text-light"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="upload-wrapper">
                <h3>{{ __('upload_photos') }}</h3>
                <input id="file-1" type="file" name="images[]" multiple class="file" data-overwrite-initial="false" >
            </div>
            <div class="dashboard-post__ads-bottom">
                <div class="form-check">
                </div>
                <div class="dashboard-post__action-btns">
                    <a onclick="return confirm('Do you really want to go previous page? If you go then your step 3 data wont save!')" href="{{ route('frontend.post.step2.back',$ad->slug) }}" class="btn btn--lg btn--outline">
                        {{ __('previous') }}
                    </a>
                    <button type="submit" class="btn btn--lg ms-3">
                        {{ __('finish_update') }}
                       <!--  <span class="icon--right">
                            <x-svg.right-arrow-icon />
                        </span> -->
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


@section('frontend_style')
<link href="{{ asset('backend/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
@endsection

@section('frontend_script')
<script src="{{ asset('backend/plugins/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/plugins/bootstrap-fileinput/themes/fas/theme.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend') }}/dist/js/ckeditor/ckeditor.js"></script>
<script src="{{ asset('backend') }}/dist/js/ckeditor/config.js"></script>

<script type="text/javascript">
    // ads post
    $("#file-1").fileinput({
        theme: 'fas',
        showUpload: false,
        allowedFileExtensions: ['jpg', 'png', 'gif','jpeg'],
        previewFileIcon: '<i class="fas fa-file"></i>',
        overwriteInitial: false,
        maxFileSize:2000,
        maxFilesNum: 10,
        validateInitialCount: true,
        showPreview: true,
        showRemove: true,
        showCancel: true,
        showCaption: false,
        showBrowse: true,
        browseOnZoneClick: true,
        minFileCount: 0,
        maxFileCount: 10,
        validateInitialCount: true,
		initialPreviewAsData: true,
        initialPreview: [
            @foreach ($ad->galleries as $gallery)
                "{{ $gallery->image ? $gallery->image_url: '' }}",
            @endforeach
        ],
        initialPreviewConfig: [
            @foreach ($ad->galleries as $gallery)
                    {
                        caption: "{{ str_replace('uploads/adds_multiple/',' ',$gallery->image) }}",
                        size: {{ getFileSize($gallery->image) }},
                        width: "20px",
                        url: "{{ route('frontend.ad.gallery.delete', $gallery->id) }}",
                        key: {{ $gallery->id }}
                    },
            @endforeach

        ]
    });

    // feature field
    function add_features_field() {
        $("#multiple_feature_part").append(`
            <div class="row">
                <div class="col-lg-10">
                        <div class="input-field">
                            <input name="features[]" type="text" placeholder="Feature" id="adname" class="@error('title') border-danger @enderror"/>
                        </div>
                </div>
                <div class="col-lg-2 mt-10">
                    <button onclick="remove_single_field()" id="remove_item" class="btn btn-sm bg-danger text-light"><i class="fas fa-times"></i></button>
                </div>
            </div>
        `);
    }

    $(document).on("click", "#remove_item", function() {
        $(this).parent().parent('div').remove();
    });

    $('.kv-file-remove').on('click', function() {
        window.location.reload();
    });

    CKEDITOR.replace('description', {
            height: 300,
            removeButtons: 'PasteFromWord'
            });
</script>
@endsection
