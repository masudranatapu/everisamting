@extends('admin.layouts.app')

@section('title')
    {{ __('Events Create') }}
@endsection

@section('content')
    @php
        $timezoonlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('events.store') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>Create Event</h3>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a href="{{ route('events.index') }}" type="button" class="btn btn-success" >
                                                <i class="fas fa-backward mr-2"></i>
                                                Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                                            <div class="mb-3">
                                                <label class="form-label">Event name <span class="text-danger">*</span></label>
                                                <input type="text" name="title" class="form-control @error('title') border-danger @enderror" placeholder="Event name" value="{{old('title')}}">
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">User</label>
                                                <select class="eventselect2 form-control" name="user_id">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Short Description <span class="text-danger">*</span></label>
                                        <textarea name="short_description" class="form-control @error('short_description') border-danger @enderror" cols="30" style="height: 100px;" placeholder="Short description" onkeyup="countChars(this);">{{ old('short_description') }}</textarea>
                                        <span id="charNum"></span>
                                        @error('short_description')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Event Details <span class="text-danger">*</span></label>
                                        <textarea name="details" class="form-control summernote @error('title') border-danger @enderror" cols="30" rows="10">{{ old('details') }}</textarea>
                                        @error('details')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3 class="event-time-date-heading">Date & Time <span class="text-danger">*</span></h3>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-12 mb-2 mb-lg-0">
                                                <label>Start / End :</label>
                                            </div>
                                            <div class="col-lg-10 col-md-12">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-6 mb-3 mb-lg-0">
                                                        <input class="form-control datepicker" type="text" name="start_date" value="" placeholder="Start Date"/>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6" id="hide_show_start_time">
                                                        <input type="time" class="form-control" name="start_time" value="{{ old('start_time') }}">
                                                    </div>
                                                    <div class="col-lg-1 col-md-6 text-center">
                                                        <p class="mt-1">To</p>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 mb-3 mb-lg-0" id="hide_show_end_time">
                                                        <input type="time" class="form-control" name="end_time" value="{{ old('end_time') }}">
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 mb-3 mb-lg-0">
                                                        <input class="form-control datepicker" type="text" name="end_date" value="{{ old('end_date') }}" placeholder="End Date"/>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6">
                                                        <select name="timezone" class="form-control eventselect2">
                                                            @foreach($timezoonlist as $value)
                                                                <option value="{{ $value }}" @if($value == 'Australia/Adelaide') selected @endif> {{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 ml-4 mt-2">
                                                        <input type="checkbox" name="all_day_event_status" class="form-check-input" id="alldayevent" onclick="allDayEventIs()" @if( old('all_day_event_status') == 1 ) checked @endif>
                                                        <label class="form-check-label" for="alldayevent">All Day Event</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3 class="event-image-heading">Event Image</h3>
                                </div>
                                <div class="card-body text-center mx-auto">
                                    <div class="text-center m-3" id="showImageArea" style="display: none;">
                                        <img width="100" height="100" src="" alt="event-image" id="showImage">
                                    </div>
                                    <input type="file" class="form-control form-style-input-file" name="image" onChange="mainFavion(this)">
                                </div>
                                <div class="card-header">
                                    <h3 class="event-category-heading">Category / Tags <span class="text-danger">*</span></h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="">Event Category</label>
                                            <select class="eventselect2 form-control" name="category_id[]" multiple="multiple">
                                                @foreach ($eventcategory as $eventcate)
                                                    <option value="{{ $eventcate->id }}">{{ $eventcate->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mt-4">
                                            <label for="">Event Tags</label>
                                            <select class="eventselect2 form-control" name="tag_id[]" multiple="multiple">
                                                @foreach ($eventtags as $tags)
                                                    <option value="{{ $tags->id }}">{{ $tags->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3>Status</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 mb-2 mb-lg-0">
                                            <label for="">Event Status</label>
                                            <select class="form-control" name="event_status" id="getEventStatus">
                                                <option value="1">Scheduled</option>
                                                <option value="2">Canceled</option>
                                                <option value="3">Postponed</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6" id="showHideForEventStatus" style="display: none;">
                                            <label for="">Reason (optional)</label>
                                            <textarea name="event_status_reason" class="form-control" cols="30" rows="10" style="height: 150px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3>Venue </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 mb-2 mb-lg-0">
                                            <label class="mb-3">{{__('event_venue')}}</label>
                                            <select class="eventselect2 form-control" name="venue_id" id="createNewVenue">
                                                <option disabled selected>Select One</option>
                                                <option value="create_new_venue">{{__('create_new_venue')}}</option>
                                                @foreach ($eventvenes as $venes)
                                                    <option value="{{ $venes->id }}">{{ $venes->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-8 col-md-12" style="display: none;" id="showHideEventVenue">
                                            <h5 class="text-center mb-2">{{__('create_new_venue')}}</h5>
                                            <div class="row form-group mb-2">
                                                <div class="col-md-4">
                                                    <label for="">Venue Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="Venue Name" name="venue_name">
                                                </div>
                                            </div>
                                            <div class="row form-group mb-2">
                                                <div class="col-md-4">
                                                    <label for="">Address</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="Address" name="venue_address">
                                                </div>
                                            </div>
                                            <div class="row form-group mb-2">
                                                <div class="col-md-4">
                                                    <label for="">City</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="City" name="venue_city">
                                                </div>
                                            </div>
                                            <div class="row form-group mb-2">
                                                <div class="col-md-4">
                                                    <label for="">Country</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="venue_country" class="form-control">
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group mb-2">
                                                <div class="col-md-4">
                                                    <label for="">State or Province</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="State or Province" name="venue_state">
                                                </div>
                                            </div>
                                            <div class="row form-group mb-2">
                                                <div class="col-md-4">
                                                    <label for="">Postal Code</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="Postal Code" name="venue_postal_code">
                                                </div>
                                            </div>
                                            <div class="row form-group mb-2">
                                                <div class="col-md-4">
                                                    <label for="">Phone</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="Phone" name="venue_phone">
                                                </div>
                                            </div>
                                            <div class="row form-group mb-2">
                                                <div class="col-md-4">
                                                    <label for="">Website</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="Website" name="venue_website">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3>Organiser </h3>
                                </div>
                                <div class="card-body">
                                    <div id="organiserDetailShow">

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mt-4">
                                            <button type="button" class="btn btn-info" onclick="addOrganiser()" title="Add atlist one organiser">Add Organiser</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3>Additional Fields / Website</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 mb-2 mb-lg-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <label for="istheeventwheelchair">Is the event wheelchair</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 ml-3 ml-lg-0">
                                                    <input type="checkbox" class="form-check-input" name="wheelchair" value="1" id="istheeventwheelchair"> Yes
                                                </div>
                                                <div class="col-lg-6 col-md-6 mt-3">
                                                    <label for="accessible">Accessible</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 ml-3 ml-lg-0 mt-3">
                                                    <input type="checkbox" class="form-check-input" name="accessible" value="1" id="accessible"> No
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <label for="">External Link</label>
                                            <input type="text" name="event_info_link" class="form-control" placeholder="Enter URL for event information">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h3>Event Cost</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <label for="">Cost</label>
                                            <input type="number" step="0.01" min="0"  name="cost" class="form-control" placeholder="Event Cost">
                                            <span class="text-warning">Leave blank to hide the field. Enter a 0 for events that are free.</span>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-success" type="submit">Submit Event</button>
                                        </div>
                                    </div>
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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    {{-- select  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/summernote/summernote-bs4.min.css')}}">
    <style>
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
    </style>

    @error('details')
        <style>
            .note-editor.note-airframe, .note-editor.note-frame {
                border-color: red !important;
            }
        </style>
    @enderror

@endsection

@section('script')
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
            }else {
                $("#showHideEventVenue").slideUp();
            }

        });

        let selectdynamicid = 0;

        function addOrganiser() {
            // alert('hello');
            selectdynamicid++;
            $("#organiserDetailShow").append(`
                <div class="row mt-4">
                    <div class="col-lg-3 col-md-12 mb-3 mb-lg-0">
                        <label class="mb-3">Organiser Details</label>
                        <select class="eventselect2 form-control" id="newCreate_${selectdynamicid}" name="organiser_id[]" onchange="createNewOrganiser(this, ${selectdynamicid})">
                            <option selected disabled>Select One</option>
                            <option value="create_new_organiser">Create New Organiser</option>
                            @foreach($eventorganiser as $eventorganise)
                                <option value="{{$eventorganise->id}}">{{ $eventorganise->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-8 col-md-12 mb-2 mb-lg-0">
                        <div id="show_${selectdynamicid}">

                        </div>
                    </div>
                    <div class="col-lg-1 col-md-12 mt-4">
                        <button type="button" class="btn btn-danger removeitem"><i class="fa fa-trash"></i></button>
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
                            <label for="">Organiser Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Full Name" name="organiser_name[]" >
                        </div>
                    </div>
                    <div class="row form-group mb-2">
                        <div class="col-md-4">
                            <label for="">Organiser Phone</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" placeholder="Phone number" name="organiser_phone[]">
                        </div>
                    </div>
                    <div class="row form-group mb-2">
                        <div class="col-md-4">
                            <label for="">Organiser Website</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Website url" name="organiser_website[]">
                        </div>
                    </div>
                    <div class="row form-group mb-2">
                        <div class="col-md-4">
                            <label for="">Organiser Email</label>
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
