<div class="col-md-6 mb-4">
    <label for="designation" class="form-label">Designation</label>
    <select name="designation_id" id="designation" class="form-control select2">
        <option value="" class="d-none">-- Select Job Designation --</option>
        @if(isset($designations) && $designations->count() > 0)
            @foreach($designations as $item)
                <option value="{{ $item->id }}" {{ old('designation') == $item->id ? 'selected' : '' }} >
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
        <option value="Full Time" {{ old('employment_type') == 'Full Time' ? 'selected' : '' }} >Full Time</option>
        <option value="Part Time" {{ old('employment_type') == 'Part Time' ? 'selected' : '' }} >Part Time</option>
        <option value="Contractual" {{ old('employment_type') == 'Contractual' ? 'selected' : '' }} >Contractual</option>
        <option value="Internship" {{ old('employment_type') == 'Internship' ? 'selected' : '' }} >Internship</option>
    </select>
</div>
<div class="col-12 mb-2">
    <label for="receive" class="form-label">How do you want to receive
        applications?</label>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" name="show_email" type="checkbox" value="1"
                       id="show_email" checked>
                <label class="form-check-label" for="show_email">
                    Email and employer dashboard
                </label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" name="show_phone" type="checkbox" value="1"
                       id="show_phone" checked>
                <label class="form-check-label" for="show_phone">
                    Phone
                </label>
            </div>
        </div>
        <div class="col-md-6 mb-4 mt-2 application_field email_show">
            <input type="email" name="email" value="{{ old('email') ?? Auth::user()->email }}" id="email" class="email_field form-control"
                   placeholder="Enter your email address">
            @error('email')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-md-6 mb-4 mt-2 application_field phone_show">
            <input type="tel" name="phone" value="{{ old('phone') ?? Auth::user()->phone }}" id="phone" class="phone_field form-control"
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
    <input type="number" name="experience" value="{{ old('experience') }}"  id="experience" class="form-control" placeholder="Enter experience of years"
           >
</div>
<div class="col-md-6 mb-4">
    <label for="educations" class="form-label">Required Education </label>
    <select name="educations" id="educations" class="form-control select2">
        <option value="" class="d-none">-- Select Education --</option>
        <option value="Primary School" {{ old('educations') == 'Primary School' ? 'selected' : '' }} >Primary School
        </option>
        <option value="High School" {{ old('educations') == 'High School' ? 'selected' : '' }} >High School</option>
        <option value="High School" {{ old('educations') == 'SSC / O Level' ? 'selected' : '' }} >SSC / O Level</option>
        <option value="HSC / A Level" {{ old('educations') == 'HSC / A Level' ? 'selected' : '' }} >HSC / A Level</option>
        <option value="Diploma" {{ old('educations') == 'Diploma' ? 'selected' : '' }} >Diploma</option>
        <option value="Honors / BBA" {{ old('educations') == 'Honors / BBA' ? 'selected' : '' }} >Honors / BBA</option>
        <option value="Masters / MBA" {{ old('educations') == 'Masters / MBA' ? 'selected' : '' }} >Masters / MBA</option>
        <option value="phD / Doctorate" {{ old('educations') == 'phD / Doctorate' ? 'selected' : '' }} >phD / Doctorate
        </option>
    </select>
</div>
<label for="salary_from" class="form-label"><strong>Salary per month
    </strong></label>
<div class="col-md-6 mb-4">
    <label for="salary_from" class="form-label">From</label>
    <input type="number" name="salary_from" id="salary_from" value="{{ old('salary_from') }}" class="form-control"
           placeholder="Form">
</div>
<div class="col-md-6 mb-4">
    <label for="salary_to" class="form-label">To</label>
    <input type="number" name="salary_to" id="salary_to" value="{{ old('salary_to') }}" class="form-control"
           placeholder="To" >
</div>
<div class="col-md-6 mb-4">
    <label for="deadline" class="form-label">Application deadline </label>
    <input type="text" name="deadline" id="datepicker" class="form-control datepicker" value="{{ old('deadline') }}"
           placeholder="MM/DD/YYYY">
</div>
<div class="col-md-6 mb-4">
    <label for="employer_name" class="form-label">Employer Name </label>
    <input type="text" name="employer_name" id="employer_name" value="{{ old('employer_name') }}" class="form-control"
           placeholder="Employer Name">
</div>
<div class="col-md-6 mb-4">
    <label for="employer_website" class="form-label">Employer Website </label>
    <input type="text" name="employer_website" id="employer_website" value="{{ old('employer_website') }}"
           class="form-control"
           placeholder="Employer website address">
</div>
<div class="col-md-6 mb-4">
    <label for="employer_logo" class="form-label">Attach logo </label>
    <input type="file" name="employer_logo" id="employer_logo" class="form-control">
</div>
