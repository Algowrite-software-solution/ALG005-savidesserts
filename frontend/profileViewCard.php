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
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script> -->
    <script defer src="js/bootstrap.bundle.js"></script>
    <script defer src="js/script.js"></script>

</head>

<body>

    <div class="row alg-bg-light">
        <div class="col-12">
            <?php include("pages/components/header.php") ?>
            <?php include("pages/components/profileNavigation.php") ?>

            <div class="row mt-3">
                <div class="col-12  d-flex justify-content-center">
                    <div class="row">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center alg-bg-dark p-4 px-5 rounded-4">
                            <div class="alg-profile-round alg-bg-light d-flex justify-content-center align-items-center fw-bold">NP</div>
                            <div class="d-flex flex-column align-items-center alg-text-light text-white mt-1">
                                <span class="fw-bold">Nimal Perera</span>
                                <span>nimal@gmail.com</span>
                                <span>+9421543678</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include("pages/components/addressView.php") ?>
            <?php include("pages/components/productPurchasingHistory.php") ?>
        </div>
    </div>
    <?php include("pages/components/footer.php") ?>
</body>

</html>