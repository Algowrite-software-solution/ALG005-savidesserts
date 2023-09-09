// header
const toggle = document.querySelector('.alg-toggle-button');
const toggleIcon = document.querySelector('.bx-menu');
const navBox = document.querySelector('.nav-box');

toggle.onclick = () => {

    navBox.classList.toggle('alg-nav-box');
    toggleIcon.classList.toggle('bx-x');
}

//  home slider

var swiper = new Swiper(".mySwiperHome", {
  direction: "vertical",
  spaceBetween: 30,
    grabCursor: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
});

// promotion slider
var swiper = new Swiper(".mySwiperPromotion", {
  type: 'loop',
  perPage: 6,
  perMove: 1,
  autoplay: true,
  pauseOnHover: false,
  arrows: false,
});


var swiper = new Swiper(".mySwiperCategory", {
  // pagination: {
  //   el: ".swiper-pagination",
  //   type: "fraction",
  // },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  // type: 'loop',
  // perPage: 3,
  slidesPerView:3,
  // spaceBetween:90,
  // centeredSlides:true,
  // perMove: 1,
  // autoplay: true,
  // navigation:{
  //   nextE1:".swiper-button-next",
  //   prevE1:".swiper-button-prev",
  // },
  pagination:{
    el:".swiper-pagination",
    clickable:true,
  },
  breakpoints: {
    200: {
      slidesPerView: 1,
      // spaceBetween: 10,
    },
    700: {
      slidesPerView: 2,
      // spaceBetween: 40,
    },
    1024: {
      slidesPerView: 4,
      // spaceBetween: 50,
    },
  },
  // pauseOnHover:true,
  // arrows: false,
});


// category slider

var swiper = new Swiper(".mySwiperBestSelling", {
  effect: "coverflow",
  grabCursor: true,
  slidesPerView: "auto",
  centeredSlides: true,
  coverflowEffect: {
      rotate: 20,
      stretch: -400,
      depth: 900,
      modifier: 1,
      slideShadows:false,
  },

  autoplay: {
      delay: 3500,
      disableOnInteraction: false,
  },
 
});







  // promotion section



 