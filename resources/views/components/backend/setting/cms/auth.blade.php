<form class="form-horizontal" action="{{ route('admin.authcontent.update') }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row justify-content-between">
        <div class="offset-1 col-md-6">

            <div class="form-group">
                <x-forms.label name="manage_ads_content" />
                <textarea class="form-control" name="manage_ads_content" rows="4">{{ $cms->manage_ads_content }}</textarea>
                @error('manage_ads_content')
                    <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <x-forms.label name="chat_content" />
                <textarea class="form-control" name="chat_content" rows="4">{{ $cms->chat_content }}</textarea>
                @error('chat_content')
                    <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <x-forms.label name="verified_user_content" />
                <textarea class="form-control" name="verified_user_content" rows="4">{{ $cms->verified_user_content }}</textarea>
                @error('verified_user_content')
                    <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                @enderror
            </div>


        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 offset-1 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_content') }}
            </button>
        </div>
    </div>
</form>
