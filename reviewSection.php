<!DOCTYPE html>
<html lang="en">

<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Sawee Dessert Review</title>
       <link rel="shortcut icon" href="resources/images/favicon.png">

       <!-- css -->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
       <link rel="stylesheet" href="css/bootstrap.css">
       <link rel="stylesheet" href="css/main.css">
       <link rel="stylesheet" href="css/style.css">
       <link rel="stylesheet" href="css/snow.css">

       <!-- boxicons -->
       <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

       <!-- script -->
       <script defer src="js/bootstrap.bundle.js"></script>
       <script defer src="js/script.js"></script>
       <script defer src="js/review.js"></script>
       <script defer src="js/snow.js"></script>

</head>

<body class="alg-bg-light">

       <div id="snow-container"></div>

       <?php include("pages/components/header.php") ?>

       <div class="container my-3 pb-3 pt-3 overflow-hidden d-flex justify-content-center align-items-center">
              <div class="d-flex flex-column  rev-sec-width">
                     <div class="d-flex pt-3 ps-2 alg-text-tan align-content-center justify-content-start">
                            <h4>Give Us Review</h4>
                     </div>
                     <div class=" p-2 d-flex align-content-center justify-content-start">
                            <textarea placeholder="maximum word count 60" maxlength="57" cols="1" rows="3" class="w-100 fs-5 p-2 form-control" id="reviewReview"></textarea>
                     </div>
                     <div class="d-flex p-2 align-content-center justify-content-start">
                            <button class="alg-bg-gold w-100 alg-text-h2 border-0 rounded-3 p-2 fw-bolder rev-hover-effect" onclick="sendReview();">Send a Review</button>
                     </div>
              </div>
       </div>

       <!-- toast mode -->
       <?php include("pages/components/toastMessage.php") ?>
</body>

</html>