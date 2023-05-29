@props(['ad', 'product_custom_field_groups'])
<div>

    <ul class="overview-details pt-3">
        @if ($ad->brand_id)
            <li class="overview-details__item">
                <span class="text--body-3 title">
                    <i class="text-info"></i>
                    Brand :
                </span>
                <span class="text--body-3 info">
                    {{ $ad->brand->name ?? '' }}
                </span>
            </li>
        @endif
        @if(isset($ad->employer_logo))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i> {{ __('Company_Logo') }} :</span>
                <span class="text--body-3 info"><img src="{{ asset($ad->employer_logo) }}" alt=""
                                                     style="width: 50px"></span>
            </li>
        @endif
        @if(isset($ad->employer_name))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i> {{ __('Employer_Name') }} :</span>
                <span class="text--body-3 info">{{ $ad->employer_name }}</span>
            </li>
        @endif
        @if(isset($ad->employer_website))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i> {{ __('Employer_Website') }} :</span>
                <span class="text--body-3 info">{{ $ad->employer_website }}</span>
            </li>
        @endif
        @if(isset($ad->employment_type))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i> {{ __('Job_Nature') }} :</span>
                <span class="text--body-3 info">{{ $ad->employment_type }}</span>
            </li>
        @endif
        @if(isset($ad->experience))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('Required_Experience') }} :</span>
                <span class="text--body-3 info">{{ $ad->experience }}</span>
            </li>
        @endif
        @if(isset($ad->education))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('Education_Qualification') }} :</span>
                <span class="text--body-3 info">{{ $ad->education }}</span>
            </li>
            @if(isset($ad->deadline))
                <li class="overview-details__item">
                    <span class="text--body-3 title"> <i class="text-info"></i>{{ __('Application_Deadline') }} :</span>
                    <span class="text--body-3 info">{{ date('d M, Y', strtotime($ad->deadline)) }}</span>
                </li>
            @endif
        @endif
        @if(isset($ad->service_type_id))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('service_type') }} :</span>
                <span class="text--body-3 info">{{ $ad->service_type->name }}</span>
            </li>
        @endif
        @if(isset($ad->condition))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('condition') }} :</span>
                <span class="text--body-3 info">{{ $ad->condition }}</span>
            </li>
        @endif
        @if(isset($ad->authenticity))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('authenticity') }} :</span>
                <span class="text--body-3 info">{{ $ad->authenticity }}</span>
            </li>
        @endif
        @if(isset($ad->ram))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('ram') }} :</span>
                <span class="text--body-3 info">{{ $ad->ram }} GB</span>
            </li>
        @endif
        @if(isset($ad->edition))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('edition') }} :</span>
                <span class="text--body-3 info">{{ $ad->edition }}</span>
            </li>
        @endif
        @if(isset($ad->product_model_id))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('model') }} :</span>
                <span class="text--body-3 info">{{ $ad->model->name }}</span>
            </li>
        @endif
        @if(isset($ad->processor))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('processor') }} :</span>
                <span class="text--body-3 info">{{ $ad->processor }}</span>
            </li>
        @endif
        @if(isset($ad->trim_edition))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('trim_edition') }} :</span>
                <span class="text--body-3 info">{{ $ad->trim_edition }}</span>
            </li>
        @endif
        @if(isset($ad->year_of_manufacture))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('year_of_manufacture') }} :</span>
                <span class="text--body-3 info">{{ $ad->year_of_manufacture }}</span>
            </li>
        @endif
        @if(isset($ad->engine_capacity))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('engine_capacity') }} :</span>
                <span class="text--body-3 info">{{ $ad->engine_capacity }}</span>
            </li>
        @endif
        @if(isset($ad->transmission))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('transmission') }} :</span>
                <span class="text--body-3 info">{{ $ad->transmission }}</span>
            </li>
        @endif
        @if(isset($ad->registration_year))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('registration_year') }} :</span>
                <span class="text--body-3 info">{{ $ad->registration_year }}</span>
            </li>
        @endif
        @if(isset($ad->body_type))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('body_type') }} :</span>
                <span class="text--body-3 info">{{ $ad->body_type }}</span>
            </li>
        @endif
        @if(isset($ad->fuel_type))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('fuel_type') }} :</span>
                <span class="text--body-3 info" style="width: 70%">
                    @foreach($ad->fuel_type as $val)
                        {{ $val }} {{ $loop->last ? '' : ', ' }}
                    @endforeach
                </span>
            </li>
        @endif
        @if(isset($ad->property_type))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('property_type') }} :</span>
                <span class="text--body-3 info">{{ $ad->property_type }}</span>
            </li>
        @endif
        @if(isset($ad->bedroom))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('bedroom') }} :</span>
                <span class="text--body-3 info">{{ $ad->bedroom }}</span>
            </li>
        @endif
        @if(isset($ad->size))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('size') }} :</span>
                <span class="text--body-3 info">{{ $ad->size }} {{ $ad->size_type ?? '' }}</span>
            </li>
        @endif
        @if(isset($ad->property_location))
            <li class="overview-details__item">
                <span class="text--body-3 title"> <i class="text-info"></i>{{ __('property_location') }} :</span>
                <span class="text--body-3 info">{{ $ad->property_location }}</span>
            </li>
        @endif

    </ul>
</div>

@push('component_style')
    <style>
        .download-attachment {
            text-decoration: underline !important;
        }
    </style>
@endpush
