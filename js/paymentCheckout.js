document.addEventListener("DOMContentLoaded", () => {
     districtLoader();
     provinceLoader();
});


function shippingDetailsChecker() {

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

function districtLoader() {
     fetch(SERVER_URL + "backend/api/districtsLoader.php", {
          method: "GET", // HTTP request method
          headers: {
               "Content-Type": "application/json", // Request headers
          },
     })
          .then((response) => response.json())

          .then((data) => {

               if (data.status === "success") {
                    const district = document.getElementById('district');
                    district.innerHTML += `<option value="0">Select Districts</option>`;
                    data.results.forEach((element) => {
                         district.innerHTML += `
                         <option value="${element.distric_id}">${element.distric_name}</option>
                         `;
                    });
               }
          })
          .catch((error) => {
               console.error("Error:", error);
          });
}
function provinceLoader() {
     fetch(SERVER_URL + "backend/api/loardProvince.php", {
          method: "GET", // HTTP request method
          headers: {
               "Content-Type": "application/json", // Request headers
          },
     })
          .then((response) => response.json())

          .then((data) => {

               if (data.status === "success") {
                    const province = document.getElementById('province');
                    province.innerHTML += `<option value="0">Select Province</option>`;
                    data.results.forEach((element) => {
                         province.innerHTML += `
                         <option value="${element.province_id}">${element.province}</option>
                         `;
                    });
               }
          })
          .catch((error) => {
               console.error("Error:", error);
          });
}