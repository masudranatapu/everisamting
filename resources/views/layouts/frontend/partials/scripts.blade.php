<script src="{{ asset('frontend') }}/js/plugins/jquery.min.js"></script>
<script src="{{ asset('frontend') }}/js/plugins/bootstrap.bundle.min.js"></script>
{{-- toastr notificaiton --}}
<script src="{{ asset('backend') }}/plugins/toastr/toastr.min.js"></script>
<script src="{{ asset('frontend/js/sweet-alert.min.js') }}"></script>
<script src="{{ asset('frontend/') }}/js/plugins/lan.js"></script>
 <script src="{{ asset('frontend/js/chat.js') }}"></script> <!-- for pusher js in realtime chat -->
<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}", 'Success!')
    @elseif(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}", 'Warning!')
    @elseif(Session::has('error'))
        toastr.error("{{ Session::get('error') }}", 'Error!')
    @endif
    // toast config
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "hideMethod": "fadeOut"
    }

    $('.login_required').click(function(event) {
        event.preventDefault();
        swal({
                title: `Do you want to login?`,
                text: "If you do this action, you need to login your account first.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#e64942',
                confirmButtonText: 'Login',
                closeOnConfirm: false,
                // closeOnCancel: false
            },
            function() {
                window.location.href = "{{ route('users.login') }}";
            });
    });
    $('#language_switch_button').on('click', function() {
        $('#switch_dropdown').toggle();
    });
</script>

@yield('frontend_script')
<script type="module" src="{{ asset('frontend') }}/js/plugins/app.js"></script>

{!! $settings->body_script !!}
@stack('component_script')

<!-- Puhser Js  -->
<script>
    // message Echo / Pusher Section
    const authId_global = "{!! $auth_user_gloabl !!}";
    const current_route_name = "{!! $current_route_name !!}";
    if(current_route_name !== "frontend.message"){

        window.Echo.private(`chat.${authId_global}`)
            .listen('MessageEvent', (e) => {
                if (e) {
                    // also show toast
                    toastr.success("You have new unseen message from "+e.user.name+"", 'New Message!!')
                    // unread message count div increament
                             // unread_count_custom3
                    $('#unread_count_custom3').removeClass('d-none'); //css class remove
                    var unreadAmount = $('#unread_count_custom3').attr('amount');
                    var amount = parseInt(unreadAmount) + parseInt(1);
                    $('#unread_count_custom3').attr('amount', parseInt(amount));
                    $('#unread_count_custom3').html(amount);
                                // unread_count_custom4
                    $('#unread_count_custom4').removeClass('d-none'); //css class remove
                    var unreadAmount1 = $('#unread_count_custom4').attr('amount');
                    var amount1 = parseInt(unreadAmount1) + parseInt(1);
                    $('#unread_count_custom4').attr('amount', parseInt(amount1));
                    $('#unread_count_custom4').html(amount1);
                                // unread_count_custom2
                    $('#unread_count_custom2').removeClass('d-none'); //css class remove
                    var unreadAmount2 = $('#unread_count_custom2').attr('amount');
                    var amount2 = parseInt(unreadAmount2) + parseInt(1);
                    $('#unread_count_custom2').attr('amount', parseInt(amount2));
                    $('#unread_count_custom2').html('('+amount2+')');
                }
            });
    }
</script>
{{--@include('pushnotification::index')--}}
