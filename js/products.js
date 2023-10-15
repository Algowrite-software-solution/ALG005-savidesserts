let selectedCategory = "";

document.addEventListener("DOMContentLoaded", () => {
  loadCategory();
  // loadProducts("");
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
            <div class="categorySwiper swiper-slide category-slide" data-category="${element.category_type}">
              <div class="category-hover" onclick="setCategory('${element.category_type}');">
                <img src="../../resources/images/categoryImages/${element.category_type}.png" class="my-2 rounded-circle img-fluid" alt="category_img">
                <span class="alg-text-gold  alg-bg-dark p-1 px-5 rounded-4 fw-bold position-relative alg-text-h3">${element.category_type}</span>
              </div>
            </div>
          `;
        });

        // load products
        let category = document.body.dataset.category;
        setCategory(category);
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
function openSignleProductView(id, weightId) {
  // alert(weight);
  window.location.href =
    "singleProductView.php?product_id=" + id + "&weightId=" + weightId;
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
          let miniDescription =
            getFirst15Words(element.product_description) + "...";

          productListViewContainer.innerHTML += `
            <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mx-0 p-0">
              <div class="row m-0 w-100 p-2 d-flex justify-content-center">
                <div class=" col-12 d-flex justify-content-end overflow-hidden flex-column alg-bg-tan ld-bs-card p-0" onclick="openSignleProductView('${element.product_id}', '${element.weight_id}');">
                  <div class="product-list-card-bacground h-75 w-100" style="background-image: url('resources/images/singleProductImg/productId=${element.product_id}&&weightId=${element.weight_id}&&image=1.jpg');"></div>
                  <div class="h-25 ld-bs-card-content d-flex flex-column text-start">
                    <div class="d-flex gap-1 fw-bold justify-content-between">
                      <div class="text-white alg-text-h3">${element.product_name}</div>
                      <div class="alg-text-h3">LKR ${element.item_price}</div>
                    </div>
                    <div class="alg-text-h3 text-white">${miniDescription}</div>
                    <hr class="p-0 my-1"/>
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

function getFirst15Words(inputString) {
  // Split the input string into an array of words using whitespace as the delimiter
  const wordsArray = inputString.split(/\s+/);
  // Take the first 20 elements from the array using the slice method
  const first20WordsArray = wordsArray.slice(0, 8);
  // Join the first 20 words back together into a new string using whitespace as a separator
  const resultString = first20WordsArray.join(" ");
  return resultString;
}

function searchProducts() {
  const searchTerm = document.getElementById("searchBar").value;

  loadProducts(searchTerm, selectedCategory);
}

function setCategory(category) {
  selectedCategory === category
    ? ((selectedCategory = ""), categorySelectEffect(""))
    : ((selectedCategory = category), categorySelectEffect(category));

  function categorySelectEffect(category) {
    // selected effect
    const categories = document.querySelectorAll(".category-slide");
    categories.forEach((element) => {
      const span = element.getElementsByTagName("span");
      span[0].classList.add("alg-text-gold");
      span[0].classList.add("alg-bg-dark");
      span[0].classList.remove("alg-text-dark");
      span[0].classList.remove("alg-bg-gold");

      if (element.dataset.category === category) {
        span[0].classList.remove("alg-text-gold");
        span[0].classList.remove("alg-bg-dark");
        span[0].classList.add("alg-text-dark");
        span[0].classList.add("alg-bg-gold");
      }
    });
  }

  loadProducts(
    document.getElementById("searchBar").value,
    selectedCategory,
    "price",
    "high to low",
    10
  );
}
