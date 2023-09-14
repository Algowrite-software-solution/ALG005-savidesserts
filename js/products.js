document.addEventListener("DOMContentLoaded", () => {
  loadCategory();
  loadProducts("");
});

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
            <div class="promotionSwiper swiper-slide">
              <div>
                <img src="resources/images/category2.png" class="img-fluid" alt="category_img">
                <span class="alg-text-gold alg-bg-dark p-1 px-5 rounded-4 fw-bold position-relative">${element.category_type}</span>
              </div>
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

// load open Signle Product View
function openSignleProductView(id) {
  window.location.href = "singleProductView.php?product_id=" + id;
}

function loadProducts(
  searchTerm = "",
  category = "",
  orderBy = "price",
  orderDirection = "high to low",
  limit = 10
) {
  let productListViewContainer = document.getElementById(
    "productListViewContainer"
  );

  fetch(
    SERVER_URL +
      "backend/api/load_product_list_api.php?search=" +
      searchTerm +
      "&options=" +
      JSON.stringify({
        category: category,
        orderBy: orderBy,
        orderDirection: orderDirection,
        limit: limit,
      }),
    {
      method: "GET", // HTTP request method
      headers: {
        "Content-Type": "application/json", // Request headers
      },
    }
  )
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json(); // Parse the response body as JSON
    })
    .then((data) => {
      productListViewContainer.innerHTML = "";
      // Handle the JSON data received from the API
      if (data.status == "success") {
        data.results.forEach((element) => {
          productListViewContainer.innerHTML += `
            <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mx-0 p-0">
              <div class="row m-0 w-100 p-2">
                  <div class="col-12 d-flex justify-content-end overflow-hidden flex-column bg-danger ld-bs-card w-100 p-0" onclick="openSignleProductView(${element.product_id});">
                  <div class="ld-bs-card-content d-flex flex-column text-start">
                    <div class="d-flex gap-1 fw-bold justify-content-between">
                      <div class="text-white alg-text-h3">${element.product_name}</div>
                      <div class="alg-text-h3">LKR ${element.item_price}</div>
                    </div>
                    <div class="alg-text-h3 text-white">${element.product_description}</div>
                    <hr/>
                    <div class="d-flex justify-content-between px-3">
                        <div class="d-flex gap-2">
                          <i class="bi bi-star-fill text-warning fs-6"></i>
                          <i class="bi bi-star-fill text-warning fs-6"></i>
                          <i class="bi bi-star-fill text-warning fs-6"></i>
                          <i class="bi bi-star-fill text-warning fs-6"></i>
                          <i class="bi bi-star-fill text-white fs-6"></i>
                        </div>
                        <div class="alg-text-h4 text-white fw-bold">${element.weight}</div>
                    </div>
                  </div>
                </div>
              </div>
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
