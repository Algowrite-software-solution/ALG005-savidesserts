document.addEventListener("DOMContentLoaded", () => {
  //   loadProductPromotions();
  loadCategory();
});

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
      // Handle the JSON data received from the API
      console.log("Data from the API:", data);
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
