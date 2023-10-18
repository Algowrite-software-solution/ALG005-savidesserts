document.addEventListener("DOMContentLoaded", () => {
  loadProductPromotions();
  loadCategory();
  latesProductLoader();
});

//toast Message
function toastMessage(message, className) {
  const toastMessageContainer = document.getElementById(
    "toastMessageContainer"
  );
  const toastLiveExample = document.getElementById("liveToast");

  toastMessageContainer.innerHTML = "";
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
  toastMessageContainer.innerHTML += `<span>${message}</span>`;

  if (className !== undefined) {
    toastLiveExample.classList.add(className);
  }
  toastBootstrap.show();
}

function getFirst20Words(inputString) {
  // Split the input string into an array of words using whitespace as the delimiter
  const wordsArray = inputString.split(/\s+/);
  // Take the first 20 elements from the array using the slice method
  const first20WordsArray = wordsArray.slice(0, 7);
  // Join the first 20 words back together into a new string using whitespace as a separator
  const resultString = first20WordsArray.join(" ");
  return resultString;
}

//product promotion view section
function loadProductPromotions() {
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
      const promotionContainer = document.getElementById("promotionContainer");


      if (data.status == "success") {
        promotionContainer.innerHTML = `<div class="container">
        <div class="col-12 text-center pt-2 px-2 pb-4">
            <span class="alg-text-h2 alg-text-dark fw-bold m-0 p-0">PROMOTION</span>
            <div class="promotionSwiper swiper mySwiperPromotion mt-2">
                <div class="swiper-wrapper" id="promotionSliderContainer">
                    <!-- banner goes here -->
                </div>
            </div>
        </div>
    </div>`;
        const promotionSliderContainer = document.getElementById(
          "promotionSliderContainer"
        );
        promotionSliderContainer.innerHTML = "";
        var x =0;
        data.response.forEach((element) => {
          x = x+1;
          console.log(x);
          promotionSliderContainer.innerHTML += `
                <div class="promotionSwiper swiper-slide">
                    <div>
                       <img src="resources/images/banner3.jpg" class="" alt="prommotion_img">
                    </div>
                </div>
            `;
        });
      } else {
        console.log("no promotion results");
      }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}

// load category
function loadCategory() {
  fetch(SERVER_URL + "backend/api/load_category_api.php", {
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
      const categorySliderContainer = document.getElementById(
        "categorySliderContainer"
      );

      if (data.status == "success") {
        categorySliderContainer.innerHTML = "";
        data.results.forEach((element) => {
          categorySliderContainer.innerHTML += `
            <div class="categorySwiper swiper-slide">
              <a class="text-decoration-none p-3 category-hover" href="products.php?category=${element.category_type}">
                <img src="${element.category_image}" class="my-2 rounded-circle category-slider-img" alt="category_img">
                <span class="alg-text-gold alg-bg-dark alg-text-h3 p-1 px-5 rounded-4 fw-bold position-relative">${element.category_type}</span>
              </a>
            </div>
          `;
        });
      } else if (data.status == "failed") {
        console.log(data.error);
      } else {
        console.log(data);
      }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}

//lates product loader
function latesProductLoader() {
  fetch(SERVER_URL + "backend/api/latesProductLoader.php", {
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
      const mainLatestProductContainer = document.getElementById(
        "mainLatestProductContainer"
      );

      if (data.status === "success") {
        mainLatestProductContainer.innerHTML = "";
        data.results.forEach((element) => {
          let miniDescription = getFirst20Words(element.description) + ".....";

          mainLatestProductContainer.innerHTML += `
          <div class="bestSellingSwiper swiper-slide" onclick="openSignleProductView('${element.product_id}', '${element.weight_id}');">
          <div class="col-12 col-md-2 col-lg-2 d-flex justify-content-end overflow-hidden flex-column ld-bs-card w-100" style="background: url('resources/images/singleProductImg/productId=${element.product_id}&&weightId=${element.weight_id}&&image=1.jpg'); height:300px">
              <div class="ld-bs-card-content d-flex flex-column text-start">
                  <div class="d-flex gap-1 fw-bold justify-content-between">
                      <div class="text-white alg-text-h3">${element.product_name}</div>
                      <div class="alg-text-h3">LKR. ${element.price}</div>
                  </div>
                  <div class="text-white card-font">${miniDescription}</div>
                  <div class="d-flex gap-2">
                      <i class="bi bi-star-fill text-warning fs-6"></i>
                      <i class="bi bi-star-fill text-warning fs-6"></i>
                      <i class="bi bi-star-fill text-warning fs-6"></i>
                      <i class="bi bi-star-fill text-warning fs-6"></i>
                      <i class="bi bi-star-fill text-white fs-6"></i>
                  </div>
              </div>
          </div>
      </div>
          `;
        });
      } else if (data.status === "failed") {
        console.log(data.error);
      } else {
        console.log(data);
      }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}

// load open Signle Product View
function openSignleProductView(id, weightId) {
  // alert(weight);
  window.location.href =
    "singleProductView.php?product_id=" + id + "&weightId=" + weightId;
}
