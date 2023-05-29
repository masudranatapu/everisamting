<form class="form-horizontal" action="{{ route('setting', 'website') }}" method="POST"
enctype="multipart/form-data">
@method('PUT')
@csrf
<input name="section" type="text" value="basic" hidden>
<div class="row ">
    <div class="col-6">
        <div class="form-group">
            <x-forms.label name="site_email" />
            <input value="{{ $setting->email }}" name="email" type="email"
                class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('enter_site_email') }}">
            @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <x-forms.label name="phone" />
            <input value="{{ $setting->phone }}" name="phone" type="text"
                class="form-control @error('phone') is-invalid @enderror" placeholder="{{ __('enter_site_phone') }}">
            @error('phone') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <x-forms.label name="address" />
            <textarea value="{{ $setting->address }}" name="address"
                class="form-control @error('address') is-invalid @enderror"
                placeholder="{{ __('enter_site_address') }}">{{ $setting->address }}</textarea>
            @error('address') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <x-forms.label name="map_address" />
            <textarea value="{{ $setting->map_address }}" name="map_address"
                class="form-control @error('map_address') is-invalid @enderror"
                placeholder="{{ __('enter_iframe_link') }}">{{ $setting->map_address }}</textarea>
            @error('map_address') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <x-forms.label name="android_app_link" />
            <input type="url" class="form-control @error('android') is-invalid @enderror" name="android"
                placeholder="{{ __('enter_company_android_link') }}" value="{{ $setting->android }}">
            @error('android') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <x-forms.label name="ios_app_link" />
            <input type="url" class="form-control @error('ios') is-invalid @enderror" name="ios"
                placeholder="{{ __('ios') }}" value="{{ $setting->ios }}">
            @error('ios') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
        </div>
    </div>
</div>

@if (userCan('setting.update'))
    <div class="row mt-3">
        <div class="col-6 offset-3 text-center">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_settings') }}
            </button>
        </div>
    </div>
@endif

</form>

@push('component_backend_script')
<script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
</script>
@endpush
