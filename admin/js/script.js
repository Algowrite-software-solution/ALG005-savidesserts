
function addProduct() {
  const name = document.getElementById("productNameInputField");
  const description = document.getElementById("productDescriptionInputField");
  const category = document.getElementById("productCategoryInputField");

  const form = new FormData();
  form.append("product_name", name.value);
  form.append("description", description.value);
  form.append("category_id", category.value);

  fetch("api/productAdding.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Product adding was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        name.value = "";
        description.value = "";
        category.value = 0;
      } else if (data.status == "failed") {
        ALG.openToast(
          "Alert",
          data.error,
          ALG.getCurrentTime(),
          "bi-x",
          "Error"
        );
      } else {
        console.log(data);
      }
    })
    .catch((error) => {
      console.error(error);
    });
}

async function addWeight() {
  const weightInput = document.getElementById("addWeightInput");
  const weight = weightInput.value;
  if (!weight) {
    ALG.openToast(
      "Invalid Input",
      "Please enter a valid weight",
      ALG.getCurrentTime(),
      "bi-x",
      "Error"
    );
    return;
  }

  let isValidated = false;
  function validateWeight(input) {
    // input = input.toLowerCase();
    // Regular expression to match valid weight inputs in kg or g
    const weightPattern = /^(\d+kg|\d+g)$/;

    if (!weightPattern.test(input)) {
      ALG.openToast(
        "Error",
        "Invalid format. Use 'kg' or 'g' (e.g., '5kg' or '750g')",
        ALG.getCurrentTime(),
        "",
        "Error"
      );
      isValidated = false;
    }

    // Extract the numeric value and unit (kg or g)
    const match = input.match(/^(\d+)(kg|g)$/);
    const value = parseInt(match[1]);
    const unit = match[2];

    if (unit === "kg") {
      if (value >= 0.5 && value <= 10) {
        isValidated = true;
      } else {
        ALG.openToast(
          "Error",
          "Weight out of range. Must be between 0.5kg and 10kg.",
          ALG.getCurrentTime(),
          "",
          "Error"
        );
        isValidated = false;
      }
    } else if (unit === "g") {
      if (value >= 500 && value <= 10000) {
        isValidated = true;
      } else {
        ALG.openToast(
          "Error",
          "Weight out of range. Must be between 500g and 10000g.",
          ALG.getCurrentTime(),
          "",
          "Error"
        );
        isValidated = false;
      }
    }
  }
  validateWeight(weight);

  if (!isValidated) {
    return;
  }

  const form = new FormData();
  form.append("weight", weight);

  return fetch("api/weightAddingProcess.php", {
    method: "POST", // HTTP request method
    body: form,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json(); // Parse the response body as JSON
    })
    .then((data) => {
      // Handle the JSON data received from the API
      if (data.status === "success") {
        ALG.openToast(
          "Success",
          "weight added successfully",
          ALG.getCurrentTime(),
          "",
          "Info"
        );
        weightInput.value = "";
        toggleProductSection("weight");
      } else if (data.status == "failed") {
        ALG.openToast(
          "Status Load Error",
          data.error,
          ALG.getCurrentTime(),
          "",
          "Error"
        );
      } else {
        ALG.openToast(
          "Something Went Wrong",
          data.error,
          ALG.getCurrentTime(),
          "",
          "Error"
        );
        console.log(data);
      }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      ALG.openToast(
        "Error",
        "Something Went Wrong",
        ALG.getCurrentTime(),
        "",
        "Error"
      );
      console.error("Fetch error:", error);
    });
}

function deleteCategory() {
  console.log("not developed yet");
  ALG.openToast(
    "Developer Alert",
    "This section is udner construction",
    ALG.getCurrentTime(),
    "",
    "Error"
  );
}

function openCategoryEditModel() {
  const modelBodyDesign = `<h5>Are you sure you want to <span class="text-danger">delete</span> this category?</h5>`;
  const modelFooterDesign = `<button data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger" onclick="deleteCategory()">Delete</button>`;

  ALG.openModel("Category Delete", modelBodyDesign, modelFooterDesign);
}

