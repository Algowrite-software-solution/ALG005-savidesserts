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

<body class="alg-bg-light">
    <?php include("pages/components/header.php") ?>
    <div class="container my-3 pb-3 pt-3 overflow-hidden min-vh-100">
        <!-- topic -->
        <div class="d-flex pt-2 pb-2 alg-text-dark justify-content-center justify-content-lg-start">
            <h1>Checkout Details</h1>
        </div>

        <!-- main div -->
        <div class="d-flex flex-column flex-lg-row gap-2  justify-content-between">

            <!-- first div -->
            <div class="alg-bg-dark alg-text-light alg-rounded-small d-flex flex-column gap-2 flex-grow-1 p-3">

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
                    <button class="fw-bolder btn alg-btn-pill" onclick="EditBtnWorker();">Edit</button>

                    <button id="saveBtn" class="fw-bolder  btn alg-btn-pill" onclick="updateShippingData();" disabled>Save</button>
                </div>

            </div>

            <!-- second dev -->
            <div class="alg-bg-dark alg-rounded-small flex-grow-1 p-3  ">

                <!-- topic -->
                <div class="alg-text-light">
                    <h2>Your Order</h2>
                </div>


                <!-- your order detail section -->
                <div id="productDetailsContainer" class="alg-text-light d-flex gap-3 flex-column h-auto scroll-container pb-3">

                    <!-- detail row by row -->
                    <!-- row details goes here check paymentCheckout.js -->
                </div>


                <!-- prices -->
                <div class=" d-flex flex-column flex-lg-row  gap-2 pe-0 pe-lg-2 py-2">
                    <!-- payment Method -->
                    <div class="d-flex flex-row flex-lg-column flex-grow-1  alg-bg-darker alg-text-light p-3 alg-rounded-small">
                        <h4>Estimate Delivery Date</h4>

                        <span id="estimateDateContainer" class="text-white fs-4">

                        </span>
                    </div>

                    <div class="d-flex flex-grow-1 justify-content-lg-end justify-content-center gap-2">
                        <!-- side names -->
                        <div class="alg-bg-light alg-text-dark p-3 alg-rounded-small d-flex flex-grow-1 flex-column gap-1">
                            <span>Sub Total :</span>
                            <span>Shipping Price :</span>
                            <span class="fw-bold ">TOTAL TO PAY :</span>
                        </div>
                        <!-- prices goes here -->
                        <div class="p-3 alg-rounded-small alg-bg-light d-flex flex-grow-1 flex-column gap-1 pe-0 pe-lg-3">
                            <span id="subTotalPrice"></span>
                            <span id="shippingPrice"></span>
                            <span class="fw-bolder" id="totalPriceContainer"></span>
                        </div>
                    </div>


                </div>

                <!-- order button -->
                <div class="bg-black d-flex justify-content-end flex-grow-1">
                    <button id="payhere-payment" onclick="placeOrder();"  type="submit" class="alg-bg-gold w-100 alg-text-h2 border-0 rounded-3 p-2 fw-bolder">Place Order</button>
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