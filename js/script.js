const SERVER_URL = "http://localhost:9001/";

document.addEventListener("DOMContentLoaded", () => {
  cartProductView();
  watchlistDataView();
  productPromotionView();
});

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
function productAddingCart() {

  const qty = document.getElementById('qty').value;
  const productItemId = document.getElementById('productItemId').value;
  const weightId = document.getElementById('weightId').value;
  const extraItemId = document.getElementById('extraItemId').value;


  // Fetch request
  fetch(SERVER_URL + "backend/api/cardAddingProcess.php", {
    method: "POST", // HTTP request method
    headers: {
      "Content-Type": "application/json", // Request headers
    },
    body:
      "cardAddingData=" +
      JSON.stringify({
        // Request body (if sending data)
        qty,
        productItemId,
        weightId,
        extraItemId,
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
}

//cart product View
function cartProductView() {
  // Fetch request
  fetch(SERVER_URL + "backend/api/ cardView.php", {
    method: "GET", // HTTP request method
    headers: {
      "Content-Type": "application/json", // Request headers
    },
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
}

//product Delete From a cart
function cartProductDelete() {

  const card_id = document.getElementById('card_id').value;

  const data = new FormData();
  data.append("card_id", card_id);
  // Fetch request
  fetch(SERVER_URL + "backend/api/cardItemDeleteProcess.php", {
    method: "POST", // HTTP request method
    headers: {
      "Content-Type": "application/x-www-form-urlencoded", // Request headers
    },
    body: data,
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
}

//cart qty update
function cartQtyUpdate() {
  const cardId = document.getElementById('card_id');
  const productId = document.getElementById('product_id');
  const qty = document.getElementById('qty').value;
  const weightId = document.getElementById('weightId');
  // Fetch request
  fetch(SERVER_URL + "backend/api/cardQtyUpdate.php", {
    method: "POST", // HTTP request method
    headers: {
      "Content-Type": "application/json", // Request headers
    },
    body:
      "cardQtyUpdate=" + JSON.stringify({
        cardId,
        productId,
        qty,
        weightId
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
}
//watchlist request
//product adding a watchlist
function productAddingWatchlist() {
  const productItemId = document.getElementById('product_item_id');

  const data = new FormData();
  data.append("product_item_id", productItemId);
  // Fetch request
  fetch(SERVER_URL + "backend/api/cardItemDeleteProcess.php", {
    method: "POST", // HTTP request method
    headers: {
      "Content-Type": "application/x-www-form-urlencoded", // Request headers
    },
    body: data,
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
}

//watchlist data view
function watchlistDataView() {
  // Fetch request
  fetch(SERVER_URL + "backend/api/watchlistView.php", {
    method: "GET", // HTTP request method
    headers: {
      "Content-Type": "application/json", // Request headers
    },
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
}

//watchlist product delete
function watchlistProductDelete() {
  const watchlist_id = document.getElementById('watchlist_id');

  const data = new FormData();
  data.append("watchlist_id", watchlist_id);
  // Fetch request
  fetch(SERVER_URL + "backend/api/cardItemDeleteProcess.php", {
    method: "POST", // HTTP request method
    headers: {
      "Content-Type": "application/x-www-form-urlencoded", // Request headers
    },
    body: data,
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
}

//product promotion view section
function productPromotionView() {
  // Fetch request
  fetch(SERVER_URL + "backend/api/promotionDataView.php", {
    method: "GET", // HTTP request method
    headers: {
      "Content-Type": "application/json", // Request headers
    },
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
}



