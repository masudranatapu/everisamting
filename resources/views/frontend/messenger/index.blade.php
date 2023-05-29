@extends('layouts.frontend.layout_one')

@section('title', __('message'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_messenger_background">
        {{ __('overview') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.dashboard') }}"
                    class="breedcrumb__page-link text--body-3">{{ __('dashboard') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('message') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- dashboard section start  -->
    <section class="section dashboard" id="app">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9">
                    <div class="dashboard__message ">
                        <div class="dashboard__message-left dashboard__message-users">
                            <h2 class="title text--body-2-600">{{ __('message') }}</h2>
                            <div class="dashboard__message-userscontent">
                                @forelse ($users as $chatuser)
                                    <x-messenger.user-list :user="$chatuser" :unread="$chatuser->unread" />
                                @empty
                                    <div class="user user--profile active">
                                        <div class="user-info">
                                            <p class="message-hint center-el"><span>{{ __('empty_contact') }}</span></p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="dashboard__message-right dashboard__message-user">
                            @if (!is_null($selected_user))
                                <div class="message-header">
                                    <x-messenger.message-header :user="$selected_user"></x-messenger.message-header>
                                </div>
                            @endif

                            <div class="message-body">
                                @if (!is_null($selected_user))
                                    @forelse ($messages as $message)
                                        <x-messenger.message :message="$message" :user="$selected_user"></x-messenger.message>
                                    @empty
                                        <p class="message-hint center-el text-center margin-t-30px">
                                            <span>{{ __('empty_message') }}</span>
                                        </p>
                                    @endforelse
                                    <div class="newMessage"></div>
                                @else
                                    <div class="vertical-center text-center margin-t-30px">
                                        <p>{{ __('select_someone_to_start_conversation') }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="message-footer">
                                @if (!is_null($selected_user))
                                    <form id="messageForm">
                                        @csrf
                                        <div class="input-message--text textarea">
                                            <textarea placeholder="{{ __('type_your_message') }}..." name="body" style="padding-bottom: 10px;" id="messageBody" required></textarea>
                                            <button class="icon" type="submit" id="sendMessage">
                                                <x-svg.send-icon />
                                            </button>
                                        </div>
                                        @error('body')
                                            <span class="invalid-feedback error-message-span">{{ $message }}</span>
                                        @enderror
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $user = Auth::user() ? Auth::user()->id : '';
        $selected_user_var = $selected_user ? $selected_user->username : '';
    @endphp
    <!-- dashboard section end  -->
@endsection

@push('css')
    <style>
        #messageBody{
            width: 91% !important;
            height: 94px !important;
            padding: 10px !important;
            border: none !important;
        }
    </style>
@endpush

@section('srcipts')
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>

    <script>
        // $('#messageBody').on('input', function() {
        //     $(this).height('auto').height(this.scrollHeight);
        // });

        // for message scroll bottom 0
        var messageBody = document.querySelector('.message-body');
        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

        // for text get proper
        function nl2br(str, is_xhtml) {
            if (typeof str === 'undefined' || str === null) {
                return '';
            }
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }

        // message send to backend form submit & more
        const messageForm = document.getElementById('messageForm');
        if (messageForm) {
            const messageSendbutton = document.getElementById('sendMessage');
            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();
                messageSendbutton.disabled = true;
                messageSendbutton.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>';

                const username = "{!! $selected_user ? $selected_user->username : '' !!}";
                const message = document.getElementById('messageBody');

                // if (message.value == '') {
                //     alert('Message body required')
                //     return;
                // } else {

                    const options = {
                        method: 'POST',
                        url: '/dashboard/message/' + username,
                        data: {
                            username: username,
                            body: message.value,
                        }
                    }
                    axios(options).then((res) => {
                        if (res.data.user) {
                            message.value = '';
                            $("#messageBody").css('height', '100%');

                            // remove no message show div
                            $('.message-hint').addClass('d-none');

                            $('.newMessage').append(
                                `<div class="user-message__content ">
                             <div class="img">
                                 <img src="${res.data.user.image_url}" alt="user-photo">
                             </div>
                             <div class="user-message__content-info">
                                 <h5 class="user-name text--body-4-600">
                                     ${res.data.user.name}
                                     <span class="dot"></span>
                                     <span class="date">
                                         ${res.data.message.created_at}
                                     </span>
                                 </h5>
                                 <div class="user-message">
                                     <p>
                                         ${ nl2br(res.data.message.body)}
                                     </p>
                                 </div>
                             </div>
                         </div>`
                            );

                            var messageBody = document.querySelector('.message-body');
                            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                            messageSendbutton.disabled = false;
                            messageSendbutton.innerHTML = `<x-svg.send-icon />`;
                        }
                    }).catch((e) => {
                        messageSendbutton.disabled = false;
                        messageSendbutton.innerHTML = `<x-svg.send-icon />`;
                        if (e.response.data.message) {
                            toastr.error("Error!! Message not send .", 'Error!')
                        }
                    });
                // }
            });
        }

        // message Echo / Pusher Section
        const authId = "{!! $user !!}";
        const selected_user_username = "{!! $selected_user_var !!}";

        window.Echo.private(`chat.${authId}`)
            .listen('MessageEvent', (e) => {
                console.log(e);
                if (e) {

                    if (e.user.username === selected_user_username) {

                        // remove unread message count div
                        $('#unread_count' + e.user.id).addClass('d-none');
                        // remove no message show div
                        $('.message-hint').addClass('d-none');

                        // new message push
                        $('.newMessage').append(
                            `<div class="user-message__content ">
                            <div class="img">
                                <img src="${e.user.image_url}" alt="user-photo">
                            </div>
                            <div class="user-message__content-info">
                                <h5 class="user-name text--body-4-600">
                                    ${e.user.name}
                                    <span class="dot"></span>
                                    <span class="date">
                                        ${e.message.created_at}
                                    </span>
                                </h5>
                                <div class="user-message">
                                    <p>
                                        ${nl2br(e.message.body)}
                                    </p>
                                </div>
                            </div>
                        </div>`
                        );

                        const options = {
                            method: 'POST',
                            url: '/dashboard/message/markas/read/' + selected_user_username,
                        }
                        axios(options);

                    } else {
                        // unread message count div increament
                        $('#unread_count' + e.user.id).removeClass('d-none');
                        $('#unread_count_custom2').removeClass('d-none');
                        $('#unread_count_custom3').removeClass('d-none');
                        $('#unread_count_custom4').removeClass('d-none'); //css class remove

                        var unreadAmount = $('#unread_count' + e.user.id).attr('amount');
                        var amount = parseInt(unreadAmount) + parseInt(1);
                        $('#unread_count' + e.user.id).attr('amount', parseInt(amount));
                        $('#unread_count' + e.user.id).html('(' + amount + ')');
                        $('#unread_count_custom2').html('(' + amount + ')');
                        $('#unread_count_custom3').html('(' + amount + ')');
                        $('#unread_count_custom4').html(amount);
                    }

                    var messageBody = document.querySelector('.message-body');
                    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                }

            });
    </script>

@endsection
