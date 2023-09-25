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
    <script defer src="../js/singleProduct.js"></script>
    <script defer src="../js/script.js"></script>
    <script defer src="../js/homeSliders.js"></script>
</head>

<body>

    <div class="container-fluid flex-column flex-lg-row m-0 p-0 d-flex paycheck-main">
        <div class="col-12 col-lg-6 d-flex flex-column alg-bg-light">
            <div class="d-flex justify-content-center justify-content-lg-start p-3">
                <h2 class="alg-text-dark fw-bolder">Checkout Details</h2>
            </div>
            <div class="col-12 d-flex flex-column justify-content-center p-1 p-lg-3">
                <h4 class="alg-text-dark py-4">Shipping Details</h4>
                <div class="col-12 d-flex flex-column flex-grow-2  justify-content-between alg-bg-dark rounded-5 p-3 px-3 gap-3 shadow">
                    <input placeholder="email" />
                    <input placeholder="mobile" />
                    <input placeholder="Address Line 1" />
                    <input placeholder="Address Line 2" />
                    <select>
                        <option>Select City</option>
                    </select>
                    <select>
                        <option>Select Province</option>
                    </select>
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
                    <div class="swiper-wrapper pt-4">

                        <?php

                        for ($x = 0; $x < 6; $x++) {
                        ?>
                            <div class="checkoutSwiper swiper-slide col-3 alg-text-light d-flex flex-column justify-content-center align-items-center">

                                <img class="img-fluid paycheck-product-im" src="https://media.istockphoto.com/id/1179207306/photo/pudding-caramel-custard-with-caramel-sauce-and-mint-leaf-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=QOgo1aIuavOspqKTbKz7Qk2O5wJJOZZPg4fiPg0p2xM=" alt="">
                                <span class="pt-1 alg-text-h3">Pudin With Honey</span>
                                <span class=" fw-bolder alg-text-h3">RS.1200</span>
                                <span class=" fw-bolder alg-text-h3">extra item</span>

                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="swiper-button-next alg-text-gold"></div>
                    <div class="swiper-button-prev alg-text-gold"></div>
                </div>


                <!--purchased product slider -->
                <!-- </div> -->
                <div class="d-flex py-4 flex-column flex-lg-row justify-content-center align-items-center justify-content-lg-around border-bottom">
                    <img class="img-fluid paycheck-thanku-img " src="https://img.freepik.com/free-vector/thank-you-placard-concept-illustration_114360-13436.jpg?w=996&t=st=1694928554~exp=1694929154~hmac=b5cf8b7b5d163da7bc470ecf12e411fb11ba50a1fe07d773b469898eda55e21d" alt="">
                    <div class="col-12 pt-3 pt-lg-0 col-lg-6 text-white">
                        <div class="d-flex justify-content-around ">
                            <span>SubTotal :</span>
                            <p>Rs. 1200</p>
                        </div>
                        <div class="d-flex justify-content-around ">
                            <span>Tax :</span>
                            <p>Free</p>
                        </div>
                        <div class="d-flex justify-content-around ">
                            <span>Discount :</span>
                            <p>-10%</p>
                        </div>
                        <div class="d-flex justify-content-around ">
                            <span class="fw-bolder">Total price :</span>
                            <p class="fw-bolder">Rs. 1080</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center justify-content-lg-end pt-4">
                    <button type="button" class="alg-bg-gold w-100 alg-text-h2 border-0 rounded-3 p-2 fw-bolder"> Place
                        Order
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>