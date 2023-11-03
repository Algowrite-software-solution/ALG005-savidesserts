// initiator
const ALG = new DashboardComponents();

document.addEventListener("DOMContentLoaded", () => {
  ALG.mainNavigationController(
    "navigationSection",
    "mainContentContainer",
    () => {},
    (panel) => {
      console.log("2st callback");
      switch (panel) {
        case "productManagementPanel":
          toggleProductSection("productView");
          break;

        case "userManagementPanel":
          toggleUserSection("userView");
          break;

        default:
          console.log(panel);
          break;
      }
    }
  );

  // sidebar controls
  const icon = document.getElementById("navigationIcon");
  if (icon) {
    icon.addEventListener("click", () => {
      toggleNavigation();
    });
  }

  // defaults
  ALG.loadMainPanel(
    "productManagementPanel",
    "mainContentContainer",
    "Product Management",
    async () => {
      await ALG.addTableToContainer(
        "productViewProductSection",
        productTableDesignData,
        [100, 150, 250, 120, 120, 60, 80]
      );
    }
  );

  ALG.addTooltipDitectors("tooltip-holder");

  //test
});

// navigation
let isNavigationPanelOpned = false;
function toggleNavigation() {
  const icon = document.getElementById("navigationIcon");
  const navigationSection = document.getElementById("navigationSection");
  const contentSection = document.getElementById("contentSection");

  if (isNavigationPanelOpned) {
    //   handle the icons
    icon.classList.remove("bi-list");
    icon.classList.add("bi-x");

    // handle the sidebar
    navigationSection.classList.add("d-flex");
    navigationSection.classList.remove("d-none");

    // handle the contnet section
    contentSection.classList.add("col-md-8");
    contentSection.classList.add("col-lg-9");
    contentSection.classList.add("col-xl-10");
  } else {
    //   handle the icons
    icon.classList.remove("bi-x");
    icon.classList.add("bi-list");

    // handle the sidebar
    navigationSection.classList.add("d-none");
    navigationSection.classList.remove("d-flex");

    // handle the contnet section
    contentSection.classList.remove("col-md-8");
    contentSection.classList.remove("col-lg-9");
    contentSection.classList.remove("col-xl-10");
  }
  isNavigationPanelOpned = !isNavigationPanelOpned;
}

// user section
async function toggleUserSection(section) {
  const sections = document.getElementById("userSectionsContainer").childNodes;

  for (var i = 0; i < sections.length; i++) {
    if (sections[i].nodeType === Node.ELEMENT_NODE) {
      sections[i].classList.remove("d-block");
      sections[i].classList.add("d-none");
    }
  }

  const selectedSection = document.getElementById(section + "UserSection");
  selectedSection.classList.add("d-block");
  selectedSection.classList.remove("d-none");

  // load data accordingly
  if (section === "userView") {
    const button = document.createElement("button");
    button.innerText = "test";
    ALG.renderComponent("userViewUserSection", button, true);
  }
}

// product section
async function toggleProductSection(section) {
  const sections = document.getElementById(
    "productSectionsContainer"
  ).childNodes;

  for (var i = 0; i < sections.length; i++) {
    if (sections[i].nodeType === Node.ELEMENT_NODE) {
      sections[i].classList.remove("d-block");
      sections[i].classList.add("d-none");
    }
  }

  const selectedSection = document.getElementById(section + "ProductSection");
  selectedSection.classList.add("d-block");
  selectedSection.classList.remove("d-none");

  // load data accordingly
  if (section === "productView") {
    await ALG.addTableToContainer(
      "productViewProductSection",
      productTableDesignData,
      [100, 150, 250, 120, 120, 60, 80]
    );
  } else if (section === "categoryView") {
    await ALG.addListToContainer("categoryViewContainer", loadCategoriesData);
  } else if (section === "productAdd") {
    await addCategoriesToSelect();
  } else if (section === "weight") {
    await ALG.addListToContainer(
      "weightViewContainer",
      weightListUiDesignAdder,
      [40, 100, 60, 80]
    );
  } else if (section === "category") {
    await ALG.addListToContainer(
      "categoryViewContainer",
      loadCategoryData,
      [40, 120, 250, 80]
    );
  } else if (section === "productItem") {
    await ALG.addListToContainer("productItemViewContainer", loadProductItems);
    await loadProductsOnProductItemSelector();
    await loadWeightToProductItemSelector();
  } else if (section === "extraItem") {
    await ALG.addListToContainer(
      "extraItemViewContainer",
      extraItemTableDesignLoad,
      [60, 150, 100, 70, 100, 60, 100]
    );
  } else if (section === "setExtraItem") {
    loadProductListToExtraItemSettingUi();
    loadExtraItemsToExtraItemSettingUi();
    await ALG.addListToContainer(
      "setupExtraItemViewContainer",
      loadSetExtraItemData,
      [60, 150, 200]
    );
  }
}

