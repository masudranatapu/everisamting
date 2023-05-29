@props(['ad'])

<div class="product-item__sidebar-item">
    @if ($ad->show_phone == 1)
        @if(auth('user')->check())
            <div class="card-number ss">
                <div class="number number--hide text--body-2">
                <span class="icon">
                    <x-svg.phone-icon width="32" height="32"/>
                </span>
                    {{ Str::limit($ad->phone, 3, ' XXXXXXXX') }}
                </div>
                <div class="number number--show text--body-2">
                <span class="icon">
                    <x-svg.phone-icon width="32" height="32"/>
                </span>
                    {{ $ad->phone }}
                </div>
                <span class="text--body-4 message">{{ __('reveal_phone_number') }}</span>
            </div>
        @else
            <div class="card-number">
                <a href="{{route('users.login')}}">
                    <div class="number text--body-2">
                <span class="icon">
                    <x-svg.phone-icon width="32" height="32"/>
                </span>
                        {{ Str::limit($ad->phone, 3, ' XXXXXXXX') }}
                    </div>
                    <span class="text--body-4">{{ __('reveal_phone_number') }}</span>
                </a>
            </div>
        @endif
    @endif


    @if (auth('user')->check() && auth('user')->user()->username !== $ad->customer->username)
        <a href="{{ route('frontend.message', $ad->customer->username) }}" type="submit" class="btn w-100">
                <span class="icon--left">
                    <x-svg.message-icon width="24" height="24" stroke="white" strokeWidth="1.6"/>
                </span>
            {{ __('send_message') }}
        </a>
        @if ($ad->customer->email)
            <a href="javascript:;" class="btn w-100 mt-2 bg-success" data-bs-toggle="modal"
               data-bs-target="#staticBackdrop">
                <span class="icon--left">
                    <x-svg.envelope-icon stroke="#ffffff"/>
                </span>
                {{ __('send_message_via_email') }}
            </a>
        @endif
        @if ($ad->whatsapp)
            <a href="https://web.wechat.com/{{ $ad->whatsapp }}" class="btn w-100 mt-2 bg-secondary" target="_blank">
                <span class="icon--left">
                    <i class="fa-brands fa-weixin" style="widht: 24px; height: 24px;"></i>
                </span>
                {{ __('Send message via WeChat') }}
            </a>
        @endif
    @endif
    @if (!auth('user')->check())
        <a href="{{ route('users.login') }}" class="btn w-100 login_required">
            <span class="icon--left">
                <x-svg.message-icon width="24" height="24" stroke="white" strokeWidth="1.6"/>
            </span>
            {{ __('send_message') }}
        </a>
        @if ($ad->whatsapp)
            <a href="https://web.wechat.com/{{ $ad->whatsapp }}" class="btn w-100 mt-2 bg-success" target="_blank">
                <span class="icon--left">
                    <i class="fa-brands fa-weixin" style="widht: 24px; height: 24px;"></i>
                </span>
                {{ __('Send message via WeChat') }}
            </a>
        @endif
        <a href="{{ route('users.login') }}" class="btn w-100 mt-2 bg-secondary">
            <span class="icon--left">
                <x-svg.envelope-icon stroke="#ffffff"/>
            </span>
            {{ __('send_message_via_email') }}
        </a>
    @endif
</div>
