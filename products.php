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
    <div class="col-12 p-0">
        <?php include("pages/components/header.php") ?>
        <?php include("pages/components/category.php") ?>
        <?php include("pages/components/searchBar.php") ?>
    </div>

    <section class="alg-bg-light">
        <div class="container">
            <div class="col-12 p-0">
                <div class="row d-flex justify-content-center align-items-center m-0 py-2" id="productListViewContainer">
                    <!-- product list goes here -->

                </div>
            </div>
        </div>
    </section>
    <?php include("pages/components/footer.php") ?>
</body>

</html>