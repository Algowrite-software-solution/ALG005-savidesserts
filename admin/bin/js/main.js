// framework initiate
const ALG = new DashboardComponents();

document.addEventListener("DOMContentLoaded", () => {
  // sidebar controls
  const icon = document.getElementById("navigationIcon");
  if (icon) {
    icon.addEventListener("click", () => {
      toggleNavigation();
    });
  }

  ALG.mainNavigationController(
    "navigationSection",
    "mainContentContainer",
    () => {},
    () => {
      alert("finished");
    }
  );

  ALG.addTooltipDitectors("tooltip-holder");

  //   test
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
    ALG.openToast("something1", "porduct view", "", "", "Alert");
  } else if (section === "productAdd") {
    ALG.openToast("something2", "porduct add", "", "", "Error");
  }
}
