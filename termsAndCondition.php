<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sawee Dessert | T&C</title>

    <link rel="shortcut icon" href="resources/images/favicon.png">

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/snow.css">


    <!-- script -->
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script defer src="js/script.js"></script>
    <script defer src="js/snow.js"></script>
</head>

<body class="">

    <div id="snow-container"></div>
    <!-- header -->
    <?php include("pages/components/header.php") ?>

    <!-- content -->
    <section class="bg-white">
        <div class="container py-5 text-dark">
            <?php
            require_once("pages/components/statementGeneratorui.php");
            $statementUiGenerator = new GenerateStatementUi("resources/json/termsAndCondition.json");
            $statementUiGenerator->generate();
            ?>
        </div>
    </section>

    <!-- footer -->
    <?php include("pages/components/footer.php") ?>
</body>

</html>