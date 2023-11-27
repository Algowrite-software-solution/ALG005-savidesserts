// // category
// let swiperCategory = new Swiper(".mySwiperCategory", {
//   // pagination: {
//   //   el: ".swiper-pagination",
//   //   type: "fraction",
//   // },
//   navigation: {
//     nextEl: ".swiper-button-next",
//     prevEl: ".swiper-button-prev",
//   },
//   slideShadows: false,
//   // type: 'loop',
//   // perPage: 3,
//   slidesPerView: 3,
//   // spaceBetween:90,
//   // centeredSlides:true,
//   // perMove: 1,
//   // autoplay: true,
//   // navigation:{
//   //   nextE1:".swiper-button-next",
//   //   prevE1:".swiper-button-prev",
//   // },
//   pagination: {
//     el: ".swiper-pagination",
//     clickable: true,
//   },
//   breakpoints: {
//     200: {
//       slidesPerView: 1,
//       // spaceBetween: 10,
//     },
//     468: {
//       slidesPerView: 2,
//       // spaceBetween: 40,
//     },
//     980: {
//       slidesPerView: 3,
//       // spaceBetween: 40,
//     },
//     1024: {
//       slidesPerView: 4,
//       // spaceBetween: 50,
//     },
//   },
//   // pauseOnHover:true,
//   // arrows: false,
// });


let swiperProfile = new Swiper(".mySwiperCategory", {
  slidesPerView: 1,
  spaceBetween: 10,
  freeMode: true,
  navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
  },
  pagination: {
      el: ".swiper-pagination",
      clickable: true,
  },
  breakpoints: {
      300: {
          slidesPerView: 1,
          spaceBetween: 20,
      },
      540: {
          slidesPerView: 2,
          spaceBetween: 20,
      },
      960: {
          slidesPerView: 3,
          spaceBetween: 10,
      },
      1200: {
          slidesPerView: 3,
          spaceBetween: 10,
      },
  }
});

