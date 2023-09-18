<?php
require_once("backend/model/SessionManager.php");
$sessionManager = new SessionManager();
$isLoggedIn = false;
$userData = null;
if ($sessionManager->isLoggedIn()) {
    $isLoggedIn = true;
    $userData = $sessionManager->getUserId();
}
?>

<header class="alg-bg-dark sticky-top ">
    <div class="container">
        <nav>
            <div class="position-relative px-lg-5">
                <div class="col-12 d-flex justify-content-between align-items-center m-0 px-0">
                    <a href="index.php" class="page-transition-button" data-target-page="index.php">
                        <div class="p-3">
                            <img src="resources/images/logo.png" alt="some thing went wrong" class="header-logo-img" />
                        </div>
                    </a>

                    <div class="d-none d-md-block d-lg-block">
                        <div class="d-flex gap-4 alg-cursor">
                            <div class="alg-bg-tan  px-5 py-1 rounded-4 position-absolute fw-bold alg-button-hover">
                                <span><a href="index.php" class="text-decoration-none text-black page-transition-button" data-target-page="index.php">Home</a></span>
                            </div>
                            <div class="alg-bg-light px-5 py-1 rounded-4 hd-marginLeft fw-bold alg-button-hover">
                                <span><a href="products.php" class="text-decoration-none text-black page-transition-button" data-target-page="products.php">Products</a></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 align-items-center">
                        <div class="d-none d-md-block d-lg-block mx-2 ">
                            <a href="#cart" class="alg-button-hover" onclick="openCartModel();"><i class="bi bi-cart-fill alg-text-gold fs-4 mx-3 alg-text-hover"></i></a>
                            <a href="#watchlist" onclick="openWatchlistModel();"><i class="bi bi-heart-fill alg-text-gold fs-4 alg-text-hover"></i></a>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center gap-3 alg-cursor">
                                <span class="rounded-circle"><i class="bi bi-whatsapp text-success fs-4"></i></i></span>
                                <div class="alg-user-Word alg-bg-gold">
                                    <?php
                                    if ($isLoggedIn) {
                                    ?>
                                        <span class="d-flex justify-content-center align-items-center fw-semibold"><a href="profileViewCard.php" class="text-decoration-none text-black page-transition-button" data-target-page="profileViewCard.php"><?php echo (substr($userData["full_name"], 0, 1)) ?></a></span>
                                    <?php
                                    } else {
                                    ?>

                                        <button type="button" class="btn btn-primary" onclick="openSignInModel()">CLICK</button>


                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="alg-toggle-button d-md-none d-lg-none fs-2">
                                <i class="bx bx-menu alg-text-gold alg-nav-hover"></i>
                            </div>
                        </div>
                    </div>

                </div>
                <div class=" text-center nav-box alg-bg-gold bg-opacity-50 position-static">
                    <div class="d-flex flex-column d-block d-md-none pb-3">
                        <span class="mt-3 alg-div-hover"><a href="index.php" class="text-decoration-none fw-semibold page-transition-button" data-target-page="index.php">Home</a></span>
                        <span class="mt-3 alg-div-hover"><a href="products.php" class="text-decoration-none fw-semibold page-transition-button" data-target-page="products.php">Products</a></span>
                        <span class="mt-3 alg-div-hover"><a href="#cart" class="text-decoration-none fw-semibold" onclick="openCartModel();">Cart</a></span>
                        <span class="mt-3 alg-div-hover" onclick="openWatchlistModel();"><a href="#watchlist" class="text-decoration-none fw-semibold">Watchlist</a></span>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<!--SignIn Modal -->
<div class="modal fade" id="signInModel" tabindex="-1" aria-labelledby="ALG-SignIn-Modal-Label" aria-hidden="true">
    <div class="modal-dialog p-0">
        <div class="modal-content rounded-5">
            <div class="modal-body p-0">
                <div class="rounded-5">
                    <div class="alg-model-head d-flex justify-content-between align-items-center p-3">
                        <h3 class="text-white">SIGN IN</h3>
                        <button class="alg-btn-circle alg-text-dark alg-bg-light fs-5 fw-bold" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x text-dark"></i></button>
                    </div>
                    <div class="alg-model-body p-3">
                        <div class="d-flex justify-content-center align-items-center col-12 p-0">
                            <div class="col-4 p-0">
                                <img src="resources/images/icons/ori-02.png" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" class="ALG-model-input form-control rounded-5" placeholder="Email address" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="password" class="form-control rounded-5" placeholder="Password" />
                            </div>

                            <!-- Submit button -->
                            <div class="d-flex justify-content-center align-items-center ">
                                <button class="p-2 mb-4 w-100 rounded-5 ALG-model-button text-white fw-bolder" onclick="signIn()">Sign In</button>
                            </div>

                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>Forgot your password?</p>
                            </div>

                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>Not a member? <button type="button" class="btn text-primary" onclick="openSignUpModel();">Register</button></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SignUp modal -->
<div class="modal fade" id="signUpModel" tabindex="-1" aria-labelledby="ALG-SignUp-Modal-Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ALG-main-model">
                <div class=" d-flex justify-content-center align-items-center flex-column pb-3">
                    <h3 class="text-white">SIGN UP</h3>
                </div>
                <div class="ALG-main-model2 p-3 rounded-5">

                    <div class="d-flex justify-content-center align-items-center col-12 p-0">
                        <div class="col-4 p-0">
                            <img src="../resources/images/icons/ori-02.png" class="img-fluid" alt="">
                        </div>
                    </div>

                    <form>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="signUp-email" class="ALG-model-input form-control rounded-5" placeholder="Email address" />
                        </div>

                        <!-- Full name -->
                        <div class="form-outline mb-4">
                            <input type="text" id="signUp-fullname" class="form-control rounded-5" placeholder="Full Name" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="signUp-password" class="form-control rounded-5" placeholder="Password" />
                        </div>


                        <div class="form-outline mb-4">
                            <input type="password" id="signUp-retypepassword" class="form-control rounded-5" placeholder="Retype the Password" />
                        </div>

                        <!-- Submit button -->
                        <div class="d-flex justify-content-center align-items-center ">
                            <button class="p-2 mb-4 w-100 rounded-5 ALG-model-button text-white fw-bolder" id="signupBtn" onclick="signUp();">Sign
                                up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- cart -->
<div class="modal fade modal-xl rounded-5" id="cartModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">


        <div class="modal-content alg-bg-light pb-3 rounded-4">
            <div class="modal-header alg-bg-dark">
                <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">CART</h1>
                <button type="button" class="rounded-circle d-flex justify-content-center p-1" data-bs-dismiss="modal" aria-label="Close"> <i class="bx bx-x fs-5 fw-bold"></i></button>
            </div>

            <div class="modal-body px-4">
                <div class="row bg-black text-white fw-bold rounded-5 px-4">
                    <div class="col-12 p-1">
                        <div class="d-flex justify-content-between alg-text-h2">
                            <div class="col-7 col-md-8 col-lg-7 m-0 p-0">
                                <span class="alg-text-h3">Product</span>
                            </div>
                            <div class="col-5 col-lg-5 col-md-5 d-flex justify-content-center gap-3 gap-md-4 gap-lg-5 m-0 p-0">
                                <span class="alg-text-h3">Weight</span>
                                <span class="alg-text-h3">QTY</span>
                                <span class="alg-text-h3">Price</span>
                                <!-- <span class="d-none d-md-block">Remove</span> -->
                                <span class="d-block"><i class="bi bi-trash-fill"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- cart main container -->
                <div class="row mt-2 gap-3" id="cartMainContainer">
                    <!-- cart items goes here -->
                </div>

                <!-- empty watchlist -->

                <div class="text-center alg-header-text alg-text-h2 mt-4 fw-bold" id="cartEmptyContainer">
                    <!-- empty section goes here -->
                </div>

                <!-- empty watchlsit -->
            </div>


            <div class="row d-flex justify-content-end mx-3" id="cartTotalContainer">
                <!-- Total Goes here -->
            </div>
        </div>
    </div>
</div>



<!-- watchlist -->
<div class="modal fade modal-xl" id="watchlist" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content alg-bg-light rounded-4">
            <div class="modal-header alg-bg-dark">
                <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">WATCHLIST</h1>
                <button type="button" class="rounded-circle d-flex justify-content-center p-1" data-bs-dismiss="modal" aria-label="Close"> <i class="bx bx-x fs-5 fw-bold"></i></button>
            </div>

            <div class="modal-body px-2 px-lg-3">
                <div class="w-100 bg-black text-white fw-bold rounded-5 m-0 px-5">
                    <div class="col-12">
                        <div class="d-flex justify-content-between alg-text-h2">
                            <div class="col-7 col-md-8 col-lg-7 m-0 p-0">
                                <span>Product</span>
                            </div>
                            <div class="col-5 col-lg-5 col-md-5 d-flex justify-content-center gap-3 gap-md-4 gap-lg-5 m-0 p-0">
                                <span>weight</span>
                                <span>Price</span>
                                <span>Remove</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- empty watchlist -->

                <div class="text-center alg-header-text alg-text-h2 mt-4 fw-bold" id="emptyWatchlistContainer">
                    <!-- empty watchlist Goes Here -->
                </div>

                <!-- empty watchlsit -->

                <div class="d-flex flex-column gap-3 pt-3" id="watchListMainContainer">
                    <!-- watchlist goes here -->
                </div>
            </div>
        </div>
    </div>
</div>