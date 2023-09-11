<section class="bg-black text-black">
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ALG-SignIn-Modal">Click</button>

        <!--SignIn Modal -->
        <div class="modal fade" id="ALG-SignIn-Modal" tabindex="-1" aria-labelledby="ALG-SignIn-Modal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ALG-main-model">
                        <div class=" d-flex justify-content-center align-items-center flex-column pb-3">
                            <h3 class="text-white">SIGN IN</h3>
                        </div>
                        <div class="ALG-main-model2 p-3 rounded-5">

                            <div class="d-flex justify-content-center align-items-center col-12 p-0">
                                <div class="col-4 p-0">
                                    <img src="resources/images/icons/ori-02.png" class="img-fluid" alt="">
                                </div>
                            </div>

                            <form>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="form2Example1" class="ALG-model-input form-control rounded-5" placeholder="Email address" />

                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="form2Example2" class="form-control rounded-5" placeholder="Password" />

                                </div>

                                <!-- Submit button -->
                                <div class="d-flex justify-content-center align-items-center ">
                                    <button type="submit" class="p-2 mb-4 w-100 rounded-5 ALG-model-button text-white fw-bolder">Sign
                                        in</button>
                                </div>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <button type="button" class="btn text-primary" data-bs-toggle="modal" data-bs-target="#ALG-forgotPassword-Modal">
                                        <p>Forgot your password?</p>
                                    </button>
                                </div>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>Not a member? <button type="button" class="btn text-primary" data-bs-toggle="modal" data-bs-target="#ALG-SignUp-Modal">
                                            Register
                                        </button></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SignUp modal -->
        <div class="modal fade" id="ALG-SignUp-Modal" tabindex="-1" aria-labelledby="ALG-SignUp-Modal-Label" aria-hidden="true">
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

        <!--forgotPassword Modal -->
        <div class="modal fade" id="ALG-forgotPassword-Modal" tabindex="-1" aria-labelledby="ALG-forgotPassword-Modal-Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ALG-main-model">
                        <div class=" d-flex justify-content-center align-items-center flex-column pb-3">
                            <h3 class="text-white">Forgot Your password?</h3>
                        </div>
                        <div class="ALG-main-model2 p-3 rounded-5">

                            <p class="m-2 mb-4">If you have forgotten your password, you can reset it here.</p>

                            <form>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="#" class="ALG-model-input form-control rounded-5" placeholder="Email address" />

                                </div>

                                <!-- Submit button -->
                                <div class="d-flex justify-content-center align-items-center ">
                                    <button type="submit" class="p-2 mb-4 w-100 rounded-5 ALG-model-button text-white fw-bolder">Reset
                                        Password</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!--forgotPassword Modal -->
        </div>
    </div>
</section>