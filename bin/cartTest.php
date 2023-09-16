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

    <div class="col-12 p-3 alg-bg-dark rounded-4">
        <div class="row d-flex justify-content-around align-items-center text-white p-2 px-4">
            <div class="col-8 col-md-8 col-lg-8 d-flex gap-3 m-0 p-0">
                <img src="resources/images/watchlist_img.png" alt="watchlist_img" class="watchlsit_img mt-2 mt-md-0">
                <div class="lh-1 m-0 p-0">
                    <span class="alg-text-h2 fw-semibold">${element.product_name}</span><br />
                    <span class="alg-text-h3">${element.category_type}</span>
                </div>
            </div>
            <div class="col-4 col-lg-4 d-flex gap-3 gap-lg-5 alg-text-h3 p-0 m-0">
                <span>${element.extra_fruit_name}</span>
                <span>${element.qty}</span>
                <span>${element.weight}</span>
                <span>LKR ${itemPrice}</span>
                <span class="mx-2 mx-lg-0"><i class="bi bi-trash-fill"
                        onclick="deleteCartProduct(${element.card_id});"></i></span>
            </div>
        </div>
    </div>
    <div class="col-5 col-md-3  text-white alg-bg-dark rounded-4">
        <div class="row">
            <div class="col-12 text-center bg-black rounded-top rounded-4">
                <span class="fw-semibold">Sub Total</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12 p-3">
                <span class="alg-text-h3">Discount 0%</span><br />
                <span class="alg-text-h2 fw-bold">LKR ${Total}</span>
            </div>
        </div>
    </div>

</body>

</html>