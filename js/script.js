const SERVER_URL = "http://localhost:9001/";

document.addEventListener("DOMContentLoaded", () => {

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
  slideShadows: false,
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
    468: {
      slidesPerView: 2,
      // spaceBetween: 40,
    },
    980: {
      slidesPerView: 3,
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
  const qty = document.getElementById("qty").value;
  const productItemId = document.getElementById("productItemId").value;
  const weightId = document.getElementById("weightId").value;
  const extraItemId = document.getElementById("extraItemId").value;

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

// //cart product View
function cartProductView() {
  // Fetch request
  fetch(SERVER_URL + "backend/api/cardView.php", {
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

      const cartMainContainer = document.getElementById('cartMainContainer');
      const cartTotalContainer = document.getElementById('cartTotalContainer');
      const cartEmptyContainer = document.getElementById('cartEmptyContainer');



      let Total = 0;

      if (data.status === 'success') {
        cartEmptyContainer.innerHTML = "";
        cartMainContainer.innerHTML = "";

        data.response.forEach((element) => {

          const itemPrice = element.qty * element.price;
          Total += itemPrice;

          cartMainContainer.innerHTML += `
                    <div class="col-12 p-3 alg-bg-dark rounded-4">
                        <div class="row d-flex justify-content-around align-items-center text-white p-2 px-4">
                            <div class="col-8 col-md-8 d-flex gap-3 m-0 p-0">
                                <img src="resources/images/watchlist_img.png" alt="watchlist_img" class="watchlsit_img mt-2 mt-md-0">
                                <div class="lh-1 m-0 p-0">
                                    <span class="alg-text-h2 fw-semibold">${element.product_name}</span><br />
                                    <span class="alg-text-h3">${element.category_type}</span>
                                </div>
                            </div>
                            <div class="col-4 col-lg-3 d-flex gap-3 gap-lg-5 alg-text-h3 p-0 m-0">
                                <span>${element.extra_fruit_name}</span>
                                <span>${element.qty}</span>
                                <span>${element.weight}</span>
                                <span>LKR ${itemPrice}</span>
                                <span class="mx-2 mx-lg-0"><i class="bi bi-trash-fill" onclick="deleteCartProduct(${element.card_id});"></i></span>
                            </div>
                        </div>
                    </div>
          `;


        });
        cartEmptyContainer.innerHTML = "";
        cartTotalContainer.innerHTML = "";
        cartTotalContainer.innerHTML += `

                <div class="col-5 col-md-3  text-white alg-bg-dark rounded-4">
                    <div class="row">
                        <div class="col-12 text-center bg-black rounded-top rounded-4">
                            <span class="fw-semibold">Sub Total</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-3">
                            <span class="alg-text-h3">Discount 0%</span><br />
                            <span class="alg-text-h2 fw-bold">LKR ${Total}</span>
                        </div>
                    </div>
                </div>
        `;

      } else {
        cartMainContainer.innerHTML = "";
        cartTotalContainer.innerHTML = "";
        cartEmptyContainer.innerHTML = "";
        cartEmptyContainer.innerHTML += `

        
        <span>Select your favorite sweat .........</span>
        
        
        `;
      }

      if (data.error === 'Please login') {
        cartMainContainer.innerHTML = "";
        cartTotalContainer.innerHTML = "";
        cartEmptyContainer.innerHTML = "";
        cartEmptyContainer.innerHTML += `
        <span>Please Login .........</span>
        `;
      }
      // console.log(Total);
      // console.log(data.status);
      // console.log(data.response);
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error.error);
    });
}

//product Delete From a cart
function deleteCartProduct(card_id) {

  const data = new FormData();
  data.append("card_id", card_id);
  // Fetch request
  fetch(SERVER_URL + "backend/api/cardItemDeleteProcess.php", {
    method: "POST", // HTTP request method
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
      cartProductView();
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}

//cart qty update
function cartQtyUpdate() {
  const cardId = document.getElementById("card_id");
  const productId = document.getElementById("product_id");
  const qty = document.getElementById("qty").value;
  const weightId = document.getElementById("weightId");
  // Fetch request
  fetch(SERVER_URL + "backend/api/cardQtyUpdate.php", {
    method: "POST", // HTTP request method
    headers: {
      "Content-Type": "application/json", // Request headers
    },
    body:
      "cardQtyUpdate=" +
      JSON.stringify({
        cardId,
        productId,
        qty,
        weightId,
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
  const productItemId = document.getElementById("product_item_id");

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
  const watchlist_id = document.getElementById("watchlist_id");

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

// cart open
let cartModel;
function openCartModel() {
  cartModel = new bootstrap.Modal("#cartModel");
  cartModel.show();
  cartProductView();
}

// watchlist open
let watchlistModel;
function openWatchlistModel() {
  watchlistModel = new bootstrap.Modal("#watchlist");
  watchlistModel.show();
}

// signin open
let signInModel;
function openSignInModel() {
  signInModel = new bootstrap.Modal("#signInModel");
  signInModel.show();
}

// signun open
let signUnModel;
function openSignUpModel() {
  signInModel = new bootstrap.Modal("#signUpModel");
  signInModel.show();
}

// sign in sign up section
document.getElementById("signupBtn").addEventListener("click", () => {
  // let email = document.getElementById('signUp-email').value;
  // let full_name = document.getElementById('signUp-fullname').value;
  // let password = document.getElementById('signUp-password').value;
  // let rePassword = document.getElementById('signUp-retypepassword').value;
  // // console.log("2");
  // const form = new FormData();
  // form.append('email',email);
  // form.append('fullName',full_name);
  // form.append('password',password);
  // form.append('confPassword',rePassword);
  // fetch(SERVER_URL + 'backend/api/signUpProcess.php', {
  //     method: "POST",
  //     headers: {
  //         "Content-Type": "application/x-www-form-urlencoded",
  //     },
  //     body: form,
  // })
  //     .then(response => response.json())
  //     .then(data =>{
  //         alert(data);
  //         console.log(data)
  //     })
  //     .catch(error=>{
  //         console.error('Error:',error);
  //     });
});

function signUp() {
  let email = document.getElementById("signUp-email").value;
  let full_name = document.getElementById("signUp-fullname").value;
  let password = document.getElementById("signUp-password").value;
  let rePassword = document.getElementById("signUp-retypepassword").value;

  // console.log("2");

  const form = new FormData();
  form.append("email", email);
  form.append("fullName", full_name);
  form.append("password", password);
  form.append("confPassword", rePassword);

  fetch(SERVER_URL + "backend/api/signUpProcess.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: form,
  })
    .then((response) => response.json())
    .then((data) => {
      alert(data);
      console.log(data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function signIn() {
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;

  const form = new FormData();
  form.append("email", email);
  form.append("password", password);

  fetch(SERVER_URL + "backend/api/signInProcess.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data.status == "success") {
        alert(data.results);
        window.location.reload();
      } else if (data.status == "failed") {
        console.log(data.results);
      } else {
        console.log(data);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

