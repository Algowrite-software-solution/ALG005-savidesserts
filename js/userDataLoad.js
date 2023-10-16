document.addEventListener("DOMContentLoaded", () => {
     userProfileDataload();
     loadInvoiceData();

});




//toast Message 
function toastMessage(message, className) {
     const toastMessageContainer = document.getElementById('toastMessageContainer');
     const toastLiveExample = document.getElementById('liveToast')


     toastMessageContainer.innerHTML = "";
     const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
     toastMessageContainer.innerHTML += `<span>${message}</span>`;

     if (className !== undefined) {
          toastLiveExample.classList.add(className)
     }
     toastBootstrap.show();

}

// load user data for profile
function userProfileDataload() {

     fetch(SERVER_URL + "backend/api/loadUserData.php", {
          method: "GET", // HTTP request method
          headers: {
               "Content-Type": "application/json", // Request headers
          },
     })
          .then((response) => response.json())

          .then((data) => {
               const userCardContainer = document.getElementById('userCardContainer');
               if (data.status === "success") {

                    const userName = data.response.user_name;
                    const name = userName.substring(0, 2);


                    userCardContainer.innerHTML = "";
                    userCardContainer.innerHTML += `
                    <div class="alg-profile-round alg-bg-light d-flex justify-content-center align-items-center fw-bold text-uppercase">${name}</div>
                    <div class="d-flex flex-column align-items-center alg-text-light text-white mt-1 px-4" >
                    <span class="fw-bold">${data.response.user_name}</span>
                    <span>${data.response.email}</span>
                   </div>
                    <button type="button" onclick="signOut();" class="text-decoration-none text-black page-transition-button alg-bg-tan fw-bold alg-button-hover px-4 py-1 mt-3 rounded-4">SIGN OUT</button>
                 `;
               }


          })
          .catch((error) => {
               console.error("Error:", error);
          });
}

//purchasing history data load
function loadInvoiceData() {
     fetch(SERVER_URL + "backend/api/loadInvoiceData.php", {
          method: "GET", // HTTP request method
          headers: {
               "Content-Type": "application/json", // Request headers
          },
     })
          .then((response) => response.json())

          .then((data) => {
               const detailsContainer = document.getElementById('detailsContainer');
               if (data.status === "success") {

                    data.result.forEach((element) => {
                         const orderContainer = document.createElement('div');
                         orderContainer.className = "row alg-bg-light text-black d-flex justify-content-between text-center mx-4 rounded-4 mt-3 mb-2 p-2 alg-text-h3";
                         orderContainer.addEventListener('click', () => {
                              loadInvoiceItem(element.order_id);
                         });

                         orderContainer.innerHTML += `
                                
              
                <div class="col-9 col-lg-6 m-0 p-0 px-2 px-lg-0">
                    <div class="row">
                        <div class="col-3">
                            <span id="orderId">${element.order_id}</span>
                        </div>
                        <div class="col-4">
                            <span>${element.order_date}</span>
                        </div>
                        <div class="col-5">
                            <span>Rs. ${element.shipping_price}</span>
                        </div>
                    </div>
                </div>
                <div class="col-3 m-0 p-0">
                    <div class="row">
                        <div class="col-3 me-3">
                            <span>Rs. ${element.pay_amout}</span>
                        </div>
                        <div class="col-6">
                            <span class="fw-bold">${element.status}</span>
                        </div>
                    </div>
                </div>
               
                         
                         `;

                         detailsContainer.appendChild(orderContainer);
                    });


               }
          })
          .catch((error) => {
               console.error("Error:", error);
          });
}

//load Invoice item
function loadInvoiceItem(orderId) {

     console.log(orderId);

     const formData = new FormData();
     formData.append("order_id", orderId);


     fetch(SERVER_URL + "backend/api/invoiceItemLoad.php", {
          method: "POST", // HTTP request method
          body: formData,
     })
          .then((response) => response.json())

          .then((data) => {
               const invoiceItemContainer = document.getElementById('invoiceItemContainer');

               if (data.status === "success") {
                         invoiceItemContainer.innerHTML = "";
                    data.result.forEach((element) => {
                         invoiceItemContainer.innerHTML += `
                              
                         <div class="d-flex justify-content-around alg-bg-light align-items-center alg-text-h3 p-2 px-0 px-lg-0 mb-2 rounded-3">
                                <span>${element.product_name}</span>
                                <span>${element.fruit}</span>
                                <span>Rs. ${element.extra_item_price}</span>
                                <span>QTY ${element.invoice_item_qty}</span>
                                <span>${element.weight}</span>
                                <span>Rs. ${element.total_product_items_price}.00</span>
                         </div>
                         
                         `;
                    });
               }

               productDetails();
          })
          .catch((error) => {
               console.error("Error:", error);
          });
}


// product details
let productDetailsModel;
function productDetails() {
     productDetailsModel = new bootstrap.Modal("#productDetailsModel");
     productDetailsModel.show();
}
