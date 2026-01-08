// const testimonialSwiper = new Swiper('.testimonials-slider', {
//     loop: true,
//     speed: 600,

//     slidesPerView: 3,
//     spaceBetween: 30,
//     grabCursor: true,


//     centeredSlides: true,

//     pagination: {
//         el: '.swiper-pagination',
//         clickable: true,
//     },
//     autoplay: {
//     delay: 4000,
//     disableOnInteraction: false,
// },


//     breakpoints: {
//         0: {
//             slidesPerView: 1,
//         },
//         768: {
//             slidesPerView: 3,
//         }
//     }
// });
const testimonialSwiper = new Swiper('.testimonials-slider', {
    loop: true,
    speed: 600,

    slidesPerView: 'auto',
    spaceBetween: 30,
    centeredSlides: true,
    grabCursor: true,

    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});

