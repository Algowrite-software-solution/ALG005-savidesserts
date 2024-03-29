<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sawee Dessert</title>

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
    <script defer src="js/home.js"></script>
    <script defer src="js/homeSliders.js"></script>
    <script defer src="js/script.js"></script>
    <script defer src="js/productsSliders.js"></script>
    <script defer src="js/snow.js"></script>
</head>

<body class="scrollbar w-100 page">

    <!-- <div id="snow-container"></div> -->

    <?php include("pages/components/header.php") ?>

    <!-- home -->
    <section class="ld-s1-hero pt-3 ">
        <div class="container">
            <div class="w-100 m-0 p-0">
                <div class="pt-lg-5">
                    <div class="d-flex justify-content-center flex-column flex-lg-row">
                        <div class="col-12 col-lg-8">
                            <div class="row pb-lg-5">
                                <div class="col-10 m-lg-4 mx-auto text-center text-md-start">
                                    <span class="alg-text-h1 text-white fw-semibold lh-1">Experience the Joy of
                                        Irresistible Desserts</span><br />
                                    <p class="alg-text-h2 text-white pt-3 mt-3 shadow">Embark own Flavorful journey of
                                        Irresistible Desserts discover the Delight of Authentic Sri Lankan Sweets,
                                        Crafted to Perfection.</p>
                                </div>
                            </div>
                            <div class="row mx-4 mx-0">
                                <div class="col-12 col-md-4 mt-3 mt-lg-2 pb-2 m-lg-0 p-lg-0 d-flex justify-content-center justify-content-lg-start bg-dange">
                                    <button onclick="window.location = 'products.php' " class="alg-bg-gold alg-main-button alg-button-hover p-2 px-4 rounded-4 text-white fw-bold alg-text-h2">SHOP
                                        NOW</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-7 col-lg-4 m-0 pb-5 d-flex align-self-center mt-5 mt-lg-0">
                            <div class="mainSlider swiper mySwiperHome bg-dange m-0 p-0">
                                <div class="swiper-wrapper bg-dar mt-2">
                                    <div class="mainSlider swiper-slide"><img src="resources/images/mainSliderImg1.png" class="rounded-5 img-fluid" alt="Some thing went wrong"></div>
                                    <div class="mainSlider swiper-slide"><img src="resources/images/mainSliderImg2.png" class="rounded-5 img-fluid" alt="Some thing went wrong"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Banner -->
    <section class="alg-bg-light d-none" id="promotionContainer">
        <div class="container">
            <div class="col-12 text-center pt-2 px-2 pb-4">
                <span class="alg-text-h2 alg-text-dark fw-bold m-0 p-0">PROMOTION</span>
                <div class="promotionSwiper swiper mySwiperPromotion mt-2">
                    <div class="swiper-wrapper" id="promotionSliderContainer">
                        <!-- image container goes here -->

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- services -->
    <section class="alg-bg-dark py-4">
        <div class="container">
            <div class="row pb-5">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 text-center pt-3">
                            <span class="alg-text-h2 alg-text-gold fw-bold">SERVICES</span>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 d-flex flex-column flex-lg-row justify-content-center align-items-center gap-4">
                            <div class="row mx-3 alg-button-hover alg-cursor">
                                <div class="col-12 alg-bg-light rounded-5 d-flex justify-content-center align-items-center gap-5">
                                    <div><img src="resources/images/service1.png" alt="" class="alg-service-img"></div>
                                    <div class="lh-1 mt-2 me-2">
                                        <span class="fw-bold alg-text-h3">24/7 Our Services </span>
                                        <p class="alg-text-h3">Our company provide 24/7 service on any service related
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mx-3 alg-button-hover alg-cursor">
                                <div class="col-12 alg-bg-light rounded-5 d-flex justify-content-center align-items-center gap-5">
                                    <div class="ps-3"><i class="bi bi-truck fs-1"></i></div>
                                    <div class="lh-1 mt-2 me-2">
                                        <span class="fw-bold alg-text-h3">Our Delivery Service</span>
                                        <p class="alg-text-h3">Island-wide delivery with Fast & Safe
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mx-3 alg-button-hover alg-cursor">
                                <div class="col-12 alg-bg-light rounded-5 d-flex justify-content-center align-items-center gap-5">
                                    <div class="ps-3"><i class="bi bi-credit-card fs-1"></i></div>
                                    <div class="lh-1 mt-2 me-2">
                                        <span class="fw-bold alg-text-h3">Our Payment Method</span>
                                        <p class="alg-text-h3">Secure payment 100% secure payment
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- category -->
    <?php include("pages/components/category.php") ?>

    <!-- best selling -->
    <section class="alg-bg-dark">
        <div class="d-flex justify-content-center m-0 p-0">
            <div class="col-10 p-0">
                <div class=" text-center pb-4 pt-3 px-3">
                    <span class="alg-text-h2 alg-text-gold fw-bold">LATEST PRODUCTS</span>
                    <div class="bestSellingSwiper swiper mySwiperBestSelling mt-4">
                        <div class="swiper-wrapper mx-auto py-2" id="mainLatestProductContainer">

                            <!-- slider goes here check home.js -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- about us -->
    <section class="alg-bg-light">
        <div class="container">
            <div class="py-2 pb-4">
                <div class="col-12 text-center p-0">
                    <div class="pt-3">
                        <span class="alg-text-h2 alg-text-dark fw-bold">ABOUT US</span>
                    </div>
                    <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3 mt-5">
                        <div class="col-12 col-lg-6 rounded-4 p-0 abtus-image-backdrop">
                            <img src="resources/images/aboutUsPerson.png" alt="" class="abtus-image-div w-100  rounded-5">
                        </div>
                        <div class="col-12 col-lg-6 desc-box scrollbar rounded-4">
                            <div>
                                <h4 class="mt-3 alg-text-tan">Journey of Sawee dessert.....</h4>
                                <p class="alg-text-light">
                                    Sawee Dessert started in 2014 as a small business and continues today with a successful 7-year
                                    journey. In the early stages, we managed to deliver the products to the customers through our
                                    trusted agent around the country. At the moment we have agents in Gampaha, Kandy, Yatiyanthota,
                                    and Anuradhapura. They managed to deliver the products within the mentioned areas while keeping
                                    the freshness and goodness. We can delivering dessert products to your hand within 36
                                    Hours of the order with the good care and quality of the products. It is a huge achievement that
                                    we have gained throughout this business journey.
                                    <br>
                                    <br>
                                    <br>
                                    We provide you with a quality, mouth watering and delicious dessert in a fair price range.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- testamonials -->
    <section class="alg-bg-dark py-4">
        <div class="container py-3">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center testm-main w-100 pt-2  px-5">
                <div class="py-2">
                    <span class="alg-text-h2 text-white fw-bold">TESTIMONIALS</span>
                </div>
                <div class="col-12 d-flex flex-lg-row flex-column justify-content-between align-items-center gap-3 m-2 p-0" id="containerTestimonial">
                    <!-- testimonials goes here -->
                </div>
            </div>
        </div>
    </section>

    <!-- contacts -->
    <section class="alg-bg-light">
        <div class="container pb-5 pt-1">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 text-center mt-lg-4">
                        <span class="alg-text-h2 alg-text-gold fw-bold">CONTACT US</span>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="row d-felx flex-column flex-md-row justify-content-center align-items-center gap-5">
                            <div class="col-10 col-md-5">
                                <div class="text-center d-flex justify-content-center">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31675.067775318512!2d79.99171349268948!3d7.081464785546644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2fb67a22e72d9%3A0x913a2c56a49c8d8e!2sGampaha!5e0!3m2!1sen!2slk!4v1692698348029!5m2!1sen!2slk" width="500" height="250" class="rounded-5" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                            <div class="col-12 col-md-5 d-flex flex-column gap-4">
                                <div class="row d-flex justify-content-center alg-button-hover cursor">
                                    <div class="col-10 col-md-11 col-lg-8">
                                        <div class="bg-white p-2 d-flex align-items-center gap-5 px-3 alg-div-hover rounded-4">
                                            <span><i class='bx bx-mobile fs-5 fw-bold'></i></span>
                                            <span class="fw-bold alg-text-h3">+94766773539</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-center alg-button-hover cursor">
                                    <div class="col-10 col-md-11 col-lg-8">
                                        <div class="bg-white p-2 d-flex align-items-center gap-5 px-3 alg-div-hover rounded-4">
                                            <span><i class='bx bxs-envelope fs-5 fw-bold'></i></span>
                                            <span class="fw-bold alg-text-h3">saweedessert@gmail.com</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-center alg-button-hover cursor">
                                    <div class="col-10 col-md-11 col-lg-8">
                                        <div class="bg-white p-2 d-flex align-items-center gap-5 px-3 alg-div-hover rounded-4">
                                            <span><i class="bi bi-geo-alt-fill fs-5 fw-bold"></i></span>
                                            <span class="fw-bold alg-text-h3">No : 244 balummahara,imbulgoda</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6 bg-lg-white p-2 d-flex gap-4 rounded-4 px-3 justify-content-center">
                                            <span><a class="text-decoration-none" href="https://www.facebook.com/profile.php?id=61552367446267&mibextid=ZbWKwL"><i class="bi bi-facebook alg-header-text fs-5 alg-text-hover cursor"></i></a></span>
                                            <span><a class="text-decoration-none" href="https://instagram.com/saweedessert?igshid=YzAwZjE1ZTI0Zg=="><i class="bi bi-instagram alg-header-text fs-5 alg-text-hover cursor"></i></a></span>
                                            <span><a class="text-decoration-none" href="https://wa.me/+94766773539"><i class="bi bi-whatsapp alg-header-text fs-5 alg-text-hover cursor"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <?php include("pages/components/footer.php") ?>
</body>

</html>