// product section
function editProduct(id) {
  const description = document.getElementById(
    "productEditDescriptionInput" + id
  ).value;
  const product = document.getElementById("productEditProductInput" + id).value;
  const categoryId = document.getElementById(
    "productEditCategoryInput" + id
  ).value;

  const form = new FormData();
  form.append("product_id", id);
  form.append("description", description);
  form.append("product_name", product);
  form.append("category_id", categoryId);

  fetch("api/productUpdate.php", {
    method: "POST",
    body: form,
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Product Update was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        ALG.addTableToContainer(
          "productViewProductSection",
          productTableDesignData,
          [100, 150, 250, 120, 120, 60, 80]
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
    })
    .catch((error) => {
      console.error(error);
    });
}

function openProductRemoveModel() {
  ALG.openModel(
    "Remove Product",
    "do you really want to remove this product",
    `<button  class="alg-btn-pill" data-bs-dismiss="modal" aria-label="Close" onclick="alert('product removed removed')">Remove</button>`
  );
}

function openProductEditModel(id, product, description, category, addedDate) {
  // design
  const design = `
    <div class="d-flex flex-column w-100 gap-3">
      <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
        <div class=" alg-text-light w-25 text-center p-2">id</div>
        <input class="rounded-pill form-control w-75" type="text" disabled value="${id}" />
      </div>
      <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
        <div class=" alg-text-light w-25 text-center p-2">product</div>
        <input id="productEditProductInput${id}" class="rounded-pill form-control w-75" type="text" value="${product}" />
      </div>
      <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
        <div class=" alg-text-light w-25 text-center p-2">category</div>
        <input id="productEditCategoryInput${id}" class="rounded-pill form-control w-75" type="text" value="${category}" />
      </div>
      <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
        <div class=" alg-text-light w-25 text-center p-2">description</div>
        <input id="productEditDescriptionInput${id}" class="rounded-pill form-control w-75" type="text" value="${description}" />
      </div>
      <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
        <div class=" alg-text-light w-25 text-center p-2">addedDate</div>
        <input disabled class="rounded-pill form-control w-75" type="text" value="${addedDate}" />
      </div>
    </div>
  `;

  ALG.openModel(
    "Edit Product",
    design,
    `<button data-bs-dismiss="modal" aria-label="Close" class="alg-btn-pill" onclick="editProduct(${id})">Edit</button>`
  );
}

// weight section
function editWeight(id) {
  const weight = document.getElementById("weightEditWeightInput" + id).value;

  const form = new FormData();
  form.append("id", id);
  form.append("newWeight", weight);

  fetch("api/weightUpdate.php", {
    method: "POST",
    body: form,
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Weight Update was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        ALG.addListToContainer(
          "weightViewContainer",
          weightListUiDesignAdder,
          [40, 100, 60, 80]
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
    })
    .catch((error) => {
      console.error(error);
    });
}

function openWeightRemoveModel() {
  ALG.openModel(
    "Remove Weight",
    "do you really want to remove this Weight",
    `<button  class="alg-btn-pill" data-bs-dismiss="modal" aria-label="Close" onclick="alert('weight removed')">Remove</button>`
  );
}

function openWeightEditModel(id, weight) {
  // design
  const design = `
    <div class="d-flex flex-column w-100 gap-3">
      <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
        <div class=" alg-text-light w-25 text-center p-2">id</div>
        <input class="rounded-pill form-control w-75" type="text" disabled value="${id}" />
      </div>
      <div class="alg-bg-darker rounded-pill d-flex w-100 rounded-pill">
        <div class=" alg-text-light w-25 text-center p-2">weight</div>
        <input id="weightEditWeightInput${id}" class="form-control rounded-pill w-75" type="text" placeholder="please add the weight value" value="${weight}"/>
      </div>
    </div>
  `;

  ALG.openModel(
    "Edit Weight",
    design,
    `<button data-bs-dismiss="modal" aria-label="Close" class="alg-btn-pill" onclick="editWeight(${id})">Edit</button>`
  );
}

// extra item
function setupExtraItem() {
  const product = document.getElementById("setupProductSelector").value;
  const extraItem = document.getElementById("setupExtraItemSelector").value;

  if (product == 0) {
    ALG.openToast(
      "Warnning",
      "Please select a product",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );
    return;
  } else if (extraItem == 0) {
    ALG.openToast(
      "Warnning",
      "Please select a extra item",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );
    return;
  }

  const form = new FormData();
  form.append("ad_product_id", product);
  form.append("ad_extra_id", extraItem);

  fetch("api/extraItem_add_for_product.php", {
    method: "POST",
    body: form,
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Extra item set up successful",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        ALG.addListToContainer(
          "setupExtraItemViewContainer",
          loadSetExtraItemData,
          [60, 150, 200]
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
    })
    .catch((error) => {
      console.error(error);
    });
}

function editExtraItem(id) {
  const extraItem = document.getElementById(
    "extraItemEditExtraItemInput" + id
  ).value;
  const status = document.getElementById("extraItemEditStatusInput" + id).value;
  const price = document.getElementById("extraItemEditPriceInput" + id).value;

  const form = new FormData();
  form.append("id", id);
  form.append("fruit", extraItem);
  form.append("extra_status_id", status);
  form.append("price", price);

  fetch("api/extraItemUpdate.php", {
    method: "POST",
    body: form,
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Weight Update was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        ALG.addListToContainer(
          "extraItemViewContainer",
          extraItemTableDesignLoad,
          [60, 150, 100, 70, 100, 60, 100]
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
    })
    .catch((error) => {
      console.error(error);
    });
}

function openExtraItemRemoveModel() {
  ALG.openModel(
    "Remove Extra Item",
    "do you really want to remove this extra item",
    `<button class="alg-btn-pill" data-bs-dismiss="modal" aria-label="Close" onclick="alert('extra item removed')">Remove</button>`
  );
}

function openExtraItemEditModel(id, extraItem, statusId, status, price) {
  // design
  const design = `
    <div class="d-flex flex-column w-100 gap-3">
      <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
        <div class=" alg-text-light w-25 text-center p-2">id</div>
        <input class="rounded-pill form-control w-75" type="text" disabled value="${id}" />
      </div>
      <div class="alg-bg-darker rounded-pill d-flex w-100 rounded-pill">
        <div class=" alg-text-light w-25 text-center p-2">extra item</div>
        <input id="extraItemEditExtraItemInput${id}" class="form-control rounded-pill w-75" type="text" placeholder="please add the extra item value" value="${extraItem}"/>
      </div>
      <div class="alg-bg-darker rounded-pill d-flex w-100 rounded-pill">
        <div class=" alg-text-light w-25 text-center p-2">status</div>
        <input id="extraItemEditStatusInput${id}" class="form-control rounded-pill w-75" type="text" placeholder="please add the status value" value="${statusId}"/>
      </div>
      <div class="alg-bg-darker rounded-pill d-flex w-100 rounded-pill">
        <div class=" alg-text-light w-25 text-center p-2">price</div>
        <input id="extraItemEditPriceInput${id}" class="form-control rounded-pill w-75" type="text" placeholder="please add the price" value="${price}"/>
      </div>
    </div>
  `;

  ALG.openModel(
    "Edit Weight",
    design,
    `<button data-bs-dismiss="modal" aria-label="Close" class="alg-btn-pill" onclick="editExtraItem('${id}')">Edit</button>`
  );
}

function addExtraItem(event) {
  const extraItem = document.getElementById("extraItemInputField").value;
  const price = document.getElementById("extraItemPriceInputField").value;

  if (!extraItem || extraItem == "") {
    ALG.openToast(
      "Invalid Input",
      "Extra item is invalid",
      ALG.getCurrentTime(),
      "",
      "Error"
    );
    return;
  }

  if (!price || price == "") {
    ALG.openToast(
      "Invalid Input",
      "Price is invalid",
      ALG.getCurrentTime(),
      "",
      "Error"
    );
    return;
  }

  // form
  const form = new FormData();
  form.append("fruit", extraItem);
  form.append("price", price);

  fetch("api/extraItemAdding.php", {
    method: "POST",
    body: form,
  })
    .then((response) => {
      console.log(response);
      // console.log(response.text());
      return response.json();
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
        ALG.addListToContainer("extraItemViewContainer", loadExtraItem);
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
      return response.json();
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
