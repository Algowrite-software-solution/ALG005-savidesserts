<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALG005 - savi dessert</title>

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
    <script defer src="js/script.js"></script>

</head>

<body style="overflow-x:hidden;">

    <!-- header -->
    <?php include("pages/components/header.php") ?>

    <!-- category -->
    <?php include("pages/components/category.php") ?>

    <!-- search bar -->
    <section class="alg-bg-dark">
        <div class="container">
            <div class="col-12 p-0 ">
                <div class="row px-2 m-0 d-flex justify-content-around align-items-center py-2">
                    <div class="col-6 col-md-2 order-2 order-md-1 alg-bg-gold p-0 p-md-2 px-4 fw-bold mt-3 mt-lg-0 rounded-5 text-center cursor">
                        Advanced
                    </div>
                    <div class="col-11 col-md-5 order-1 order-md-2 ">
                        <div class="row d-flex m-0">
                            <div class="col-10 p-0 m-0 alg-bg-light rounded-end rounded-5">
                                <div class="m-0 m-lg-1 p-md-1"><input type="text" placeholder="Search products..." class="form-control border-0 alg-bg-light border-0"></div>
                            </div>
                            <div class="col-2 alg-bg-gold p-0 m-0 d-flex justify-content-center align-items-center rounded-start rounded-5">
                                <i class="bi bi-search text-white fs-4"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-2 btn-group alg-bg-gold  order-3 order-md-3 mt-3 mt-lg-0 rounded-5 p-1 p-md-2 cursor">

                        <button class="alg-bg-gold dropdown-toggle fw-bold border-0 mx-auto" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </button>
                        <ul class="dropdown-menu alg-bg-gold">
                            <li><a class="dropdown-item" href="#">Menu item</a></li>
                            <li><a class="dropdown-item" href="#">Menu item</a></li>
                            <li><a class="dropdown-item" href="#">Menu item</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- product list -->
    <section class="alg-bg-light">
        <div class="container">
            <div class="col-12 p-0">
                <div class="row d-flex justify-content-center align-items-center m-0 py-2" id="productListViewContainer">
                    <!-- product list goes here -->

                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include("pages/components/footer.php") ?>
</body>

</html>