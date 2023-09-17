<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALG005 - savi dessert</title>

    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/singleProduct.css">
    <link rel="stylesheet" href="../css/style.css">

    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />


    <!-- script -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script defer src="../js/bootstrap.bundle.js"></script>
    <script defer src="../js/singleProduct.js"></script>
    <script defer src="../js/script.js"></script>
</head>

<body>

    <div class="container-fluid m-0 p-0 d-flex">
        <div class="col-6 d-flex flex-column alg-bg-light py-3">
            <div class=" p-3">
                <h2 class="alg-text-dark fw-bolder">Checkout Details</h2>
            </div>
            <div class="col-12 d-flex flex-column justify-content-center p-3">
                <h4 class="alg-text-dark py-4">Billing Address</h4>
                <div class="col-12 d-flex justify-content-between alg-bg-dark rounded-5 p-3 px-3 gap-3">
                    <div class="d-flex gap-3 justify-content-center flex-row ">
                        <img src="https://www.javainstitute.edu.lk/img/faculty/mr-thilina.jpg"
                            class="img-fluid paycheck-prof-img" alt="">
                        <div class="d-flex alg-text-light lh-1 justify-content-center flex-column">
                            <h4>Thilina Fonseka</h4>
                            <p>+94 72 2345553</p>
                            <p>thilina@gmail.com</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center flex-column">
                        <button type="button" class="alg-bg-tan alg-text-h3 border-0 rounded-3 p-2 fw-bolder"> Edit
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-column justify-content-center p-3">
                <h4 class="alg-text-dark py-4">Payment Method</h4>
                <div class="col-12 d-flex justify-content-between alg-bg-dark rounded-5 p-3 px-3 gap-3">
                    <div class="d-flex gap-3 justify-content-center flex-row ">
                        <img src="https://www.clearhaus.com/img/figurehead/assets/card-schemes.jpg"
                            class="img-fluid paycheck-prof-img" alt="">
                        <div class="d-flex alg-text-light justify-content-center flex-column">
                            <h5>Visa / Master Card</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-6 alg-bg-light">
            <div class="d-flex alg-bg-tan flex-column justify-content-center m-2 p-5 rounded-5">
                <div class="d-flex alg-text-light justify-content-between">
                    <h4>Your order</h4>
                    <button type="button" class="alg-bg-gold alg-text-h3 border-0 rounded-3 p-2 fw-bolder"> Edit
                    </button>
                </div>
                <div class="d-flex flex-row justify-content-around py-4 border-bottom">
                    <!--purchased product slider -->

                    <div class="col-3 alg-text-light d-flex flex-column justify-content-center align-items-center">
                        <img class="img-fluid paycheck-product-img"
                            src="https://media.istockphoto.com/id/1179207306/photo/pudding-caramel-custard-with-caramel-sauce-and-mint-leaf-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=QOgo1aIuavOspqKTbKz7Qk2O5wJJOZZPg4fiPg0p2xM="
                            alt="">
                        <h6 class="pt-3">Pudin With Honey</h6>
                        <h6 class="pt-1 fw-bolder">RS.1200</h6>
                    </div>
                    <div class="col-3 alg-text-light d-flex flex-column justify-content-center align-items-center">
                        <img class="img-fluid paycheck-product-img"
                            src="https://media.istockphoto.com/id/1179207306/photo/pudding-caramel-custard-with-caramel-sauce-and-mint-leaf-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=QOgo1aIuavOspqKTbKz7Qk2O5wJJOZZPg4fiPg0p2xM="
                            alt="">
                        <h6 class="pt-3">Pudin With Honey</h6>
                        <h6 class="pt-1 fw-bolder">RS.1200</h6>
                    </div>
                    <div class="col-3 alg-text-light d-flex flex-column justify-content-center align-items-center">
                        <img class="img-fluid paycheck-product-img"
                            src="https://media.istockphoto.com/id/1179207306/photo/pudding-caramel-custard-with-caramel-sauce-and-mint-leaf-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=QOgo1aIuavOspqKTbKz7Qk2O5wJJOZZPg4fiPg0p2xM="
                            alt="">
                        <h6 class="pt-3">Pudin With Honey</h6>
                        <h6 class="pt-1 fw-bolder">RS.1200</h6>
                    </div>

                    <!--purchased product slider -->
                </div>
                <div class="d-flex py-4 justify-content-around border-bottom">
                    <img class="img-fluid paycheck-thanku-img "
                        src="https://img.freepik.com/free-vector/thank-you-placard-concept-illustration_114360-13436.jpg?w=996&t=st=1694928554~exp=1694929154~hmac=b5cf8b7b5d163da7bc470ecf12e411fb11ba50a1fe07d773b469898eda55e21d"
                        alt="">
                    <div class="col-6 text-white">
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
                <div class="d-flex justify-content-end pt-4">
                    <button type="button" class="alg-bg-gold w-50 alg-text-h2 border-0 rounded-3 p-2 fw-bolder"> Place
                        Order
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>