const SERVER_URL = "";

document.addEventListener("DOMContentLoaded", () => {
  cartRowCount();
});

// header
const toggle = document.querySelector(".alg-toggle-button");
const toggleIcon = document.querySelector(".bx-menu");
const navBox = document.querySelector(".nav-box");

toggle.onclick = () => {
  navBox.classList.toggle("alg-nav-box");
  toggleIcon.classList.toggle("bx-x");
};

//toast Message
function toastMessage(message, className) {
  const toastMessageContainer = document.getElementById(
    "toastMessageContainer"
  );
  const toastLiveExample = document.getElementById("liveToast");

  toastMessageContainer.innerHTML = "";
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
  toastMessageContainer.innerHTML += `<span>${message}</span>`;

  toastLiveExample.classList.remove("text-bg-success");
  toastLiveExample.classList.remove("text-bg-danger");

  if (className !== undefined) {
    toastLiveExample.classList.add(className);
  }
  toastBootstrap.show();
}

// cart data global object
var cartData = {
  items: [],
  total: 0,
};

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

          // Check if the item already exists in the cart
          const existingItem = cartData.items.find(
            (item) => item.id === element.card_id
          );
          // If the item doesn't exist, add it to the cart
          if (!existingItem) {
            cartData.items.push({
              id: element.card_id,
              product_name: element.product_name,
              category_type: element.category_type,
              extra_price: element.extra_price,
              extra_fruit: element.extra_fruit,
              qty: element.qty,
              itemPrice: itemPrice,
              weight_id: element.weight_id,
              weight: element.weight,
            });
          }

          // Update the cart total
          cartData.total = Total;
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
                              <span class="alg-text-h3 fw-bold">LKR ${Total}</span>
                            </div>
                            <div class="col-6">
                              <button type="button" class="alg-bg-tan alg-text-h3 border-0 rounded-3 p-1 fw-bolder" onclick="paymentCheckout();"> Checkout </button>
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
      cartRowCount();
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
      if (data.status === "success") {
        toastMessage("Product Added", "text-bg-success");
      } else {
        toastMessage(data.error, "text-bg-danger");
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

// forgot password model
let forgotPasswordModel;
function openForgotPassword() {
  forgotPasswordModel = new bootstrap.Modal("#forgotPasswordModel");
  signInModel.hide();
  forgotPasswordModel.show();
}

let timeRemaining = 30; // Initial time in seconds
let timerInterval;

function timeUpdater() {
  document.getElementById("verificationSendingTimeRunner").textContent =
    timeRemaining;
  if (timeRemaining === 0) {
    clearInterval(timerInterval);
    console.log("Time's up!");
  } else {
    timeRemaining--;
  }
}

function resetTimer() {
  clearInterval(timerInterval);
  timeRemaining = 30;
  timeUpdater();
  timerInterval = setInterval(timeUpdater, 1000);
}

// password reset
let passwordResetModel;
function passwordReset() {
  const btn = document.querySelector(".spinner-border");
  const mainBtn = document.getElementById("mainButton");
  btn.classList.remove("d-none");
  mainBtn.setAttribute("disabled", "disabled");

  passwordResetModel = new bootstrap.Modal("#passwordResetModel");

  const forgotPasswordEmail = document.getElementById(
    "forgottenPasswordEmail"
  ).value;
  const formData = new FormData();
  formData.append("email", forgotPasswordEmail);

  fetch(SERVER_URL + "backend/api/verificationSendingApi.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        forgotPasswordModel.hide();
        passwordResetModel.show();
        //time counter
        timeUpdater();
        setInterval(timeUpdater, 1000);
      } else {
        toastMessage(data.error, "text-bg-danger");
        console.log(data.error);
      }

      btn.classList.add("d-none");
      mainBtn.removeAttribute("disabled");
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function verificationSendAgain() {
  const forgotPasswordEmail = document.getElementById(
    "forgottenPasswordEmail"
  ).value;
  const formData = new FormData();
  formData.append("email", forgotPasswordEmail);

  fetch(SERVER_URL + "backend/api/verificationSendingApi.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        toastMessage("Verification send again", "text-bg-success");
      } else {
        toastMessage(data.error, "text-bg-danger");
        console.log(data.error);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// password set
let passwordSetModel;
function passwordSet() {
  passwordSetModel = new bootstrap.Modal("#passwordSetModel");

  const verificationCode = document.getElementById("verification_code").value;
  const forgotPasswordEmail = document.getElementById(
    "forgottenPasswordEmail"
  ).value;

  const formData = new FormData();
  formData.append("verification_id", verificationCode);
  formData.append("email", forgotPasswordEmail);

  fetch(SERVER_URL + "backend/api/verificationMatchingApi.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        passwordResetModel.hide();
        passwordSetModel.show();
      } else {
        toastMessage(data.error, "text-bg-danger");
        console.log(data.error);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

//password reset
function passwordResetLast() {
  const password = document.getElementById("fg-password").value;
  const confPassword = document.getElementById("fg-confirm_password").value;
  const forgotPasswordEmail = document.getElementById(
    "forgottenPasswordEmail"
  ).value;

  console.log(password);
  console.log(confPassword);
  console.log(forgotPasswordEmail);

  const formData = new FormData();
  formData.append("newPassword", password);
  formData.append("confPassword", confPassword);
  formData.append("email", forgotPasswordEmail);

  fetch(SERVER_URL + "backend/api/forgottenPasswordProcess.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        openSignInModel();
      } else {
        toastMessage(data.error.error, "text-bg-danger");
        console.log(data.error);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// product details
let productDetailsModel;
function productDetails() {
  productDetailsModel = new bootstrap.Modal("#productDetailsModel");
  productDetailsModel.show();
}

// signin open
let signInModel;
let signUpModel;
signInModel = new bootstrap.Modal("#signInModel");
signUpModel = new bootstrap.Modal("#signUpModel");

function openSignInModel() {
  signInModel.show();
  forgotPasswordModel.hide();
  passwordResetModel.hide();
  passwordSetModel.hide();
}

// signun open
function openSignUpModel() {
  signInModel.hide();
  signUpModel.show();
}

function goBackToSignIn() {
  signUpModel.hide();
  signInModel.show();
}

let termsAndCondition = 0;

//signUp checkbox value change
const checkbox1 = document.getElementById("defaultCheck1");
const signUpBtn = document.getElementById("signUpBtn");

checkbox1.addEventListener("change", () => {
  if (checkbox1.checked) {
    console.log("checked : 1");
    signUpBtn.removeAttribute("disabled");
    termsAndCondition = 1;
    console.log(termsAndCondition);
  } else {
    signUpBtn.setAttribute("disabled", "disabled");
    console.log("unchecked : 2");
    termsAndCondition = 2;
    console.log(termsAndCondition);
  }
});

let marketingPerpose = 1;
//marketing pepose email validation
const checkbox2 = document.getElementById("defaultCheck2");

checkbox2.addEventListener("change", () => {
  if (checkbox2.checked) {
    console.log("checked : 1");
    marketingPerpose = 1;
    console.log(marketingPerpose);
  } else {
    console.log("unchecked : 2");
    marketingPerpose = 2;
    console.log(marketingPerpose);
  }
});

function signUp() {
  console.log(termsAndCondition);
  console.log(marketingPerpose);

  const email = document.getElementById("signUp-email").value;
  const full_name = document.getElementById("signUp-fullname").value;
  const password = document.getElementById("signUp-password").value;
  const rePassword = document.getElementById("signUp-retypepassword").value;

  const form = new FormData();
  form.append("email", email);
  form.append("fullName", full_name);
  form.append("password", password);
  form.append("confPassword", rePassword);
  form.append("termsAndCondition", termsAndCondition);
  form.append("marketingPerpose", marketingPerpose);

  fetch(SERVER_URL + "backend/api/signUpProcess.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        toastMessage("Sign up success", "text-bg-success");
        setTimeout(() => {
          signInModel.show();
          signUpModel.hide();
        }, 2000);
      } else {
        toastMessage(data.error, "text-bg-danger");
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
        toastMessage(data.result, "text-bg-success");
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      } else if (data.status == "failed") {
        toastMessage(data.error, "text-bg-danger");
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
        toastMessage("Sign out success", "text-bg-success");

        setTimeout(() => {
          window.location = "index.php";
        }, 2000);
      } else {
        console.log(responseObject);
      }
    }
  };

  request.open("POST", SERVER_URL + "backend/api/signOut.php", true);
  request.send();
}

function paymentCheckout() {
  window.location.assign("paymentCheckoutUpdatedUI.php");
}

function cartRowCount() {
  const cartRow = document.getElementById("cartRow");

  // Fetch request
  fetch(SERVER_URL + "backend/api/cartDataCountLoader.php", {
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
      cartRow.innerHTML = "";

      if (data.status === "success") {
        cartRow.innerHTML += ` 
        <a class="alg-button-hover" onclick="openCartModel();"><i class="bi bi-cart-fill alg-text-gold fs-4 mx-3 alg-text-hover"><span class="translate-middle rounded-pill badge bg-danger header-badge position-absolute">${data.result.row_count}</span></i></a>
        <a onclick="openWatchlistModel();"><i class="bi bi-heart-fill alg-text-gold fs-4 alg-text-hover"></i></a>
        `;
      } else {
        cartRow.innerHTML += ` 
        <a class="alg-button-hover" onclick="openCartModel();"><i class="bi bi-cart-fill alg-text-gold fs-4 mx-3 alg-text-hover"><span class="translate-middle rounded-pill badge bg-danger header-badge position-absolute">+</span></i></a>
        <a onclick="openWatchlistModel();"><i class="bi bi-heart-fill alg-text-gold fs-4 alg-text-hover"></i></a>
        `;
      }

      if (data.error) {
        console.log(data.error);
      }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}
