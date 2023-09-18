const SERVER_URL = "http://localhost:9001/";

// JavaScript for smooth page transition
document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.page-transition-button');

  buttons.forEach(button => {
    button.addEventListener('click', function (event) {
      event.preventDefault();

      // Add the transition class to trigger the animation
      document.body.classList.add('page-transition');

      // Get the target page URL from the button's data attribute
      const targetPage = this.getAttribute('data-target-page');

      // After a short delay, navigate to the target page
      setTimeout(function () {
        window.location.href = targetPage;
      }, 1000); // Adjust the delay as needed
    });
  });
});


document.addEventListener("DOMContentLoaded", () => { });

// header
const toggle = document.querySelector(".alg-toggle-button");
const toggleIcon = document.querySelector(".bx-menu");
const navBox = document.querySelector(".nav-box");

toggle.onclick = () => {
  navBox.classList.toggle("alg-nav-box");
  toggleIcon.classList.toggle("bx-x");
};

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

      const cartMainContainer = document.getElementById("cartMainContainer");
      const cartTotalContainer = document.getElementById("cartTotalContainer");
      const cartEmptyContainer = document.getElementById("cartEmptyContainer");

      let Total = 0;

      if (data.status === "success") {
        cartEmptyContainer.innerHTML = "";
        cartMainContainer.innerHTML = "";

        data.response.forEach((element) => {
          const itemPrice = element.qty * (element.price + element.extra_price);
          Total += itemPrice;
          // cart main container
          cartMainContainer.innerHTML += `
                    <div class="col-12 p-3 alg-bg-dark rounded-4">
                        <div class="d-flex justify-content-around align-items-center text-white p-2 px-0 px-lg-0">
                            <div class="col-7 col-md-6 col-lg-7 d-flex gap-2 gap-lg-3 m-0 p-0">
                                <img src="resources/images/watchlist_img.png" alt="watchlist_img" class="watchlsit_img mt-2 mt-md-0">
                                <div class="lh-1 m-0 p-0">
                                    <span class="alg-text-h3 fw-semibold">${element.product_name}</span><br />
                                    <span class="alg-text-h3">${element.category_type}</span><br/>
                                    <span class="alg-text-h3">*Per Item = LKR ${element.extra_price} (${element.extra_fruit})</span>
                                </div>
                            </div>
                            <div class="col-5 col-md-5 col-lg-5 d-flex justify-content-center gap-3 gap-md-4 gap-lg-5 alg-text-h3 p-0 m-0">
                                <span>${element.weight}</span>
                                <span>(${element.qty})</span>
                                <span>LKR ${itemPrice}</span>
                                <span class="mx-0 mx-lg-0"><i class="bi bi-trash-fill" onclick="deleteCartProduct(${element.card_id});"></i></span>
                            </div>
                        </div>
                    </div>
          `;
        });

        cartEmptyContainer.innerHTML = "";
        cartTotalContainer.innerHTML = "";
        cartTotalContainer.innerHTML += `

                <div class="col-6 col-md-5 col-lg-3  text-white alg-bg-dark rounded-4">
                    <div class="col-12">
                        <div class="col-12 text-center bg-black rounded-top rounded-4">
                            <span class="fw-semibold">Sub Total</span>
                        </div>
                    </div>
                        <div class="col-12 d-flex px-1 pt-3 pb-3 justify-content-between gap-3">
                            <div class="col-6 d-flex flex-column">
                              <span class="alg-text-h3">Discount 0%</span>
                              <span class="alg-text-h3 fw-bold">LKR ${Total}</span>
                            </div>
                            <div class="col-6">
                              <button type="button" class="alg-bg-tan alg-text-h3 border-0 rounded-3 p-1 fw-bolder"> Checkout </button>
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

      if (data.error === "Please login") {
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
function productAddingWatchlist(productId, weightId) {

  const form = new FormData();
  form.append("productId", productId);
  form.append("weightId", weightId);


  // Fetch request
  fetch(SERVER_URL + "backend/api/watchListAddingProcess.php", {
    method: "POST", // HTTP request method
    body: form,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json(); // Parse the response body as JSON
    })
    .then((data) => {
      // Handle the JSON data received from the API
      if (data.status === 'success') {
        console.log('success');
      } else {
        console.log(data.error);
      }

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
      const watchListMainContainer = document.getElementById(
        "watchListMainContainer"
      );
      const emptyWatchlistContainer = document.getElementById(
        "emptyWatchlistContainer"
      );

      // Handle the JSON data received from the API
      if (data.status === "success") {
        emptyWatchlistContainer.innerHTML = "";
        watchListMainContainer.innerHTML = "";

        data.response.forEach((element) => {
          watchListMainContainer.innerHTML += `
          <div class="col-12 alg-bg-dark rounded-4 p-2">
          <div class="d-flex justify-content-around align-items-center text-white m-0 p-2 px-3">
              <div class="col-7 col-md-6 col-lg-6 d-flex align-items-center gap-2 gap-lg-3 m-0 p-0">
                  <img src="resources/images/watchlist_img.png" alt="watchlist_img" class="watchlsit_img mt-3 mt-md-0">
                  <div class="lh-1">
                      <span class="alg-text-h2 fw-semibold">${element.product_name}</span><br />
                      <span class="alg-text-h3">${element.category_type}</span>
                  </div>
              </div>
              <div class="col-5 col-lg-6 col-md-5 d-flex justify-content-center gap-3 gap-md-4 gap-lg-5 m-0 p-0 alg-text-h3">
                  <span>${element.weight}</span>
                  <span>LKR ${element.price}</span>
                  <span class="mx-2 mx-lg-0"><i class="bi bi-trash-fill" onclick="watchlistProductDelete(${element.watchlist_id});"></i></span>
              </div>
          </div>
      </div>
          `;
        });

        // console.log(data.response);
      } else {
        watchListMainContainer.innerHTML = "";
        emptyWatchlistContainer.innerHTML = "";

        emptyWatchlistContainer.innerHTML += `
        <span>Select your favorite sweat .........</span>
        `;
      }

      if (data.error === "Please login") {
        watchListMainContainer.innerHTML = "";
        emptyWatchlistContainer.innerHTML = "";

        emptyWatchlistContainer.innerHTML += `
        <span>Please Login.........</span>
        `;
      }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}

//watchlist product delete
function watchlistProductDelete(watchlist_id) {
  const data = new FormData();
  data.append("watchlist_id", watchlist_id);
  // Fetch request
  fetch(SERVER_URL + "backend/api/watchListProductDelete.php", {
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
      watchlistDataView();
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
  watchlistDataView();
}

// signin open
let signInModel;
let signUpModel;
signInModel = new bootstrap.Modal("#signInModel");
signUpModel = new bootstrap.Modal("#signUpModel");

function openSignInModel() {
  signInModel.show();
}

// signun open
function openSignUpModel() {
  signInModel.hide();
  signUpModel.show();
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

  // console.log(email);
  // console.log(full_name);
  // console.log(password);
  // console.log(rePassword);

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
      if (data.status === 'success') {
        console.log('sign up success');
      } else {
        console.log(data);
      }
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
    .then((response) => response.json())
    .then((data) => {
      if (data.status == "success") {
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

// sign Out 
function signOut() {
  const request = new XMLHttpRequest();
  request.onreadystatechange = () => {
    if (request.readyState == 4 && request.status == 200) {
      responseObject = JSON.parse(request.responseText);
      if (responseObject.status === "success") {
        window.location = "index.php";
      } else {
        console.log(responseObject);
      }
    }
  };

  request.open("POST", SERVER_URL + "backend/api/signOut.php", true);
  request.send();
}