// ui data updators
async function loadExtraItemsToExtraItemSettingUi() {
  const tableData = await loadExtraItem();
  const setupExtraItemSelector = document.getElementById(
    "setupExtraItemSelector"
  );
  setupExtraItemSelector.innerHTML = "";

  const option = document.createElement("option");
  option.value = 0;
  option.innerText = "select an extra item";
  setupExtraItemSelector.appendChild(option);

  tableData.forEach((element) => {
    const option = document.createElement("option");
    option.value = element.extra_id;
    option.innerText = element.extra_fruit;
    setupExtraItemSelector.appendChild(option);
  });
}

async function loadProductListToExtraItemSettingUi() {
  const tableData = await loadProductData();

  const addProductSelector = document.getElementById("setupProductSelector");
  addProductSelector.innerHTML = "";

  const option = document.createElement("option");
  option.value = 0;
  option.innerText = "select a product";
  addProductSelector.appendChild(option);

  tableData.forEach((element) => {
    const option = document.createElement("option");
    option.value = element.product_id;
    option.innerText = element.product_name;
    addProductSelector.appendChild(option);
  });
}

async function productTableDesignData() {
  const tableData = await loadProductsData();
  let designData = [];
  tableData.forEach((element) => {
    const newData = {
      id: element.product_id,
      product: element.product_name,
      description: element.product_description,
      category: element.category_type,
      ["added date"]: element.add_date,
      edit: `<i class="bi bi-pen" onclick="openProductEditModel(${element.product_id}, '${element.product_name}', '${element.product_description}', '${element.category_id}', '${element.add_date}')"></i>`,
      remove: `<i class="bi bi-x-circle" onclick="openProductRemoveModel()"></i>`,
    };

    designData.push(newData);
  });

  return designData;
}

async function addCategoriesToSelect() {
  const select = document.getElementById("productCategoryInputField");
  const categories = await loadCategoriesData();

  select.innerHTML = "";
  const defaultOption = document.createElement("option");
  defaultOption.value = 0;
  defaultOption.innerText = "Select a category";
  select.appendChild(defaultOption);

  categories.forEach((element) => {
    const option = document.createElement("option");
    option.value = element.id;
    option.innerText = element.category_type;
    select.appendChild(option);
  });
}

async function weightListUiDesignAdder() {
  const weightData = await loadWeightData();
  let preparedResultSet = [];
  weightData.forEach((element) => {
    const data = {
      id: element.weight_id,
      weight: element.weight,
      edit: `<i class="bi bi-pen" onclick="openWeightEditModel(${element.weight_id}, '${element.weight}');"></i>`,
      remove: `<i class="bi bi-x-circle" onclick="openWeightRemoveModel();"></i>`,
    };

    preparedResultSet.push(data);
  });

  return preparedResultSet;
}

async function extraItemTableDesignLoad() {
  const dataset = await loadExtraItem();
  const newListDataSet = [];

  dataset.forEach((element) => {
    const newData = {
      id: element.extra_id,
      extra_item: element.extra_fruit,
      status: element.extra_status_id,
      price: element.price,
      availability: element.extraItem_status_type,
      edit: `<i class="bi bi-pen" onclick="openExtraItemEditModel('${element.extra_id}', '${element.extra_fruit}', '${element.extra_status_id}', '${element.extraItem_status_type}', '${element.price}')"></i>`,
      remove: `<i class="bi bi-x-circle" onclick="openExtraItemRemoveModel()"></i>`,
    };
    newListDataSet.push(newData);
  });

  return newListDataSet;
}

async function loadWeightToProductItemSelector() {
  const products = await loadWeightData();
  const select = document.getElementById("productItemWeightSelectInput");
  select.innerHTML = "";

  const defaultOption = document.createElement("option");
  defaultOption.selected = true;
  defaultOption.disabled = true;
  defaultOption.value = 0;
  defaultOption.innerText = "Select a weight";
  select.appendChild(defaultOption);

  products.forEach((element) => {
    const option = document.createElement("option");
    option.value = element.weight_id;
    option.innerText = element.weight;

    select.appendChild(option);
  });
}

async function loadProductsOnProductItemSelector() {
  const products = await loadProductData();
  const select = document.getElementById("productItemProductSelectInput");
  select.innerHTML = "";

  const defaultOption = document.createElement("option");
  defaultOption.selected = true;
  defaultOption.disabled = true;
  defaultOption.value = 0;
  defaultOption.innerText = "Select a product";
  select.appendChild(defaultOption);

  products.forEach((element) => {
    const option = document.createElement("option");
    option.value = element.product_id;
    option.innerText = element.product_name;

    select.appendChild(option);
  });
}

// data loaders
async function loadExtraItem() {
  return fetch("api/extraItemView.php", {
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
      if (data.status == "success") {
        return data.results;
      } else if (data.status == "failed") {
        console.log(data.error);
        return null;
      } else {
        console.log(data);
        return null;
      }
    })
    .catch((error) => {
      console.error("Fetch error:", error);
      return null;
    });
}

