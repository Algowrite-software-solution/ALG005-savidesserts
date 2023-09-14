document.addEventListener("DOMContentLoaded", () => {
  loadCategory();
  loadProducts("Pudin");
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

function loadProducts(
  searchTerm = "",
  category = "",
  orderBy = "price",
  orderDirection = "high to low",
  limit = 10
) {
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
      return response.text(); // Parse the response body as JSON
    })
    .then((data) => {
      // Handle the JSON data received from the API
      console.log(data);
      // if (data.status == "success") {
      //   console.log(data);
      // } else if (data.status == "failed") {
      //   console.log(data.error);
      // } else {
      //   console.log(data);
      // }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}
