<?php
require_once("backend/model/SessionManager.php");
$sessionManager = new SessionManager();
$isLoggedIn = false;
$userData = null;
if ($sessionManager->isLoggedIn()) {
    $isLoggedIn = true;
    $userData = $sessionManager->getUserId();
}

$currentPage = substr($_SERVER["SCRIPT_NAME"], 1, -4);
$currentCategory = (isset($_GET["category"])) ? $_GET["category"] : null;
?>

<header class="alg-bg-dark sticky-top">
    <div class="container">
        <nav>
            <div class="position-relative px-lg-5">
                <div class="col-12 d-flex justify-content-between align-items-center m-0 px-0">
                    <a href="index.php">
                        <div class="px-3 py-2">
                            <img src="resources/images/logo3.png" alt="some thing went wrong" class="header-logo-img" />
                        </div>
                    </a>

                    <div class="d-none d-md-block d-lg-block">
                        <div class="d-flex alg-bg-light rounded-pill fs-5">
                            <a href="index.php" class="text-decoration-none text-black">
                                <div class="alg-bg-tan px-5 py-1 rounded-pill header-btn fw-bold <?php echo ($currentPage === "index") ? "header-btn-selected" : "" ?> ">
                                    <span class="d-none d-lg-block fs-6">Home</span><i class="d-block d-lg-none bi bi-house"></i>
                                </div>
                            </a>
                            <a href="products.php" class="text-decoration-none text-black">
                                <div class="alg-bg-light px-5 py-1 rounded-pill header-btn fw-bold <?php echo ($currentPage === "products" && $currentCategory !== "Jelly") ? "header-btn-selected" : "" ?> ">
                                    <span class="d-none d-lg-block fs-6">Shop</span><i class="d-block d-lg-none bi bi-shop"></i>
                                </div>
                            </a>
                            <a href="products.php?category=Ingredients" class="text-decoration-none text-black">
                                <div class="alg-bg-light px-5 py-1 rounded-pill header-btn fw-bold <?php echo ($currentPage === "products" && $currentCategory === "Jelly") ? "header-btn-selected" : "" ?> ">
                                    <span class="d-none d-lg-block fs-6">Ingredients</span><i class="d-block d-lg-none bi bi-heart"></i>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="d-flex gap-3 align-items-center">
                        <div class="d-none d-md-block d-lg-block mx-2 " id="cartRow">
                            <!-- cart opening section goes here check script.js line 786 -->
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center gap-3 alg-cursor">
                                <span class="rounded-circle"><i class="bi bi-whatsapp text-success fs-4"></i></span>
                                <div class="alg-user-Word alg-bg-gold">
                                    <?php
                                    if ($isLoggedIn) {
                                    ?>
                                        <span class="d-flex justify-content-center align-items-center fw-semibold"><a href="profileViewCard.php" class="text-decoration-none text-black">
                                                <?php echo (substr($userData["full_name"], 0, 1)) ?>
                                            </a></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="d-flex justify-content-center align-items-center" onclick="openSignInModel()"><i class="bi bi-person-fill fs-5 alg-text-light alg-text-hove"></i></span>
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
            </div>
        </nav>
    </div>
    <div class="d-flex d-md-none text-center nav-box alg-bg-gold bg-opacity-50 position-static">
        <div class="flex-column text-center w-100 d-flex">
            <span class="py-2"><a href="index.php" class="alg-text-dark text-decoration-none fw-semibold">Home</a></span>
            <span class="py-2"><a href="products.php" class="alg-text-dark text-decoration-none fw-semibold">Products</a></span>
            <span class="py-2"><a href="#cart" class="alg-text-dark text-decoration-none fw-semibold" onclick="openCartModel();">Cart</a><span class="translate-middle rounded-pill badge bg-danger header-badge position-absolute d-none d-lg-block">+</span></span>
            <span class="py-2" onclick="openWatchlistModel();"><a href="#watchlist" class="alg-text-dark text-decoration-none fw-semibold">Watchlist</a></span>
        </div>
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
                                <p class="alg-cursor" onclick="openForgotPassword();">Forgot your password?</p>
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

<!-- forgot password model -->
<div class="modal fade" id="forgotPasswordModel" tabindex="-1" aria-labelledby="ALG-SignIn-Modal-Label" aria-hidden="true">
    <div class="modal-dialog p-0">
        <div class="modal-content rounded-5">
            <div class="modal-body p-0">
                <div class="rounded-5">
                    <div class="alg-model-body p-3 rounded-5 d-flex flex-column align-items-center">
                        <div class="text-center">
                            <span class="alg-text-h2 fw-bold">Forgot password?</span>
                            <p class="alg-text-h3 text-black-50">No worries, we will send you reset instructions.</p>

                            <div class="text-start">
                                <span class="alg-text-h3 fw-semibold">Email</span>
                                <input type="email" id="forgottenPasswordEmail" class="ALG-model-input alg-text-h3 form-control rounded-5" placeholder="Email address" />
                                <button id="mainButton"  class="p-2 mb-3 w-100 rounded-5 ALG-model-button alg-text-h3 text-white fw-bolder mt-2 mt-md-3" onclick="passwordReset();">
                                    <span class="spinner-border spinner-border-sm d-none" aria-hidden="true"></span>
                                    <span role="status">Reset Password</span>
                                </button>
                                <p class="alg-text-h3 text-center alg-cursor" onclick="openSignInModel();"><i class="bi bi-arrow-left"></i> Back to Sign In</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- password reset model -->
<div class="modal fade" id="passwordResetModel" tabindex="-1" aria-labelledby="ALG-SignIn-Modal-Label" aria-hidden="true">
    <div class="modal-dialog p-0">
        <div class="modal-content rounded-5">
            <div class="modal-body p-0">
                <div class="rounded-5">
                    <div class="alg-model-body p-3 rounded-5 px-5">
                        <div class="text-center">
                            <span class="alg-text-h2 fw-bold">Password Reset</span>
                            <p class="alg-text-h3 text-black-50">We sent a code to abc@gmail.com</p>

                            <div class="text-start">
                                <span class="alg-text-h3 fw-semibold">Verification code</span>
                                <span class="alg-text-h3 fw-semibold" id="verificationSendingTimeRunner">30</span>
                                <input type="text" id="verification_code" class="ALG-model-input alg-text-h3 form-control rounded-5" placeholder="code" />
                                <button class="p-2 mb-3 w-100 rounded-5 alg-text-h3 ALG-model-button text-white fw-bolder mt-2 mt-md-3" onclick="passwordSet();">Next</button>
                                <p class="alg-text-h3 text-center alg-cursor" onclick="verificationSendAgain();">Didn't receive the email? <a href="#">Click to resend</a></p>
                                <p class="alg-text-h3 text-center alg-cursor" onclick="openSignInModel();"><i class="bi bi-arrow-left"></i> Back to Sign In</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- set password model -->
<div class="modal fade" id="passwordSetModel" tabindex="-1" aria-labelledby="ALG-SignIn-Modal-Label" aria-hidden="true">
    <div class="modal-dialog p-0">
        <div class="modal-content rounded-5">
            <div class="modal-body p-0">
                <div class="rounded-5">
                    <div class="alg-model-body p-3 rounded-5">
                        <div class="text-center px-5">
                            <span class="alg-text-h2 fw-bold">Set new password</span>
                            <p class="alg-text-h3 text-black-50">Must be at least 8 characters</p>

                            <div class="text-start">

                                <span class="alg-text-h3 fw-semibold">Password</span>
                                <input type="password" id="fg-password" class="ALG-model-input form-control alg-text-h3 rounded-5 mb-3" placeholder="password" />

                                <span class="alg-text-h3 fw-semibold">Confirm Password</span>
                                <input type="password" id="fg-confirm_password" class="ALG-model-input alg-text-h3 form-control rounded-5" placeholder="confirm password" />

                                <button class="p-2 mb-3 w-100 rounded-5 alg-text-h3 ALG-model-button text-white fw-bolder mt-2 mt-md-3" onclick="passwordResetLast();">Reset password</button>
                                <p class="alg-text-h3 text-center alg-cursor" onclick="openSignInModel();"><i class="bi bi-arrow-left"></i> Back to Sign In</p>
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
        <div class="modal-content  rounded-5">
            <div class=" col-12 alg-bg-dark  rounded-5">
                <div class="alg-model-head d-flex justify-content-between align-items-center p-3">
                    <h3 class="text-white">SIGN UP</h3>
                    <button class="alg-btn-circle alg-text-dark alg-bg-light fs-5 fw-bold" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x text-dark"></i></button>
                </div>
            </div>
            <div class="modal-body ALG-main-model alg-model-body">
                <div class="ALG-main-model2 p-2 rounded-5">

                    <div class="d-flex justify-content-center align-items-center col-12 p-0">
                        <div class="col-4 p-0">
                            <img src="../resources/images/icons/ori-02.png" class="img-fluid" alt="">
                        </div>
                    </div>


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

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="defaultCheck1" onclick="activateSignUpBtn();">
                        <label class="form-check-label" for="flexRadioDefault1">
                            I agree to <a href="termsAndCondition.php">Terms & Conditions</a>
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input checked class="form-check-input" type="checkbox" id="defaultCheck2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Do you agree to use your email for marketing news ?
                        </label>
                    </div>

                    <!-- Submit button -->
                    <div class="d-flex justify-content-center align-items-center ">
                        <button class="p-2 mb-4 w-100 rounded-5 ALG-model-button text-white fw-bolder" onclick="signUp();" id="signUpBtn" disabled>Sign up</button>
                    </div>

                    <!-- Sign In buttons -->
                    <div class="text-center">
                        <p>Go back to ? <button type="button" class="btn text-primary" onclick="goBackToSignIn();">Sign
                                In</button></p>
                    </div>

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
<!-- toast mode -->
<?php include("pages/components/toastMessage.php") ?>