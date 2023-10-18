<?php

$category = (isset($_GET["category"]) ? $_GET["category"] : "");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sawee Dessert | Shop</title>

    <link rel="shortcut icon" href="resources/images/favicon.png" >

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

    <!-- script -->
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script defer src="js/bootstrap.bundle.js"></script>
    <script defer src="js/products.js"></script>
    <script defer src="js/productsSliders.js"></script>
    <script defer src="js/script.js"></script>
</head>

<body style="overflow-x:hidden;" data-category="<?php echo $category ?>">

    <!-- header -->
    <?php include("pages/components/header.php") ?>

    <!-- category -->
    <?php include("pages/components/category.php") ?>

    <!-- search bar -->
    <section class="alg-bg-dark">
        <div class="container">
            <div class="col-12 p-0 ">
                <div class="row px-2 m-0 p-0 d-flex flex-row flex-md-row justify-content-center align-items-center py-3">
                    <!-- <button class="col-6 col-md-2 order-2 order-md-1 alg-btn-pill p-1 p-lg-2 mt-3 mt-md-0">
                        Advanced
                    </button> -->
                    <div class="col-12 col-md-6 order-1 order-md-2 m-0 p-0">
                        <div class="row m-0 p-0">
                            <input id="searchBar" type="text" placeholder="Search products..." class="alg-searchbar border-0 alg-bg-light py-1 px-3 border-0 col-10 p-0 alg-bg-light rounded-end rounded-5" oninput="searchProducts();">
                            <button class="pp-search-btn col-2  rounded-start rounded-5 py-1 px-3 border-0" onclick="searchProducts();">
                                <div id="searchIcon" class="d-block">
                                    <i class="bi bi-search  text-white fs-4"></i>
                                </div>
                                <div id="loadingIcon" class="alg-text-white spinner-border d-none" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- <div class="col-6 col-md-2  order-3 order-md-3 position-relative mt-3 mt-md-0">
                        <button class="alg-btn-pill p-1 p-lg-2 dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </button>
                        <ul class="dropdown-menu alg-bg-tan rounded-4 w-100">
                            <li><a class="dropdown-item alg-text-light fw-bold" href="#">Menu item</a></li>
                            <li><a class="dropdown-item alg-text-light fw-bold" href="#">Menu item</a></li>
                            <li><a class="dropdown-item alg-text-light fw-bold" href="#">Menu item</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <!-- product list -->
    <section class="alg-bg-light">
        <div class="container">
            <div class="col-12 p-0">
                <div class="row d-flex justify-content-center align-items-center m-0 py-2 pd-s3-container" id="productListViewContainer">
                    <!-- product list goes here -->
                    <?php
                    for ($i = 0; $i < 6; $i++) {
                    ?>
                        <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mx-0 p-0">
                            <div class="row m-0 w-100 p-2">
                                <div class="col-12 d-flex justify-content-end overflow-hidden flex-column alg-bg-tan ld-bs-card w-100 p-0 placeholder-wave"></div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include("pages/components/footer.php") ?>
</body>

</html>