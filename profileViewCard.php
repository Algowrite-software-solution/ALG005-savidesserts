<?php

require_once("backend/model/SessionManager.php");

$session_manager = new SessionManager();
if (!$session_manager->isLoggedIn()) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sawee Dessert</title>

    <link rel="shortcut icon" href="resources/images/favicon.png">

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
    <script defer src="js/userDataLoad.js"></script>

</head>

<body>

    <section class="alg-bg-light profile-pg">

        <?php include("pages/components/header.php") ?>
        <?php include("pages/components/profileNavigation.php") ?>

        <div class="mt-3">
            <div class="col-12  d-flex justify-content-center">
                <div class="">
                    <div class="col-12 d-flex flex-column justify-content-center align-items-center alg-bg-dark p-4 px-5 rounded-4" id="userCardContainer">
                        <!-- profile data goes here -->
                    </div>

                </div>
            </div>
        </div>

        <?php include("pages/components/productPurchasingHistory.php") ?>

    </section>
    <?php include("pages/components/footer.php") ?>
</body>

</html>