async function loadProductData() {
  return fetch("api/productView.php", {
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
      if (data.status == "success") {
        return data.results;
      } else if (data.status == "failed") {
        console.log(data.error);
        return null;
      } else {
        console.log(data);
        return null;
      }
    })
    .catch((error) => {
      console.error("Fetch error:", error);
      return null;
    });
}

async function loadSetExtraItemData() {
  return fetch("api/extraItem_add_for_product.php", {
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
      if (data.status == "success") {
        const results = data.results;
        const listArray = [];

        results.forEach((element) => {
          const newData = {
            id: element.id,
            "extra item": element.fruit,
            product: element.product_name,
          };

          listArray.push(newData);
        });
        return listArray;
      } else if (data.status == "failed") {
        console.log(data.error);
        return null;
      } else {
        console.log(data);
        return null;
      }
    })
    .catch((error) => {
      console.error("Fetch error:", error);
      return null;
    });
}

async function loadProductItems() {
  return fetch("api/product_item_load.php", {
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
      if (data.status == "success") {
        const results = data.results;
        const listArray = [];

        results.forEach((element) => {
          const newData = {
            id: element.product_item_id,
            "product id": element.product_id,
            "product status id": element.product_status_id,
            quantity: element.qty,
            price: element.price,
            "weight id": element.weight_id,
            image: element["images[0]"]
              ? `<img src="${element["images[0]"]}" class="alg-list-cell-image"  />`
              : "Empty",
          };

          listArray.push(newData);
        });
        return listArray;
      } else if (data.status == "failed") {
        console.log(data.error);
        return null;
      } else {
        console.log(data);
        return null;
      }
    })
    .catch((error) => {
      console.error("Fetch error:", error);
      return null;
    });
}

async function loadCategoryData() {
  return fetch("api/categoryView.php", {
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
      if (data.status == "success") {
        const results = data.results;
        const listArray = [];

        results.forEach((element) => {
          const newData = {
            id: element.category_id,
            category: element.category_type,
            image: `<img src="${element.category_image}" class="alg-list-cell-image"  />`,
            edit: `<i class="bi bi-pen fs-4" onclick="openCategoryEditModel();"></i>`,
            delete: `<i class="bi bi-x-circle fs-4" onclick="openCategoryEditModel();"></i>`,
          };

          listArray.push(newData);
        });

        return listArray;
      } else if (data.status == "failed") {
        console.log(data.error);
        return null;
      } else {
        console.log(data);
        return null;
      }
    })
    .catch((error) => {
      console.error("Fetch error:", error);
      return null;
    });
}

async function loadWeightData() {
  return fetch("api/weightsView.php", {
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
      if (data.status == "success") {
        return data.results;
      } else if (data.status == "failed") {
        console.log(data.error);
        return null;
      } else {
        console.log(data);
        return null;
      }
    })
    .catch((error) => {
      console.error("Fetch error:", error);
      return null;
    });
}

async function loadProductsData() {
  return fetch("api/productView.php", {
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
      if (data.status == "success") {
        return data.results;
      } else if (data.status == "failed") {
        console.log(data.error);
        return null;
      } else {
        console.log(data);
        return null;
      }
    })
    .catch((error) => {
      console.error("Fetch error:", error);
      return null;
    });
}

async function loadCategoriesData() {
  return fetch("../backend/api/load_category_api.php", {
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
      if (data.status == "success") {
        return data.results;
      } else if (data.status == "failed") {
        console.log(data.error);
        return null;
      } else {
        console.log(data);
        return null;
      }
    })
    .catch((error) => {
      console.error("Fetch error:", error);
      return null;
    });
}

function test() {
  console.log("test run");
  //
  //
  //
  //
  //
  // setTimeout(() => {
  //   // const notificationSection = document.createElement("div");
  //   // notificationSection.innerHTML = "You have got an order....!";
  //   // notificationSection.style.backgroundColor = "green";
  //   // notificationSection.style.padding = "20px";
  //   // notificationSection.style.color = "white";
  //   // ALG.openModel("Alert", notificationSection);
  //   fetch("http://localhost:9001/" + "backend/api/load_category_api.php", {
  //     method: "GET", // HTTP request method
  //     headers: {
  //       "Content-Type": "application/json", // Request headers
  //     },
  //   })
  //     .then((response) => {
  //       if (!response.ok) {
  //         throw new Error(`HTTP error! Status: ${response.status}`);
  //       }
  //       return response.json(); // Parse the response body as JSON
  //     })
  //     .then((data) => {
  //       // Handle the JSON data received from the API
  //       if (data.status == "success") {
  //         const table = ALG.createTable(data.results);
  //         ALG.openToast("kavindu buruwa", table, "00:23:23", "bi-x");
  //       } else if (data.status == "failed") {
  //         console.log(data.error);
  //       } else {
  //         console.log(data);
  //       }
  //     })
  //     .catch((error) => {
  //       // Handle errors that occur during the Fetch request
  //       console.error("Fetch error:", error);
  //     });
  // }, 2000);
}
