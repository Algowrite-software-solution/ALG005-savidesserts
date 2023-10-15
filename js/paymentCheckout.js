document.addEventListener("DOMContentLoaded", () => {
     shippingDetailsLoad();
     liveCartDetailsLoad();
     shippingPriceLoader();
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
                    document.getElementById('postCode').value = data.results[0].postal_code || "";


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
     const postCode = document.getElementById('postCode').value;


     const formData = new FormData();
     formData.append("province", province);
     formData.append("district", district);
     formData.append("fullName", fullName);
     formData.append("mobile", mobile);
     formData.append("addressLine1", addressLine1);
     formData.append("addressLine2", addressLine2);
     formData.append("city", city);
     formData.append("postCode", postCode);

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


// calculation
let Total = 0;
let ProductItemPrice = 0;
let ExtraToppingsPrice = 0;
let ShippingPrice = 0;

// global element result
let globalElementResult = [];


//shippingPrice loader
function shippingPriceLoader() {
     // Fetch request
     fetch(SERVER_URL + "backend/api/shippingDataLoader.php", {
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
               ShippingPrice = 0;
               if (data.status === "success") {
                    ShippingPrice = data.result;
                    // console.log(ShippingPrice);

                    return data.result;
               } else {
                    toastMessage(data.error, "text-bg-danger");
               }
          })
          .catch((error) => {
               // Handle errors that occur during the Fetch request
               console.error("Fetch error:", error);
          });

}
shippingPriceLoader();


// live cart details loader 2 
function liveCartDetailsLoad() {

     let shippingPriceContainer = document.getElementById('shippingPrice');
     let totalPriceContainer = document.getElementById('totalPriceContainer');
     let subTotalPrice = document.getElementById('subTotalPrice');
     let productDetailsContainer = document.getElementById('productDetailsContainer');

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

               // calculation
               Total = 0;
               ProductItemPrice = 0;
               ExtraToppingsPrice = 0;



               if (data.status === "success") {

                    data.response.forEach((element) => {

                         //all calculation
                         globalElementResult.push(element);

                         const extraPrice = element.qty * element.extra_price;
                         ExtraToppingsPrice += extraPrice;

                         const productItemsPrice = element.qty * element.price;
                         ProductItemPrice += productItemsPrice;

                         const itemPrice = element.qty * (element.price + element.extra_price);
                         Total += itemPrice;

                         let rowItemsPrice = productItemsPrice + extraPrice;


                         //    set element our design
                         productDetailsContainer.innerHTML += `
                         <div class="d-flex flex-column flex-lg-row flex-lg-row gap-2  alg-pc-border pt-3 pb-3">
                        <!-- product image -->
                        <img src="https://img.taste.com.au/6i4vEH8z/w354-h236-cfill-q80/taste/2016/11/warm-chocolate-puddings-22259-1.jpeg" alt="you order images" class="alg-pc-img">

                        <!-- details goes here -->
                        <div class=" d-flex flex-column flex-grow-1">
                            <!-- product name -->
                            <div class="">
                                <h4 class="fw-bold alg-pc-font">${element.product_name}</h4>
                            </div>
                            <div class="d-flex gap-2 overflow-auto">
                                <!-- one side -->
                                <div class="alg-bg-tan  justify-content-center alg-text-dark alg-rounded-small d-flex flex-column flex-grow-1 p-2">
                                    <span class="alg-pc-font">Weight: ${element.weight}</span>
                                    <span class="alg-pc-font">QTY: ${element.qty}</span>
                                    <span class="alg-pc-font">Topping: ${element.extra_fruit}</span>
                                </div>

                                <!-- other side -->
                                <div class="alg-bg-tan  justify-content-center alg-text-dark alg-rounded-small d-flex flex-column flex-grow-1 p-2">
                                    <span class="alg-pc-font">Product Price : Rs.${element.price}</span>
                                    <span class="alg-pc-font">Topping Price : Rs.${element.extra_price}</span>

                                </div>
                                <!-- other side -->
                                <div class="alg-bg-tan align-items-center justify-content-center alg-text-dark alg-rounded-small d-flex flex-column flex-grow-1 p-2">
                                    <span class="fw-bold alg-pc-font">Rs.${rowItemsPrice}</span>
                                </div>
                            </div>
                        </div>
                    </div>
 
                         `;
                    })
                    // add shipping cost for total
                    Total += parseInt(ShippingPrice);
                    // prices sets
                    shippingPriceContainer.textContent = "Rs.  " + ShippingPrice + ".00";
                    totalPriceContainer.textContent = "Rs." + Total + ".00";
                    subTotalPrice.textContent = "Rs." + ProductItemPrice + ".00";

               }
          })
          .catch((error) => {
               // Handle errors that occur during the Fetch request
               console.error("Fetch error:", error);
          });
}




