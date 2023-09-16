class DashboardComponents {
  createTable(dataSet, parentElementId) {
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

    console.log(table);
    this.renderTable(parentElementId, table);
  }

  renderTable(parentElementId, table) {
    document.getElementById(parentElementId).appendChild(table);
  }
}

fetch(
  "http://localhost:9001/" +
    "backend/api/load_product_list_api.php?search=" +
    "Pudin" +
    "&options=" +
    JSON.stringify({
      category: "pudin",
      orderBy: "",
      orderDirection: "",
      limit: 4,
    }),
  {
    method: "GET", // HTTP request method
    headers: {
      "Content-Type": "application/json", // Request headers
    },
  }
)
  .then((response) => {
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.json(); // Parse the response body as JSON
  })
  .then((data) => {
    // Handle the JSON data received from the API
    if (data.status == "success") {
      new DashboardComponents().createTable(data.results, "tableContainer");
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
