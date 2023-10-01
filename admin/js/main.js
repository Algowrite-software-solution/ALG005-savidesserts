// initiator
const ALG = new DashboardComponents();

document.addEventListener("DOMContentLoaded", () => {
  ALG.mainNavigationController(
    "navigationSection",
    "mainContentContainer",
    () => {},
    () => {
      toggleProductSection("productView");
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
    loadProductsData
  );
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
    await loadProductsData();
  } else if (section === "categoryView") {
    loadCategoriesList();
  } else if (section === "productAdd") {
    await addCategoriesToSelect();
  }
}

// ui data updators
async function loadCategoriesList() {
  const tableData = await loadCategories();
  const userTable = ALG.createList(tableData);
  ALG.renderComponent("categoryViewProductSection", userTable, true);
}

async function addCategoriesToSelect() {
  const select = document.getElementById("productCategoryInputField");
  const categories = await loadCategories();

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

// data loaders
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
        const userTable = ALG.createTable(data.results);
        ALG.renderComponent("productViewProductSection", userTable, true);
      } else if (data.status == "failed") {
        console.log(data.error);
      } else {
        console.log(data);
      }
    })
    .catch((error) => {
      console.error("Fetch error:", error);
    });
}

async function loadCategories() {
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
