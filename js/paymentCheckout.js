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


// calculation
let Total = 0;
let ProductItemPrice = 0;
let ExtraToppingsPrice = 0;

// global element result
let globalElementResult = [];


function liveCartDetailsLoad() {

     const swDetailContainer = document.getElementById('swiperDetailContainer');
     const priceContainer = document.getElementById('priceContainer');

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
               priceContainer.innerHTML = "";
               swDetailContainer.innerHTML = "";

               // calculation
               Total = 0;
               ProductItemPrice = 0;
               ExtraToppingsPrice = 0;


               if (data.status === "success") {

                    data.response.forEach((element) => {


                         globalElementResult.push(element);

                         const extraPrice = element.qty * element.extra_price;
                         ExtraToppingsPrice += extraPrice;

                         const productItemsPrice = element.qty * element.price;
                         ProductItemPrice += productItemsPrice;

                         const itemPrice = element.qty * (element.price + element.extra_price);
                         Total += itemPrice;

                         swDetailContainer.innerHTML += `
                         <div class="checkoutSwiper swiper-slide alg-text-light d-flex flex-column justify-content-center align-items-center" >
                                <img class="img-fluid paycheck-product-im" src="https://media.istockphoto.com/id/1179207306/photo/pudding-caramel-custard-with-caramel-sauce-and-mint-leaf-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=QOgo1aIuavOspqKTbKz7Qk2O5wJJOZZPg4fiPg0p2xM=" alt="">
                                <span class="pt-1 fw-bolder alg-text-h3">${element.product_name}</span>
                                <span class="alg-text-h3">RS.${element.price}</span>
                                <span class="alg-text-h3">Weight : ${element.weight}</span>
                                <span class="alg-text-h3">Toppings : ${element.extra_fruit}</span>
                                <span class="alg-text-h3">Toppings Price : ${element.extra_price}</span>
                                <span class="alg-text-h3">QTY : ${element.qty}</span>
                         </div>
                         
                         `;




                    })

                    priceContainer.innerHTML += `
                         <div class="d-flex justify-content-around" id="productPriceContainer">
                            <span>Product Total Price:</span>
                            <p>Rs. ${ProductItemPrice}</p>
                         </div>
                         <div class="d-flex justify-content-around" id="extraToppingPrice">
                            <span class="fw-bolder">Extra Item Total price :</span>
                            <p class="fw-bolder">Rs. ${ExtraToppingsPrice}</p>
                         </div>
                         <div class="d-flex justify-content-around" id="ShippingPrice">
                            <span class="fw-bolder">Shipping price :</span>
                            <p class="fw-bolder">Rs. 00</p>
                         </div>
                         <div class="d-flex justify-content-around" id="Total">
                            <span class="fw-bolder">Total Price :</span>
                            <p class="fw-bolder">Rs. ${Total}</p>
                         </div>
                    
                    
                    `;


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

     //validation input filed
     if (fullName === null || fullName === undefined) {
          toastMessage("Please enter the full name", "text-bg-danger");
         
     }

     if (mobile === null || mobile === undefined) {
          toastMessage("Please enter the mobile number", "text-bg-danger");
         
     }
     if (addressLine1 === null || addressLine1 === undefined) {
          toastMessage("Please enter the address", "text-bg-danger");
         
     }
     if (city === null || city === undefined) {
          toastMessage("Please enter the city", "text-bg-danger");
         
     }
     if (district === 0) {
          toastMessage("Please enter the district", "text-bg-danger");
          
     }
     if (province === 0) {
          toastMessage("Please enter the province", "text-bg-danger");
          
     }

     //genarate random order Id
     const orderId = generateUniqueId();
     const total = Total;


     const formData = new FormData();
     formData.append('orderId', orderId);
     formData.append('total', total);


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