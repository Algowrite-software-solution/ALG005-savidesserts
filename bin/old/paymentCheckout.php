<?php

require_once("backend/model/SessionManager.php");
$sessionManager = new SessionManager();
$isLoggedIn = false;
$userData = null;
if ($sessionManager->isLoggedIn()) {
    $isLoggedIn = true;
    $userData = $sessionManager->getUserId();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALG005 - savi dessert</title>

    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/singleProduct.css">
    <link rel="stylesheet" href="../css/style.css">

    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />


    <!-- script -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script defer src="../js/bootstrap.bundle.js"></script>
    <script defer src="../js/homeSliders.js"></script>
</head>

<body>
    <?php include("pages/components/header.php") ?>
    <div class="container-fluid flex-column flex-lg-row m-0 p-0 d-flex paycheck-main ">
        <div class="col-12 col-lg-6 d-flex flex-column alg-bg-light">
            <div class="d-flex justify-content-center justify-content-lg-start p-3">
                <h2 class="alg-text-dark fw-bolder">Checkout Details</h2>
            </div>
            <div class="col-12 d-flex flex-column justify-content-center p-1 p-lg-3">
                <h4 class="alg-text-dark py-4">Shipping Details</h4>
                <div class="d-flex flex-column justify-content-between alg-bg-dark rounded-5 p-4 px-3 gap-3 shadow">
                    <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-between gap-2" id="container1">
                        <input id="fullName" placeholder="Full Name" type="text" class="form-control" disabled />
                        <input id="mobile" placeholder="Mobile" type="tel" class="form-control" disabled />
                    </div>
                    <div class="d-flex flex-column  flex-md-row flex-lg-row justify-content-between gap-2" id="container2">
                        <input id="addressLine1" placeholder="Address Line 1" type="text" class="form-control" disabled />
                        <input id="addressLine2" placeholder="Address Line 2 (Optional)" type="text" class="form-control" disabled />
                    </div>
                    <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-between gap-2" id="container3">
                        <input id="city" placeholder="City" type="text" class="form-control" disabled />
                        <select id="district" class="form-select" disabled>
                            <!-- district option goes here -->
                        </select>
                        <select id="province" class="form-select" disabled>
                            <!-- province option goes here -->
                        </select>
                    </div>
                    <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-end gap-2">
                        <button class="fw-bolder btn btn-danger" onclick="EditBtnWorker();">Edit</button>
                        <button id="saveBtn" class="fw-bolder  btn btn-primary" onclick="updateShippingData();" disabled>Save</button>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-column justify-content-center p-1 p-lg-3">
                <h4 class="alg-text-dark py-4">Payment Method</h4>
                <div class="col-12 d-flex justify-content-between alg-bg-dark rounded-5 p-3 px-3 gap-3 shadow">
                    <div class="d-flex gap-3 justify-content-center flex-row ">
                        <img src="https://www.clearhaus.com/img/figurehead/assets/card-schemes.jpg" class="img-fluid paycheck-prof-img" alt="">
                        <div class="d-flex alg-text-light justify-content-center flex-column">
                            <h5 class="fs-5">Visa / Master Card</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 alg-bg-light">
            <div class="d-flex alg-bg-tan flex-column justify-content-center m-2 p-4 p-lg-5 rounded-5 shadow-lg">
                <div class="d-flex alg-text-light justify-content-between">
                    <h4>Your order</h4>
                    <button type="button" class="alg-bg-gold alg-text-h3 border-0 rounded-3 p-2 fw-bolder"> Edit
                    </button>
                </div>
                <!-- <div class="d-flex flex-row justify-content-around py-4 border-bottom"> -->
                <!--purchased product slider -->

                <div class="checkoutSwiper swiper mySwiperCheckOut pt-4 px-5 border-bottom">
                    <div class="swiper-wrapper pt-4 d-flex gap-4" id="swiperDetailContainer">
                        <!-- slider goes here check paymentCheckout.js-->
                    </div>
                    <div class="swiper-button-next alg-text-gold"></div>
                    <div class="swiper-button-prev alg-text-gold"></div>
                </div>


                <!--purchased product slider -->
                <!-- </div> -->
                <div class="d-flex py-5 flex-column flex-lg-row justify-content-center align-items-center justify-content-lg-around border-bottom">
                    <img class="img-fluid paycheck-thanku-img " src="https://img.freepik.com/free-vector/thank-you-placard-concept-illustration_114360-13436.jpg?w=996&t=st=1694928554~exp=1694929154~hmac=b5cf8b7b5d163da7bc470ecf12e411fb11ba50a1fe07d773b469898eda55e21d" alt="">
                    <div class="col-12 pt-3 pt-lg-0 col-lg-6 text-white" id="priceContainer">

                    </div>
                </div>
                <div class="d-flex justify-content-center justify-content-lg-end pt-4">
                    <button onclick="placeOrder();" id="payhere-payment" type="button" class="alg-bg-gold w-100 alg-text-h2 border-0 rounded-3 p-2 fw-bolder"> Place
                        Order
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- toast mode -->
    <?php include("pages/components/toastMessage.php") ?>

    <script src="../js/script.js"></script>
    <script src="../js/paymentCheckout.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <?php include("pages/components/footer.php") ?>
</body>
</html>