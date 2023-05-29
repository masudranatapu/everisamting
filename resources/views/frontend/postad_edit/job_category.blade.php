<div class="col-md-6 mb-4">
    <label for="designation" class="form-label">Designation </label>
    <select name="designation_id" id="designation" class="form-control select2">
        <option value="" class="d-none">-- Select Job Designation --</option>
        @if(isset($designations) && $designations->count() > 0)
            @foreach($designations as $item)
                <option value="{{ $item->id }}" {{ $ad->designation_id == $item->id ? 'selected' : '' }} >
                    {{ $item->name }}
                </option>
            @endforeach
        @endif
    </select>
</div>
<div class="col-md-6 mb-4">
    <label for="employment_type" class="form-label">Job Type </label>
    <select name="employment_type" id="employment_type" class="form-control select2">
        <option value="" class="d-none">-- Select Job Type --</option>
        <option value="Full Time"  {{ $ad->employment_type == "Full Time"? "selected" : "" }}>Full Time</option>
        <option value="Part Time"  {{ $ad->employment_type == "Part Time"? "selected" : "" }}>Part Time</option>
        <option value="Contractual" {{ $ad->employment_type == "Contractual"? "selected" : "" }}>Contractual</option>
        <option value="Internship"  {{ $ad->employment_type == "Internship" ? "selected": ""}}>Internship</option>
    </select>
</div>
<div class="col-12 mb-2">
    <label for="receive" class="form-label">How do you want to receive
        applications?</label>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" name="show_email" type="checkbox" value="1"
                    {{ $ad->show_email == "1"? "checked" : "" }}
                       id="show_email" checked>
                <label class="form-check-label" for="show_email">
                    Email and employer dashboard
                </label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" name="show_phone" type="checkbox" value="1"
                {{ $ad->show_phone == "1"? "checked" : "" }}
                       id="show_phone" checked>
                <label class="form-check-label" for="show_phone">
                    Phone
                </label>
            </div>
        </div>
        <div class="col-md-6 mb-4 mt-2 application_field email_show">
            <input type="email" name="email" id="email" class="email_field form-control"
                    value="{{ $ad->email }}"
                   placeholder="Enter your email address">
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6 mb-4 mt-2 application_field phone_show">
            <input type="tel" name="phone" id="phone" class="phone_field form-control"
                value="{{ $ad->phone }}"
                   placeholder="Enter your phone number">
            @error('phone')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
<div class="col-md-6 mb-4">
    <label for="experience" class="form-label">Required work experience (years)
    </label>
    <input type="number" name="experience" id="experience" value="{{ $ad->exprience }}" class="form-control" placeholder="Enter numbers of years"
           >
</div>
<div class="col-md-6 mb-4">
    <label for="educations" class="form-label">Required Education  </label>
    <select name="educations" id="educations" class="form-control select2">
        <option value="" class="d-none">-- Select Education --</option>
        <option value="Primary School" {{ $ad->educations == 'Primary School' ? 'selected' : '' }} >Primary School
        </option>
        <option value="High School" {{ $ad->educations == 'High School' ? 'selected' : '' }} >High School</option>
        <option value="SSC / O Level" {{ $ad->educations == 'SSC / O Level' ? 'selected' : '' }} >SSC / O Level</option>
        <option value="HSC / A Level" {{ $ad->educations == 'HSC / A Level' ? 'selected' : '' }} >HSC / A Level</option>
        <option value="Diploma" {{ $ad->educations == 'Diploma' ? 'selected' : '' }} >Diploma</option>
        <option value="Honors / BBA" {{ $ad->educations == 'Honors / BBA' ? 'selected' : '' }} >Honors / BBA</option>
        <option value="Masters / MBA" {{ $ad->educations == 'Masters / MBA' ? 'selected' : '' }} >Masters / MBA</option>
        <option value="phD / Doctorate" {{ $ad->educations == 'phD / Doctorate' ? 'selected' : '' }} >phD / Doctorate
        </option>
    </select>
</div>
<label for="salary_from" class="form-label"><strong>Salary per month
    </strong></label>
<div class="col-md-6 mb-4">
    <label for="salary_from" class="form-label">From</label>
    <input type="number" name="salary_from" id="salary_from" value="{{ $ad->salary_from }}" class="form-control"
           placeholder="Form">
</div>
<div class="col-md-6 mb-4">
    <label for="salary_to" class="form-label">To</label>
    <input type="number" name="salary_to" id="salary_to" value="{{ $ad->salary_to }}" class="form-control"
           placeholder="To">
</div>
<div class="col-md-6 mb-4">
    <label for="deadline" class="form-label">Application deadline </label>
    <input type="text" name="deadline" id="datepicker" class="form-control" value="{{ date('d M Y',strtotime($ad->deadline)) }}"
           placeholder="MM/DD/YYYY">
</div>
<div class="col-md-6 mb-4">
    <label for="employer_name" class="form-label">Employer Name </label>
    <input type="text" name="employer_name" id="employer_name" value="{{ $ad->employer_name }}" class="form-control"
           placeholder="Employer Name">
</div>
<div class="col-md-6 mb-4">
    <label for="employer_website" class="form-label">Employer Website </label>
    <input type="text" name="employer_website" id="employer_website" value="{{ $ad->employer_website }}"
           class="form-control"
           placeholder="Employer website address">
</div>
<div class="col-md-6 mb-4 ">
    <label for="employer_logo" class="form-label">Attach logo </label>
    <input type="file" name="employer_logo" id="employer_logo" class="form-control">
    @if($ad->employer_logo)
    <img class="img-style mt-3" src="{{ asset($ad->employer_logo) }}" style="float: right;" alt="employer_logo">
    @endif
</div>
