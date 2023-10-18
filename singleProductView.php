<?php
if (!isset($_GET["product_id"])) {
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sawee Dessert</title>

    <link rel="shortcut icon" href="resources/images/favicon.png">

    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/singleProduct.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />


    <!-- script -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script defer src="js/bootstrap.bundle.js"></script>
    <script defer src="js/singleProduct.js"></script>
    <script defer src="js/script.js"></script>
</head>

<body data-productid="<?php echo $_GET["product_id"] ?>" data-weight="<?php echo $_GET["weightId"] ?>">

    <!-- header -->
    <?php include("pages/components/header.php") ?>

    <!-- singleProduct -->
    <section class="alg-bg-light">
        <div class="container">
            <div class="col-12 d-flex">
                <div class="flex-column flex-lg-row col-12 d-flex justify-content-center align-items-center mt-4 mb-5 gap-lg-4">
                    <div class="d-flex w-100 justify-content-between">
                        <div class="d-lg-none mb-1 ">
                            <h2 class="fw-bolder singleProduct-titl" id="productTitle">...</h2>
                        </div>
                        <div class="d-lg-none d-block d-flex justify-content-end" onclick="productAddingWatchlist(<?php echo $_GET['product_id'] ?>,<?php echo $_GET['weightId'] ?>);">
                            <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" width="44" height="44" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="m14.121 19.337c-.467.453-.942.912-1.424 1.38-.194.189-.446.283-.697.283s-.503-.094-.697-.283c-4.958-4.813-9.303-8.815-9.303-12.54 0-3.348 2.582-5.177 5.234-5.177 1.831 0 3.636.867 4.766 2.563 1.125-1.688 2.935-2.554 4.771-2.554 2.649 0 5.229 1.815 5.229 5.168 0 .681-.144 1.37-.411 2.072-.375-.361-.798-.673-1.258-.925.113-.393.169-.773.169-1.147 0-2.52-1.933-3.668-3.729-3.668-1.969 0-3.204 1.355-4.159 2.694-.141.197-.369.314-.612.314-.243-.001-.471-.119-.611-.317-.953-1.347-2.165-2.699-4.155-2.7-.985 0-1.937.346-2.61.95-.735.658-1.124 1.602-1.124 2.727 0 2.738 3.046 5.842 8.5 11.127.346-.336.682-.663 1.007-.981.327.383.701.724 1.114 1.014zm3.38-9.335c2.58 0 4.499 2.107 4.499 4.499 0 2.58-2.105 4.499-4.499 4.499-2.586 0-4.5-2.112-4.5-4.499 0-2.406 1.934-4.499 4.5-4.499zm.5 3.999v-1.5c0-.265-.235-.5-.5-.5-.266 0-.5.235-.5.5v1.5h-1.5c-.266 0-.5.235-.5.5s.234.5.5.5h1.5v1.5c0 .265.234.5.5.5.265 0 .5-.235.5-.5v-1.5h1.499c.266 0 .5-.235.5-.5s-.234-.5-.5-.5z" fill-rule="nonzero" />
                            </svg>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start gap-5 mb-2 m-0 p-0 w-100">
                        <div class="d-lg-none col-lg-3 alg-bg-dark text-white text-center rounded-5 p-1 px-4" id="productCategory">
                            ....
                        </div>
                        <!-- <span class="position-relative">
                            <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" width="24" height="24" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="m14.121 19.337c-.467.453-.942.912-1.424 1.38-.194.189-.446.283-.697.283s-.503-.094-.697-.283c-4.958-4.813-9.303-8.815-9.303-12.54 0-3.348 2.582-5.177 5.234-5.177 1.831 0 3.636.867 4.766 2.563 1.125-1.688 2.935-2.554 4.771-2.554 2.649 0 5.229 1.815 5.229 5.168 0 .681-.144 1.37-.411 2.072-.375-.361-.798-.673-1.258-.925.113-.393.169-.773.169-1.147 0-2.52-1.933-3.668-3.729-3.668-1.969 0-3.204 1.355-4.159 2.694-.141.197-.369.314-.612.314-.243-.001-.471-.119-.611-.317-.953-1.347-2.165-2.699-4.155-2.7-.985 0-1.937.346-2.61.95-.735.658-1.124 1.602-1.124 2.727 0 2.738 3.046 5.842 8.5 11.127.346-.336.682-.663 1.007-.981.327.383.701.724 1.114 1.014zm3.38-9.335c2.58 0 4.499 2.107 4.499 4.499 0 2.58-2.105 4.499-4.499 4.499-2.586 0-4.5-2.112-4.5-4.499 0-2.406 1.934-4.499 4.5-4.499zm.5 3.999v-1.5c0-.265-.235-.5-.5-.5-.266 0-.5.235-.5.5v1.5h-1.5c-.266 0-.5.235-.5.5s.234.5.5.5h1.5v1.5c0 .265.234.5.5.5.265 0 .5-.235.5-.5v-1.5h1.499c.266 0 .5-.235.5-.5s-.234-.5-.5-.5z" fill-rule="nonzero" />
                            </svg>
                        </span> -->
                    </div>
                    <div class="col-lg-6 col-12 order-1 d-flex flex-column py-1 mx-5 rounded-5 justify-content-center align-items-center singleProductImg-box">
                        <div class="w-100 position-relative px-3">
                            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                                <div class="swiper-wrapper" id="singleProductViewImageSliderMain">

                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            <div thumbsSlider="" class="swiper mySwiper">
                                <div class="swiper-wrapper" id="singleProductViewImageSliderSecondary">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12 d-flex flex-column order-2">
                        <div class="col-12 d-flex flex-column justify-content-center justify-content-lg-start align-items-center align-items-lg-start mb-1 mb-lg-5">
                            <div class="d-none d-lg-block mb-1 order-lg-1">
                                <h2 class="fw-bolder singleProduct-titl" id="productTitleLargeScreen">....</h2>
                            </div>
                            <div class="d-flex justify-content-start align-item-center gap-5 mb-2 m-0 p-0 order-lg-2">
                                <div class="col-lg-7 alg-bg-dark d-none d-lg-block text-white text-center rounded-5 p-1 px-4" id="productCategoryLargeScreen">.....</div>
                                <!-- wishlist adding item -->
                                <span class="d-none d-lg-block " onclick="productAddingWatchlist(<?php echo $_GET['product_id'] ?>,<?php echo $_GET['weightId'] ?>);">
                                    <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" width="24" height="24" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m14.121 19.337c-.467.453-.942.912-1.424 1.38-.194.189-.446.283-.697.283s-.503-.094-.697-.283c-4.958-4.813-9.303-8.815-9.303-12.54 0-3.348 2.582-5.177 5.234-5.177 1.831 0 3.636.867 4.766 2.563 1.125-1.688 2.935-2.554 4.771-2.554 2.649 0 5.229 1.815 5.229 5.168 0 .681-.144 1.37-.411 2.072-.375-.361-.798-.673-1.258-.925.113-.393.169-.773.169-1.147 0-2.52-1.933-3.668-3.729-3.668-1.969 0-3.204 1.355-4.159 2.694-.141.197-.369.314-.612.314-.243-.001-.471-.119-.611-.317-.953-1.347-2.165-2.699-4.155-2.7-.985 0-1.937.346-2.61.95-.735.658-1.124 1.602-1.124 2.727 0 2.738 3.046 5.842 8.5 11.127.346-.336.682-.663 1.007-.981.327.383.701.724 1.114 1.014zm3.38-9.335c2.58 0 4.499 2.107 4.499 4.499 0 2.58-2.105 4.499-4.499 4.499-2.586 0-4.5-2.112-4.5-4.499 0-2.406 1.934-4.499 4.5-4.499zm.5 3.999v-1.5c0-.265-.235-.5-.5-.5-.266 0-.5.235-.5.5v1.5h-1.5c-.266 0-.5.235-.5.5s.234.5.5.5h1.5v1.5c0 .265.234.5.5.5.265 0 .5-.235.5-.5v-1.5h1.499c.266 0 .5-.235.5-.5s-.234-.5-.5-.5z" fill-rule="nonzero" />
                                    </svg>
                                </span>
                            </div>

                            <p class="px-2 my-2 my-lg-3 mx-auto text-start w-100 alg-text-p order-2 order-lg-3" id="productDescription">.......</p>

                            <div class="d-flex my-1 text-white p-2 px-2 alg-bg-dark justify-content-start justify-content-lg-around align-items-center rounded-5 order-1 order-lg-4 align-self-start">
                                <div class="px-3 alg-text-h3">RATING</div>
                                <div class="bg-whit d-flex rounded-end-5 p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="yellow">
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="yellow">
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="yellow">
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="yellow">
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="yellow">
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Items seletor -->

                            <div class="order-3 order-lg-5 col-12 d-flex flex-lg-column gap-2">
                                <div class="mt-3 mt-lg-4 col-6 col-lg-5 mb-3 mb-lg-1">
                                    <select class="item-selector-outline w-100 p-2 rounded-2" id="extraItemContainer" onchange="singleProductPriceCalculation();">
                                        <!-- option goes here -->
                                    </select>
                                </div>


                                <!-- QTY Changer -->
                                <span class="mt-4 alg-text-h3 fw-semibold d-none d-lg-block">Quantity</span>
                                <div class="qty-changer-main-div mt-lg-1 col-6 col-lg-3 m-0 p-0">
                                    <div class="qty-changer-wrapper col-12 col-lg-5">
                                        <span class="minus" id="minusid">-</span>
                                        <span class="num alg-text-h3 fw-bold" id="numid">1</span>
                                        <span class="plus" id="plusid">+</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12 col-lg-10 d-flex flex-column mt-0 justify-content-center justify-content-lg-start align-items-center align-items-lg-start bg-danger"> -->
                        <div class="col-12 col-lg-10 d-flex justify-content-center justify-content-lg-start align-items-center align-items-lg-start gap-2">
                            <div class="col-6 col-lg-6">
                                <select class="item-selector-outline w-100 p-2 rounded-5" id="loadWeightContainer" aria-label="Default select example" onchange="changeProductItemForWeight(<?php echo $_GET['product_id'] ?>);">
                                    <!-- weight goes here -->
                                </select>
                            </div>
                            <div class="col-6 col-lg-6 d-flex mx-0 p-2 mt-lg-0 justify-content-center align-items-center rounded-5 alg-bg-dark text-white" id="productPrice">

                            </div>
                        </div>

                        <!-- </div> -->
                        <div class=" col-12 col-lg-10 d-grid mt-3 mt-lg-4">
                            <button type="button" class="alg-bg-tan border-0 rounded-5 p-2 fw-bolder" onclick="addToCartItem(<?php echo $_GET['product_id'] ?>,<?php echo $_GET['weightId'] ?>);"> Add to cart </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- singleProduct -->
    <section class="alg-bg-dark">
        <div class="container py-2">
            <div class="w-100 my-3">
                <h2 class="alg-text-h2 fw-bold alg-text-light ps-2">Related Items</h2>
            </div>
            <div class="w-100 d-flex flex-wrap flex-column flex-md-row" id="relatedProductsContainer">
                <?php
                for ($x = 0; $x < 3; $x++) {
                ?>
                    <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center mx-0 p-0">
                        <div class="row m-0 w-100 p-2">
                            <div class="col-12 d-flex justify-content-end overflow-hidden flex-column alg-bg-tan ld-bs-card w-100 p-0 placeholder-wave"></div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include("pages/components/footer.php") ?>
</body>

</html>