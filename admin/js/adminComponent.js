class DashboardComponents {
  constructor() {
    // model
    this.model = new bootstrap.Modal("#dashBoardModel");

    // toast
    this.toastBootstrap = bootstrap.Toast.getOrCreateInstance(
      document.getElementById("dashBoardToast")
    );
  }

  // modal creator
  openModel(modelTitle = null, modelBody = null, modelFooter = null) {
    this.model.show();
    modelTitle
      ? (document.getElementById("modelTitle").innerText = modelTitle)
      : null;

    modelBody
      ? document.getElementById("modelBody").appendChild(modelBody)
      : null;

    modelFooter
      ? (document.getElementById("modelFooter").innerHTML = modelFooter)
      : null;
  }

  closeModel() {
    this.model.hide();
  }

  // toast creator
  openToast(
    toastTitle = null,
    toastBody = null,
    toastTime = "00:00:00",
    toastIcon = "bi-heart"
  ) {
    this.toastBootstrap.show();
    toastTitle
      ? (document.getElementById("toastTitle").innerText = toastTitle)
      : null;

    toastBody
      ? ((document.getElementById("toastBody").innerHTML = ""),
        document.getElementById("toastBody").appendChild(toastBody))
      : null;

    toastTime
      ? (document.getElementById("toastTime").innerHTML = toastTime)
      : null;

    toastIcon
      ? (document.getElementById("toastIcon").classList = [
          "bi",
          toastIcon,
          "text-dark",
          "mx-1",
        ])
      : null;
  }

  // create a table
  createTable(dataSet) {
    let tableHeader = [];
    let tableRows = [];

    dataSet.forEach((element) => {
      tableHeader = [];

      let row = [];
      for (const key in element) {
        if (element.hasOwnProperty(key)) {
          tableHeader.push(key);
          row.push(element[key]);
        }
      }
      tableRows.push(row);
    });

    dataSet.forEach((element) => {
      tableHeader = [];
      for (const key in element) {
        if (element.hasOwnProperty(key)) {
          tableHeader.push(key);
        }
      }
    });

    // create header
    let headerDesign = document.createElement("div");
    headerDesign.classList.add("alg-table-header-container");
    tableHeader.forEach((element) => {
      const headerCell = document.createElement("div");
      headerCell.classList.add("alg-table-header-cell");
      headerCell.innerText = element;
      headerDesign.appendChild(headerCell);
    });

    // create body
    let bodyDesign = document.createElement("div");
    bodyDesign.classList.add("alg-table-body-container");
    tableRows.forEach((element) => {
      let bodyRow = document.createElement("div");
      bodyRow.classList.add("alg-table-body-row");
      element.forEach((element) => {
        const bodyCell = document.createElement("div");
        bodyCell.classList.add("alg-table-body-cell");
        bodyCell.innerText = element;
        bodyRow.appendChild(bodyCell);
      });
      bodyDesign.appendChild(bodyRow);
    });

    // combine table
    const table = document.createElement("div");
    table.classList.add("alg-table");

    table.appendChild(headerDesign);
    table.appendChild(bodyDesign);

    return table;
  }

  // create a list
  createList(dataSet) {
    let listHeader = [];
    let listRows = [];

    dataSet.forEach((element) => {
      listHeader = [];

      let row = [];
      for (const key in element) {
        if (element.hasOwnProperty(key)) {
          listHeader.push(key);
          row.push(element[key]);
        }
      }
      listRows.push(row);
    });

    dataSet.forEach((element) => {
      listHeader = [];
      for (const key in element) {
        if (element.hasOwnProperty(key)) {
          listHeader.push(key);
        }
      }
    });

    // create header
    let headerDesign = document.createElement("div");
    headerDesign.classList.add("alg-list-header-container");
    listHeader.forEach((element) => {
      const headerBlock = document.createElement("div");
      headerBlock.classList.add("alg-list-header-block");
      headerBlock.innerText = element;
      headerDesign.appendChild(headerBlock);
    });

    // create body
    let bodyDesign = document.createElement("div");
    bodyDesign.classList.add("alg-list-body-container");
    listRows.forEach((element) => {
      let bodyRow = document.createElement("div");
      bodyRow.classList.add("alg-list-body-row");
      element.forEach((element) => {
        const bodyBlock = document.createElement("div");
        bodyBlock.classList.add("alg-list-body-block");
        bodyBlock.innerText = element;
        bodyRow.appendChild(bodyBlock);
      });
      bodyDesign.appendChild(bodyRow);
    });

    // combine list
    const list = document.createElement("div");
    list.classList.add("alg-list");

    list.appendChild(headerDesign);
    list.appendChild(bodyDesign);

    return list;
  }

  // render an element to the document
  renderComponent(parentElementId, component) {
    document.getElementById(parentElementId).appendChild(component);
  }
}

// test
//
//
//
//
//
//
// const ALG = new DashboardComponents();
// test
//
//
//
//
//
loadProducts();
function loadProducts(
  searchTerm = "",
  category = "",
  orderBy = "price",
  orderDirection = "high to low",
  limit = 10
) {
  fetch("http://localhost:9001/" + "backend/api/load_category_api.php", {
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
        const table = ALG.createTable(data.results);
        ALG.renderComponent("tableContainer", table);

        setTimeout(() => {
          ALG.openModel("Hellow World", ALG.createList(data.results));
        }, 2000);

        setTimeout(() => {
          ALG.closeModel();
        }, 5000);

        setTimeout(() => {
          ALG.openToast(
            "something",
            "<h1>Who AM I</h1>",
            "01:20:37",
            "bi-emoji-wink-fill"
          );
        }, 7000);
      } else if (data.status == "failed") {
        console.log(data.error);
      } else {
        console.log(data);
      }
    })
    .catch((error) => {
      // Handle errors that occur during the Fetch request
      console.error("Fetch error:", error);
    });
}

const testButon = document.createElement("button");
testButon.innerHTML = "somethign";
ALG.openToast("Who is this toast", testButon, "01:20:37", "bi-emoji-wink-fill");
setTimeout(() => {
  testButon.innerHTML = "betterword";
  ALG.openToast(
    "Who is this toast",
    testButon,
    "01:20:37",
    "bi-emoji-wink-fill"
  );
}, 2333);
