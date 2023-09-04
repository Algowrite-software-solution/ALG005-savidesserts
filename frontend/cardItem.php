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
                <?php include ("pages/components/category.php") ?>
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
                                                <div class="d-flex flex-column justify-content-end">

                                                    <div> <img src="resources/images/item1.png" alt="" class="im position-relative pt-4" style="width:222.3px; height:320px;"></div>

                                                    <div class="mx-4 position-absolute mt-3" style="width:176.6px;">
                                                        <div class="px-1 m-0 alg-bg-tan p-2  rounded-1">
                                                            <div class="d-flex justify-content-between pb-1">
                                                                <span class="text-white fw-bold alg-text-h3">Product Title</span>
                                                                <span class="fw-bold alg-text-h3">LKR 1300</span>
                                                            </div>

                                                            <div>
                                                                <p class="alg-text-h3 lh-1 pb-1 my-0 text-white">This is the product description and it contain small details.</p>
                                                            </div>

                                                            <div>
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                                <i class="bi bi-star-fill text-warning"></i>
                                                                <i class="bi bi-star-fill"></i>
                                                            </div>
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