// header
const toggle = document.querySelector(".alg-toggle-button");
const toggleIcon = document.querySelector(".bx-menu");
const navBox = document.querySelector(".nav-box");

toggle.onclick = () => {
  navBox.classList.toggle("alg-nav-box");
  toggleIcon.classList.toggle("bx-x");
};

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
    delay: 2500,
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

// category
let swiperCategory = new Swiper(".mySwiperCategory", {
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
  slidesPerView: 3,
  // spaceBetween:90,
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

// promotion section

//cart and watch list data fetch
//cart request data

//product adding from cart
fetch("https://api.example.com/data", {
  method: "POST", // HTTP request method
  headers: {
    "Content-Type": "application/json", // Request headers
  },
  body: JSON.stringify({
    // Request body (if sending data)
    key1: "value1",
    key2: "value2",
  }),
})
  .then((response) => {
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.json(); // Parse the response body as JSON
  })
  .then((data) => {
    // Handle the JSON data received from the API
    console.log("Data from the API:", data);
  })
  .catch((error) => {
    // Handle errors that occur during the Fetch request
    console.error("Fetch error:", error);
  });


