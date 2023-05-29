"use strict";
var swiper = new Swiper(".mySwiper", {
    spaceBetween: 12,
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {

        1024: {
            slidesPerView: 6,
        },
        1: {
            slidesPerView: 3,
        },
    },
});

var swiper2 = new Swiper(".mySwiper2", {
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiper,
    },
});
