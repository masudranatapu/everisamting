<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <center>
                    <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()"
                        class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
                </center>
                <div class="card">
                    <div class="card-header">{{ __('dashboard') }}</div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif

                        <div class="alert alert-success" role="alert">
                            <h4>Current User:</h4>
                            <p class="m-0">Name: {{ auth('user')->user()->name }}</p>
                            <p class="m-0">Username:{{ auth('user')->user()->username }}</p>
                            <p class="m-0">Email:{{ auth('user')->user()->email }}</p>
                        </div>

                        <form action="{{ route('notification') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>User</label>
                                <select name="user_id" id="" class="form-control">
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }} -
                                        ({{ $customer->username }})
                                        -
                                        ({{ $customer->email }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="Title">
                            </div>
                            <div class="form-group">
                                <label>Body</label>
                                <textarea class="form-control" name="body">Message</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Notification</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>

    <script>
        // Sani
        const firebaseConfig = {
            apiKey: "AIzaSyDFIbDQ02eek_7f3kX8VZP0SY9mg1vxzbo",
            authDomain: "onest-2b96a.firebaseapp.com",
            projectId: "onest-2b96a",
            storageBucket: "onest-2b96a.appspot.com",
            messagingSenderId: "1017680157250",
            appId: "1:1017680157250:web:37a86503f53c1e47456bdb",
            measurementId: "G-HRMW40YNCY"
        };

        //Arif
        // var firebaseConfig = {
        //     apiKey: "AIzaSyAdc25G4K_awtcumx2UXujB_qJLk5tWUDc",
        //     authDomain: "adlisting-push-notification.firebaseapp.com",
        //     projectId: "adlisting-push-notification",
        //     storageBucket: "adlisting-push-notification.appspot.com",
        //     messagingSenderId: "145309645210",
        //     appId: "1:145309645210:web:6f04d69c2d7dd3a40fe223",
        // };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
            messaging.requestPermission().then(function() {
                return messaging.getToken()
            }).then(function(token) {
                sendTokenToServer(token)
            }).catch(function(err) {
                console.log(`Token Error :: ${err}`);
            });
        }

        initFirebaseMessagingRegistration();

        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(noteTitle, noteOptions);
        });

        function sendTokenToServer(token) {
            axios.post("{{ route('fcmToken') }}", {
                _method: "POST",
                token
            }).then((res => {
                console.log(res.data.token)
            })).catch((err) => {
                console.log(err)
            })

        }
    </script>
</body>

</html>
