// default loaders
document.addEventListener("DOMContentLoaded", () => {
  const productid = document.body.dataset.productid;
  const weight = document.body.dataset.weight;

  loadProduct(productid, weight);
  loadExtraItem(productid);
  loadWeight(productid, weight);
  loadSwiper();
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

  toastLiveExample.classList.remove("text-bg-success");
  toastLiveExample.classList.remove("text-bg-danger");

  if (className !== undefined) {
    toastLiveExample.classList.add(className);
  }
  toastBootstrap.show();
}

function loadSwiper() {
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
}

//Product Item Price
let productItemPrice;

// load product details
function loadProduct(productId, weightId) {
  // Fetch request
  fetch(
    SERVER_URL + "backend/api/load_single_product.php?product_id=" + productId + "&weightId=" + weightId,
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
      const productCategory = document.getElementById("productCategory");
      const productTitleLargeScreen = document.getElementById(
        "productTitleLargeScreen"
      );
      const productCategoryLargeScreen = document.getElementById(
        "productCategoryLargeScreen"
      );

      if (data.status == "success") {
        const details = data.results;
        productItemPrice = details.item_price;
        title.innerText = details.product_name;
        productTitleLargeScreen.innerText = details.product_name;
        productDescription.innerText = details.product_description;
        productPrice.innerText = "LKR. " + " " + details.item_price;
        productCategory.innerHTML = details.category_type;
        productCategoryLargeScreen.innerHTML = details.category_type;

        // load Images
        const mainImageSliderContainer = document.getElementById(
          "singleProductViewImageSliderMain"
        );

        const secondaryImageSliderContainer = document.getElementById(
          "singleProductViewImageSliderSecondary"
        );
        mainImageSliderContainer.innerHTML = "";
        secondaryImageSliderContainer.innerHTML = "";

        let hasImages = false;
        details.images.forEach((element) => {
          if (element) {
            mainImageSliderContainer.innerHTML += `<div class="swiper-slide">
            <img src="${element}" />
            </div>`;

            secondaryImageSliderContainer.innerHTML += `<div class="swiper-slide">
            <img src="${element}" />
            </div>`;
            hasImages = true;
          }
        });

        if (!hasImages) {
          mainImageSliderContainer.innerHTML += `<div class="swiper-slide alg-text-light">
                                                    <div>No images to Show</div>
                                                  </div>`;

          secondaryImageSliderContainer.innerHTML += `<div class="swiper-slide alg-text-light">
                                                        
                                                      </div>`;
        }

        loadSwiper();

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
            let miniDescription =
              getFirst20Words(element.product_description) + "...";

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

function getFirst20Words(inputString) {
  // Split the input string into an array of words using whitespace as the delimiter
  const wordsArray = inputString.split(/\s+/);
  // Take the first 20 elements from the array using the slice method
  const first20WordsArray = wordsArray.slice(0, 7);
  // Join the first 20 words back together into a new string using whitespace as a separator
  const resultString = first20WordsArray.join(" ");
  return resultString;
}

// load open Signle Product View
function openSignleProductView(id, weightId) {
  // alert(weight);
  window.location.href =
    "singleProductView.php?product_id=" + id + "&weightId=" + weightId;
}
// Define a global object to store the extra items and their prices
const extraItemData = {
  4: {
    value: 4,
    price: 0,
  },
};

//load extra item
function loadExtraItem(productId) {
  const extraItemContainer = document.getElementById("extraItemContainer");

  const fdata = new FormData();
  fdata.append("product_id", productId);
  // Fetch request
  fetch(SERVER_URL + "backend/api/extra_Item_LoadApi.php", {
    method: "POST", // HTTP request method
    body: fdata,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json(); // Parse the response body as JSON
    })
    .then((data) => {
      // Handle the JSON data received from the API
      // console.log("Data from the API:", data);
      extraItemContainer.innerHTML = `<option value="1">Select Toppings</option>`;
      if (data.status === "success") {
        data.response.forEach((element) => {
          extraItemData[element.extra_id] = {
            value: element.extra_id,
            price: element.price,
          };
          extraItemContainer.innerHTML += `
          <option value="${element.extra_id}">LKR ${element.price}  ${element.extra_fruit}</option>
          `;
        });
      } else if (data.status === "no row data") {
        extraItemContainer.innerHTML = `<option disabled value="1">Select Toppings</option>`;
      } else {
        console.log(data);
      }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}

// load weight
function loadWeight(productId, weightId) {
  //weight container
  const loadWeightContainer = document.getElementById("loadWeightContainer");

  const fdata = new FormData();
  fdata.append("product_id", productId);
  // Fetch request
  fetch(SERVER_URL + "backend/api/weight_load.php", {
    method: "POST", // HTTP request method
    body: fdata,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json(); // Parse the response body as JSON
    })
    .then((data) => {
      // Handle the JSON data received from the API
      // console.log("Data from the API:", data);
      loadWeightContainer.innerHTML = "";
      if (data.status === "success") {
        data.response.forEach((element) => {
          const option = document.createElement("option");
          option.value = element.weight_id;
          option.textContent = element.weight;
          loadWeightContainer.appendChild(option);
        });

        // Select the option with the specified weightId
        const selectedOption = loadWeightContainer.querySelector(
          `option[value="${weightId}"]`
        );
        if (selectedOption) {
          selectedOption.selected = true;
        }
      } else if (data.status === "no row data") {
        console.log(data.status);
      } else {
        console.log(data);
      }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}

function changeProductItemForWeight(productId) {
  const loadWeightContainer = document.getElementById("loadWeightContainer").value;
  // alert(weight);
  window.location.href = "singleProductView.php?product_id=" + productId + "&weightId=" + loadWeightContainer;
}

//add to cart
function addToCartItem(product_id, weight_id) {
  const loadWeightContainer =
    document.getElementById("loadWeightContainer").value || weight_id;
  const extraItemContainer =
    document.getElementById("extraItemContainer").value || 1;
  const qty = document.getElementById("numid").textContent;

  const fdata = new FormData();
  fdata.append("product_id", product_id);
  fdata.append("qty", qty);
  fdata.append("loadWeightContainer", loadWeightContainer);
  fdata.append("extraItemContainer", extraItemContainer);

  // Fetch request
  fetch(SERVER_URL + "backend/api/cardAddingProcess.php", {
    method: "POST", // HTTP request method
    body: fdata,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json(); // Parse the response body as JSON
    })
    .then((data) => {
      // Handle the JSON data received from the API
      // console.log("Data from the API:", data);
      loadWeightContainer.innerHTML = "";
      if (data.status === "product added successfully") {
        toastMessage("Product Added", "text-bg-success");
        cartRowCount();
      } else {
        toastMessage(data.error, "text-bg-danger");
      }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}

let TotalPrice = 0;
let qty = 1;

function singleProductPriceCalculation() {
  //extra Item Container
  const extraItemContainer =
    document.getElementById("extraItemContainer").value || 1;
  //price container
  const productPrice = document.getElementById("productPrice");

  //get extraItem Releted price
  const selectedExtraItemPrice = extraItemData[extraItemContainer].price;

  //price Total Cal
  TotalPrice = (productItemPrice + selectedExtraItemPrice) * qty;

  productPrice.innerText = "LKR. " + " " + TotalPrice;
}

// single product QTY changer
const plus = document.getElementById("plusid");
const minus = document.getElementById("minusid");
const num = document.getElementById("numid");
//increase
plus.addEventListener("click", () => {
  qty++;
  qty = qty < 10 ? +qty : qty;
  num.innerText = qty;
  singleProductPriceCalculation();
});
// minimize
minus.addEventListener("click", () => {
  if (qty > 1) {
    qty--;
    qty = qty < 10 ? +qty : qty;
    num.innerText = qty;
    singleProductPriceCalculation();
  }
});

//cart row count
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
