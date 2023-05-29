@extends('layouts.frontend.layout_one')

@section('title', __('ads'))
@php
    $condition = [
        'jobs' , 'education', 'property', 'health-beauty', 'agriculture'
];
    $brands_cat = [
        'mobiles' , 'electronics', 'pc', 'mobile-phones-tablets', 'vehicles'
];
 $categories_slug = explode(',', request('category'));
        $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
        $isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet"));
        $isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows"));
        $isMac = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "Mac"));

@endphp

@section('meta')
    @php
        $data = metaData('ads');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}"/>
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('frontend.adlist') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}"/>
    <meta name=twitter:url content="{{ route('frontend.adlist') }}"/>
    <meta name=twitter:title content="{{ $data->title }}"/>
    <meta name=twitter:description content="{{ $data->description }}"/>
    <meta name=twitter:image content="{{ $data->image_url }}"/>
@endsection

@section('content')
    <x-frontend.breedcrumb-component :background="$cms->ads_background">
        {{ __('ad_list') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('ad_list') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->
    <x-frontend.adlist-search class="adlist-search" :categories="$categories" :dark="false"
                              :total-ads="$adlistings->total()"/>
    {{-- @if (isset($searchable_fields) && count($searchable_fields))
    <x-frontend.ad.custom-field :searchableFields="$searchable_fields" />
    @endif --}}

    <section class="section ad-list">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    <div class="list-sidebar">
                        <div class="product-filter">
                            <h3>{{ __('product_filters') }}</h3>
                            <span class="close">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.625 4.375L4.375 15.625" stroke="#767E94" stroke-width="1.6"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.625 15.625L4.375 4.375" stroke="#767E94" stroke-width="1.6"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        </div>
                        <form method="GET" action="{{ route('frontend.adlist.search') }}" id="adFilterForm">

                            <input type="hidden" class="session_cat" value="{{ $categories_slug[0] }}">
                            <div class="accordion list-sidebar__accordion" id="accordionGroup">
                                <div class="accordion-item list-sidebar__accordion-item price">
                                    <h2 class="accordion-header list-sidebar__accordion-header" id="priceTag">
                                        <button class="accordion-button list-sidebar__accordion-button collapsed"
                                                type="button" data-bs-toggle="collapse" data-bs-target="#priceCollapse"
                                                aria-expanded="false" aria-controls="priceCollapse">
                                            @if($categories_slug && $categories_slug[0] == 'jobs')
                                                {{ __('salary') }}
                                            @else
                                                {{ __('prices') }}
                                            @endif
                                        </button>
                                    </h2>
                                    <div id="priceCollapse" class="accordion-collapse collapse show"
                                         aria-labelledby="priceTag" data-bs-parent="#accordionGroup">
                                        <div class="accordion-body list-sidebar__accordion-body">
                                            <div class="price-range-slider">
                                                <div class="row">
                                                    @if($categories_slug && $categories_slug[0] == 'jobs')
                                                        <div class="col-6">
                                                            <div class="mb-2">
                                                                <input type="number"
                                                                       class="form-control mb-3 price_input_child"
                                                                       name="salary_from" id="salary_from"
                                                                       placeholder="{{ __('from') }}"
                                                                       value="{{ request()->salary_from }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="number"
                                                                   class="form-control mb-1 price_input_child"
                                                                   name="salary_to" id="salary_to"
                                                                   placeholder="{{ __('to') }}"
                                                                   value="{{ request()->salary_to }}">
                                                        </div>
                                                    @else
                                                        <div class="col-6">
                                                            <div class="mb-2">
                                                                <input type="number"
                                                                       class="form-control mb-3 price_input_child"
                                                                       name="price_min" id="price_min"
                                                                       placeholder="{{ __('min') }}"
                                                                       value="{{ request()->price_min }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="number"
                                                                   class="form-control mb-1 price_input_child"
                                                                   name="price_max" id="price_max"
                                                                   placeholder="{{ __('max') }}"
                                                                   value="{{ request()->price_max }}">
                                                        </div>
                                                    @endif
                                                    <div class="col-12">
                                                        <button type="button" class="btn  w-100 filter_now">
                                                            Filter
                                                            Now
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="mb-3">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item list-sidebar__accordion-item category">
                                    <h2 class="accordion-header list-sidebar__accordion-header" id="category">
                                        <button class="accordion-button list-sidebar__accordion-button" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#categoryCollapse"
                                                aria-expanded="true" aria-controls="categoryCollapse">
                                            {{ __('category') }}
                                        </button>
                                    </h2>
                                    <div id="categoryCollapse" class="accordion-collapse collapse {{ $categories_slug[0] ? 'show' : '' }} "
                                         aria-labelledby="category" data-bs-parent="#accordionGroup">
                                        <div class="accordion-body list-sidebar__accordion-body">
                                            <div class="accordion list-sidebar__accordion-inner" id="subcategoryGroup">
                                                @foreach ($categories as $category)
                                                    @php
                                                        $totalcateads = DB::table('ads')
                                                        ->where('category_id', $category->id)
                                                        ->get();
                                                    @endphp
                                                    <div class="accordion-item list-sidebar__accordion-inner-item">
                                                        <h2 class="accordion-header"
                                                            id="{{ Str::slug($category->slug) }}">
                                                            <div
                                                                class="accordion-button list-sidebar__accordion-inner-button {{ isActiveCategorySidebar($category) ? '' : 'collapsed' }}"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#{{ Str::slug($category->slug) }}Collapse"
                                                                aria-expanded="true"
                                                                aria-controls="{{ Str::slug($category->slug) }}Collapse">
                                                        <span class="list-sidebar__accordion-inner-icon">
                                                            <i class="{{ $category->icon }}"></i>
                                                        </span>
                                                                <span class="cat_title">{{ $category->name }} </span>
                                                                @if ($category->subcategories->count() > 0)
                                                                    <span class="icon icon--plus">
                                                            <x-svg.plus-light-icon/>
                                                        </span>
                                                                @endif
                                                                <span class="icon icon--minus">
                                                            <x-svg.minus-icon/>
                                                        </span>
                                                            </div>
                                                        </h2>
                                                        <div id="{{ Str::slug($category->slug) }}Collapse"
                                                             class="accordion-collapse collapse {{ isActiveCategorySidebar($category) ? 'show' : '' }}"
                                                             aria-labelledby="{{ $category->slug }}"
                                                             data-bs-parent="#subcategoryGroup">
                                                            <div
                                                                class="accordion-body list-sidebar__accordion-inner-body">
                                                                @foreach ($category->subcategories as $subcategory)
                                                                    @php
                                                                        $totalsubcateads = DB::table('ads')
                                                                        ->where('subcategory_id', $subcategory->id)
                                                                        ->where('status', 'active')
                                                                        ->get();
                                                                    @endphp
                                                                    <div
                                                                        class="list-sidebar__accordion-inner-body--item">
                                                                        <div class="form-check">
                                                                            <input id="{{ $subcategory->slug }}"
                                                                                   type="checkbox"
                                                                                   name="subcategory[]"
                                                                                   value="{{ $subcategory->slug }}"
                                                                                   data-cat="{{ $category->slug }}"
                                                                                   class="form-check-input subcat_search {{ $category->slug }}" {{ request('subcategory')
                                                                    && in_array($subcategory->slug,
                                                                request('subcategory')) ? 'checked' : '' }}/>

                                                                            <x-forms.label
                                                                                name="{{ $subcategory->name }} ( {{ $totalsubcateads->count() }} ) "
                                                                                for="{{ $subcategory->slug }}"
                                                                                class="form-check-label"/>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($categories_slug[0] && !in_array($categories_slug[0], $condition))
                                    <div class="accordion accordion-flush" id="condition">
                                        <div class="accordion-item list-sidebar__accordion-item">
                                            <h2 class="accordion-header list-sidebar__accordion-header"
                                                id="condition_heading">
                                                <button
                                                    class="accordion-button list-sidebar__accordion-button collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#condition_collapseOne"
                                                    aria-expanded="false" aria-controls="condition_collapseOne">
                                                    {{ __('condition') }}
                                                </button>
                                            </h2>
                                            <div id="condition_collapseOne"
                                                 class="accordion-collapse collapse {{ request()->has('condition') ? 'show' : ''}} "
                                                 aria-labelledby="condition_heading" data-bs-parent="#condition">
                                                <div
                                                    class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 condition_item">
                                                    <div class="list-sidebar__accordion-inner-body--item">
                                                        <div class="form-check">
                                                            <input id="new" type="checkbox"
                                                                   name="condition[]"
                                                                   value="new"
                                                                   class="form-check-input"
                                                                   {{ request('condition') && in_array('new',  request('condition')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="new"
                                                                for="new" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="used" type="checkbox"
                                                                   name="condition[]"
                                                                   value="used"
                                                                   class="form-check-input"
                                                                   {{ request('condition') && in_array('used',  request('condition')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="used"
                                                                for="used" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="gently_used" type="checkbox"
                                                                   name="condition[]"
                                                                   value="gently_used"
                                                                   class="form-check-input"
                                                                   {{ request('condition') && in_array('gently_used',  request('condition')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="gently_used"
                                                                for="gently_used" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($categories_slug && in_array($categories_slug[0], $brands_cat))
                                    @if(isset($brands) && $brands->count() > 0)
                                        <div class="accordion accordion-flush" id="brand_bb">
                                            <div class="accordion-item list-sidebar__accordion-item">
                                                <h2 class="accordion-header list-sidebar__accordion-header"
                                                    id="brand_bb_heading">
                                                    <button
                                                        class="accordion-button list-sidebar__accordion-button collapsed"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#brand_bb_collapseOne"
                                                        aria-expanded="false" aria-controls="brand_bb_collapseOne">
                                                        {{ __('brand') }}
                                                    </button>
                                                </h2>
                                                <div id="brand_bb_collapseOne"
                                                     class="accordion-collapse collapse {{ request()->has('brand') ? 'show' : ''}} "
                                                     aria-labelledby="brand_heading" data-bs-parent="#brand">
                                                    <div
                                                        class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 brand_item">
                                                        <div class="list-sidebar__accordion-inner-body--item">
                                                            @foreach($brands as $brand)
                                                                <div class="form-check">
                                                                    <input id="{{$brand->slug}}" type="checkbox"
                                                                           name="brand[]"
                                                                           value="{{ $brand->slug }}"
                                                                           class="form-check-input"
                                                                           {{ request('brand') && in_array($brand->slug,  request('brand')) ? 'checked' : '' }}
                                                                           onchange="changeFilter()"/>

                                                                    <x-forms.label
                                                                        name="{{ $brand->name }}"
                                                                        for="{{$brand->slug}}" :required="false"
                                                                        class="form-check-label"/>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($models) && $models->count() > 0)
                                        <div class="accordion accordion-flush" id="model_mm">
                                            <div class="accordion-item list-sidebar__accordion-item">
                                                <h2 class="accordion-header list-sidebar__accordion-header"
                                                    id="model_mm_heading">
                                                    <button
                                                        class="accordion-button list-sidebar__accordion-button collapsed"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#model_mm_collapseOne"
                                                        aria-expanded="false" aria-controls="model_mm_collapseOne">
                                                        {{ __('model') }}
                                                    </button>
                                                </h2>
                                                <div id="model_mm_collapseOne"
                                                     class="accordion-collapse collapse {{ request()->has('model') ? 'show' : ''}} "
                                                     aria-labelledby="model_heading" data-bs-parent="#model">
                                                    <div
                                                        class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 model_item">
                                                        <div class="list-sidebar__accordion-inner-body--item">
                                                            @foreach($models as $model)
                                                                <div class="form-check">
                                                                    <input id="{{ $model->slug }}" type="checkbox"
                                                                           name="model[]"
                                                                           value="{{ $model->slug }}"
                                                                           class="form-check-input"
                                                                           {{ request('model') && in_array($model->slug,  request('model')) ? 'checked' : '' }}
                                                                           onchange="changeFilter()"/>

                                                                    <x-forms.label
                                                                        name="{{ $model->name }}"
                                                                        for="{{ $model->slug }}" :required="false"
                                                                        class="form-check-label"/>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if($categories_slug && $categories_slug[0] == 'jobs')
                                    @if(isset($designations) && $designations->count() > 0)
                                        <div class="accordion accordion-flush" id="designation">
                                            <div class="accordion-item list-sidebar__accordion-item">
                                                <h2 class="accordion-header list-sidebar__accordion-header"
                                                    id="designation_heading">
                                                    <button
                                                        class="accordion-button list-sidebar__accordion-button collapsed"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#designation_collapseOne"
                                                        aria-expanded="false" aria-controls="designation_collapseOne">
                                                        {{ __('designation') }}
                                                    </button>
                                                </h2>
                                                <div id="designation_collapseOne"
                                                     class="accordion-collapse collapse {{ request()->has('designation') ? 'show' : ''}} "
                                                     aria-labelledby="designation_heading"
                                                     data-bs-parent="#designation">
                                                    <div
                                                        class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 designation_item">
                                                        <div class="list-sidebar__accordion-inner-body--item">
                                                            @foreach($designations as $designation)
                                                                <div class="form-check">
                                                                    <input id="{{ $designation->slug }}" type="checkbox"
                                                                           name="designation[]"
                                                                           value="{{ $designation->slug }}"
                                                                           class="form-check-input"
                                                                           {{ request('designation') && in_array($designation->slug,  request('designation')) ? 'checked' : '' }}
                                                                           onchange="changeFilter()"/>

                                                                    <x-forms.label
                                                                        name="{{ $designation->name }}"
                                                                        for="{{ $designation->slug }}" :required="false"
                                                                        class="form-check-label"/>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="accordion accordion-flush" id="job_type">
                                        <div class="accordion-item list-sidebar__accordion-item">
                                            <h2 class="accordion-header list-sidebar__accordion-header"
                                                id="job_type_heading">
                                                <button
                                                    class="accordion-button list-sidebar__accordion-button collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#job_type_collapseOne"
                                                    aria-expanded="false" aria-controls="job_type_collapseOne">
                                                    {{ __('job_type') }}
                                                </button>
                                            </h2>
                                            <div id="job_type_collapseOne"
                                                 class="accordion-collapse collapse {{ request()->has('job_type') ? 'show' : ''}} "
                                                 aria-labelledby="job_type_heading" data-bs-parent="#job_type">
                                                <div
                                                    class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 job_type_item">
                                                    <div class="list-sidebar__accordion-inner-body--item">
                                                        <div class="form-check">
                                                            <input id="full_time" type="checkbox"
                                                                   name="job_type[]"
                                                                   value="Full Time"
                                                                   class="form-check-input"
                                                                   {{ request('job_type') && in_array('Full Time',  request('job_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="full_time"
                                                                for="full_time" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="part_time" type="checkbox"
                                                                   name="job_type[]"
                                                                   value="Part Time"
                                                                   class="form-check-input"
                                                                   {{ request('job_type') && in_array('Part Time',  request('job_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="part_time"
                                                                for="part_time" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="Contractual" type="checkbox"
                                                                   name="job_type[]"
                                                                   value="Contractual"
                                                                   class="form-check-input"
                                                                   {{ request('job_type') && in_array('Contractual',  request('job_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="Contractual"
                                                                for="Contractual" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="Internship" type="checkbox"
                                                                   name="job_type[]"
                                                                   value="Internship"
                                                                   class="form-check-input"
                                                                   {{ request('job_type') && in_array('Internship',  request('job_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="Internship"
                                                                for="Internship" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-flush" id="education">
                                        <div class="accordion-item list-sidebar__accordion-item">
                                            <h2 class="accordion-header list-sidebar__accordion-header"
                                                id="education_heading">
                                                <button
                                                    class="accordion-button list-sidebar__accordion-button collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#education_collapseOne"
                                                    aria-expanded="false" aria-controls="education_collapseOne">
                                                    {{ __('education') }}
                                                </button>
                                            </h2>
                                            <div id="education_collapseOne"
                                                 class="accordion-collapse collapse {{ request()->has('education') ? 'show' : ''}} "
                                                 aria-labelledby="education_heading" data-bs-parent="#education">
                                                <div
                                                    class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 education_item">
                                                    <div class="list-sidebar__accordion-inner-body--item">
                                                        <div class="form-check">
                                                            <input id="Primary_School" type="checkbox"
                                                                   name="education[]"
                                                                   value="Primary School"
                                                                   class="form-check-input"
                                                                   {{ request('education') && in_array('Primary School',  request('education')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="Primary School"
                                                                for="Primary_School" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="High_School" type="checkbox"
                                                                   name="education[]"
                                                                   value="High School"
                                                                   class="form-check-input"
                                                                   {{ request('education') && in_array('High School',  request('education')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="High School"
                                                                for="High_School" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="SSC_Level" type="checkbox"
                                                                   name="education[]"
                                                                   value="SSC / O Level"
                                                                   class="form-check-input"
                                                                   {{ request('education') && in_array('SSC / O Level',  request('education')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="SSC / O Level"
                                                                for="SSC_Level" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="HSC_Level" type="checkbox"
                                                                   name="education[]"
                                                                   value="HSC / A Level"
                                                                   class="form-check-input"
                                                                   {{ request('education') && in_array('HSC / A Level',  request('education')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="HSC / A Level"
                                                                for="HSC_Level" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="Diploma" type="checkbox"
                                                                   name="education[]"
                                                                   value="Diploma"
                                                                   class="form-check-input"
                                                                   {{ request('education') && in_array('Diploma',  request('education')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="Diploma"
                                                                for="Diploma" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="Honors_BBA" type="checkbox"
                                                                   name="education[]"
                                                                   value="Honors / BBA"
                                                                   class="form-check-input"
                                                                   {{ request('education') && in_array('Honors / BBA',  request('education')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="Honors / BBA"
                                                                for="Honors_BBA" :required="false"
                                                                class="form-check-label"/>
                                                        </div>

                                                        <div class="form-check">
                                                            <input id="Masters_MBA" type="checkbox"
                                                                   name="education[]"
                                                                   value="Masters / MBA"
                                                                   class="form-check-input"
                                                                   {{ request('education') && in_array('Masters / MBA',  request('education')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="Masters / MBA"
                                                                for="Masters_MBA" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="phD_Doctorate" type="checkbox"
                                                                   name="education[]"
                                                                   value="phD / Doctorate"
                                                                   class="form-check-input"
                                                                   {{ request('education') && in_array('phD / Doctorate',  request('education')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="phD / Doctorate"
                                                                for="phD_Doctorate" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($categories_slug && $categories_slug[0] == 'vehicles')

                                    <div class="accordion accordion-flush" id="fuel_type">
                                        <div class="accordion-item list-sidebar__accordion-item">
                                            <h2 class="accordion-header list-sidebar__accordion-header"
                                                id="fuel_type_heading">
                                                <button
                                                    class="accordion-button list-sidebar__accordion-button collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#fuel_type_collapseOne"
                                                    aria-expanded="false" aria-controls="fuel_type_collapseOne">
                                                    {{ __('fuel_type') }}
                                                </button>
                                            </h2>
                                            <div id="fuel_type_collapseOne"
                                                 class="accordion-collapse collapse {{ request()->has('fuel_type') ? 'show' : ''}} "
                                                 aria-labelledby="fuel_type_heading" data-bs-parent="#fuel_type">
                                                <div
                                                    class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 fuel_type_item">
                                                    <div class="list-sidebar__accordion-inner-body--item">
                                                        <div class="form-check">
                                                            <input id="diesel" type="checkbox"
                                                                   name="fuel_type[]"
                                                                   value="diesel"
                                                                   class="form-check-input"
                                                                   {{ request('fuel_type') && in_array('diesel',  request('fuel_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="diesel"
                                                                for="diesel" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="petrol" type="checkbox"
                                                                   name="fuel_type[]"
                                                                   value="petrol"
                                                                   class="form-check-input"
                                                                   {{ request('fuel_type') && in_array('petrol',  request('fuel_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="petrol"
                                                                for="petrol" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="cng" type="checkbox"
                                                                   name="fuel_type[]"
                                                                   value="cng"
                                                                   class="form-check-input"
                                                                   {{ request('fuel_type') && in_array('cng',  request('fuel_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="cng"
                                                                for="cng" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="hybrid" type="checkbox"
                                                                   name="fuel_type[]"
                                                                   value="hybrid"
                                                                   class="form-check-input"
                                                                   {{ request('fuel_type') && in_array('hybrid',  request('fuel_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="hybrid"
                                                                for="hybrid" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="electric" type="checkbox"
                                                                   name="fuel_type[]"
                                                                   value="electric"
                                                                   class="form-check-input"
                                                                   {{ request('fuel_type') && in_array('electric',  request('fuel_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="electric"
                                                                for="electric" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="octane" type="checkbox"
                                                                   name="fuel_type[]"
                                                                   value="octane"
                                                                   class="form-check-input"
                                                                   {{ request('fuel_type') && in_array('octane',  request('fuel_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="octane"
                                                                for="octane" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="lpg" type="checkbox"
                                                                   name="fuel_type[]"
                                                                   value="lpg"
                                                                   class="form-check-input"
                                                                   {{ request('fuel_type') && in_array('lpg',  request('fuel_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="lpg"
                                                                for="lpg" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="other" type="checkbox"
                                                                   name="fuel_type[]"
                                                                   value="other"
                                                                   class="form-check-input"
                                                                   {{ request('fuel_type') && in_array('other',  request('fuel_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="other"
                                                                for="other" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-flush" id="transmission">
                                        <div class="accordion-item list-sidebar__accordion-item">
                                            <h2 class="accordion-header list-sidebar__accordion-header"
                                                id="transmission_heading">
                                                <button
                                                    class="accordion-button list-sidebar__accordion-button collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#transmission_collapseOne"
                                                    aria-expanded="false" aria-controls="transmission_collapseOne">
                                                    {{ __('transmission') }}
                                                </button>
                                            </h2>
                                            <div id="transmission_collapseOne"
                                                 class="accordion-collapse collapse {{ request()->has('transmission') ? 'show' : ''}} "
                                                 aria-labelledby="transmission_heading" data-bs-parent="#transmission">
                                                <div
                                                    class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 transmission_item">
                                                    <div class="list-sidebar__accordion-inner-body--item">
                                                        <div class="form-check">
                                                            <input id="manual" type="checkbox"
                                                                   name="transmission[]"
                                                                   value="manual"
                                                                   class="form-check-input"
                                                                   {{ request('transmission') && in_array('manual',  request('transmission')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="manual"
                                                                for="manual" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="automatic" type="checkbox"
                                                                   name="transmission[]"
                                                                   value="automatic"
                                                                   class="form-check-input"
                                                                   {{ request('transmission') && in_array('automatic',  request('transmission')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="automatic"
                                                                for="automatic" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="other_transmission" type="checkbox"
                                                                   name="transmission[]"
                                                                   value="other_transmission"
                                                                   class="form-check-input"
                                                                   {{ request('transmission') && in_array('other_transmission',  request('transmission')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="other_transmission"
                                                                for="other_transmission" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion accordion-flush" id="body_type">
                                        <div class="accordion-item list-sidebar__accordion-item">
                                            <h2 class="accordion-header list-sidebar__accordion-header"
                                                id="body_type_heading">
                                                <button
                                                    class="accordion-button list-sidebar__accordion-button collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#body_type_collapseOne"
                                                    aria-expanded="false" aria-controls="body_type_collapseOne">
                                                    {{ __('body_type') }}
                                                </button>
                                            </h2>
                                            <div id="body_type_collapseOne"
                                                 class="accordion-collapse collapse {{ request()->has('body_type') ? 'show' : ''}} "
                                                 aria-labelledby="body_type_heading" data-bs-parent="#body_type">
                                                <div
                                                    class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 body_type_item">
                                                    <div class="list-sidebar__accordion-inner-body--item">
                                                        <div class="form-check">
                                                            <input id="saloon" type="checkbox"
                                                                   name="body_type[]"
                                                                   value="saloon"
                                                                   class="form-check-input"
                                                                   {{ request('body_type') && in_array('saloon',  request('body_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="saloon"
                                                                for="saloon" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="hatchback" type="checkbox"
                                                                   name="body_type[]"
                                                                   value="hatchback"
                                                                   class="form-check-input"
                                                                   {{ request('body_type') && in_array('hatchback',  request('body_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="hatchback"
                                                                for="hatchback" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="estate" type="checkbox"
                                                                   name="body_type[]"
                                                                   value="estate"
                                                                   class="form-check-input"
                                                                   {{ request('body_type') && in_array('estate',  request('body_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="estate"
                                                                for="estate" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="convertible" type="checkbox"
                                                                   name="body_type[]"
                                                                   value="convertible"
                                                                   class="form-check-input"
                                                                   {{ request('body_type') && in_array('convertible',  request('body_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="convertible"
                                                                for="convertible" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="Coupe/sports" type="checkbox"
                                                                   name="body_type[]"
                                                                   value="Coupe/sports"
                                                                   class="form-check-input"
                                                                   {{ request('body_type') && in_array('Coupe/sports',  request('body_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="Coupe/sports"
                                                                for="Coupe/sports" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="SUV/4X4" type="checkbox"
                                                                   name="body_type[]"
                                                                   value="SUV/4X4"
                                                                   class="form-check-input"
                                                                   {{ request('body_type') && in_array('SUV/4X4',  request('body_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="SUV/4X4"
                                                                for="SUV/4X4" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="MPV" type="checkbox"
                                                                   name="body_type[]"
                                                                   value="MPV"
                                                                   class="form-check-input"
                                                                   {{ request('body_type') && in_array('MPV',  request('body_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="MPV"
                                                                for="MPV" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($categories_slug && $categories_slug[0] == 'property')
                                    <div class="accordion accordion-flush" id="property_type">
                                        <div class="accordion-item list-sidebar__accordion-item">
                                            <h2 class="accordion-header list-sidebar__accordion-header"
                                                id="property_type_heading">
                                                <button
                                                    class="accordion-button list-sidebar__accordion-button collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#property_type_collapseOne"
                                                    aria-expanded="false" aria-controls="property_type_collapseOne">
                                                    {{ __('property_type') }}
                                                </button>
                                            </h2>
                                            <div id="property_type_collapseOne"
                                                 class="accordion-collapse collapse {{ request()->has('property_type') ? 'show' : ''}} "
                                                 aria-labelledby="property_type_heading"
                                                 data-bs-parent="#property_type">
                                                <div
                                                    class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 property_type_item">
                                                    <div class="list-sidebar__accordion-inner-body--item">
                                                        <div class="form-check">
                                                            <input id="agricultural" type="checkbox"
                                                                   name="property_type[]"
                                                                   value="agricultural"
                                                                   class="form-check-input"
                                                                   {{ request('property_type') && in_array('agricultural',  request('property_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="agricultural"
                                                                for="agricultural" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="residential" type="checkbox"
                                                                   name="property_type[]"
                                                                   value="residential"
                                                                   class="form-check-input"
                                                                   {{ request('property_type') && in_array('residential',  request('property_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="residential"
                                                                for="residential" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="commercial" type="checkbox"
                                                                   name="property_type[]"
                                                                   value="commercial"
                                                                   class="form-check-input"
                                                                   {{ request('property_type') && in_array('commercial',  request('property_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="commercial"
                                                                for="commercial" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="other" type="checkbox"
                                                                   name="property_type[]"
                                                                   value="other"
                                                                   class="form-check-input"
                                                                   {{ request('property_type') && in_array('other',  request('property_type')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="other"
                                                                for="other" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion accordion-flush" id="bedroom">
                                        <div class="accordion-item list-sidebar__accordion-item">
                                            <h2 class="accordion-header list-sidebar__accordion-header"
                                                id="bedroom_heading">
                                                <button
                                                    class="accordion-button list-sidebar__accordion-button collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#bedroom_collapseOne"
                                                    aria-expanded="false" aria-controls="bedroom_collapseOne">
                                                    {{ __('bedroom') }}
                                                </button>
                                            </h2>
                                            <div id="bedroom_collapseOne"
                                                 class="accordion-collapse collapse {{ request()->has('bedroom') ? 'show' : ''}} "
                                                 aria-labelledby="bedroom_heading"
                                                 data-bs-parent="#bedroom">
                                                <div
                                                    class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 property_type_item">
                                                    <div class="list-sidebar__accordion-inner-body--item">
                                                        <div class="form-check">
                                                            <input id="bedroom_1" type="checkbox"
                                                                   name="bedroom[]"
                                                                   value="1"
                                                                   class="form-check-input"
                                                                   {{ request('bedroom') && in_array('1',  request('bedroom')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="one"
                                                                for="bedroom_1" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="bedroom_2" type="checkbox"
                                                                   name="bedroom[]"
                                                                   value="2"
                                                                   class="form-check-input"
                                                                   {{ request('bedroom') && in_array('2',  request('bedroom')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="two"
                                                                for="bedroom_2" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="bedroom_3" type="checkbox"
                                                                   name="bedroom[]"
                                                                   value="3"
                                                                   class="form-check-input"
                                                                   {{ request('bedroom') && in_array('3',  request('bedroom')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="three"
                                                                for="bedroom_3" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="bedroom_4" type="checkbox"
                                                                   name="bedroom[]"
                                                                   value="4"
                                                                   class="form-check-input"
                                                                   {{ request('bedroom') && in_array('4',  request('bedroom')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="four"
                                                                for="bedroom_4" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="bedroom_5" type="checkbox"
                                                                   name="bedroom[]"
                                                                   value="5"
                                                                   class="form-check-input"
                                                                   {{ request('bedroom') && in_array('5',  request('bedroom')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="five"
                                                                for="bedroom_5" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="bedroom_6" type="checkbox"
                                                                   name="bedroom[]"
                                                                   value="6"
                                                                   class="form-check-input"
                                                                   {{ request('bedroom') && in_array('6',  request('bedroom')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="six"
                                                                for="bedroom_6" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="bedroom_7" type="checkbox"
                                                                   name="bedroom[]"
                                                                   value="7"
                                                                   class="form-check-input"
                                                                   {{ request('bedroom') && in_array('7',  request('bedroom')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="seven"
                                                                for="bedroom_7" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="bedroom_8" type="checkbox"
                                                                   name="bedroom[]"
                                                                   value="8"
                                                                   class="form-check-input"
                                                                   {{ request('bedroom') && in_array('8',  request('bedroom')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="eight"
                                                                for="bedroom_8" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="bedroom_9" type="checkbox"
                                                                   name="bedroom[]"
                                                                   value="9"
                                                                   class="form-check-input"
                                                                   {{ request('bedroom') && in_array('9',  request('bedroom')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="nine"
                                                                for="bedroom_9" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="bedroom_10" type="checkbox"
                                                                   name="bedroom[]"
                                                                   value="10"
                                                                   class="form-check-input"
                                                                   {{ request('bedroom') && in_array('10',  request('bedroom')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="ten"
                                                                for="bedroom_10" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item list-sidebar__accordion-item size">
                                        <h2 class="accordion-header list-sidebar__accordion-header" id="sizeTag">
                                            <button class="accordion-button list-sidebar__accordion-button collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#sizeCollapse"
                                                    aria-expanded="false" aria-controls="sizeCollapse">
                                                {{ __('size') }}
                                            </button>
                                        </h2>
                                        <div id="sizeCollapse" class="accordion-collapse collapse {{ request()->min_size || request()->max_size  ? 'show' : ''}}"
                                             aria-labelledby="sizeTag" data-bs-parent="#accordionGroup">
                                            <div class="accordion-body list-sidebar__accordion-body">
                                                <div class="size-range-slider">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-2">
                                                                <input type="number"
                                                                       class="form-control mb-3 price_input_child"
                                                                       name="min_size" id="min_size"
                                                                       placeholder="{{ __('min') }}"
                                                                       value="{{ request()->min_size }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="number"
                                                                   class="form-control mb-1 price_input_child"
                                                                   name="max_size" id="max_size"
                                                                   placeholder="{{ __('max') }}"
                                                                   value="{{ request()->max_size }}">
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="button" class="btn  w-100 filter_now">
                                                                Filter
                                                                Now
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">

                                                        {{-- <span class="input-group-text price-grp price_input_child">-</span>
                                                        --}}


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($categories_slug && $categories_slug[0] == 'fashion')
                                    <div class="accordion accordion-flush" id="fashion_size">
                                        <div class="accordion-item list-sidebar__accordion-item">
                                            <h2 class="accordion-header list-sidebar__accordion-header"
                                                id="fashion_size_heading">
                                                <button
                                                    class="accordion-button list-sidebar__accordion-button collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#fashion_size_collapseOne"
                                                    aria-expanded="false" aria-controls="fashion_size_collapseOne">
                                                    {{ __('size') }}
                                                </button>
                                            </h2>
                                            <div id="fashion_size_collapseOne"
                                                 class="accordion-collapse collapse {{ request()->has('sizes') ? 'show' : ''}} "
                                                 aria-labelledby="fashion_size_heading" data-bs-parent="#fashion_size">
                                                <div
                                                    class="accordion-body list-sidebar__accordion-inner-body pb-3 px-3 fashion_size_item">
                                                    <div class="list-sidebar__accordion-inner-body--item">
                                                        <div class="form-check">
                                                            <input id="small" type="checkbox"
                                                                   name="sizes[]"
                                                                   value="small"
                                                                   class="form-check-input"
                                                                   {{ request('sizes') && in_array('small',  request('sizes')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="small"
                                                                for="small" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="medium" type="checkbox"
                                                                   name="sizes[]"
                                                                   value="medium"
                                                                   class="form-check-input"
                                                                   {{ request('sizes') && in_array('medium',  request('sizes')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="medium"
                                                                for="medium" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="large" type="checkbox"
                                                                   name="sizes[]"
                                                                   value="large"
                                                                   class="form-check-input"
                                                                   {{ request('sizes') && in_array('large',  request('sizes')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="large"
                                                                for="large" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="extra_large" type="checkbox"
                                                                   name="sizes[]"
                                                                   value="extra_large"
                                                                   class="form-check-input"
                                                                   {{ request('sizes') && in_array('extra_large',  request('sizes')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="extra_large"
                                                                for="extra_large" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                        <div class="form-check">
                                                            <input id="double_extra_large" type="checkbox"
                                                                   name="sizes[]"
                                                                   value="double_extra_large"
                                                                   class="form-check-input"
                                                                   {{ request('sizes') && in_array('double_extra_large',  request('sizes')) ? 'checked' : '' }}
                                                                   onchange="changeFilter()"/>

                                                            <x-forms.label
                                                                name="double_extra_large"
                                                                for="double_extra_large" :required="false"
                                                                class="form-check-label"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="ad-list__content row">
                        @forelse ($adlistings as $ad)
                            <x-frontend.single-ad :ad="$ad" :adfields="$ad->productCustomFields"
                                                  className="col-lg-4 col-md-6"/>
                        @empty
                            <x-not-found2 message="{{ __('no_ads_found') }}"/>
                        @endforelse
                    </div>
                    <div class="page-navigation">
                        {{ $adlistings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>
@endsection

@section('adlisting_style')
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/select2.min.css"/>
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/nouislider.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/select2-bootstrap-5-theme.css"/>
    <style>
        .cat_title {
            width: 65%
        }

        .price-grp {
            border: none !important;
            background-color: #FFFFFF !important;
        }

        .price_input_child {
            height: 35px !important;
            padding: 0px 8px;
        }

        .fa-square-caret-right {
            font-size: 30px;
            color: #49A9EE;
        }

        .accordion-button:focus {
            box-shadow: none;
        }
    </style>
@endsection

@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/plugins/select2/js/select2.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/bvselect.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/nouislider.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/wNumb.min.js"></script>
    <script>
        $('.subcat_search').change(function () {
            let cat = null;
            if ($(this).is(':checked')) {
                cat = $(this).data('cat');
            }
            if (cat != null) {
                // alert(cat)
                $("input").not('.' + cat).prop('checked', false);
                $('#adFilterForm').attr('action', "{{ url('/ads') }}/" + cat);
            } else {
                // $('#adFilterForm').find(":input[name='subcategory[]']").attr("disabled", "disabled");
                $('#adFilterForm').attr('action', '{{ route('frontend.adlist.search') }}');
            }
            $('#adFilterForm').submit();

        });
        $('#topSearchFrom').submit(function () {
            let cat = $('.category_select option:selected').val();
            if (cat) {
                $('#topSearchFrom').attr('action', "{{ url('/ads') }}/" + cat);
            } else {
                $('#topSearchFrom').attr('action', '{{ route('frontend.adlist.search') }}');
            }
        });
        $('.filter_now').click(function () {
            changeFilter();
        });

        function changeFilter() {
            let cat = $('.session_cat').val();
            const form = $('#adFilterForm');
            const data = form.serializeArray();
            if (cat) {
                $('#adFilterForm').attr('action', "{{ url('/ads') }}/" + cat);
            } else {
                $('#adFilterForm').attr('action', '{{ route('frontend.adlist.search') }}');
            }
            $('#adFilterForm').submit();
        }


    </script>
@endsection
