<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALG005 - savi dessert</title>

    <!-- css -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />


    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script defer src="./js/bootstrap.bundle.js"></script>
    <script defer src="./js/singleProduct.js"></script>
    <script defer src="./js/script.js"></script>
</head>

<body>
    <div class="">
        <div class="col-12">
            <?php include("pages/components/header.php") ?>

            <!-- Start singleProduct -->

            <div class="col-12 d-flex singleProduct-main">

                <div class="flex-column flex-lg-row col-12 d-flex justify-content-center align-items-center mt-5 mb-5">

                    <div
                        class="col-lg-5 order-2 order-lg-1 d-flex flex-column pt-4 pb-4 mx-5 mt-lg-0 mt-3 rounded-5 justify-content-center align-items-center singleProductImg-box">
                        <div class="col-11">
                            <div class="container ">
                                <div class="mySlides main-box ">
                                    <img src="https://cdn.pixabay.com/photo/2017/01/11/11/33/cake-1971552_1280.jpg"
                                        style="width:100%" class="rounded-5">
                                </div>

                                <div class="mySlides">
                                    <img src="https://cdn.pixabay.com/photo/2017/01/16/17/45/pancake-1984716_1280.jpg"
                                        style="width:100%" class="rounded-5">
                                </div>

                                <div class="mySlides">
                                    <img src="https://cdn.pixabay.com/photo/2017/12/01/16/14/cookies-2991174_1280.jpg"
                                        style="width:100%" class="rounded-5">
                                </div>

                                <div class="mySlides">
                                    <img src="https://cdn.pixabay.com/photo/2014/05/23/23/17/dessert-352475_1280.jpg"
                                        style="width:100%" class="rounded-5">
                                </div>
                            </div>

                            <div class="d-flex flex-row mt-4">
                                <div class="">
                                    <img class="demo cursor"
                                        src="https://cdn.pixabay.com/photo/2017/01/11/11/33/cake-1971552_1280.jpg"
                                        style="width:100%" onclick="currentSlide(1)" alt="The Woods">
                                </div>
                                <div class="">
                                    <img class="demo cursor"
                                        src="https://cdn.pixabay.com/photo/2017/01/16/17/45/pancake-1984716_1280.jpg"
                                        style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
                                </div>
                                <div class="">
                                    <img class="demo cursor"
                                        src="https://cdn.pixabay.com/photo/2017/12/01/16/14/cookies-2991174_1280.jpg"
                                        style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
                                </div>
                                <div class="">
                                    <img class="demo cursor"
                                        src="https://cdn.pixabay.com/photo/2014/05/23/23/17/dessert-352475_1280.jpg"
                                        style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-5 col-12 d-flex flex-column order-1 order-lg-2">
                        <div
                            class="col-12 d-flex flex-column justify-content-center justify-content-lg-start align-items-center align-items-lg-start mb-5">
                            <div>
                                <h2 class="fw-bolder singleProduct-title">Watalappan Delight</h2>
                            </div>
                            <div class="col-lg-2 my-3 singleProduct-tag text-white text-center rounded-5 p-1">
                                Category
                            </div>
                            <p class="px-4 px-lg-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat,
                                molestias ipsa
                                similique
                                sed
                                eaque commodi excepturi, nesciunt debitis enim, at est velit dicta nulla harum! Et natus
                                totam
                                nemo iste?</p>
                            <div
                                class="d-flex my-3 text-white p-2 px-2 singleProduct-tag justify-content-around align-items-center rounded-5">
                                <div class="px-3 fs-6">RATING</div>
                                <div class="bg-white d-flex rounded-end-5 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"
                                        fill="yellow">
                                        <path
                                            d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"
                                        fill="yellow">
                                        <path
                                            d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"
                                        fill="yellow">
                                        <path
                                            d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"
                                        fill="yellow">
                                        <path
                                            d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24"
                                        fill="yellow">
                                        <path
                                            d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- QTY Changer -->

                            <div class="qty-changer-main-div mt-3">
                                <div class="qty-changer-wrapper">
                                    <span class="minus" id="minusid">-</span>
                                    <span class="num" id="numid">01</span>
                                    <span class="plus" id="plusid">+</span>
                                </div>
                            </div>

                            <!-- QTY Changer -->

                            <!-- Items seletor -->

                            <div class="mt-4">
                                <select class="form-select">
                                    <option selected>select item</option>
                                    <option value="1">dry grapes</option>
                                    <option value="2">cashew</option>
                                    <option value="3">honey</option>
                                </select>
                            </div>

                            <!-- Items seletor -->

                        </div>
                        <div class="col-12 d-flex flex-column mt-1 justify-content-center justify-content-lg-start align-items-center align-items-lg-start">
                            <div class="col-12 d-flex justify-content-center justify-content-lg-start align-items-center align-items-lg-start">
                                <div class="col-5">
                                    <select class="form-select" aria-label="Default select example">
                                        <option value="1">250g</option>
                                        <option value="2">300g</option>
                                        <option value="3">500g</option>
                                        <option value="3">750g</option>
                                        <option value="3">1Kg</option>
                                    </select>
                                </div>
                                <div class="col-5 d-flex mx-3 p-2 justify-content-center align-items-center rounded-5 singleProduct-tag text-white">
                                    LKR 2500
                                </div>
                            </div>

                    </div>

                </div>

            </div>

            <!-- End singleProduct -->
            <section>

                <div class="col-12 alg-bg-dark">
                    <div class="d-flex justify-content-center">
                        <div class="col-10 col-md-8 pb-4 mt-3">
                            <div class="row">
                                <?php
                                for ($x = 0; $x < 3; $x++) {
                                ?>
                                    <div class="col-5 col-md-6 col-lg-4 d-flex justify-content-center mx-auto">
                                        <div class="col-12 col-md-2 col-lg-2 d-flex justify-content-end overflow-hidden flex-column ld-bs-card w-100">
                                            <div class="ld-bs-card-content d-flex flex-column text-start">
                                                <div class="d-flex gap-1 fw-bold justify-content-between">
                                                    <div class="text-white alg-text-h3">Product Title</div>
                                                    <div class="alg-text-h3">LKR 3000</div>
                                                </div>
                                                <div class="alg-text-h3 text-white">this is some little descrioption for
                                                    the product......</div>
                                                <div class="d-flex gap-2">
                                                    <i class="bi bi-star-fill text-warning fs-6"></i>
                                                    <i class="bi bi-star-fill text-warning fs-6"></i>
                                                    <i class="bi bi-star-fill text-warning fs-6"></i>
                                                    <i class="bi bi-star-fill text-warning fs-6"></i>
                                                    <i class="bi bi-star-fill text-white fs-6"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php include("pages/components/footer.php") ?>
            </div>
        </div>
</body>

</html>