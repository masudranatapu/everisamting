@extends('layouts.frontend.layout_one')

@section('title', __('create'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->event_background">
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.event.create') }}" class="breedcrumb__page-link text--body-3">{{ __('create') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <div class="event_create">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-2 mb-3">
                    <form action="{{ route('frontend.event.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h2 class="new-event-title">{{ __('create') }}</h2>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Event_Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title"  placeholder="{{ __('Event_Name') }}" value="{{ old('title') }}" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('short_description') }} <span class="text-danger">*</span></label>
                                    <textarea name="short_description" class="form-control" required cols="30" style="height: 100px;" placeholder="{{ __('short_description') }}" onkeyup="countChars(this);">{{ old('short_description') }}</textarea>
                                    <span id="charNum"></span>
                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">{{ __('description') }}<span class="text-danger">*</span></label>
                                    <textarea name="details" class="form-control summernote" cols="30" rows="10" required>{{ old('details') }}</textarea>
                                    @error('details')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-header">
                                <h2 class="new-event-title">{{ __('Time_n_Date') }} <span class="text-danger">*</span></h2>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-12 mb-2 mb-lg-0">
                                            <label>{{ __('start_end') }} :</label>
                                        </div>
                                        <div class="col-lg-10 col-md-12">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-6 mb-2 mb-lg-0">
                                                    <input class="form-control datepicker @error('start_date') border-danger @enderror" type="text" name="start_date" required value="{{ old('start_date') }}" placeholder="Start Date"/>
                                                </div>
                                                <div class="col-lg-2 col-md-6" id="hide_show_start_time">
                                                    <input type="time" class="form-control @error('start_time') border-danger @enderror" name="start_time" value="{{ old('start_time') }}">
                                                </div>
                                                <div class="col-lg-2 col-md-6 text-center">
                                                    <p class="mt-3">{{ __('to') }}</p>
                                                </div>
                                                <div class="col-lg-2 col-md-6 mb-2 mb-lg-0" id="hide_show_end_time">
                                                    <input type="time" class="form-control @error('end_time') border-danger @enderror" name="end_time" value="{{ old('end_time') }}">
                                                </div>
                                                <div class="col-lg-3 col-md-6 mb-2 mb-lg-0">
                                                    <input class="form-control datepicker @error('end_date') border-danger @enderror" type="text" name="end_date" required value="{{ old('end_date') }}" placeholder="End Date"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 my-2">
                                                    <input type="checkbox" name="all_day_event_status" class="form-check-input" id="alldayevent" onclick="allDayEventIs()" @if( old('all_day_event_status') == 1 ) checked @endif>
                                                    <label class="form-check-label" for="alldayevent">{{ __('al_day_event') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h2 class="new-event-title">
                                    {{ __('Category_Tags') }}
                                    <span class="text-danger">*</span>
                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="" class="form-label">
                                            {{ __('category') }}
                                        </label>
                                        <select class="eventselect2 form-control" name="category_id[]" multiple="multiple">
                                            @if(isset($event_cat) && count($event_cat) > 0 )
                                                @foreach ( $event_cat as $key => $cat )
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 mt-4">
                                        <label for="" class="form-label">
                                            {{ __('tag') }}
                                        </label>
                                        <select class="eventselect2 form-control" name="tag_id[]" multiple="multiple">
                                            @if(isset($event_tag) && count($event_tag) > 0 )
                                                @foreach ($event_tag as $key => $tag )
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('tag_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h2 class="new-event-title">{{ __('status') }}</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 mb-2 mb-lg-0">
                                        <label for="" class="form-label">{{ __('status') }}</label>
                                        <select class="form-control" name="event_status" id="getEventStatus">
                                            <option value="1">{{ __('Scheduled') }}</option>
                                            <option value="2">{{ __('Canceled') }}</option>
                                            <option value="3">{{ __('Postponed') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6" id="showHideForEventStatus" style="display: none;">
                                        <label for="" class="form-label">{{ __('reseson_op') }}</label>
                                        <textarea name="event_status_reason" class="form-control" cols="30" rows="10" style="height: 150px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h2 class="new-event-title">
                                    {{ __('venues') }}
                                    <small>( {{ __('venues_quote') }} )</small>
                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <label class="mb-3">{{ __('venues') }}</label>
                                        <select class="eventselect2 form-control" name="venue_id" id="createNewVenue">
                                            <option disabled selected>{{ __('select_one') }}</option>
                                            <option value="create_new_venue">Create New Venue</option>
                                            @if(isset($event_venue) && count($event_venue) > 0 )
                                                @foreach ( $event_venue as $key => $venue )
                                                    <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-8 col-md-12 mt-4 mt-lg-0" style="display: none;" id="showHideEventVenue">
                                        <h5 class="text-center mb-2">Create New Venue</h5>
                                        <div class="row form-group mb-2">
                                            <div class="col-md-4">
                                                <label for="" class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="{{ ('name') }} " name="venue_name">
                                            </div>
                                        </div>
                                        <div class="row form-group mb-2">
                                            <div class="col-md-4">
                                                <label for="" class="form-label">{{ __('location ') }} <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="{{ __('address') }}" name="venue_address">
                                            </div>
                                        </div>
                                        <input type="hidden" name="venue_country" value="230">
                                        <div class="row form-group mb-2">
                                            <div class="col-md-4">
                                                <label for="" class="form-label">{{ __('state_or_Province') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="{{ __('state_or_Province') }} " name="venue_state">
                                            </div>
                                        </div>
                                        <div class="row form-group mb-2">
                                            <div class="col-md-4">
                                                <label for="" class="form-label">{{ __('phone') }}</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="Phone" name="venue_phone">
                                            </div>
                                        </div>
                                        <div class="row form-group mb-2">
                                            <div class="col-md-4">
                                                <label for="" class="form-label">{{ ('website') }} </label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="{{ __('event_website') }}" name="venue_website">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h2 class="new-event-title">
                                    {{ __('organiser') }}
                                    <small>( {{ __('organiser_quote') }} )</small>
                                </h2>
                            </div>
                            <div class="card-body">
                                <div id="organiserDetailShow">

                                </div>
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <button type="button" class="mybtn bg-info" onclick="addOrganiser()" title="Add atlist one organiser">{{ __('Add_Organiser') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h2>{{ __('adi_info') }}</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <label for="istheeventwheelchair">{{ __('wheelchair') }}</label>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <input type="checkbox" class="form-check-input" name="wheelchair" id="istheeventwheelchair"> {{ __('yes') }}
                                            </div>
                                            <div class="col-lg-6 col-md-6 mt-3">
                                                <label for="accessible">{{ __('accessible') }}</label>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mt-3">
                                                <input type="checkbox" class="form-check-input" name="accessible" id="accessible" > {{ __('no') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <label for="" class="form-label">{{ __('External_Link') }}</label>
                                        <input type="text" name="event_info_link" class="form-control @error('event_info_link') border-danger @enderror" placeholder="{{ __('event_link') }}" value="{{ old('event_info_link') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h2 class="new-event-title">{{ __('cost_image') }}</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                                        <label for="" class="form-label">{{ __('cost') }}</label>
                                        <input type="number" step="0.01" min="0" name="cost" class="form-control" placeholder="{{ __('cost') }}">
                                        <span class="text-warning">{{ __('cost_info') }}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="text-center m-3" style="display: none;" id="showImageArea">
                                            <img src="" alt="event-image" id="showImage">
                                        </div>
                                        <div class="text-center mt-4">
                                            <input type="file" class="form-control d-none" id="file-upload" onChange="mainFavion(this)" name="image">
                                            <label for="file-upload" class="custom-file-upload">Choose Image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button class="mybtn" type="submit">{{ __('submit_event') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('frontend_style')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    {{-- select  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/summernote/summernote-bs4.min.css')}}">
    <style>
        .select2-container{width: 100% !important;}
        .select2-container--default .select2-selection--multiple {
            min-height: 48px;
        }


        .note-btn-group .note-btn {
            padding: 0.5rem 0.5rem !important;
            font-size: 15px !important;
        }

        .mb-3 .btn {
            line-height: 15px !important;
        }

        .select2-container .select2-selection--single {
            min-height: 45px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 45px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            margin-top: 6px !important;
        }

        .mybtn {
            font-size: 16px;
            line-height: 46px;
            font-weight: 700;
            text-transform: capitalize;
            font-family: "Nunito Sans", sans-serif;
            color: #fff;
            padding: 0px 20px;
            border-radius: 4px;
            background-color: #f27319;
        }
    </style>
@endsection

@section('frontend_script')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('frontend/summernote/summernote-bs4.min.js')}}"></script>
    <script>

        $(function() {
            $(".datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true
            });
        });

        $(document).ready(function() {
            $('.eventselect2').select2();
        });

        $(document).ready(function() {
            $('.countryselect2').select2();
        });

        function mainFavion(input) {
            // alert(input);
            if (input.files && input.files[0]) {

                setTimeout(function () {
                    $("#showImageArea").slideDown();
                }, 100)

                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result).width(100).height(100);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#getEventStatus").change(function() {
            var getEventStatus = $("#getEventStatus").val();
            // alert(getEventStatus);
            if(getEventStatus == 2){
                $("#showHideForEventStatus").slideDown();
            }else if(getEventStatus == 3) {
                $("#showHideForEventStatus").slideDown();
            }else {
                $("#showHideForEventStatus").slideUp();
            }

        });

        $('.summernote').summernote({
            height: 200,
            inheritPlaceholder: true,
            placeholder: 'Enter your event details .... ',
        });

        function allDayEventIs() {

            var checkBox = document.getElementById("alldayevent");

            if (checkBox.checked == true){
                $("#hide_show_start_time").hide();
                $("#hide_show_end_time").hide();
            } else {
                $("#hide_show_start_time").show();
                $("#hide_show_end_time").show();
            }
        }

        $("#createNewVenue").change(function() {

            var createNewVenue = $("#createNewVenue").val();
            // alert(createNewVenue);

            if(createNewVenue == 'create_new_venue') {
                $("#showHideEventVenue").slideDown();

                $('[name="venue_name"]').attr('required', '');
                $('[name="venue_address"]').attr('required', '');

            }else {
                $("#showHideEventVenue").slideUp();

                $('[name="venue_name"]').removeAttr('required');
                $('[name="venue_address"]').removeAttr('required');

            }

        });

        let selectdynamicid = 0;

        function addOrganiser() {
            // alert('hello');
            selectdynamicid++;
            $("#organiserDetailShow").append(`
                <div class="row mt-4">
                    <div class="col-lg-3 col-md-6 mb-2 mb-lg-0">
                        <label class="mb-3">Organiser Details</label>
                        <select class="eventselect2 form-control" id="newCreate_${selectdynamicid}" name="organiser_id[]" onchange="createNewOrganiser(this, ${selectdynamicid})">
                            <option selected disabled>Select One</option>
                            <option value="create_new_organiser">Create New Organiser</option>
                            @foreach($event_organiser as $organiser)
                                <option value="{{$organiser->id}}">{{ $organiser->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-8 col-md-6 mb-2 mb-lg-0">
                        <div id="show_${selectdynamicid}">

                        </div>
                    </div>
                    <div class="col-lg-1 mt-4">
                        <button type="button" class="mybtn bg-danger removeitem"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            `);
        };

        $(document).on("click", ".removeitem", function() {
            $(this).parent().parent('div').remove();
        });

        function createNewOrganiser(component, newId) {

            var createNew = $("#"+component.id).val();
            // alert(createNew);

            var showCreateOnId = newId;
            // alert(showCreateOnId);

            if(createNew == 'create_new_organiser'){
                $("#show_" + showCreateOnId).html(`
                    <h5 class="text-center mb-2">Create New Organiser</h5>
                    <div class="row form-group mb-2">
                        <div class="col-md-4">
                            <label for="" class="form-label">Organiser Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Full Name" name="organiser_name[]" required>
                        </div>
                    </div>
                    <div class="row form-group mb-2">
                        <div class="col-md-4">
                            <label for="" class="form-label">Organiser Phone <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" placeholder="Phone number" name="organiser_phone[]" required>
                        </div>
                    </div>
                    <div class="row form-group mb-2">
                        <div class="col-md-4">
                            <label for="" class="form-label">Organiser Website</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Website url" name="organiser_website[]">
                        </div>
                    </div>
                    <div class="row form-group mb-2">
                        <div class="col-md-4">
                            <label for="" class="form-label">Organiser Email</label>
                        </div>
                        <div class="col-md-8">
                            <input type="email" class="form-control" placeholder="Email address" name="organiser_email[]">
                        </div>
                    </div>
                `);
            }else {
                $("#show_" + showCreateOnId).html(``);
            }

        }
    </script>
    <script>
        function countChars(obj){
            var maxLength = 250;
            var strLength = obj.value.length;

            if(strLength > maxLength){
                document.getElementById("charNum").innerHTML = '<span style="color: red;">'+strLength+' out of '+maxLength+' characters</span>';
            }else{
                document.getElementById("charNum").innerHTML = '<span style="color: green;">'+strLength+' out of '+maxLength+' characters</span>';
            }

        }
    </script>
@endsection
