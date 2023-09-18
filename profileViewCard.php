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
    <script defer src="js/bootstrap.bundle.js"></script>
    <script defer src="js/script.js"></script>

</head>

<body>

    <section class="container-fluid m-0 alg-bg-light">

        <?php include("pages/components/header.php") ?>
        <?php include("pages/components/profileNavigation.php") ?>

        <div class="mt-3">
            <div class="col-12  d-flex justify-content-center">
                <div class="">
                    <div class="col-12 d-flex flex-column justify-content-center align-items-center alg-bg-dark p-4 px-5 rounded-4">
                        <div class="alg-profile-round alg-bg-light d-flex justify-content-center align-items-center fw-bold">
                            NP</div>
                        <div class="d-flex flex-column align-items-center alg-text-light text-white mt-1 px-4">
                            <span class="fw-bold">Nimal Perera</span>
                            <span>nimal@gmail.com</span>
                            <span>+9421543678</span>
                        </div>
                        <button type="button" onclick="signOut();" class="text-decoration-none mt-2 text-black page-transition-button alg-bg-tan fw-bold alg-button-hover px-4 py-1 rounded-4">SIGN OUT</button>
                    </div>
                </div>
            </div>
        </div>

        <?php include("pages/components/addressView.php") ?>
        <?php include("pages/components/productPurchasingHistory.php") ?>

    </section>
    <?php include("pages/components/footer.php") ?>
</body>

</html>