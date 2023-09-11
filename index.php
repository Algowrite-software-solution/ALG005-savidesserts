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

<body class="scrollbar w-100" style="overflow-x: hidden;">



    <!-- content -->
    <?php include("pages/components/header.php") ?>
    <?php include("pages/components/home.php") ?>
    <?php include "pages/components/banner.php" ?>
    <?php include("pages/components/services.php") ?>
    <?php include("pages/components/category.php") ?>
    <?php include("pages/components/productViewCard.php") ?>
    <?php include "pages/components/aboutUs.php" ?>

    <?php include "pages/components/testamonials.php" ?>
    <?php include("pages/components/contactUs.php") ?>
    <?php include "pages/components/footer.php" ?>



    <?php include("pages/components/watchlist.php") ?>


    <?php include("pages/components/cart.php") ?>



    <?php include "pages/components/signInModel.php" ?>
    <a href="./singleProductView.php">singleProduct View</a>
    <a href="./profileViewCard.php">profile View</a>
</body>

</html>