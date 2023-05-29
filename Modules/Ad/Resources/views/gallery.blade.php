@extends('admin.layouts.app')

@section('title')
    Ad Gallery - Admin
@endsection

@section('content')
    <div class="container-fluid mb-50">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-dark d-flex justify-content-between align-items-center">
                        <h6 class="d-inline mb-2"> {{ __('gallery_add') }}</h6>
                    </div>
                    <div class="card-body">
                        {{-- <form id="dropzoneForm" method="post" action="{{ route('module.ad.store_gallery', $id) }}"
                            enctype="multipart/form-data" class="dropzone">
                            @csrf
                        </form>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-success" id="submit-all"><i class="fas fa-sync"></i>
                                {{ __('Upload_Gallery') }}</button>
                        </div> --}}
                        <form action="{{ route('module.ad.store_gallery', $id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="upload-wrapper">
                                {{-- <h3>{{ __('upload_photos') }}</h3> --}}
                                @error('images')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="input-images-2" style="padding-top: .5rem;" multiple></div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                        {{ __('Upload_Gallery') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-dark" style="line-height: 36px;">Ad Gallery List</h3>
                        <a href="{{ route('module.ad.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;Back</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered  text-center mb-3">
                            <thead class="text-dark">
                                <tr>
                                    <th width="5%">{{ __('sl') }}</th>
                                    <th width="15%">{{ __('ad_title') }}</th>
                                    <th width="10%">{{ __('Gallery_Image') }}</th>
                                    <th width="15%">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($adGalleries) != 0)
                                    @foreach ($adGalleries as $gallery)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $gallery->ad->title }}</td>
                                            <td class="text-center">
                                                @if ($gallery->image)
                                                    <img width="60px" height="60px" src="{{ asset($gallery->image) }}"
                                                        alt="">
                                                @else
                                                    <img width="60px" height="60px"
                                                        src="{{ asset('backend/image/default-ad.png') }}" alt="">
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('module.ad.delete_gallery', $gallery->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button title="{{ __('delete_product') }}"
                                                        onclick="return confirm('{{ __('are_you_sure') }}?');"
                                                        class="btn bg-danger"><i
                                                            class="fas fa-trash text-light"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center">{{ __('nothing_found') }}.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <style>
        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed rgb(0, 135, 247);
            border-image: none;
            max-width: 805px;
            margin-left: auto;
            margin-right: auto;
        }
    </style> --}}
    <link rel="stylesheet" href="{{ asset('image_uploader/image-uploader.css') }}">
@endsection

@section('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
    <script type="text/javascript">
        Dropzone.options.dropzoneForm = {
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            thumbnailHeight: 120,
            thumbnailWidth: 120,
            maxFilesize: 3,
            filesizeBase: 1000,
            addRemoveLinks: true,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            init: function() {
                myDropzone = this;
                $('#submit-all').on('click', function() {
                    myDropzone.processQueue();
                });

                this.on("complete", function() {
                    if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                        var _this = this;
                        _this.removeAllFiles();
                        console.log()
                    }
                });
            },
            success: function(file, response) {
                window.location.href = response.url;
                toastr.success(response.message, 'Success');
            },
            error: function(file, response) {
                toastr.success('Image upload failed', 'Success');
            }
        };
    </script> --}}
    <script src="{{ asset('image_uploader/image-uploader.min.js') }}"></script>
    <script>
        $('.input-images-2').imageUploader({
            maxSize: 10 * 1024 * 1024,
            maxFiles: 10,
            multiple: true,
        });
    </script>
@endsection
