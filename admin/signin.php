<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sawee Dessert | log In</title>

    <!-- css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="css/adminComponents.css">

    <style>
        .signin-container {
            min-height: 200px;
            background-color: var(--darker);
        }
    </style>

    <!-- js -->
    <script defer src="js/bootstrap.bundle.js"></script>
    <script defer src="https://unpkg.com/@popperjs/core@2"></script>
    <script defer src="js/adminComponent.js"></script>
    <script defer src="js/signIn.js"></script>

</head>

<body class="alg-bg-dark alg-h-100vh d-flex flex-column justify-content-between">


    <!-- signup body -->
    <div class="flex-grow-1 d-flex justify-content-center align-items-center rounded-4">
        <div class="signin-container col-12 col-md-8 col-lg-4 rounded-4 alg-text-gold p-3 text-center">
            <h2 class="fw-bold">Sawee Dessert </h2>
            <h5>Admin Dashboard Login</h5>
            <hr>
            <div>
                <div class="d-flex flex-column text-start mt-2">
                    <label class="fw-bold form-label" for="mobile">Mobile</label>
                    <input class="form-control" type="text" id="mobile" placeholder="enter your mobile">
                </div>
                <div class="d-flex flex-column text-start mt-2">
                    <label class="fw-bold form-label" for="password">Password</label>
                    <input class="form-control" type="password" id="password" placeholder="enter admin password">
                </div>
                <button onclick="signIn()" type="submit" class="mt-4 w-100 btn alg-btn-pill">Sign In</button>
            </div>
        </div>
    </div>

    <!-- utility -->
    <!-- model -->
    <div class="modal" tabindex="-1" id="dashBoardModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelTitle">Modal title</h5>
                    <button type="button" class="bg-transparent border-0 d-flex justify-content-center align-items-center alg-rounded-large alg-text-dark" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle-fill" style="font-size: 26px;"></i></button>
                </div>
                <div class="modal-body" id="modelBody">

                </div>
                <div class="modal-footer" id="modelFooter">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- message toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="dashBoardToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i id="toastIcon" class=""></i>
                <strong class="me-auto" id="toastTitle">Bootstrap</strong>
                <small id="toastTime">11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastBody">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>

    <!-- tooltip -->
    <div class="tooltip py-1 px-2 opacity-50 alg-rounded-small alg-bg-light alg-text-dark" id="tooltip" role="tooltip">
        <div data-popperbody="">I'm a tooltip</div>
        <div id="arrow" data-popper-arrow></div>
    </div>

    <!-- dropdowns -->
    <div class="dropdown-center" id="dropdown">
        <ul class="dropdown-menu alg-bg-light alg-rounded-small p-2">

        </ul>
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