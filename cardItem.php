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
    <!-- <script defer src="js/bootstrap.bundle.js"></script> -->
    <script defer src="js/script.js"></script>

</head>

<body style="overflow-x:hidden;">

    <div class="row">
        <div class="col-12z">

            <?php include("pages/components/header.php") ?>
            <?php include("pages/components/category.php") ?>
            <?php include("pages/components/searchBar.php") ?>

            <section>
                <div class="row">
                    <div class="col-12 alg-bg-light px-2">
                        <div class="row  d-flex justify-content-center align-items-center gap-5 gap-lg-0">
                            <div class="col-11 col-md-8 pb-4 mt-3 px-2">
                                <div class="row">
                                    <?php
                                    for ($x = 0; $x < 6; $x++) {
                                    ?>
                                        <div class="col-5 col-md-6 col-lg-4 d-flex justify-content-center mx-auto">
                                            <div class="col-12 col-md-2 col-lg-2 d-flex justify-content-end overflow-hidden flex-column ld-bs-card w-100">
                                                <div class="ld-bs-card-content d-flex flex-column text-start">
                                                    <div class="d-flex gap-1 fw-bold justify-content-between">
                                                        <div class="text-white alg-text-h3">Product Title</div>
                                                        <div class="alg-text-h3">LKR 3000</div>
                                                    </div>
                                                    <div class="alg-text-h3 text-white">this is some little descrioption for the product......</div>
                                                    <div class="d-flex gap-2">
                                                        <i class="bi bi-star-fill text-warning fs-6"></i>
                                                        <i class="bi bi-star-fill text-warning fs-6"></i>
                                                        <i class="bi bi-star-fill text-warning fs-6"></i>
                                                        <i class="bi bi-star-fill text-warning fs-6"></i>
                                                        <i class="bi bi-star-fill text-white fs-6"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php include("pages/components/footer.php") ?>
        </div>
    </div>

</body>

</html>