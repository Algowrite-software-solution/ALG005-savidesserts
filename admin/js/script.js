// product item setup section
let productItemImages = [];

function addProductItemImageToList() {
  const imageInput = document.getElementById("productItemImageInput");
  for (const key in imageInput.files) {
    if (Object.hasOwnProperty.call(imageInput.files, key)) {
      const reader = new FileReader();

      reader.onload = function (event) {
        const dataURL = event.target.result;
        productItemImages.push(dataURL);
        previewProductListImages();
      };

      reader.readAsDataURL(imageInput.files[key]);
    }
  }
}

function previewProductListImages() {
  const imageContainer = document.getElementById(
    "productItemImagePreviewContainer"
  );
  imageContainer.innerHTML = "";

  productItemImages.forEach((element) => {
    const img = document.createElement("img");
    img.classList.add("product-items-image-slide");
    if (element) {
      img.setAttribute("src", element);
    }

    imageContainer.appendChild(img);
  });
}

function imageToDataUrl(image) {
  const img = document.createElement("img");
  img.setAttribute("src", image);

  const canvas = document.createElement("canvas");
  canvas.width = image.width;
  canvas.height = image.height;
  const context = canvas.getContext("2d");
  context.drawImage(img, 0, 0, canvas.width, canvas.height);

  // Convert the canvas content to a Data URL
  const dataURL = canvas.toDataURL("image/jpeg");
  return dataURL;
}

async function productItemSave(event) {
  // loading effect start
  event.target.disabled = true;

  const product = document.getElementById("productItemProductSelectInput");
  const quantity = document.getElementById("productItemQuantitySelectInput");
  const price = document.getElementById("productItemProductPriceInput");
  const weight = document.getElementById("productItemWeightSelectInput");

  if (product.value == 0) {
    ALG.openToast(
      "Warnning",
      "Please Select a product",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );

    event.target.disabled = false;
    return;
  } else if (quantity.value == "") {
    ALG.openToast(
      "Warnning",
      "Please add a quantity",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );

    event.target.disabled = false;
    return;
  } else if (price.value == "") {
    ALG.openToast(
      "Warnning",
      "Please add a price",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );

    event.target.disabled = false;
    return;
  } else if (weight.value == 0) {
    ALG.openToast(
      "Warnning",
      "Please select a weight",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );

    event.target.disabled = false;
    return;
  } else if ((productItemImages, productItemImages.length === 0)) {
    ALG.openToast(
      "Warnning",
      "Please add an image ",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );

    event.target.disabled = false;
    return;
  }

  const form = new FormData();
  form.append("product_id", product.value);
  form.append("qty", quantity.value);
  form.append("price", price.value);
  form.append("weight_id", weight.value);

  // image handle
  let tempDataUrlArray = [];

  for (let index = 0; index < productItemImages.length; index++) {
    try {
      const element = productItemImages[index];

      const imageDataUrl = await ALG.compressImageFromDataUrl(element);
      tempDataUrlArray.push(imageDataUrl);
    } catch (error) {
      console.error("error : " + error);
    }
  }
  productItemImages = tempDataUrlArray;
  previewProductListImages();
  form.append("product_image", JSON.stringify(productItemImages));

  fetch("api/productItemAdding.php", {
    method: "POST",
    body: form,
  })
    .then((response) => {
      console.log(response);
      // console.log(response.text());
      return response.text();
    })
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Product Item adding was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );
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

      event.target.disabled = false;
    })
    .catch((error) => {
      console.error(error);
    });
}

function addCategory() {
  const category = document.getElementById("addCategoryInput");
  const categoryImage = document.getElementById("addCategoryImageInput");

  if (category.value == "") {
    ALG.openToast(
      "Warnning",
      "Category is empty",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );
    return;
  } else if (categoryImage.files[0] == null) {
    ALG.openToast(
      "Warnning",
      "Category image is empty",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );

    return;
  }

  const form = new FormData();
  form.append("category_type", category.value);
  form.append("category_image", categoryImage.files[0]);

  fetch("api/categoryAdding.php", {
    method: "POST",
    body: form,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Category adding was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        category.value = "";
        categoryImage.value = "";
        document
          .getElementById("categoryImagePreviewBox")
          .setAttribute("src", "#");
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

function previewCategoryInputImage() {
  const image = document.getElementById("addCategoryImageInput");
  const categoryImagePreviewBox = document.getElementById(
    "categoryImagePreviewBox"
  );

  if (image.files && image.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      categoryImagePreviewBox.setAttribute(
        "src",
        e.target.result ? e.target.result : "#"
      );
    };

    reader.readAsDataURL(image.files[0]);
  }
}

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
