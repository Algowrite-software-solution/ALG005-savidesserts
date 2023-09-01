<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALG005 - savi dessert</title>

    <!-- css -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- script -->
    <script defer src="../js/bootstrap.bundle.js"></script>
    <script defer src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</head>

<body>

    <!-- Footer Start -->

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ALG-SignIn-Modal">
        Click
    </button>

    <!--SignIn Modal -->
    <div class="modal fade" id="ALG-SignIn-Modal" tabindex="-1" aria-labelledby="ALG-SignIn-Modal-Label"
        aria-hidden="true">
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
                                <img src="../resources/images/icons/ori-02.png" class="img-fluid" alt="">
                            </div>
                        </div>

                        <form>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="form2Example1" class="ALG-model-input form-control rounded-5"
                                    placeholder="Email address" />

                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="form2Example2" class="form-control rounded-5"
                                    placeholder="Password" />

                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="form2Example2" class="form-control rounded-5"
                                    placeholder="Retype the Password" />

                            </div>

                            <!-- Submit button -->
                            <div class="d-flex justify-content-center align-items-center ">
                                <button type="submit"
                                    class="p-2 mb-4 w-100 rounded-5 ALG-model-button text-white fw-bolder">Sign
                                    in</button>
                            </div>

                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>Not a member? <button type="button" class="btn text-primary" data-bs-toggle="modal"
                                        data-bs-target="#ALG-SignUp-Modal">
                                        Register
                                    </button></p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--SignIn Modal -->

    <!-- SignUp modal -->

    <div class="modal fade" id="ALG-SignUp-Modal" tabindex="-1" aria-labelledby="ALG-SignUp-Modal-Label"
        aria-hidden="true">
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
                                <input type="email" id="signUp-email" class="ALG-model-input form-control rounded-5"
                                    placeholder="Email address" />

                            </div>

                            <!-- Full name -->
                            <div class="form-outline mb-4">
                                <input type="text" id="signUp-fullname" class="form-control rounded-5"
                                    placeholder="Full Name" />

                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="signUp-password" class="form-control rounded-5"
                                    placeholder="Password" />

                            </div>


                            <!-- Submit button -->
                            <div class="d-flex justify-content-center align-items-center ">
                                <button type="submit"
                                    class="p-2 mb-4 w-100 rounded-5 ALG-model-button text-white fw-bolder">Sign
                                    up</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SignUp modal -->

</body>

</html>