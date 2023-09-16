// default loaders
document.addEventListener("DOMContentLoaded", () => {
  loadProduct(document.body.dataset.productid);
});

// single product QTY changer
const plus = document.getElementById("plusid"),
  minus = document.getElementById("minusid"),
  num = document.getElementById("numid");

let a = 1;

plus.addEventListener("click", () => {
  if (a < 20) {
    a++;
  }
  a = a < 10 ? "0" + a : a;
  num.innerText = a;
});

minus.addEventListener("click", () => {
  if (a > 1) {
    a--;
    a = a < 10 ? "0" + a : a;
    num.innerText = a;
  }
});

var swiper = new Swiper(".mySwiper", {
  loop: true,
  spaceBetween: 10,
  slidesPerView: 3,
  freeMode: true,
  watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
  loop: true,
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});

// load product details
function loadProduct(productId) {
  // Fetch request
  fetch(
    SERVER_URL + "backend/api/load_single_product.php?product_id=" + productId,
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
      // Handle the JSON data received from the API
      const title = document.getElementById("productTitle");
      const productDescription = document.getElementById("productDescription");
      const productPrice = document.getElementById("productPrice");

      if (data.status == "success") {
        const details = data.results;
        title.innerText = details.product_name;
        productDescription.innerText = details.product_description;
        productPrice.innerText = details.product_price;

        // load related items
        let keywords =
          details.product_name +
          " " +
          details.product_description +
          " " +
          details.category_type;
        laodRelatedProducts(keywords);
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

// load related items
function laodRelatedProducts(keywords) {
  const productListViewContainer = document.getElementById(
    "relatedProductsContainer"
  );

  // Fetch request
  fetch(
    SERVER_URL + "backend/api/load_related_item_api.php?search=" + keywords,
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
      // Handle the JSON data received from the API
      productListViewContainer.innerHTML = "";

      if (data.status == "success") {
        if (data.results.length !== 0) {
          data.results.forEach((element) => {
            productListViewContainer.innerHTML += `
              <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mx-0 p-0">
                <div class="row m-0 w-100 p-2">
                    <div class="col-12 d-flex justify-content-end overflow-hidden flex-column bg-danger ld-bs-card w-100 p-0" onclick="openSignleProductView('${element.product_id}', '${element.weight}');">
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
        } else {
          productListViewContainer.innerHTML = "No Related Product";
        }
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

//load extra item
function loadExtraItem() {
  fetch(SERVER_URL + "backend/api/signInProcess.php", {
    method: "POST",
    body: ;
  })
    .then((response) => response.text())
    .then((data) => {
      console.log(data.status);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
