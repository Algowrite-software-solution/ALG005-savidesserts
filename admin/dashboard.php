<?php
// access validator
require_once(__DIR__ . "/../backend/model/SessionManager.php");

$sessionManager = new SessionManager("alg005_admin");
if (!$sessionManager->isLoggedIn()) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Savi Dessert</title>

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/adminComponents.css">

    <!-- js -->
    <script defer src="js/bootstrap.bundle.js"></script>
    <script defer src="https://unpkg.com/@popperjs/core@2"></script>
    <script defer src="js/adminComponent.js"></script>
    <script defer src="js/main.js"></script>
    <script defer src="js/script.js"></script>
</head>

<body class="alg-bg-dark alg-h-100vh d-flex flex-column justify-content-between">

    <!-- navigation -->
    <div class="alg-bg-darker">
        <div class="container py-2 d-flex justify-content-between alg-text-light">
            <div class="d-flex fs-3 align-items-center justify-content-between gap-2">
                <div class="w-100">
                    <i class=" bi bi-x" id="navigationIcon"></i>
                </div>
                <div data-tooltip-holder="Home" class="logo fw-bold fs-3">SAVI</div>
            </div>
            <div class="d-none d-md-flex align-items-center justify-content-center w-100">
                <button class="btn alg-btn-pill mx-3">something1</button>
                <button class="btn alg-btn-pill mx-3">something2</button>
            </div>
            <div class="border-start alg-text-h2 d-flex gap-2 px-2 align-items-center justify-content-between">
                <i class=" bi bi-bell-fill"></i>
                <i class=" bi bi-gear-fill"></i>
                <i class=" bi bi-person-circle"></i>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="alg-bg-dark d-flex flex-grow-1 position-relative alg-text-light">
        <div class="alg-sm-position-ablsolute col-8 h-100 col-md-4 col-lg-3 col-xl-2 p-3 d-none d-lg-block" id="navigationSection">
            <div class="rounded-3 alg-bg-darker px-3 py-4 h-100 alg-shadow navigation-sidebar">
                <button data-algMainNavigationPanel="productManagementPanel" data-algMainNavigationPanelTitle="Product Management" class="alg-btn-pill rounded-4 my-2 w-100 main-navigation-panel-btn">Product Management</button>
                <button data-algMainNavigationPanel="userManagementPanel" data-algMainNavigationPanelTitle="User Management" class="alg-btn-pill rounded-4 my-2 w-100 main-navigation-panel-btn">User Management</button>
                <button data-algMainNavigationPanel="orderManagementPanel" data-algMainNavigationPanelTitle="Order Management" class="alg-btn-pill rounded-4 my-2 w-100 main-navigation-panel-btn">Order Management</button>
                <button data-algMainNavigationPanel="promotionManagementPanel" data-algMainNavigationPanelTitle="Promotion Management" class="alg-btn-pill rounded-4 my-2 w-100 main-navigation-panel-btn">Promotion Management</button>
            </div>
        </div>
        <div class=" col-12 col-md-8  col-lg-9 col-xl-10 p-3" id="contentSection">
            <div class="rounded-3 alg-bg-dark h-100 alg-shadow d-flex flex-column p-3 gap-2">
                <div class="alg-bg-tan py-2 px-5 rounded-pill">
                    <h5 class="d-grid alg-text-dark text-center fw-bold fs-5" id="mainContentContainerTitle">Admin Panel Title Goes Here</h5>
                </div>
                <hr class="content-divider py-0 m-0">
                <div class="flex-grow-1 rounded-3 d-flex flex-column gap-2" id="mainContentContainer">
                    Loading...🔃
                </div>
            </div>
        </div>
    </div>

    <!-- utility -->
    <!-- model -->
    <div class="modal" tabindex="-1" id="dashBoardModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelTitle">Modal title</h5>
                    <button type="button" class="bg-transparent border-0 d-flex justify-content-center align-items-center alg-rounded-large alg-text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle-fill" style="font-size: 26px;"></i></button>
                </div>
                <div class="modal-body" id="modelBody">

                </div>
                <div class="modal-footer" id="modelFooter">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- message toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="dashBoardToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i id="toastIcon" class=""></i>
                <strong class="me-auto" id="toastTitle">Error!</strong>
                <small id="toastTime">0 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastBody">
                Something went wrong!.
            </div>
        </div>
    </div>

    <!-- tooltip -->
    <div class="tooltip py-1 px-2 opacity-50 alg-rounded-small alg-bg-light alg-text-dark" id="tooltip" role="tooltip">
        <div data-popperbody="">I'm a tooltip</div>
        <div id="arrow" data-popper-arrow></div>
    </div>

    <!-- dropdowns -->
    <div class="dropdown-center" id="dropdown">
        <ul class="dropdown-menu alg-bg-light alg-rounded-small p-2">

        </ul>
    </div>
    <!-- footer -->

    <footer class="alg-bg-darker">
        <div class="container d-flex justify-content-center flex-column align-items-center">
            <div class="py-1 text-center text-white alg-text-p py-3 mt-2">
                All rights reserved 2023 &copy;
            </div>

            <button onclick="openBugReportModel()" class="alg-btn-pill">BUG REPORT</button>
        </div>
    </footer>
</body>

</html>