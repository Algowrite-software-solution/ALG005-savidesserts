//  home slider
let swiperHome = new Swiper(".mySwiperHome", {
  direction: "vertical",
  spaceBetween: 30,
  grabCursor: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
});

// promotion slider
let swiperPromotion = new Swiper(".mySwiperPromotion", {
  type: "loop",
  perPage: 6,
  perMove: 1,
  autoplay: true,
  pauseOnHover: false,
  arrows: false,
});

// best selling slider
let swiperBestSelling = new Swiper(".mySwiperBestSelling", {
  effect: "coverflow",
  grabCursor: true,
  slidesPerView: "auto",
  centeredSlides: true,
  coverflowEffect: {
    rotate: 20,
    stretch: -400,
    depth: 900,
    modifier: 1,
    slideShadows: false,
  },

  autoplay: {
    delay: 3500,
    disableOnInteraction: false,
  },
});

// category
// let swiperCategory = new Swiper(".mySwiperCategory", {
//   spaceBetween: 3,

//   // centeredSlides: true,
//   freeMode: true,
//   navigation: {
//     nextEl: ".swiper-button-next",
//     prevEl: ".swiper-button-prev",
//   },
//   autoplay: {
//     delay: 1000,
//   },
//   centeredSlides: true,
  
//   pagination: {
//     el: ".swiper-pagination",
//     clickable: true,
//   },
//   breakpoints: {
//     300: {
//       slidesPerView: 1,
//       spaceBetween: 0,
//     },
//     540: {
//       slidesPerView: 1,
//       spaceBetween: 0,
//     },
//     960: {
//       slidesPerView: 2,
//       spaceBetween: 0,
//     },
//     1200: {
//       slidesPerView: 3,
//       spaceBetween: 0,
//     },
//   }
// });


// checkout section slider

let swiperCheckout = new Swiper(".mySwiperCheckOut", {
  // pagination: {
  //   el: ".swiper-pagination",
  //   type: "fraction",
  // },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  slideShadows: false,
  // type: 'loop',
  // perPage: 3,
  // slidesPerView: 30,
  // spaceBetween:48,
  // centeredSlides:true,
  // perMove: 1,
  // autoplay: true,
  // navigation:{
  //   nextE1:".swiper-button-next",
  //   prevE1:".swiper-button-prev",
  // },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    200: {
      slidesPerView: 1,
      spaceBetween: 50,
    },
    468: {
      slidesPerView: 2,
      spaceBetween: 60,
    },
    980: {
      slidesPerView: 2,
      spaceBetween: 60,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 50,
    }
  },
  // pauseOnHover:true,
  // arrows: false,
});