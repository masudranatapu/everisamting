// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyCLWDVfiuVeyIxPSl9r9byp-EzZhiV8h64",
    authDomain: "everisamting-235ef.firebaseapp.com",
    projectId: "everisamting-235ef",
    storageBucket: "everisamting-235ef.appspot.com",
    messagingSenderId: "129927534050",
    appId: "1:129927534050:web:d16358bcc91c59571055bb",
    measurementId: "G-7FBVE4JJYB"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    console.log('test click event');
    event.waitUntil(self.clients.openWindow('#'));
});
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "../public/assets/images/logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});



