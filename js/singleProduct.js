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
      console.log("Data from the API:", data);

      const title = document.getElementById("productTitle");
      const productDescription = document.getElementById("productDescription");
      const productPrice = document.getElementById("productPrice");

      if (data.status == "success") {
        const details = data.results;
        title.innerText = details.product_name;
        productDescription.innerText = details.product_description;
        productPrice.innerText = details.product_price;
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
