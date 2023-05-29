<form action="{{ route('frontend.message.store',$user->username) }}" method="POST" id="messageForm">
    @csrf
    <div class="input-message--text">
        <textarea placeholder="{{ __('type_your_message') }}..." name="body" style="padding-bottom: 10px;" id="messageBody"></textarea>
        <button class="icon" type="submit" id="sendMessage">
            <x-svg.send-icon />
        </button>
    </div>
    @error('body')
        <span class="invalid-feedback" style="display: block;padding-left:20px;padding-bottom:10px;">{{ $message  }}</span>
    @enderror
</form>

<script>
    const messageSendbutton = document.getElementById('sendMessage');
    const messageBody = document.getElementById('messageBody');
    messageSendbutton.addEventListener('click', function(e){
        e.preventDefault();
        if(messageBody.value == ''){
            alert('Message body required')
            return;
        }else{
            document.getElementById('messageForm').submit();
        }
    })
</script>
