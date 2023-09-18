// initiator
const ALG = new DashboardComponents();

document.addEventListener("DOMContentLoaded", () => {
  test();

  const icon = document.getElementById("navigationIcon");
  if (icon) {
    icon.addEventListener("click", () => {
      toggleNavigation();
    });
  }
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

function test() {
  setTimeout(() => {
    // const notificationSection = document.createElement("div");
    // notificationSection.innerHTML = "You have got an order....!";
    // notificationSection.style.backgroundColor = "green";
    // notificationSection.style.padding = "20px";
    // notificationSection.style.color = "white";

    // ALG.openModel("Alert", notificationSection);

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
          console.log("2");
          const table = ALG.createTable(data.results);
          ALG.openToast('kavindu buruwa', table, "00:23:23", "bi-x");
        } else if (data.status == "failed") {
          console.log(data.error);
          console.log("3");
        } else {
          console.log(data);
          console.log("4");
        }
      })
      .catch((error) => {
        // Handle errors that occur during the Fetch request
        console.error("Fetch error:", error);
      });
  }, 2000);
}
