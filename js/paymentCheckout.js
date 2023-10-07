document.addEventListener("DOMContentLoaded", () => {
     shippingDetailsLoad();
     liveCartDetailsLoad();
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



const saveBtn = document.getElementById("saveBtn");
const inputFields = document.querySelectorAll(".form-control");
const selectFields = document.querySelectorAll(".form-select");

// Function to enable input fields and the Save button
function enableInputs() {
     for (const field of inputFields) {
          field.disabled = !field.disabled;
     }
     for (const field of selectFields) {
          field.disabled = !field.disabled;
     }
     saveBtn.disabled = !saveBtn.disabled;
}

// edit button toggle
function EditBtnWorker() {
     enableInputs();
}

function districtLoader(districtId) {

     const district = document.getElementById('district');

     fetch(SERVER_URL + "backend/api/districtsLoader.php", {
          method: "GET", // HTTP request method
          headers: {
               "Content-Type": "application/json", // Request headers
          },
     })
          .then((response) => response.json())

          .then((data) => {
               district.innerHTML = "";
               district.innerHTML += `<option value="0">Select District</option>`;

               if (data.status === "success") {
                    data.results.forEach((element) => {
                         const option = document.createElement('option');
                         option.value = element.distric_id;
                         option.textContent = element.distric_name;
                         district.appendChild(option);

                    });

                    if (districtId != null) {
                         const selectOption = district.querySelector(`option[value="${districtId}"]`);
                         if (selectOption) {
                              selectOption.selected = true;
                         }
                    }
               }
          })
          .catch((error) => {
               console.error("Error:", error);
          });
}
function provinceLoader(provinceId) {

     const province = document.getElementById('province');

     fetch(SERVER_URL + "backend/api/loardProvince.php", {
          method: "GET", // HTTP request method
          headers: {
               "Content-Type": "application/json", // Request headers
          },
     })
          .then((response) => response.json())

          .then((data) => {
               province.innerHTML = "";
               province.innerHTML += `<option value="0">Select Province</option>`;

               if (data.status === "success") {

                    data.results.forEach((element) => {
                         const option = document.createElement('option');
                         option.value = element.province_id;
                         option.textContent = element.province;
                         province.appendChild(option);
                    });

                    if (provinceId != null) {
                         const selectOption = province.querySelector(`option[value="${provinceId}"]`);
                         if (selectOption) {
                              selectOption.selected = true;
                         }
                    }
               }
          })
          .catch((error) => {
               console.error("Error:", error);
          });
}

//load shipping data
function shippingDetailsLoad() {
     fetch(SERVER_URL + "backend/api/loadShippingDetails.php", {
          method: "GET", // HTTP request method
          headers: {
               "Content-Type": "application/json", // Request headers
          },
     })
          .then((response) => response.json())

          .then((data) => {

               if (data.status === "success") {
                    document.getElementById('fullName').value = data.results[0].fullName || "";
                    document.getElementById('mobile').value = data.results[0].mobile || "";
                    document.getElementById('addressLine1').value = data.results[0].address_line_1 || "";
                    document.getElementById('addressLine2').value = data.results[0].address_line_2 || "";
                    document.getElementById('city').value = data.results[0].city || "";


                    const districtId = data.results[0].distric_id;
                    const provinceId = data.results[0].province_id;

                    districtLoader(districtId);
                    provinceLoader(provinceId);

               } else {
                    document.getElementById('fullName').value = data.name;
                    districtLoader();
                    provinceLoader();
               }
          })
          .catch((error) => {
               console.error("Error:", error);
          });
}

//Update Shipping data
function updateShippingData() {

     const province = document.getElementById('province').value;
     const district = document.getElementById('district').value;
     const fullName = document.getElementById('fullName').value;
     const mobile = document.getElementById('mobile').value;
     const addressLine1 = document.getElementById('addressLine1').value;
     const addressLine2 = document.getElementById('addressLine2').value;
     const city = document.getElementById('city').value;


     const formData = new FormData();
     formData.append("province", province);
     formData.append("district", district);
     formData.append("fullName", fullName);
     formData.append("mobile", mobile);
     formData.append("addressLine1", addressLine1);
     formData.append("addressLine2", addressLine2);
     formData.append("city", city);

     // Fetch request
     fetch(SERVER_URL + "backend/api/shippingDataUpdate.php", {
          method: "POST", // HTTP request method
          body: formData,
     })
          .then((response) => {
               if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
               }
               return response.json(); // Parse the response body as JSON
          })
          .then((data) => {
               if (data.status === "success") {
                    toastMessage("Shipping details Updated", "text-bg-success");
                    shippingDetailsLoad();
               } else {
                    toastMessage(data.error, "text-bg-danger");
               }
          })
          .catch((error) => {
               // Handle errors that occur during the Fetch request
               console.error("Fetch error:", error);
          });


}

// cart data global object
var cartData = {
     items: [],
     total: 0,
};

function liveCartDetailsLoad() {

     const swDetailContainer = document.getElementById('swiperDetailContainer');
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
               swDetailContainer.innerHTML = "";
               let Total = 0;

               if (data.status === "success") {

                    data.response.forEach((element) => {
                         const itemPrice = element.qty * (element.price + element.extra_price);
                         Total += itemPrice;

                         swDetailContainer.innerHTML += `
                         <div class="checkoutSwiper swiper-slide alg-text-light d-flex flex-column justify-content-center align-items-center" >
                                <img class="img-fluid paycheck-product-im" src="https://media.istockphoto.com/id/1179207306/photo/pudding-caramel-custard-with-caramel-sauce-and-mint-leaf-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=QOgo1aIuavOspqKTbKz7Qk2O5wJJOZZPg4fiPg0p2xM=" alt="">
                                <span class="pt-1 alg-text-h3">${element.product_name}</span>
                                <span class=" fw-bolder alg-text-h3">RS.${element.price}</span>
                                <span class=" fw-bolder alg-text-h3">${element.extra_fruit}</span>
                            </div>
                         
                         `;

                    })
               }
          })
          .catch((error) => {
               // Handle errors that occur during the Fetch request
               console.error("Fetch error:", error.error);
          });
}