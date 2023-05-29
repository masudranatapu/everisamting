<div class="d-flex justify-content-between align-items-center">
    <h3 class="card-title" style="line-height: 36px;">{{ __('value') }}</h3>
    <ul class="d-flex nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a type="button" class="nav-link btn btn-info" id="home-tab" data-toggle="tab" href="#home" role="tab"
                aria-controls="home" aria-selected="true">
                <i class="fas fa-list"></i>
                <span class="ml-1">{{ __('list') }}</span>
            </a>
        </li>
        @if ($field->type == 'checkbox' && count($values) == 0)
            <li class="nav-item ml-1" role="presentation">
                <a type="button" class="nav-link btn btn-success" id="profile-tab" data-toggle="tab" href="#profile"
                    role="tab" aria-controls="profile" aria-selected="false">
                    <i class="fas fa-plus"></i>
                    <span class="ml-1">{{ __('add') }}</span>
                </a>
            </li>
        @else
            <li class="nav-item ml-1" role="presentation">
                <a type="button" class="nav-link btn btn-success" id="profile-tab" data-toggle="tab" href="#profile"
                    role="tab" aria-controls="profile" aria-selected="false">
                    <i class="fas fa-plus"></i>
                    <span class="ml-1">{{ __('add') }}</span>
                </a>
            </li>
        @endif
    </ul>
</div>
