<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Savi Dessert</title>

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="bin/adminComponents.css">

    <!-- js -->
    <script defer src="js/bootstrap.bundle.js"></script>
    <script defer src="bin/adminComponent.js"></script>
    <script defer src="js/main.js"></script>
</head>

<body class="alg-bg-dark alg-h-100vh d-flex flex-column justify-content-between">

    <!-- navigation -->
    <div class="alg-bg-darker">
        <div class="container py-2 d-flex justify-content-between alg-text-light">
            <div class="d-flex fs-3 align-items-center justify-content-between gap-2">
                <div class="w-100">
                    <i class=" bi bi-x" id="navigationIcon"></i>
                </div>
                <div class="logo fw-bold fs-3">SAVI</div>
            </div>
            <div class="d-none d-md-flex align-items-center justify-content-center w-100">
                <button class="btn alg-btn-pill mx-3">something1</button>
                <button class="btn alg-btn-pill mx-3">something2</button>
            </div>
            <div class="border-start alg-text-h2 d-flex gap-2 px-2 align-items-center justify-content-between">
                <i class=" bi bi-bell-fill"></i>
                <i class=" bi bi-gear-fill"></i>
                <i class=" bi bi-person-circle"></i>
            </div>
        </div>
    </div>

    <!-- content -->
    <div class="alg-bg-dark d-flex flex-grow-1 position-relative alg-text-light">
        <div class="alg-sm-position-ablsolute col-8 h-100 col-md-4 col-lg-3 col-xl-2 p-3" id="navigationSection">
            <div class="rounded-3 alg-bg-darker px-3 py-4 h-100 alg-shadow navigation-sidebar">
                <button class="alg-btn-pill my-2 w-100">Navigation 1</button>
                <button class="alg-btn-pill my-2 w-100">Navigation 2</button>
                <button class="alg-btn-pill my-2 w-100">Navigation 3</button>
                <button class="alg-btn-pill my-2 w-100">Navigation 4</button>
                <button class="alg-btn-pill my-2 w-100">Navigation 5</button>
                <button class="alg-btn-pill my-2 w-100">Navigation 6</button>
            </div>
        </div>
        <div class=" col-12 col-md-8  col-lg-9 col-xl-10 p-3" id="contentSection">
            <div class="rounded-3 alg-bg-dark h-100 alg-shadow d-flex flex-column p-3 gap-2">
                <div class="alg-bg-tan py-2 px-5 rounded-pill">
                    <h5 class="d-grid alg-text-dark text-center fw-bold fs-5">Admin Panel Title Goes Here</h5>
                </div>
                <hr class="content-divider py-0 m-0">
                <div class="flex-grow-1 rounded-3 d-flex flex-column gap-2">
                    <section class="w-100 d-flex flex-wrap">
                        <div class="col-12 col-lg-6 p-2">
                            <div class="w-100 rounded-4 alg-bg-tan p-3">1 <br> <br> <br> <br> <br> </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="w-100 rounded-4 alg-bg-tan p-3">1 <br> <br> <br> <br> <br> </div>
                        </div>
                    </section>
                    <section class="w-100 d-flex flex-wrap">
                        <div class="col-6 col-lg-3 p-2">
                            <div class="w-100 rounded-4 alg-bg-tan p-3"><br> <br> <br> <br> <br></div>
                        </div>
                        <div class="col-6 col-lg-3 p-2">
                            <div class="w-100 rounded-4 alg-bg-tan p-3">1</div>
                        </div>
                        <div class="col-6 col-lg-3 p-2">
                            <div class="w-100 rounded-4 alg-bg-tan p-3">1</div>
                        </div>
                        <div class="col-6 col-lg-3 p-2">
                            <div class="w-100 rounded-4 alg-bg-tan p-3">1</div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->

    <footer class="alg-bg-darker">
        <div class="container">
            <div class="py-1 text-center text-white alg-text-p py-3 mt-2">
                All rights reserved 2023 &copy;
            </div>
        </div>
    </footer>
</body>

</html>