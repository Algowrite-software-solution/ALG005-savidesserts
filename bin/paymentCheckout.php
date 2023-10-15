<?php

// require_once("backend/model/SessionManager.php");
// $sessionManager = new SessionManager();
// $isLoggedIn = false;
// $userData = null;
// if ($sessionManager->isLoggedIn()) {
//     $isLoggedIn = true;
//     $userData = $sessionManager->getUserId();
// }

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
    <link rel="stylesheet" href="style.css">

    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />


    <!-- script -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script defer src="../js/bootstrap.bundle.js"></script>
    <script defer src="../js/homeSliders.js"></script>
</head>

<body class="alg-bg-light">
    <div class="container bg-primary pb-3 pt-3">
        <!-- topic -->
        <div class="d-flex pt-2 pb-2 bg-body justify-content-center justify-content-lg-start">
            <h1>Checkout Details</h1>
        </div>

        <!-- main div -->
        <div class="d-flex flex-column flex-lg-row gap-2  justify-content-between">

            <!-- first div -->
            <div class="bg-warning d-flex flex-column gap-2 flex-grow-1 p-3">

                <!-- topic -->
                <div>
                    <h3>Shipping Details</h3>
                </div>
                <!-- details -->
                <!-- full name input -->
                <input id="fullName" placeholder="Full Name" type="text" class="form-control" disabled />
                <!-- mobile input -->
                <input id="mobile" placeholder="Mobile" type="tel" class="form-control" disabled />

                <!-- address 1 input -->
                <input id="addressLine1" placeholder="Address Line 1" type="text" class="form-control" disabled />
                <!-- address 2 input -->
                <input id="addressLine2" placeholder="Address Line 2 (Optional)" type="text" class="form-control" disabled />

                <!-- city -->
                <input id="city" placeholder="City" type="text" class="form-control" disabled />
                <!-- post code -->
                <input id="postCode" placeholder="Post code" type="text" class="form-control" disabled />
                <!-- selector -->
                <select id="district" class="form-select" disabled>
                    <!-- district option goes here -->
                </select>
                <!-- selector -->
                <select id="province" class="form-select" disabled>
                    <!-- province option goes here -->
                </select>

                <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-end gap-2">
                    <!-- button section -->
                    <button class="fw-bolder btn btn-danger" onclick="EditBtnWorker();">Edit</button>

                    <button id="saveBtn" class="fw-bolder  btn btn-primary" onclick="updateShippingData();" disabled>Save</button>
                </div>

            </div>

            <!-- second dev -->
            <div class="alg-bg-tan flex-grow-1 p-3 ">

                <!-- topic -->
                <div class="bg-black text-white">
                    <h2>Your Order</h2>
                </div>


                <!-- your order detail section -->
                <div class="bg-info d-flex gap-3 flex-column h-auto scroll-container pb-3">

                    <div class="d-flex gap-2 bg-secondary">
                        <!-- product image -->
                        <img src="https://img.taste.com.au/6i4vEH8z/w354-h236-cfill-q80/taste/2016/11/warm-chocolate-puddings-22259-1.jpeg" alt="you order images" class="alg-pc-img">

                        <!-- details goes here -->
                        <div class="bg-warning d-flex flex-column flex-grow-1">
                            <!-- product name -->
                            <div class="bg-secondary">
                                <h4 class="fw-bold">product name goes here</h4>
                            </div>
                            <div class="d-flex gap-2 ">
                                <!-- one side -->
                                <div class="bg-danger-subtle d-flex flex-column flex-grow-1 p-2">
                                    <span>Weight: 1kg</span>
                                    <span>QTY: 1</span>
                                    <span>Topping: white chocolate</span>
                                </div>

                                <!-- other side -->
                                <div class="bg-info-subtle d-flex flex-column flex-grow-1 p-2">
                                    <span>Product Price : Rs.2000</span>
                                    <span>Topping Price : Rs.300</span>

                                </div>
                                <!-- other side -->
                                <div class="bg-info-subtle d-flex flex-column flex-grow-1 p-2">
                                    <span class="fw-bold">Rs.2300</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- prices -->
                <div class="bg-body-tertiary d-flex flex-column flex-lg-row  gap-2 pe-0 pe-lg-2 p-2">


                    <!-- payment Method -->
                    <div class="d-flex flex-row flex-lg-column flex-grow-1  bg-danger">
                        <h4>Estimate Delivery Date</h4>
                    </div>

                    <div class="d-flex flex-grow-1 justify-content-lg-end justify-content-center">
                        <!-- side names -->
                        <div class="bg-primary d-flex flex-grow-1 flex-column gap-1">
                            <span class="">Sub Total :</span>
                            <span class="">Shipping Price :</span>
                            <span class="fw-bold ">TOTAL TO PAY :</span>
                        </div>
                        <!-- prices goes here -->
                        <div class="bg-warning d-flex flex-grow-1 flex-column gap-1 pe-0 pe-lg-3">
                            <span class="">Rs.2300.00</span>
                            <span class="">Rs. 200.00</span>
                            <span class="fw-bolder">Rs.2500.00</span>
                        </div>
                    </div>


                </div>

                <!-- order button -->
                <div class="bg-black d-flex justify-content-end flex-grow-1">
                    <button class="alg-bg-gold w-100 alg-text-h2 border-0 rounded-3 p-2 fw-bolder">Place Order</button>
                </div>


            </div>
        </div>
    </div>

    <!-- toast mode -->
    <!-- <?php include("pages/components/toastMessage.php") ?> -->

    <script src="../js/script.js"></script>
    <script src="../js/paymentCheckout.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>