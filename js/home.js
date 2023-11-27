SERVER_URL = ""
document.addEventListener("DOMContentLoaded", () => {
  loadProductPromotions();
  loadCategory();
  latesProductLoader();
  loadReviewSection();
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
  const promotionContainer = document.getElementById('promotionContainer');
  const promotionSliderContainer = document.getElementById('promotionSliderContainer');
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

      if (data.status === "success") {

        if (data.result.length > 0) {
          promotionContainer.classList.remove('d-none');

          data.result.map((item) => {

            promotionSliderContainer.innerHTML +=
              `
               <div class="promotionSwiper swiper-slide" onclick="loadRelatedPromotion('${item.product_product_id}', '${item.weight_id}')">
                  <div>
                      <img src="resources/images/banner3.jpg" class="" alt="prommotion_img">
                  <div/>
               </div>
            `;

          });

        }

      } else {
        console.log("no promotion data");
      }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}

//loadRelated product
function loadRelatedPromotion(product_id, weightId) {
  window.location.href = "singleProductView.php?product_id=" + product_id + "&weightId=" + weightId;
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
        throw new Error(`HTTP error! Status: ${response.status} `);
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
            <div div class="categorySwiper swiper-slide" >
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
        throw new Error(`HTTP error! Status: ${response.status} `);
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
            <div class="bestSellingSwiper swiper-slide col-12 col-md-6 col-lg-2 d-flex justify-content-center mx-0 p-0">
              <div class="row m-0 w-100 d-flex justify-content-center">
                <div class="col-12 d-flex justify-content-between overflow-hidden flex-column alg-bg-tan ld-bs-card p-0" onclick="openSignleProductView('${element.product_id}', '${element.weight_id}');">
                  <div class="product-list-card-bacground h-50 w-100 flex-grow-1" style="background-image: url('resources/images/singleProductImg/productId=${element.product_id}&&weightId=${element.weight_id}&&image=1.jpg');width:100px;"></div>
                  <div class="h-2 ld-bs-card-content d-flex flex-column text-start">
                    <div class="d-flex gap-1 fw-bold justify-content-between">
                      <div class="text-white alg-text-h3">${element.product_name}</div>
                      <div class="alg-text-h3">LKR. ${element.price}</div>
                    </div>
                    <div class="text-white card-font">${miniDescription}</div>
                    <hr />
                    <div class="d-flex gap-2 pb-1">
                      <i class="bi bi-star-fill text-warning fs-6"></i>
                      <i class="bi bi-star-fill text-warning fs-6"></i>
                      <i class="bi bi-star-fill text-warning fs-6"></i>
                      <i class="bi bi-star-fill text-warning fs-6"></i>
                      <i class="bi bi-star-fill text-white fs-6"></i>
                    </div>

                  </div>
                </div>
              </div>
            </ >
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

//load Review section
function loadReviewSection() {
  fetch(SERVER_URL + "backend/api/loadReviewsClientSide.php", {
    method: "GET", // HTTP request method
    headers: {
      "Content-Type": "application/json", // Request headers
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status} `);
      }
      return response.json(); // Parse the response body as JSON
    })
    .then((data) => {
      // Handle the JSON data received from the API
      const containerTestimonial = document.getElementById("containerTestimonial");

      if (data.status === "success") {
        containerTestimonial.innerHTML = "";
        data.result.forEach((element) => {
          containerTestimonial.innerHTML += `
                    <div class="testm-card d-flex justify-content-center align-items-center  alg-bg-light p-2">
                        <div class="col-4 p-0">
                            <img src="resources/images/profile.png" class="img-fluid testm-card-img">
                        </div>
                        <div class="col-8 px-1">
                            <p class="ld-tes-card-paragraph  alg-text-dark fw-bold">${element.review}</p>
                            <div class="d-flex gap-2 pb-1">
                                <i class="bi bi-star-fill text-warning fs-6"></i>
                                <i class="bi bi-star-fill text-warning fs-6"></i>
                                <i class="bi bi-star-fill text-warning fs-6"></i>
                                <i class="bi bi-star-fill text-warning fs-6"></i>
                                <i class="bi bi-star-fill text-white fs-6"></i>
                            </div>
                            <h5 class="alg-text-gold">
                                -${element.full_name}
                            </h5>
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
