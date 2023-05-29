<script src={{ asset('frontend/plugins/firebase/firebase.js') }}></script>
<script>
    var setting = {!! $setting !!};
    // if (authId_global) {
        if (setting) {
            if (setting.push_notification_status) {

                var firebaseConfig = {
                    apiKey: setting ? setting.api_key : 'AIzaSyDWnq0Dze0l39orxrKvPLPylDLgeytguZ8',
                    authDomain: setting ? setting.auth_domain : 'everisamting-cb858.firebaseapp.com',
                    projectId: setting ? setting.project_id : 'everisamting-cb858',
                    storageBucket: setting ? setting.storage_bucket : 'everisamting-cb858.appspot.com',
                    messagingSenderId: setting ? setting.messaging_sender_id : '362693629322',
                    appId: setting ? setting.app_id : '1:362693629322:web:95648050fd6d4c70db2473',
                    measurementId: setting ? setting.measurement_id : 'G-RZ1JM9Q1EC'
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
                            // alert('m')
                            $.ajax({
                                url: '{{ route('store.token') }}',
                                type: 'POST',
                                data: {
                                    "_token": "{{ csrf_token() }}",
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
                    const title = payload.notification.title;
                    const options = {
                        body: payload.notification.body,
                        icon: setting ? setting.favicon_image_url : payload.notification.icon,
                    };
                    new Notification(title, options);
                });

                self.addEventListener('notificationclick', function(event) {
                    event.notification.close();
                    if (event.notification && event.notification.data && event.notification.data.notification) {
                        const url = event.notification.data.notification.click_action;
                        event.waitUntil(
                            self.clients.matchAll({ type: 'window' }).then(windowClients => {
                                for (let i = 0; i < windowClients.length; i++) {
                                    const client = windowClients[i];
                                    if (client.url === url && 'focus' in client) {
                                        return client.focus();
                                    }
                                }
                                if (self.clients.openWindow) {
                                    return self.clients.openWindow(url);
                                }
                            })
                        );
                    }
                });
            }
        }
    // }
</script>