//random number generate
function generateUniqueId() {
     const randomNumber = Math.floor(100000 + Math.random() * 900000); // Generates a random number between 100000 and 999999
     const uniqueId = `#${randomNumber}`;
     return uniqueId;
}

function placeOrder() {

     //input filed
     const fullName = document.getElementById('fullName').value;
     const mobile = document.getElementById('mobile').value;
     const addressLine1 = document.getElementById('addressLine1').value;
     const addressLine2 = document.getElementById('addressLine2').value;
     const city = document.getElementById('city').value;
     const district = document.getElementById('district').value;
     const province = document.getElementById('province').value;

     //genarate random order Id
     const orderId = generateUniqueId();
     const total = Total;


     const formData = new FormData();
     formData.append('orderId', orderId);
     formData.append('total', total);
     formData.append('fullName', fullName);
     formData.append('mobile', mobile);
     formData.append('addressLine1', addressLine1);
     formData.append('city', city);
     formData.append('district', district);
     formData.append('province', province);


     // Fetch request
     fetch(SERVER_URL + "backend/api/paymentProcess.php", {
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

                    // Payment completed. It can be a successful failure.
                    payhere.onCompleted = function onCompleted(orderId) {
                         console.log("Payment completed. OrderID:" + orderId);
                         // Note: validate the payment and show success or failure page to the customer

                         addInvoice(orderId);

                    };

                    // Payment window closed
                    payhere.onDismissed = function onDismissed() {
                         // Note: Prompt user to pay again or show an error page
                         console.log("Payment dismissed");
                         // toastMessage("Payment dismissed", "text-bg-danger");
                    };

                    // Error occurred
                    payhere.onError = function onError(error) {
                         // Note: show an error page
                         console.log("Error:" + error);
                    };

                    // Put the payment variables here
                    var payment = {
                         "sandbox": true,
                         "merchant_id": "1224343",    // Replace your Merchant ID
                         "return_url": 'http://localhost:9001/paymentCheckout.php',     // Important
                         "cancel_url": 'http://localhost:9001/paymentCheckout.php',     // Important
                         "notify_url": "http://sample.com/notify",
                         "order_id": orderId,
                         "items": orderId,
                         "amount": total,
                         "currency": "LKR",
                         "hash": data.results, // *Replace with generated hash retrieved from backend
                         "first_name": "null",
                         "last_name": "null",
                         "email": "samanp@gmail.com",
                         "phone": mobile,
                         "address": "No.1, Galle Road",
                         "city": "Colombo",
                         "country": "Sri Lanka",
                         "delivery_address": addressLine1,
                         "delivery_city": city,
                         "delivery_country": "Sri Lanka",
                         "delivery_address_line_2": addressLine2,
                         "custom_2": ""
                    };

                    // Show the payhere.js popup, when "PayHere Pay" is clicked
                    document.getElementById('payhere-payment').onclick = function (e) {
                         payhere.startPayment(payment);
                    };
               } else {
                    toastMessage(data.error, "text-bg-danger");
               }
          })
          .catch((error) => {
               // Handle errors that occur during the Fetch request
               console.log(error);
               // toastMessage("Fetch error:", error, "text-bg-danger");
          });
}


function addInvoice(orderId) {

     const formData = new FormData();
     formData.append("globalElementResult", JSON.stringify(globalElementResult));
     formData.append("Total", Total);
     formData.append("ProductItemPrice", ProductItemPrice);
     formData.append("ExtraToppingsPrice", ExtraToppingsPrice);
     formData.append("orderId", orderId);
     formData.append("shippingPrice", ShippingPrice);

     // Fetch request
     fetch(SERVER_URL + "backend/api/addInvoiceProcess.php", {
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
                    toastMessage("Order Placed", "text-bg-success");

                    setTimeout(() => { window.location.reload() }, 2000);

               } else {
                    toastMessage(data.error, "text-bg-danger");
               }
          })
          .catch((error) => {
               // Handle errors that occur during the Fetch request
               console.error("Fetch error:", error);
          });
}