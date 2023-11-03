class DashboardComponents {
  constructor() {
    // properties
    this.activeDropdown = null;
    this.mainNavigationBtns;
    // model
    this.model = new bootstrap.Modal("#dashBoardModel");

    // toast
    this.toastBootstrap = bootstrap.Toast.getOrCreateInstance(
      document.getElementById("dashBoardToast")
    );
  }

  // image compressor
  async compressImageFromDataUrl(dataURL, quality = 0.3) {
    return await new Promise((resolve, reject) => {
      const img = new Image();
      img.src = dataURL;

      img.onload = function () {
        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");

        canvas.width = img.width;
        canvas.height = img.height;

        // Draw the original image on the canvas
        ctx.drawImage(img, 0, 0, img.width, img.height);

        // Convert the canvas to a Blob with the specified quality
        canvas.toBlob(
          function (blob) {
            fileToDataURL(blob, (compressedDataURL) => {
              resolve(compressedDataURL);
            });
          },
          "image/jpeg",
          quality
        );
      };

      function fileToDataURL(file, callback) {
        const reader = new FileReader();

        reader.onload = function (event) {
          const dataURL = event.target.result;
          callback(dataURL);
        };

        reader.readAsDataURL(file);
      }
    });
  }

  // dispose opened effect
  disposeOpnedPanel() {
    this.activeDropdown.dispose();
  }

  // dropdown controller
  openDropdown(event, content) {
    const dropdownElement = document.getElementById("dropdown");
    const dropdownVisibleContent = dropdownElement.childNodes[1];
    dropdownVisibleContent.style.translate = "-45% 0";
    dropdownVisibleContent.innerHTML = "";

    content instanceof Element
      ? dropdownVisibleContent.appendChild(content)
      : (dropdownVisibleContent.innerHTML = content);

    event.target.appendChild(dropdownElement);

    const dropdown = new bootstrap.Dropdown(dropdownElement);
    this.activeDropdown = dropdown;
    dropdown.show();
  }

  // main navigation panel content arranger
  mainNavigationController(
    navigationPanelId,
    mainContainerId,
    callback = () => {},
    passdownCallback = () => {}
  ) {
    this.mainNavigationBtns = document
      .getElementById(navigationPanelId)
      .querySelectorAll(".main-navigation-panel-btn");

    this.mainNavigationBtns.forEach((element) => {
      element.addEventListener("click", () => {
        const requestedPanel = element.dataset.algmainnavigationpanel;
        const requestedPaneltitle = element.dataset.algmainnavigationpaneltitle;

        this.loadMainPanel(
          requestedPanel,
          mainContainerId,
          requestedPaneltitle,
          passdownCallback(requestedPanel)
        );
      });
    });

    // callback
    callback();
  }

  loadMainPanel(requestedPanel, mainContainerId, title, callback = () => {}) {
    const mainContainer = document.getElementById(mainContainerId);
    const mainContainerTitle = document.getElementById(
      "mainContentContainerTitle"
    );
    fetch("components/mainNavigationPanels/" + requestedPanel + ".php", {
      method: "GET",
    })
      .then((response) => response.text())
      .then((data) => {
        mainContainerTitle.innerText = title;

        mainContainer.innerHTML = "";
        mainContainer.innerHTML = data;

        // callback
        try {
          callback();
        } catch (error) {
          console.log("error");
        }
      });
  }

  // listners
  addTooltipDitectors(elementType) {
    const elements = document.querySelectorAll("[data-" + elementType + "]");
    elements.forEach((element) => {
      element.addEventListener("mouseover", (event) => {
        const contentText = element.getAttribute("data-" + elementType);
        ALG.openTooltip(event, contentText);
      });
    });
  }

  // tooltipcreator

  openTooltip(event, innerContent) {
    if (!innerContent) {
      return;
    }

    const tooltip = document.querySelector("#tooltip");
    const element = event.target;

    // set popper content
    tooltip.childNodes[1].innerHTML = innerContent;

    const popperInstance = Popper.createPopper(element, tooltip, {
      placement: "bottom",
    });

    function show() {
      tooltip.setAttribute("data-show", "");
      popperInstance.update();
    }

    function hide() {
      tooltip.removeAttribute("data-show");
    }

    const showEvents = ["mouseenter", "focus"];
    const hideEvents = ["mouseleave", "blur"];

    showEvents.forEach((event) => {
      element.addEventListener(event, show);
    });

    hideEvents.forEach((event) => {
      element.addEventListener(event, hide);
    });
  }

  // modal creator
  openModel(modelTitle = null, modelBody = null, modelFooter = null) {
    this.model.show();
    modelTitle
      ? (document.getElementById("modelTitle").innerText = modelTitle)
      : null;

    modelBody
      ? modelBody instanceof Element
        ? document.getElementById("modelBody").appendChild(modelBody)
        : (document.getElementById("modelBody").innerHTML = modelBody)
      : null;

    modelFooter
      ? modelBody instanceof Element
        ? document.getElementById("modelFooter").appendChild(modelFooter)
        : (document.getElementById("modelFooter").innerHTML = modelFooter)
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
    toastIcon = "bi-heart",
    type = "Info"
  ) {
    // set type
    switch (type) {
      case "Success":
        document.getElementById("toastTitle").style.color = "green";
        break;
      case "Info":
        document.getElementById("toastTitle").style.color = "blue";
        break;
      case "Error":
        document.getElementById("toastTitle").style.color = "red";
        break;
      case "Alert":
        document.getElementById("toastTitle").style.color = "yellow";
        break;

      default:
        break;
    }

    toastTitle
      ? (document.getElementById("toastTitle").innerText = toastTitle)
      : null;

    if (toastBody) {
      document.getElementById("toastBody").innerHTML = "";
      if (typeof toastBody === "object" && toastBody !== null) {
        let textToType = "";
        for (let key in toastBody) {
          if (toastBody.hasOwnProperty(key)) {
            textToType += key + ": " + toastBody[key] + "<br>";
          }
        }
        document.getElementById("toastBody").innerHTML = textToType;
      } else {
        document.getElementById("toastBody").innerHTML = toastBody;
      }
    } else {
      null;
    }

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

    this.toastBootstrap.show();
  }

  // create a table
  createTable(dataSet, collumnLengths = null) {
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
    let headerCount = 0;
    tableHeader.forEach((element) => {
      const headerBlock = document.createElement("div");
      headerBlock.classList.add("alg-table-header-cell");
      if (collumnLengths) {
        headerBlock.style.width = collumnLengths[headerCount] + "px";
        headerCount++;
      } else {
        headerBlock.style.flexGrow = "1";
        headerBlock.style.width = "150px";
      }
      headerBlock.innerText = element;
      headerDesign.appendChild(headerBlock);
    });

    // create body
    let bodyDesign = document.createElement("div");
    bodyDesign.classList.add("alg-table-body-container");
    tableRows.forEach((element) => {
      let bodyRow = document.createElement("div");
      bodyRow.classList.add("alg-table-body-row");
      let bodyCount = 0;
      element.forEach((element) => {
        const bodyCell = document.createElement("div");
        bodyCell.classList.add("alg-table-body-cell");
        if (collumnLengths) {
          bodyCell.style.width = collumnLengths[bodyCount] + "px";
          bodyCount++;
        } else {
          bodyCell.style.flexGrow = "1";
          bodyCell.style.width = "150px";
        }
        bodyCell.innerHTML = element;
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
  createList(dataSet, collumnLengths = null) {
    let listHeader = [];
    let listRows = [];

    if (dataSet === null) {
      this.openToast(
        "no data to show",
        "Invalid data row count",
        this.getCurrentTime(),
        "",
        "Alert"
      );
      const filler = document.createElement("p");
      filler.innerText = "no row data to show";
      return filler;
    }

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
    let headerCount = 0;
    listHeader.forEach((element) => {
      const headerBlock = document.createElement("div");
      headerBlock.classList.add("alg-list-header-block");
      if (collumnLengths) {
        headerBlock.style.width = collumnLengths[headerCount] + "px";
        headerCount++;
      } else {
        headerBlock.style.flexGrow = "1";
        headerBlock.style.width = "150px";
      }

      headerBlock.innerText = element;
      headerDesign.appendChild(headerBlock);
    });

    // create body
    let bodyDesign = document.createElement("div");
    bodyDesign.classList.add("alg-list-body-container");
    listRows.forEach((element) => {
      let bodyRow = document.createElement("div");
      bodyRow.classList.add("alg-list-body-row");
      let bodyCount = 0;
      element.forEach((element) => {
        const bodyBlock = document.createElement("div");
        bodyBlock.classList.add("alg-list-body-block");
        if (collumnLengths) {
          bodyBlock.style.width = collumnLengths[bodyCount] + "px";
          bodyCount++;
        } else {
          bodyBlock.style.flexGrow = "1";
          bodyBlock.style.width = "150px";
        }

        bodyBlock.innerHTML = element;
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
  clearElementInnerHtml(parentElementId) {
    document.getElementById(parentElementId).innerHTML = "";
  }

  renderComponent(parentElementId, component, replace = false) {
    if (replace) {
      this.clearElementInnerHtml(parentElementId);
    }
    document.getElementById(parentElementId).appendChild(component);
  }

  async addListToContainer(
    id,
    callback = async () => {},
    collumnLengths = null
  ) {
    const listData = await callback();
    const list = ALG.createList(listData, collumnLengths);
    ALG.renderComponent(id, list, true);
  }

  async addTableToContainer(
    id,
    callback = async () => {},
    collumnLengths = null
  ) {
    const tableData = await callback();
    const table = ALG.createTable(tableData, collumnLengths);
    ALG.renderComponent(id, table, true);
  }

  // utility
  async imageFileToDataURL(file, callback) {
    const reader = new FileReader();

    reader.onload = function (event) {
      const dataURL = event.target.result;
      callback(dataURL);
    };

    reader.readAsDataURL(file);
  }

  getCurrentTime() {
    const now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let ampm = hours >= 12 ? "PM" : "AM";

    // Convert to 12-hour time format
    hours = hours % 12;
    hours = hours ? hours : 12; // Handle midnight (0)

    const timeString = `${hours}:${String(minutes).padStart(2, "0")} ${ampm}`;

    return timeString;
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
// loadProducts();
// function loadProducts(
//   searchTerm = "",
//   category = "",
//   orderBy = "price",
//   orderDirection = "high to low",
//   limit = 10
// ) {
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
//         ALG.renderComponent("tableContainer", table);

//         setTimeout(() => {
//           ALG.openModel("Hellow World", ALG.createList(data.results));
//         }, 2000);

//         setTimeout(() => {
//           ALG.closeModel();
//         }, 5000);

//         setTimeout(() => {
//           ALG.openToast(
//             "something",
//             "<h1>Who AM I</h1>",
//             "01:20:37",
//             "bi-emoji-wink-fill"
//           );
//         }, 7000);
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
// }

// const testButon = document.createElement("button");
// testButon.innerHTML = "somethign";
// ALG.openToast("Who is this toast", testButon, "01:20:37", "bi-emoji-wink-fill");
// setTimeout(() => {
//   testButon.innerHTML = "betterword";
//   ALG.openToast(
//     "Who is this toast",
//     testButon,
//     "01:20:37",
//     "bi-emoji-wink-fill"
//   );
// }, 2333);
