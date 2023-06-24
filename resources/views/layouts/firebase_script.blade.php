
<script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-messaging.js"></script>
<script>
    var setting = {!! $setting !!};
    // if (authId_global) {
    if (setting) {
        if (setting.push_notification_status) {

            var firebaseConfig = {
                apiKey: setting ? setting.api_key : 'AIzaSyCLWDVfiuVeyIxPSl9r9byp-EzZhiV8h64',
                authDomain: setting ? setting.auth_domain : 'everisamting-235ef.firebaseapp.com',
                projectId: setting ? setting.project_id : 'everisamting-235ef',
                storageBucket: setting ? setting.storage_bucket : 'everisamting-235ef.appspot.com',
                messagingSenderId: setting ? setting.messaging_sender_id : '129927534050',
                appId: setting ? setting.app_id : '1:129927534050:web:d16358bcc91c59571055bb',
                measurementId: setting ? setting.measurement_id : 'G-7FBVE4JJYB'
            };
            firebase.initializeApp(firebaseConfig);
            const messaging = firebase.messaging();

            function startFCM() {
                messaging
                    .requestPermission()
                    .then(function () {
                        return messaging.getToken();
                    })
                    .then(function (response) {
                        console.log(response)
                        $.ajax({
                            url: '{{ route('store.token') }}',
                            type: 'GET',
                            data: {
                                token: response
                            },
                            dataType: 'JSON',
                            success: function (response) {
                                // alert('Token stored.');
                            },
                            error: function (error) {
                                // alert(error);
                            },
                        });
                    }).catch(function (error) {
                    // alert(error);
                });
            }

            $(window).on("load", function () {
                startFCM();
                // alert(1)
            });


            messaging.onMessage(function (payload) {
                const noteTitle = payload.notification.title;
                const noteOptions = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                    image: payload.notification.image,
                };
                new Notification(noteTitle, noteOptions);
                // console.log(payload.notification);

                self.addEventListener('notificationclick', function(event) {
                    event.notification.close();
                    console.log('test click event');
                    event.waitUntil(self.clients.openWindow('#'));
                });

            });
        }
    }

</script>
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('{{ asset("firebase-messaging-sw.js") }}')
                .then(function(registration) {
                    console.log('Service Worker registered with scope:', registration.scope);
                })
                .catch(function(error) {
                    console.error('Service Worker registration failed:', error);
                });
        });
    }
</script>



