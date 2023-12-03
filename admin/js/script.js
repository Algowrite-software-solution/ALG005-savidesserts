// review section

async function viewReviewsDataOnUi() {
  const reviews = await loadReviewData();

  const reviewStatusData = await loadReviewStatusData();

  const newReviewsData = [];
  let selectDesign = ``;
  let options = ``;

  reviews.forEach((element) => {
    let color;

    reviewStatusData.forEach((element2) => {
      let isSelected =
        element2.id === element.review_status_id ? " selected " : " ";

      color = element.rv_status === "Active" ? " bg-success " : " bg-danger ";

      const option = `<option ${isSelected} value="${element2.id}">${element2.rv_status}</option>`;
      options += option;
    });

    selectDesign += `<select class="${color} form-select" onchange="upadteReviewStatus(event, ${element.rev_id})">${options}</select>`;
    newReviewsData.push({
      "User Id": element.user_user_id,
      Name: element.full_name,
      Email: element.email,
      review: element.review,
      status: selectDesign,
    });
  });

  return newReviewsData;
}

function upadteReviewStatus(event, reviewId) {
  const form = new FormData();
  form.append("rev_id", reviewId);
  form.append("rv_status_id", event.target.value);

  fetch("api/reviewStatusUpdate.php", {
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
          "Status Successfully Updated",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        ALG.addTableToContainer(
          "reviewViewOrderSection",
          viewReviewsDataOnUi,
          [100, 150, 200, 250, 150]
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

// shipping section
function addShippingPrice() {
  const price = document.getElementById("shippingPriceInput").value;

  const form = new FormData();
  form.append("shippingPrice", price);

  fetch("api/shippingPriceUpdateProccess.php", {
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
          "Shipping Price Edited successfully",
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
    })
    .catch((error) => {
      console.error(error);
    });
}

// promotion section
function editPromotions(id) {
  const productId = document.getElementById(
    "promotionEditProductSelect" + id
  ).value;
  const weightId = document.getElementById(
    "promotionEditWeightSelect" + id
  ).value;
  const endDate = document.getElementById(
    "promotionEndDateEditInput" + id
  ).value;

  const status = document.getElementById(
    "promotionEditStatusSelect" + id
  ).value;

  const form = new FormData();
  form.append("product_id", productId);
  form.append("weight_id", weightId);
  form.append("promotion_id", id);
  form.append("end_date_time", endDate);
  form.append("promotion_status_id", status);

  fetch("api/productPromotionUpdate.php", {
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
          "Promotion Edited successfully",
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
    })
    .catch((error) => {
      console.error(error);
    });
}

async function openSinglePromotionView(
  id,
  endDate,
  productId,
  weightId,
  promotionStatusId
) {
  endDate = endDate.slice(0, -9);

  // product
  const productData = await loadProductData();
  let productsDesign = "";
  let productSelected = false;
  productData.forEach((element) => {
    productSelected = element.product_id === productId ? " selected " : "";
    productsDesign += `<option ${productSelected} value="${element.product_id}">${element.product_name}</option>`;
  });

  // weight
  const weightData = await loadWeightData();
  let weightsDesign = "";
  let weightSelected = false;
  weightData.forEach((element) => {
    weightSelected = element.product_id === weightId ? " selected " : "";
    weightsDesign += `<option  ${weightSelected} value="${element.weight_id}">${element.weight}</option>`;
  });

  // status
  const statusData = await loadPromotionStatusData();
  let promotionStatusDesign = "";
  let promotionStatusSlected = false;
  statusData.forEach((element) => {
    promotionStatusSlected =
      element[0] === promotionStatusId ? " selected " : "";
    promotionStatusDesign += `<option  ${promotionStatusSlected} value="${element[0]}">${element[1]}</option>`;
  });

  const body = `
  <div class="d-flex justify-content-center flex-column align-items-center">
    <div>
    <label for="promotionImageEditInput"><i class="p-3 fs-3 text-white bi bi-pen position-absolute"></i></label>
    <input type="file" class="d-none" id="promotionImageEditInput" />
      <img src="../resources/images/promotionImages/${id}.jpg" style="width: 100%; height: 200px; object-fit: contain;" />
    </div>
    <div class="d-flex p-3 alg-bg-dark gap-2 flex-column w-100 alg-rounded-small my-2">
      <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
        <div class=" alg-text-light w-25 text-center p-2">Id</div>
        <input class="rounded-pill form-control w-75" type="text" disabled value="${id}" />
      </div>
      <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
        <div class=" alg-text-light w-25 text-center p-2">End</div>
        <input class="rounded-pill form-control w-75" id="promotionEndDateEditInput${id}" type="date" value="${endDate}" />
      </div>
      <div class="d-flex flex-column">
        <label for="promotionEditProductSelect${id}">Product</label>
        <select name="promotionEditProductSelect" id="promotionEditProductSelect${id}" class="form-select">
        ${productsDesign}
        </select>
      </div>
      <div class="d-flex flex-column">
        <label for="promotionEditWeightSelect${id}">Weight</label>
        <select name="promotionEditWeightSelect" id="promotionEditWeightSelect${id}" class="form-select">
        ${weightsDesign}
        </select>
      </div>
      <div class="d-flex flex-column">
        <label for="promotionEditStatusSelect${id}">Weight</label>
        <select name="promotionEditStatusSelect" id="promotionEditStatusSelect${id}" class="form-select">
        ${promotionStatusDesign}
        </select>
      </div>
    </div>
  </div>
  `;

  const footerDesign = `
      <button class="btn btn-danger">Delete Promotion</button>
      <button class="alg-btn-pill" onclick="editPromotions('${id}')">Edit</button>
  `;

  ALG.openModel("Promotion : " + id, body, footerDesign);
}

function savePromotion() {
  const product = document.getElementById("promotionAddProductSelect").value;
  const weight = document.getElementById("promotionAddWeightSelect").value;
  const endData = document.getElementById("promotionAddEndDate").value;
  const image = document.getElementById("promotionAddImage").files[0];

  if (product == 0) {
    ALG.openToast(
      "Warnning",
      "Please select a product",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );
    return;
  } else if (weight == 0) {
    ALG.openToast(
      "Warnning",
      "Please select a weight",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );
    return;
  } else if (!endData) {
    ALG.openToast(
      "Warnning",
      "Please select end date",
      ALG.getCurrentTime(),
      "bi-heart",
      "Error"
    );
    return;
  }

  const form = new FormData();
  form.append("product_id", product);
  form.append("weight_id", weight);
  form.append("end_date_time", endData);
  form.append("promotion_image", image);

  fetch("api/productPromotionAdding.php", {
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
          "Promotion added successfully",
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
    })
    .catch((error) => {
      console.error(error);
    });
}

// order section
function orderStatusChange(event, id, orderId) {
  const statusId = event.target.value;

  const query = `?invoice_id=${id}&invoice_status_Id=${statusId}`;
  fetch("api/invoiceStatusUpdateProcess.php" + query, {
    method: "GET",
  })
    .then((response) => {
      return response.json();
    })
    .then(async (data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "User status updated!",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );
        openSingleOrderViewModel(orderId);
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

async function openSingleOrderViewModel(invoiceId) {
  const invoiceData = await loadOrderData(invoiceId);
  const invoiceStatusData = await loadInvoiceStatusData();

  let options = "";
  let colors = "";
  switch (invoiceData[0].invoice_status_id) {
    case "1":
      colors = " bg-warning text-dark ";
      break;
    case "2":
      colors = " bg-primary text-white ";
      break;
    case "3":
      colors = " bg-success text-white ";
      break;

    case "4":
      colors = " bg-danger text-white ";
      break;

    default:
      colors = " bg-white text-dark ";
      break;
  }

  let index = 1;
  invoiceStatusData.forEach((statusElement) => {
    selected = index == invoiceData[0].invoice_status_id ? " selected " : "";
    options += `<option ${selected} value="${index}">${statusElement[0]}</option>`;
    index++;
  });

  // invoice items
  const invioceItemData = await loadInvoiceItemData(invoiceData[0].order_id);

  let invoiceItems = ``;
  invioceItemData.forEach((itemData) => {
    let items = ``;

    for (const key in itemData) {
      if (Object.hasOwnProperty.call(itemData, key)) {
        const element = itemData[key];
        items += `<div class="w-100 d-flex border-2 border-dark">
        <div class="col-6 alg-text-white p-2 alg-bg-dark" >${key} : </div>
        <div class="col-6 alg-text-dark p-2 alg-bg-light">${element}</div>
        </div>`;
      }
    }

    invoiceItems += `<div>
      <div class="p-3 alg-bg-tan alg-rounded-small">Product Item</div>
      <div class="p-1 my-3">${items}</div>
    </div>`;
  });

  const orderDesign = `
  <div class="d-flex flex-column w-100 gap-3">
    <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
      <div class=" alg-text-light w-25 text-center p-2">id</div>
      <input class="rounded-pill form-control w-75" type="text" disabled value="${invoiceId}" />
    </div>
    <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
      <div class=" alg-text-light w-25 text-center p-2">order data</div>
      <input class="rounded-pill form-control w-75" type="text" disabled value="${invoiceData[0].order_date}" />
    </div>
    <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
      <div class=" alg-text-light w-25 text-center p-2">Amount</div>
      <input class="rounded-pill form-control w-75" type="text" disabled value="LKR ${invoiceData[0].pay_amout}" />
    </div>
    <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
      <div class=" alg-text-light w-25 text-center p-2">Amount</div>
      <select onchange="orderStatusChange(event, '${invoiceData[0].invoice_id}', '${invoiceData[0].order_id}')" class="form-select ${colors}">
        ${options}
      </select>
    </div>

    <hr />

    <div class="p-2 d-flex flex-column">
      ${invoiceItems}
    </div>
  </div>
  `;

  ALG.openModel("Model", orderDesign, "&nbsp;");
}

// product section
function changeUserStatus(event, userId) {
  const statusId = event.target.value;

  const query = `?u_id=${userId}&s_id=${statusId}`;
  fetch("api/userStatusUpdate.php" + query, {
    method: "GET",
  })
    .then((response) => {
      return response.json();
    })
    .then(async (data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "User status updated!",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        await ALG.addTableToContainer(
          "userViewUserSection",
          loadUserDataToUserManagement,
          [60, 250, 100, 100, 120, 100, 150]
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

function openProductRemoveModel(productId) {
  ALG.openModel(
    "Remove Product",
    "Do you really want to remove this product?",
    `<button  class="alg-btn-pill" data-bs-dismiss="modal" aria-label="Close" onclick="removeProductProcess('${productId}')">Remove</button>`
  );
}

function removeProductProcess(id) {
  fetch("api/productDelete.php?product_id=" + id, {
    method: "GET",
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Product remove was successfull",
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
function removeExtraItemData(id) {
  console.log(id);
  fetch("api/extraFruitRemove.php?id=" + id, {
    method: "GET",
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Extra Item Remove was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        ALG.addListToContainer(
          "setupExtraItemViewContainer",
          loadSetExtraItemData,
          [60, 150, 200, 80]
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

function openExtraItemRemoveModel(id) {
  ALG.openModel(
    "Remove Extra Item",
    "do you really want to remove this extra item",
    `<button class="alg-btn-pill" data-bs-dismiss="modal" aria-label="Close" onclick="removeExtraItemData('${id}')">Remove</button>`
  );
}

async function openExtraItemEditModel(id, extraItem, statusId, status, price) {
  // status select design
  const extraItemStatusData = await loadExtraItemStatus();
  let statusSelect = "";
  extraItemStatusData.forEach((element) => {
    let selected = element.extra_status_id === statusId ? " selected " : " ";
    const option = `<option ${selected} value="${element.extra_status_id}">${element.extra_status}</option>`;
    statusSelect += option;
  });

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
        <select name="" id="extraItemEditStatusInput${id}" class="form-select rounded-pill w-75">
          ${statusSelect}
        </select>
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

function removeProductItemImage(url, id) {
  const confirmation = confirm("Are you sure you want to remove this image?");
  if (confirmation) {
    const form = new FormData();
    form.append("image_path", url);

    fetch("api/productItemImageDelete.php", {
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
            "Image Removed Successfully",
            ALG.getCurrentTime(),
            "bi-heart",
            "Success"
          );

          document.getElementById("productItemEditButton" + id).click();
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
}

async function editProductItemImage(event, url, id) {
  const file = event.target.files[0];
  let dataURL;
  await ALG.imageFileToDataURL(file, async (imageUrl) => {
    dataURL = await ALG.compressImageFromDataUrl(imageUrl);

    const form = new FormData();
    form.append("image_url", url);
    form.append("image", dataURL);

    fetch("api/productItemImageUpdate.php", {
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
            "Image Edited Successfully",
            ALG.getCurrentTime(),
            "bi-heart",
            "Success"
          );

          document.getElementById("productItemEditButton" + id).click();
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
  });
}

async function openProductItemEditModel(
  id,
  productId,
  productStatusId,
  quantity,
  price,
  weightId
) {
  const products = await loadProductData();
  let productSelectOptions = ``;
  products.forEach((element) => {
    const selected = element.product_id === productId ? " selected " : "";
    productSelectOptions += `<option ${selected} value="${element.product_id}" id="${element.product_id}">${element.product_name}</option>`;
  });

  const productItemsData = await loadProductItemsData();
  let imagesDesgin = ``;
  productItemsData.forEach((element) => {
    if (element.product_item_id === id) {
      let count = 0;
      element.images.forEach((imageElement) => {
        let tmpId = id + count;
        imagesDesgin += `<div class="position-relative">
          <div class="position-absolute" style="right: 0;">
            <i class=" bi  bi-x-circle-fill fs-1 alg-text-light" style="cursor: pointer;" onclick="removeProductItemImage('${imageElement}', '${id}')"></i>
            <label for="editProductItemImageInput${tmpId}"><i class=" bi  bi-pen fs-1 alg-text-light" style=" cursor:pointer;"></i></label>
            <input onchange="editProductItemImage(event, '${imageElement}', '${id}')" type="file" class="d-none" id="editProductItemImageInput${tmpId}" />
          </div>
          <img style="width: 300px; height: 250px; object-fit: contain;" class="rounded-2 m-2" src="${imageElement}?code=${Math.random()}" alt="image of product" />  
        </div>`;

        count++;
      });
    }
  });

  const weights = await loadWeightData();
  let weightsSelectOptions = ``;
  weights.forEach((element) => {
    const selected = element.weight_id === weightId ? " selected " : "";
    weightsSelectOptions += `<option ${selected} value="${element.weight_id}" id="${element.weight_id}">${element.weight}</option>`;
  });

  const productStatuses = await loadProductStatusData();
  let productStatusesSelectOptions = ``;
  productStatuses.forEach((element) => {
    const selected = element.status_id === productStatusId ? " selected " : "";
    productStatusesSelectOptions += `<option ${selected} value="${element.status_id}" id="${element.status_id}">${element.status_type}</option>`;
  });

  const modelBodyDesign = `
                          <div class="d-flex flex-column w-100 gap-3">
                            <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
                                <div class=" alg-text-light w-25 text-center p-2">id</div>
                                <input class="rounded-pill form-control w-75" type="text" disabled value="${id}" />
                            </div>
                            <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
                                <div class=" alg-text-light w-25 text-center p-2">Product Id</div>
                                <select class="rounded-pill form-control w-75" name="productItemUpdateProductsSelect" id="productItemUpdateProductsSelect">
                                    ${productSelectOptions}
                                </select>
                            </div>
                            <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
                                <div class=" alg-text-light w-25 text-center p-2">Product Status Id</div>
                                <select class="rounded-pill form-control w-75" name="productItemUpdateStatusSelect" id="productItemUpdateStatusSelect">
                                    ${productStatusesSelectOptions}
                                </select>
                            </div>
                            <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
                                <div class=" alg-text-light w-25 text-center p-2">Quantity</div>
                                <input class="rounded-pill form-control w-75" type="text" id="productItemUpdateQuantitySelect" value="${quantity}" />
                            </div>
                            <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
                                <div class=" alg-text-light w-25 text-center p-2">Price</div>
                                <input class="rounded-pill form-control w-75" type="text" id="productItemUpdatePriceSelect" value="${price}" />
                            </div>
                            <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
                                <div class=" alg-text-light w-25 text-center p-2">Weight</div>
                                <select class="rounded-pill form-control w-75" name="productItemUpdateWeightSelect" id="productItemUpdateWeightSelect">
                                    ${weightsSelectOptions}
                                </select>
                            </div>

                            <div class="p-2 d-flex rounded-2 alg-bg-dark my-2 overflow-auto">
                              ${imagesDesgin}
                            </div>
                          </div>`;
  const modelFooterDesign = `<button onclick="updateProductItem('${id}')" class="alg-btn-pill">Edit</button>`;

  ALG.openModel("Product Item Edit", modelBodyDesign, modelFooterDesign);
}

function updateProductItem(id) {
  alert(id);
  const productId = document.getElementById(
    "productItemUpdateProductsSelect"
  ).value;
  const status = document.getElementById("productItemUpdateStatusSelect").value;
  const quantity = document.getElementById(
    "productItemUpdateQuantitySelect"
  ).value;
  const price = document.getElementById("productItemUpdatePriceSelect").value;
  const weight = document.getElementById("productItemUpdateWeightSelect").value;

  const form = new FormData();
  form.append("id", id);
  form.append("qty", quantity);
  form.append("price", price);
  form.append("product_status_id", status);
  form.append("product_product_id", productId);
  form.append("weight_id", weight);

  fetch("api/productItemUpdate.php", {
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
          "Product Item Update was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        ALG.addTableToContainer("productItemViewContainer", loadProductItems);
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

function openProductItemRemoveModel(id) {
  const modelBodyDesign = `Do you want to remove the product item with all of its images  ${id}`;
  const modelFooterDesign = `<button class="btn btn-danger"  data-bs-dismiss="modal" aria-label="Close" onclick="deleteProductItem('${id}')">yes</button>`;

  ALG.openModel("Product Item Remove", modelBodyDesign, modelFooterDesign);
}

function deleteProductItem(id) {
  fetch("api/productItemDelete.php?id=" + id, {
    method: "GET",
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
          "Product Item delete was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        ALG.addTableToContainer("productItemViewContainer", loadProductItems);
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

function openCategoryRemoveModel(categoryId, imagePath) {
  ALG.openModel(
    "Remove Category",
    "Do you really want to remove this category?",
    `<button  class="alg-btn-pill" data-bs-dismiss="modal" aria-label="Close" onclick="removeCategoryProcess('${categoryId}', '${imagePath}')">Remove</button>`
  );
}

function removeCategoryProcess(id, imagePath) {
  fetch(
    "api/categoryDelete.php?category_id=" +
      id +
      "&category_image_path=" +
      imagePath,
    {
      method: "GET",
    }
  )
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      if (data.status == "success") {
        ALG.openToast(
          "Success",
          "Category remove was successfull",
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

        ALG.addTableToContainer(
          "categoryViewContainer",
          loadCategoryData,
          [40, 120, 250, 80, 80]
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

async function openCategoryEditModel(categoryId, categoryType, categoryImage) {
  const modelBodyDesign = `
    <div class="d-flex flex-column w-100 gap-3">
      <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
        <div class=" alg-text-light w-25 text-center p-2">id</div>
        <input class="rounded-pill form-control w-75" type="text" disabled value="${categoryId}" />
      </div>
      <div class=" alg-bg-darker rounded-pill d-flex w-100 ">
        <div class=" alg-text-light w-25 text-center p-2">Category</div>
        <input class="rounded-pill form-control w-75" id="categoryEditInput${categoryId}" type="text" value="${categoryType}" />
      </div>
      <div class=" alg-bg-darker alg-rounded-small d-flex w-100 flex-column">
        <div class=" alg-text-light w-25 text-center p-2">Image</div>
        <div class="alg-bg-light p-2 w-100 d-flex justify-content-center">
          <img id="categoryEditImageContainer" style="width: 200px; height: 200px; object-fit: cover;" class="rounded-pill" src="${categoryImage}" />
        </div>
        <input onchange="selectCategoryImage(event)" type="file" id="categoryImageEditInput${categoryId}" class="form-control" />
      </div>
    </div>  
  `;
  const modelFooterDesign = `<button data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger" onclick="editCategory(${categoryId})">Edit</button>`;

  ALG.openModel("Category Delete", modelBodyDesign, modelFooterDesign);
}

// let categoryUpdatedImage;
// function selectCategoryImage() {}

let tempCategoryEditImage = "";
function selectCategoryImage(event) {
  const image = event.target.files[0];
  ALG.imageFileToDataURL(image, (dataURL) => {
    tempCategoryEditImage = dataURL;
    document
      .getElementById("categoryEditImageContainer")
      .setAttribute("src", tempCategoryEditImage);
  });
}

function editCategory(id) {
  const category = document.getElementById("categoryEditInput" + id).value;

  const form = new FormData();
  form.append("id", id);
  form.append("category_type", category);
  form.append("image", tempCategoryEditImage);

  fetch("api/categoryUpdate.php", {
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
          "Category Update was successfull",
          ALG.getCurrentTime(),
          "bi-heart",
          "Success"
        );

        tempCategoryEditImage = "";

        ALG.addTableToContainer(
          "categoryViewContainer",
          loadCategoryData,
          [40, 120, 250, 80]
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
